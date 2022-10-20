@extends('layouts.org_web.layout')
@section('content')

    <header class="inner-header no-overlay" style="margin-top: 6%">
        <div class="container" >
            <div class="section-heading">
                <h1>البحث عن الدورات التدريبية</h1>
                <!-- <p>شركة يمن تداول هي شركة ريادية متطورة تعمل في مجال المال، تساند العاملين في منصة الاعمال المالية بمساندة متقدمة ومرنة عبر باقات متنوعه من الخدمات المالية ذات الجودة العالية والدقة وبمعايير عالمية تفوق توقعات العملاء؛ لتستمر حركة مواردهم المالية  إلى الأمام.</p> -->
                <div class="search-input mt-5 d-flex flex-column flex-md-row align-items-center">
                    <input type="text" class="form-control" placeholder="ماذا تريد ان تتعلم؟">
                    <button class="btn" type="submit">
                        <i class="fas fa-search"></i>
                        <span>بحث</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="courses">

        <section class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h3 class="font-weight-bold mb-5">
                        <span>253 </span>
                        <span>نتيجة البحث عن</span>
                        <span> "</span>
                        <span>{{$term}}</span>
                        <span>"</span>
                    </h3>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center justify-content-start">
                            <button class="btn mx-2" data-toggle="collapse" href="#filter-collapse" role="button" aria-expanded="false" aria-controls="filter-collapse">
                                <i class="fas fa-filter"></i>
                                <span>تصفية</span>
                            </button>
                            <div class="form-group m-0">
                                <select class="form-control">
                                    <option disabled value="0" selected>ترتيب</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <p>253 نتيجة</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 collapse show" id="filter-collapse">
                    <div class="filters mb-4">
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter1" aria-expanded="false" aria-controls="filter1">
                                <span>الموضوع</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter1">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter2" aria-expanded="false" aria-controls="filter2">
                                <span>المستوى</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter2">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter3" aria-expanded="false" aria-controls="filter3">
                                <span>اللغة</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter3">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter4" aria-expanded="false" aria-controls="filter4">
                                <span>السعر</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter4">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter5" aria-expanded="false" aria-controls="filter5">
                                <span>المميزات</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter5">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter6" aria-expanded="false" aria-controls="filter6">
                                <span>التقييمات</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter6">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter">
                            <button class="btn btn-primary d-flex align-items-center justify-content-between" type="button" data-toggle="collapse" data-target="#filter7" aria-expanded="false" aria-controls="filter7">
                                <span>مدة الفيديو</span>
                                <i class="fas fa-angle-down"></i>
                            </button>
                            <div class="collapse" id="filter7">
                                <div class="card card-body">
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 1</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 2</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 3</label>
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">اختيار 4</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="results" style="flex-direction: row;">
                        <div class="course-card" style="flex-direction: row;">
                            <figure class="col-md-3" style="padding-right: 0;">
                                <img src="dist/img/sample.jpg" alt="">
                            </figure>
                            <div class="course-card-content col-md-9">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">Bestseller</p>
                            </div>
                        </div>

                        <div class="course-card" style="flex-direction: row;">
                            <figure class="col-md-3" style="padding-right: 0;">
                                <img src="dist/img/sample.jpg" alt="">
                            </figure>
                            <div class="course-card-content col-md-9">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">Bestseller</p>
                            </div>
                        </div>
                        <div class="course-card" style="flex-direction: row;">
                            <figure class="col-md-3" style="padding-right: 0;">
                                <img src="dist/img/sample.jpg" alt="">
                            </figure>
                            <div class="course-card-content col-md-9">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">Bestseller</p>
                            </div>
                        </div>
                        <div class="course-card" style="flex-direction: row;">
                            <figure class="col-md-3" style="padding-right: 0;">
                                <img src="dist/img/sample.jpg" alt="">
                            </figure>
                            <div class="course-card-content col-md-9">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">Bestseller</p>
                            </div>
                        </div>
                        <div class="course-card" style="flex-direction: row;">
                            <figure class="col-md-3" style="padding-right: 0;">
                                <img src="dist/img/sample.jpg" alt="">
                            </figure>
                            <div class="course-card-content col-md-9">
                                <h5>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة</h5>
                                <p>4.5 (25,428 تقييمات)</p>
                                <p>
                                    <span>$9.99</span>
                                    <span>$149</span>
                                </p>
                                <p class="badge">Bestseller</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection
