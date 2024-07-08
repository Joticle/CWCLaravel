<?php

namespace App\Models\Traits\User;

trait Attributes
{

    public function getThumbnail()
    {
        return $this->getFile('thumbnail') ?:  asset('images/profile.png');
    }
}
