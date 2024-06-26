<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsFeedback extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    const RATINGS = ['0' => '0','1' => '1','2' => '2','3' => '3','4' => '4','5' => '5'];

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function getImage(){
        $value = $this->image;
        if($value != ""){
            $uploadingPath = public_path('/uploads/students/'.$this->id);
            return asset('/uploads/students/'.$this->id.'/'.$value);
        } else {
            return asset('images/no-image.jpg');
        }
    }

    public function getRatingHtmlAttribute()
    {
        $rating = $this->rating;
        $html = '<ul class="stars">';
        $ratings = self::RATINGS;
        foreach (array_slice($ratings, 1) as $value) {
            if ($value <= $rating) {
                $html .= '<li><i class="fa-sharp fa-solid fa-star"></i></li>';
            } else {
                $html .= '<li><i class="fa-sharp fa-regular fa-star"></i></li>';
            }
        }

        $html .= '</ul>';

        return $html;
    }
}
