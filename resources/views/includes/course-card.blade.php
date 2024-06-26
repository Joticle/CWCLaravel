<div class="rts-single-course">
    <a href="{{$course->getLink()}}" class="thumbnail">
        <img src="{{$course->getLogo()}}" alt="course">
    </a>
    <div class="save-icon">
        <i class="fa-sharp fa-light fa-bookmark"></i>
    </div>
    <div class="tags-area-wrapper">
        <div class="single-tag">
            <span>{{printPrice($course->price)}}</span>
        </div>
    </div>
    <div class="lesson-studente">
        <div class="lesson">
            <i class="fa-light fa-calendar-lines-pen"></i>
            <span>{{$course->modules_count}} {{ Str::plural('Lesson', $course->modules_count) }}</span>
        </div>
        <div class="lesson">
            <i class="fa-light fa-user-group"></i>
            <span>0 Students</span>
        </div>
    </div>
    <a href="{{$course->getLink()}}">
        <h5 class="title">{{$course->name}}</h5>
    </a>
    {{--<p class="teacher">Dr. Angela Yu</p>--}}
    <div class="rating-and-price">
        <a href="{{$course->getLink()}}" class="rts-btn btn-border">Detail</a>
        @if(!$dashboard)
            @if($course->enrolled())
                <a href="{{$course->getLink()}}" class="rts-btn btn-success text-white"><i class="fa fa-check"></i> Enrolled</a>
            @else
                <a href="{{route('course.enroll',$course->slug)}}" class="rts-btn btn-primary">Enroll Now</a>
            @endif
        @endif
    </div>
</div>