@extends('layouts.org_web.layout')
@section('content')

    <header class="inner-header coursePage" style="margin-top: 6%">
        <video autoplay muted loop>
            <source src="{{asset('/courses/img/videos/sample.mp4')}}" type="video/mp4">
        </video>
        <div class="section-heading">
            <h3 style="font-family: 'Almarai',sans-serif; color: white;">{{$consultant_info->name}}</h3>
            <p>{{$consultant_info->description}}</p>
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center mb-3">
{{--                <p class="feature">افضل المبيعات</p>--}}
                <p class="d-flex flex-column flex-sm-row align-items-center justify-content-center">
                    <span class="mx-1">{{$countCustomers}} اشتروا الاستشارة</span>
{{--                    <span class="mx-1">4.5 (25,428 تقييمات)</span>--}}
                </p>
            </div>
            <div class="d-flex flex-column flex-sm-row align-items-center justify-content-center mb-3">
                <a href="#" class="btn register-btn m-1 " data-toggle="modal" data-target="#exampleModalCenter">شراء الاستشارة</a>
            </div>

        </div>
    </header>

    <!-- Course Details Section Starts -->
    <section class="course-details-section padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="course-details-sidebar">
                        <div class="course-details-widget">
                            <div class="course-widget-title">
                                <h4>تفاصيل الاستشارة</h4>
                            </div>
                            <div class="course-widget-items">
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-usd"></i> السعر</span>
                                    </div>
                                    <div class="item-right">
                                        <span>$ {{$consultant_info->price}}</span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-clock-o"></i> مدة الاستشارة</span>
                                    </div>
                                    <div class="item-right">
                                        <span>ساعتين  </span>
                                    </div>
                                </div>

                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-shopping-cart"></i> عدد الاشخاص الذي اشتروا الاستشارة</span>
                                    </div>
                                    <div class="item-right">
                                        <span>{{$countCustomers}} شخص </span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-language"></i> اللغة</span>
                                    </div>
                                    <div class="item-right">
                                        <span>العربية</span>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="item-left">
                                        <span><i class="fa fa-share-alt"></i> مشاركة</span>
                                    </div>
                                    <div class="item-right">
                                        <ul>
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>

                            <div class="course-widget-buttons">
                                <a href="#" class="template-button" data-toggle="modal" data-target="#exampleModalCenter">شراء الأستشارة</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="course-details-title">
                        <h3 style="font-family: 'Almarai',sans-serif;">{{$consultant_info->name}}</h3>
                    </div>
                    <div class="course-details-tab">
                        <div class="tab">
                            <ul>
                                <li class="tab-one active">
                                    <span>نبذة </span>
                                </li>


{{--                                <li class="tab-four">--}}
{{--                                    <span>review</span>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                        <div class="tab-content margin-top-30">
                            <div class="tab-one-content tab-content-bg overview-content lost active">
                                <h4>وصف الاستشارة :</h4>
                                <p class="margin-top-20">{{$consultant_info->description}}</p>
                                <div class="overview-title margin-top-30">
                                    <h4>ما ستستفيد من الاستشارة ؟</h4>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <ul class="learn-item">
                                            <li><i class="fa fa-check"></i> {{$consultant_info->what_will_benefit}}<span></span></li>
                                        </ul>
                                    </div>

                                </div>
{{--                                <p class="margin-top-20">This course is aimed at teaching photographers what it takes to improve your techniques to earn more money.You'll start with the basics and tackle how a camera operates. While there are plenty of digital photography courses that focus on specific styles or how to use gear, it's hard to find a comprehensive course like this one, which is for beginner to advanced photographers.</p>--}}
                                <div class="overview-title margin-top-20">
                                    <h4>من سيستفيد من الاستشارة :</h4>
                                </div>
                                <ul class="require-item">
                                    <li><i class="fa fa-square"></i> <span>{{$consultant_info->who_will_benefit}}</span></li>
                                </ul>
                            </div>
{{--                            <div class="tab-four-content tab-content-bg review-content lost">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-lg-4">--}}
{{--                                        <div class="rating-left">--}}
{{--                                            <h2>4.5</h2>--}}
{{--                                            <ul class="green-starts">--}}
{{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                <li><a href="#"><i class="fa fa-star-half-o"></i></a></li>--}}
{{--                                            </ul>--}}
{{--                                            <span>متوسط التقييم</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-8">--}}
{{--                                        <div class="rating-right">--}}
{{--                                            <div class="review-title">--}}
{{--                                                <h4>تقييمات</h4>--}}
{{--                                            </div>--}}
{{--                                            <div class="single-review">--}}
{{--                                                <div class="progress-part">--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="start-part">--}}
{{--                                                    <ul class="yellow-starts">--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="percentage-part">--}}
{{--                                                    <span>80%</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="single-review">--}}
{{--                                                <div class="progress-part">--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="start-part">--}}
{{--                                                    <ul class="yellow-starts">--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="percentage-part">--}}
{{--                                                    <span>50%</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="single-review">--}}
{{--                                                <div class="progress-part">--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="start-part">--}}
{{--                                                    <ul class="yellow-starts">--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="percentage-part">--}}
{{--                                                    <span>20%</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="single-review">--}}
{{--                                                <div class="progress-part">--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="start-part">--}}
{{--                                                    <ul class="yellow-starts">--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="percentage-part">--}}
{{--                                                    <span>10%</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="single-review">--}}
{{--                                                <div class="progress-part">--}}
{{--                                                    <div class="progress">--}}
{{--                                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="start-part">--}}
{{--                                                    <ul class="yellow-starts">--}}
{{--                                                        <li><a href="#"><i class="fa fa-star"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                        <li><a href="#"><i class="fa fa-star-o"></i></a></li>--}}
{{--                                                    </ul>--}}
{{--                                                </div>--}}
{{--                                                <div class="percentage-part">--}}
{{--                                                    <span>10%</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 style="font-size: 18px" class="modal-title" id="exampleModalLongTitle">
                            <i class="fas fa-calendar-check"></i>
                          ..  فضلا قم بتحديد وقتك ووسيلة التواصل  المناسبة لك
                        </h2>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-10 col-lg-12 col-xl-12">
                                <div class="card border-0">
                                    <div class="col-sm-3">
                                        <label class="text-grey mt-1 mb-3">اختر وقتك المفضل </label>
                                    </div>

                                    <div class="row px-3">
                                        <div class="col-sm-10 list">
                                            <div class="mb-2 row justify-content-center px-3">
                                                <div class="mob ">
                                                    <label class="text-grey mr-1">وسيلة التواصل</label>
                                                    <select class="mb-2 mob">
                                                        <option value="opt1">اتصال</option>
                                                        <option value="opt2">وتساب</option>
                                                        <option value="opt2">زووم</option>
                                                    </select>
                                                </div>
                                                <div class="mob mb-2"> <label class="text-grey mr-1">التاريخ</label> <input type="date" class="ml-1"  name="from " > </div>

                                                <div class="mob mb-2"> <label class="text-grey mr-1">من</label> <input class="ml-1" type="time" name="from"> </div>
                                                <div class="mob mb-2"> <label class="text-grey mr-4">الى</label> <input class="ml-1" type="time" name="to"> </div>
                                                <div class="mt-1 cancel fa fa-times text-danger"></div>

                                            </div>
                                        </div>
                                        <div class="row px-3 mt-3">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="row px-3">
                                                    <div class="fa fa-plus-circle text-success add"></div>
                                                    <p class="text-success ml-3 add">اضافة</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                            <button type="button" class="btn btn-primary">التالي</button>
                                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <script>

        $(document).ready(function(){

            $('.add').click(function(){
                $(".list").append(
                    '<div class="mb-2 row justify-content-center px-3">' +
                    '<div class="mob ">' +
                    '<label class="text-grey mr-1">وسيلة التواصل</label>' +
                    '<select class="mb-2 mob">' +
                        ' <option value="opt1">اتصال</option>'+
                        ' <option value="opt1">وتساب</option>'+
                        ' <option value="opt1">زووم</option>'+
                        ' </select>'+
                        ' </div>'+
                    '<div class="mob">' +
                    '<label class="text-grey mr-1">التاريخ</label>' +
                    '<input type="date" class="ml-1"  name="from">' +
                    '</div>' +
                    '<div class="mob mb-2">' +
                    '<label class="text-grey mr-1">من</label>' +
                    '<input class="ml-1" type="time" name="from">' +
                    '</div>' +
                    '<div class="mob mb-2">' +
                    '<label class="text-grey mr-4">الى</label>' +
                    '<input class="ml-1" type="time" name="to">' +
                    '</div>' +
                    '<div class="mt-1 cancel fa fa-times text-danger">' +
                    '</div>' +
                    '</div>');
            });

            $(".list").on('click', '.cancel', function(){
                $(this).parent().remove();
            });

        });
    </script>
@endsection

