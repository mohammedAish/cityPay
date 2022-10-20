<div class="col-lg-3 col-md-6 grid-item marketing">
    <div class="single-course-item">
        <div class="course-image">
            <img src={{asset($consultant->img_path)}} alt="image"
                 style="width: 100%;">
        </div>
        <div class="course-content margin-top-30">
            <div class="course-title">
                <h4> {{$consultant->name}}  </h4>
            </div>
{{--            "id" => "2"--}}
{{--            "consultants_category_id" => "1"--}}
{{--            "name" => "{"ar":"استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد"}"--}}
{{--            "consultant_type" => "paid"--}}
{{--            "price" => "6.00"--}}
{{--            "currency_id" => "1"--}}
{{--            "service_id" => "4"--}}
{{--            "service_package_id" => "1"--}}
{{--            "description" => "{"ar":"استشارة في التسويق الفعال للمشاريع الناشئة في ظل ازمة اقتصادية عارمة في البلاد"}"--}}
{{--            "who_will_benefit" => null--}}
{{--            "what_will_benefit" => null--}}
{{--            "img_path" => "{"ar":"storage\/consultants\/bba01d78d54fd92c32a8c9d6638c86ca.png"}"--}}
{{--            "external_link" => "http://sss"--}}
{{--            "active" => "1"--}}
{{--            "created_at" => "2021-04-09 19:37:26"--}}

            {{--                            <div class="course-info margin-top-20">--}}
            {{--                                <div class="course-view">--}}
            {{--                                    <i class="fa fa-eye"></i>--}}
            {{--                                    <span>25,000 views</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-video">--}}
            {{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                                    <span>36 lectures</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-time">--}}
            {{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                                    <span>2h 40mins</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            <div class="course-price-cart margin-top-20">
                <div class="course-price">
                    <span class="span-big">{{($consultant->consultant_type=='paid')?$consultant->price:$consultant->consultant_type}} </span>
                </div>
            </div>
        </div>
        <div class="hover-state">

            <div class="course-title margin-top-10">
                <h4><a href="{{route('consultant.detail',$consultant->id)}}">{{$consultant->name}}</a></h4>
            </div>
            <div class="course-price-info margin-top-20">
                <span class="course-category"><a href="#">{{$consultants_cat->name}}</a></span>
                <span class="course-price">{{($consultant->consultant_type=='paid')?$consultant->price:$consultant->consultant_type}} </span>
            </div>
            {{--                            <div class="course-info margin-top-30">--}}
            {{--                                <div class="course-enroll">--}}
            {{--                                    <span>enrolled 0</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-video">--}}
            {{--                                    <i class="fa fa-play-circle-o"></i>--}}
            {{--                                    <span>36 lectures</span>--}}
            {{--                                </div>--}}
            {{--                                <div class="course-time">--}}
            {{--                                    <i class="fa fa-clock-o"></i>--}}
            {{--                                    <span>2h 40mins</span>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            <p class="margin-top-20">{{$consultant->description}}</p>

            <div class="preview-button margin-top-20">
                <a href="{{route('consultant.detail',$consultant->id)}}" class="template-button">التفاصيل</a>
                <a href="cart.html" class="template-button margin-left-10">شراء</a>
            </div>
        </div>
    </div>
</div>