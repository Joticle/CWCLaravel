<?php

namespace App\Models\Traits\Trust;

trait Attributes
{
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function getButtonAttribute($value)
    {
        return json_decode($value);
    }


    public function getImage()
    {
        return $this->getFile('image') ?:  asset('images/no-image.jpg');
    }
}
