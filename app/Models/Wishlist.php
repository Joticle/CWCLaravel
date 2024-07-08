<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\WhishList\Attributes;
use App\Models\Traits\WhishList\Relationships;

class Wishlist extends Model
{
    use HasFactory, Attributes, Relationships;

    protected $guarded = ['id'];

}
