<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Connection\Attributes;
use App\Models\Traits\Connection\Relationships;
class Connection extends Model
{
    use Attributes, Relationships;
    use HasFactory;
    protected $guarded = ['id'];

}
