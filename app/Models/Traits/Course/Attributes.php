<?php

namespace App\Models\Traits\Course;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait Attributes
{

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function getBadgeClassAttribute()
    {
        if ($this->level === 'Beginner')
            return 'info';
        else if ($this->level === 'Intermediate')
            return 'success';
        else
            return 'danger';
    }

    public function getLogo()
    {
        return $this->getFile('logo') ?:  asset('images/no-image.jpg');
    }

    public function getLink()
    {
        return route('course.detail', $this->slug);
    }

    public function enrolled()
    {
        $enrolled_courses = \auth()->user()->courseEnrolled->pluck('course_id')->toArray();
        if (in_array($this->id, $enrolled_courses)) {
            return true;
        }
        return false;
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->wishlist()->where('user_id', Auth::id())->exists();
    }

    public function getformatTagsAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : null;
    }

    public function getdurationAttribute()
    {
        return Carbon::parse($this->start_date)->diffForHumans(Carbon::parse($this->end_date), true);
    }
}
