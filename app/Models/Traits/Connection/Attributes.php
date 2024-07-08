<?php

namespace App\Models\Traits\Connection;

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

    public function getCategoriesAttribute($value)
    {
        return json_decode($value);
    }

    public function getLogo()
    {
        $value = $this->logo;
        if ($value != "") {
            return asset('/uploads/connections/' . $this->id . '/' . $value);
        } else {
            return asset('images/no-image.jpg');
        }
    }

    public function getCategoryIcon($name)
    {
        if ($name != "") {
            return asset('/uploads/connections/' . $this->id . '/categories/' . $name);
        } else {
            return asset('images/no-image.jpg');
        }
    }
}
