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
        return $this->getFile('logo') ?:  asset('images/no-image.jpg');
    }

    public function getCategoryIcon($name)
    {
        return $this->getFile('categories', true, $name) ?:  asset('images/no-image.jpg');
    }
}
