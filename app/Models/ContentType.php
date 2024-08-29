<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentType extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'content_types'; // Specify the table name if different from model name convention

    protected $fillable = [
        'name',
        'type',
        'status'
    ];

    public const CONTENTLIST = [
        'file' => ['name' => 'File', 'icon' => 'fa-file'],
        'image' => ['name' => 'Image', 'icon' => 'fa-image'],
        'link' => ['name' => 'Link', 'icon' => 'fa-link'],
        'embedded-video' => ['name' => 'Embedded Video', 'icon' => 'fa-circle-play'],
        'paragraph' => ['name' => 'Paragraph', 'icon' => 'fa-paragraph']
    ];
}
