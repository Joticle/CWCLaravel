<?php

namespace App\Models;

use App\Traits\UploadFiles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseModuleContent extends Model
{
    use HasFactory, SoftDeletes, UploadFiles;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'course_module_content'; // Specify the table name if different from model name convention

    protected $fillable = [
        'course_id',
        'course_module_id',
        'name',
        'content_type_id',
        'value',
        'sort_order',
        'status'
    ];

    public function getFileContentPath()
    {
        return $this->getFilePath('value') ?:  public_path('images/no-image.jpg');
    }

    public function contentType()
    {
        return $this->belongsTo(ContentType::class);
    }

    public function getPreviewLinkAttribute()
    {
        $contentType = $this->contentType;

        $link = '';
        if ($contentType->type == 'link') {
            $link = trim($this->value);
        } elseif (in_array($contentType->type, ['file', 'image'])) {
            $link = route('course.content', ['id' => $this->id]);
        } elseif (in_array($contentType->type, ['paragraph', 'embedded-video'])) {
            $link = 'javascript:void(0)';
        }
        return $link;
    }
}
