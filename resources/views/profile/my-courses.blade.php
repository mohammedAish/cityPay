@extends('profile.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            @include('layouts.profile.tabs')

            <h2><i class="fas fa-chalkboard-teacher"></i>دوراتي التدريبية </h2>
        </div>
        <div class="profile-page-area clearfix">
            <div class="profile-page-area-main" style="background-color: whitesmoke">

                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrap">
                            <table class="table">

                                <tbody>
                                <tr class="alert" role="alert" style="border-bottom: 15px whitesmoke solid;background-color: white">
                                    <th width="20%">
                                        <figure>
                                            <img src="{{asset('org_assets/dist/img/sample.jpg')}}" class="img-fluid " style="width: 100%;  height: auto;">
                                        </figure>

                                    </th>
                                    <td width="60%">
                                        <h5 style="color: green">اسم الكورس هنا</h5>
                                        <h3 style="font-size: 15px !important;">اسم المدرب هنا هو</h3>
                                        <p>
                                           لتوضيح المورس باي اسيتنسيننتىينتىيتننتم ى تىت وصف الكورس هنا
                                        </p>
{{--                                        <form action="" class="mt-1">--}}
{{--                                            <div class="form-group d-flex">--}}
{{--                                                <label for="">قم بتقييم الكورس</label>--}}
{{--                                                <ul id='stars' class="d-flex mx-3 rating-stars">--}}
{{--                                                    <li class='star' title='Poor' data-value='1'>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </li>--}}
{{--                                                    <li class='star' title='Fair' data-value='2'>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </li>--}}
{{--                                                    <li class='star' title='Good' data-value='3'>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </li>--}}
{{--                                                    <li class='star' title='Excellent' data-value='4'>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </li>--}}
{{--                                                    <li class='star' title='WOW!!!' data-value='5'>--}}
{{--                                                        <i class="fas fa-star"></i>--}}
{{--                                                    </li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}
                                    </td>
                                    <td width="20%" style="padding: 20px" >
                                        <a href="#" class="d-flex flex-row" style="padding-top: 50px">
                                            <h3>start</h3>
                                            <i class="fas fa-circle" style=" padding-top: 10px;  padding-right: 5px; padding-left: 5px; padding-bottom: 5px;"></i>
                                        </a>


                                    </td>

                                </tr>
                                <tr class="alert" role="alert" style="border-bottom: 15px whitesmoke solid;background-color: white">
                                    <th width="20%">
                                        <figure>
                                            <img src="{{asset('org_assets/dist/img/sample.jpg')}}" class="img-fluid " style="width: 100%;  height: auto;">
                                        </figure>

                                    </th>
                                    <td width="60%">
                                        <h5 style="color: green">اسم الكورس هنا</h5>
                                        <h3 style="font-size: 15px !important;">اسم المدرب هنا هو</h3>
                                        <p>
                                            لتوضيح المورس باي اسيتنسيننتىينتىيتننتم ى تىت وصف الكورس هنا
                                        </p>
                                        {{--                                        <form action="" class="mt-1">--}}
                                        {{--                                            <div class="form-group d-flex">--}}
                                        {{--                                                <label for="">قم بتقييم الكورس</label>--}}
                                        {{--                                                <ul id='stars' class="d-flex mx-3 rating-stars">--}}
                                        {{--                                                    <li class='star' title='Poor' data-value='1'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='Fair' data-value='2'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='Good' data-value='3'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='Excellent' data-value='4'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='WOW!!!' data-value='5'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                </ul>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                    </td>
                                    <td width="20%" style="padding: 20px" >
                                        <a href="#" class="d-flex flex-row" style="padding-top: 50px">
                                            <h3>continue</h3>
                                            <i class="fas fa-circle" style=" color: #e4e417;padding-top: 10px;  padding-right: 5px; padding-left: 5px; padding-bottom: 5px;"></i>
                                        </a>


                                    </td>

                                </tr>
                                <tr class="alert" role="alert" style="border-bottom: 15px whitesmoke solid;background-color: white">
                                    <th width="20%">
                                        <figure>
                                            <img src="{{asset('org_assets/dist/img/sample.jpg')}}" class="img-fluid " style="width: 100%;  height: auto;">
                                        </figure>

                                    </th>
                                    <td width="60%">
                                        <h5 style="color: green">اسم الكورس هنا</h5>
                                        <h3 style="font-size: 15px !important;">اسم المدرب هنا هو</h3>
                                        <p>
                                            لتوضيح المورس باي اسيتنسيننتىينتىيتننتم ى تىت وصف الكورس هنا
                                        </p>
                                        {{--                                        <form action="" class="mt-1">--}}
                                        {{--                                            <div class="form-group d-flex">--}}
                                        {{--                                                <label for="">قم بتقييم الكورس</label>--}}
                                        {{--                                                <ul id='stars' class="d-flex mx-3 rating-stars">--}}
                                        {{--                                                    <li class='star' title='Poor' data-value='1'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='Fair' data-value='2'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='Good' data-value='3'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='Excellent' data-value='4'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li class='star' title='WOW!!!' data-value='5'>--}}
                                        {{--                                                        <i class="fas fa-star"></i>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                </ul>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                    </td>
                                    <td width="20%" style="padding: 20px" >
                                        <a href="#" class="d-flex flex-row" style="padding-top: 50px">
                                            <h3>Done</h3>
                                            <i class="fas fa-circle" style=" color: green;padding-top: 10px;  padding-right: 5px; padding-left: 5px; padding-bottom: 5px;"></i>
                                        </a>


                                    </td>

                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>

{{--    <div id="logout" class="modal fade remove-theme-popup" role="dialog">--}}
{{--        <div class="modal-dialog">--}}
{{--            <!-- Modal content-->--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-body">--}}
{{--                    <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>--}}
{{--                    <div class="remove-popup">--}}
{{--                        <h3>Are you sure want to logout ?</h3>--}}
{{--                        <div class="remove-popuo-btn clearfix">--}}
{{--                            <button class="remove-btn cancel-btn" data-dismiss="modal">Cancel</button>--}}
{{--                            <button class="remove-btn" data-dismiss="modal">Logout</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- logout model area -->
@endsection
