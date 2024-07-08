<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Courses extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    protected $table = 'courses'; // Specify the table name if different from model name convention

    const LEVELS = ['Beginner' => 'Beginner', 'Intermediate' => 'Intermediate', 'Expert' => 'Expert'];
    const DEFAULT_LEVEL = 'Beginner';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'start_date',
        'end_date',
        'status',
        'price',
        'tags'
    ];

    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    public function getBadgeClassAttribute()
    {
        if($this->level === 'Beginner')
            return 'info';
        else if($this->level === 'Intermediate')
            return 'success';
        else
            return 'danger';
    }

    public function getLogo(){
        $value = $this->logo;
        if($value != ""){
            $uploadingPath = public_path('/uploads/courses/'.$this->id);
            return asset('/uploads/courses/'.$this->id.'/'.$value);
        } else {
            return asset('images/no-image.jpg');
        }
    }
    public function getLink(){
        return route('course.detail',$this->slug);
    }
    public function enrolled(){
        $enrolled_courses = \auth()->user()->courseEnrolled->pluck('course_id')->toArray();
        if(in_array($this->id, $enrolled_courses)){
            return true;
        }
        return false;
    }
    function modules(){
        return $this->hasMany(CourseModules::class,'course_id','id')->orderBy('sort_order','asc');
    }

    public function courseEnrolls() {
        return $this->hasMany(CourseEnroll::class, 'course_id');
    }

    public function getIsBookmarkedAttribute()
    {
        return $this->wishlist()->where('user_id', Auth::id())->exists();
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'course_id');
    }
}
