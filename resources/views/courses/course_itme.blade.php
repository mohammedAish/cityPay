<div class="course-card single-course-item">
    <figure>
        <img src="{{asset($course->img_path)}}" alt="">
    </figure>
    <div class="course-card-content">
        <h5>{{$course->name}}</h5>
        <p>4.5 (25,428 تقييمات)</p>
        <p>
            <span>{{$course->price}} {{$course->currency->symbol}}</span>
            <span>$149</span>
        </p>
        <p class="badge">{{trans('lang.Bestseller')}}</p>
    </div>
    <div class="hover-state">
        {{--                                <span class="heart-icon"><i class="fa fa-heart-o"></i></span>--}}
        <span class="title-tag">{{$course->teacher->customer->first_name}} {{$course->teacher->customer->last_name}}</span>
        <div class="course-title margin-top-10">
            <a href="#"><h5 style="color: green">{{$course->name}}</h5></a>
        </div>
        <div class="course-price-info margin-top-20">
                                                <span class="course-category"><a
                                                            href="#">{{$course->category->name}}</a></span>
            <span class="course-price">{{$course->price}} {{$course->currency->symbol}}</span>
        </div>
        <div class="course-info margin-top-30">
            <div class="course-enroll">
                <span>enrolled {{$course->total_students}}</span>
            </div>
            <div class="course-video">
                <i class="fa fa-play-circle-o"></i>
                <span>{{$course->subjects_count}} lectures</span>
            </div>
            <div class="course-time">
                <i class="fa fa-clock-o"></i>
                <span>{{$course->duration}}h </span>
            </div>
        </div>
        <p class="margin-top-20">{!! $course->description !!}</p>

        <div class="preview-button margin-top-20">
            <a href="{{route('courses.detail', $course->id)}}"
               class="template-button">course preview</a>
            <a  href="{{route('courses.checkout',$course->id)}}" class="template-button margin-left-10">buy</a>
        </div>
    </div>
</div>