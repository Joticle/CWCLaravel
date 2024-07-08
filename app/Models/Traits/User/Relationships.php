<?php

namespace App\Models\Traits\User;

use App\Models\Courses;

trait Relationships
{

    public function AauthAcessToken()
    {
        return $this->hasMany('\App\Models\OauthAccessToken');
    }
    public function courseEnrolled()
    {
        return $this->hasMany('\App\Models\CourseEnroll', 'user_id')->where('status', '=', 'Paid');
    }
    public function courseOrders()
    {
        return $this->hasMany('\App\Models\CourseEnroll', 'user_id');
    }

    public function wishlist()
    {
        return $this->belongsToMany(Courses::class, 'wishlists', 'user_id', 'course_id')->withTimestamps();
    }
}
