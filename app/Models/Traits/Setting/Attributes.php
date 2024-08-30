<?php

namespace App\Models\Traits\Setting;

trait Attributes
{
    public function getFavicon()
    {
        return $this->favicon ? $this->getFile('favicon') :  asset('site-assets/images/fav.png');
    }

    public function getLogo()
    {
        return $this->logo ? $this->getFile('logo') :  asset('images/logo-transparent.png');
    }

    public function getOwnerImage()
    {
        return $this->owner_image ? $this->getFile('owner_image') :  asset('site-assets/images/about/01.png');
    }

}
