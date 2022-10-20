@extends('layouts.org_web.layout')
@section('content')

    <div class="wallet-box-scroll " style="margin-top: 100px;">

        <div class="container">
            <div class="row">

            <div class=" col-md-9">

                <h3> وسطاء تداول العملات الأجنبية</h3>


                <table id="example" class="table table-borderless" style="width:100%">
                    <thead>
                    <th style="width: 20%"></th>
                    <th style="width:50%"></th>
                    <th style="width: 30%"></th>

                    </thead>
                    <tbody>
                    <tr class="single-cart-item " >
                        <td >
                                    <div class="col-lg-4">
                                        <a href="#"><img src="{{asset('/org_assets/dist/img/hotforex-logo.png')}}" alt="image" style="width: 150px;"></a>
                                    </div>



                        </td>
                        <td>
                            <table style="width: 100% !important;">
                                <tr style="border-bottom: grey 1px solid; ">
                                    <td colspan="2">


                                            <h3>
                                               FXTM
                                            </h3>



                                    </td>
                                </tr>
                                <tr >
                                    <td >
                                        <h6>
                                            Institutional
                                        </h6>
                                        <span>نقاط سعر الفايدة 50</span>

                                    </td>
                                    <td >
                                        <h6>
                                            Corporate
                                        </h6>
                                        <span>نقاط سعر الفايدة 50</span>

                                    </td>

                                </tr>
                            </table>

                    </td>
                        <td style="padding-top: 60px;" class="d-flex flex-row">
                            <div class="cta-button">
                                <a href="{{url('trading/add_account_new')}}" class="template-button-2 m-1">اضافة حساب</a>
                            </div>

                            <div class="cta-button">
                                <a href="{{url('trading/broker_detail')}}" class="template-button-2 m-1">التفاصيل</a>
                            </div>
                        </td>

                    </tr>
                    <tr class="spacer"><td ></td><td ></td><td></td></tr>





                    </tbody>
                </table>

            </div>
            <div class="col-lg-3">
                <div class="course-category-sidebar">
                    <div class="lms-single-widget">
                        <div class="lms-widget-title">
                            <h4>all categories</h4>
                        </div>
                        <ul>
                            <li class="active"><a href="web-development.html">web development</a></li>
                            <li><a href="education.html">education</a></li>
                            <li><a href="business.html">business</a></li>
                            <li><a href="banking.html">banking</a></li>
                            <li><a href="corporate.html">corporate</a></li>
                            <li><a href="consulting.html">consulting</a></li>
                            <li><a href="marketing.html">marketing</a></li>
                            <li><a href="photography.html">photography</a></li>
                            <li><a href="music.html">music</a></li>
                        </ul>
                    </div>
                    <div class="lms-single-widget">
                        <div class="lms-widget-title">
                            <h4>level</h4>
                        </div>
                        <ul>
                            <li class="active"><a href="#">all levels</a></li>
                            <li><a href="#">beginner</a></li>
                            <li><a href="#">advance</a></li>
                        </ul>
                    </div>
                    <div class="lms-single-widget">
                        <div class="lms-widget-title">
                            <h4>language</h4>
                        </div>
                        <select name="language" id="language">
                            <option value="all language">all language</option>
                            <option value="english">english</option>
                            <option value="bengali">bengali</option>
                            <option value="arabic">arabic</option>
                        </select>
                    </div>
                    <div class="lms-single-widget">
                        <div class="lms-widget-title">
                            <h4>instructor</h4>
                        </div>
                        <select name="instructor" id="instructor">
                            <option value="all instructor">all instructor</option>
                            <option value="arya stark">arya stark</option>
                            <option value="john snow">john snow</option>
                            <option value="devid walter">devid walter</option>
                        </select>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>



@endsection
