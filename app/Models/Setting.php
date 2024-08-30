<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Setting\Attributes;
use App\Models\Traits\Setting\Relationships;
use App\Traits\UploadFiles;

class Setting extends Model
{
    use HasFactory, Attributes, Relationships, UploadFiles;

    protected $guarded = ['id'];
}
