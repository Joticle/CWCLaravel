<?php

namespace App\Models\Traits\User;

trait Attributes
{

    public function getThumbnail()
    {
        $value = $this->thumbnail;
        if ($value != "") {
            $uploadingPath = public_path('/uploads/user/' . $this->id);
            return asset('/uploads/user/' . $this->id . '/' . $value);
        } else {
            return asset('images/profile.png');
        }
    }
}
