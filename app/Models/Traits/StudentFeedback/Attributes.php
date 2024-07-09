<?php

namespace App\Models\Traits\StudentFeedback;

use App\Models\StudentsFeedback;

trait Attributes
{

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function getImage()
    {
        return $this->getFile('image') ?:  asset('images/no-image.jpg');
    }

    public function getRatingHtmlAttribute()
    {
        $rating = $this->rating;
        $html = '<ul class="stars list-inline">';
        $ratings = StudentsFeedback::RATINGS;
        foreach (array_slice($ratings, 1) as $value) {
            if ($value <= $rating) {
                $html .= '<li class="list-inline-item"><i class="fa fa-star"></i></li>';
            } else {
                $html .= '<li class="list-inline-item"><i class="text-dark fa fa-star"></i></li>';
            }
        }
        $html .= '</ul>';

        return $html;
    }
}
