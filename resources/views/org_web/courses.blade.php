@include('layouts.org_web.header')
<style>
    .collapse-content .fa.fa-heart:hover {
        color: #f44336 !important;
    }
    .collapse-content .fa.fa-share-alt:hover {
        color: #0d47a1 !important;
    }
    .jumbotron {
        padding: 1rem 0.25rem;
        margin-bottom: 2rem;
        background-color: #f0f8ff;
        border-radius: .3rem;
    }
    .list-group-item {
        padding: 0.25rem 1.25rem !important;
    }
    /* in desktop only */
    .popover {
        max-width: 50% !important;
        width: 34% !important;
    }
</style>

<header class="inner-header">
    <div class="section-heading">
        <h1>الكورسات</h1>
        <p>آخر الكورسات من شركة يمن تداول الدولية للخدمات المالية</p>
    </div>
</header>

<!-- Main content -->
<main>
    <section class="inner blog-posts">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card-grid">
                        <div class="card-grid-img"></div>

                        <div class="card-grid-content">
                            <h5>عنوان الكورس </h5>
                            <div class="card-user">
                                <i class="fa fa-money"></i>
                                <p> السعر
                                    100 $ </p>
                            </div>
                            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                        </div>
                        <div class="card-grid-footer">

                            <div>
                                <div class="item">
                                    <i class="fas fa-user"></i>
                                    <span>المسجلين: </span>
                                    <span>20</span>
                                </div>
                            </div>

                            <a href="{{route('singlecourse')}}" class="btn btn-sm btn-default">
                                تسجيل في الكورس
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card-grid">
                        <div class="card-grid-img"></div>
                        <div class="card-grid-content">
                            <h5>عنوان الكورس </h5>
                            <div class="card-user">
                                <i class="fa fa-money"></i>
                                <p> السعر
                                    100 $ </p>
                            </div>
                            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                        </div>
                        <div class="card-grid-footer">
                            <div>
                                <div class="item">
                                    <i class="fas fa-eye"></i>
                                    <span>المسجلين: </span>
                                    <span>20</span>
                                </div>
                            </div>

                            <a href="{{route('singlecourse')}}" class="btn btn-sm btn-default">
                                تسجيل في الكورس
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card-grid">
                        <div class="card-grid-img"></div>
                        <div class="card-grid-content">
                            <h5>عنوان الكورس </h5>
                            <div class="card-user">
                                <i class="fa fa-money"></i>
                                <p> السعر
                                    100 $ </p>
                            </div>
                            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                        </div>
                        <div class="card-grid-footer">
                            <div>
                                <div class="item">
                                    <i class="fas fa-eye"></i>
                                    <span>المسجلين: </span>
                                    <span>20</span>
                                </div>
                            </div>

                            <a href="{{route('singlecourse')}}" class="btn btn-sm btn-default">
                                تسجيل في الكورس
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-6 col-lg-3">
                    <div class="card-grid">
                        <div class="card-grid-img"></div>
                        <div class="card-grid-content" data-toggle="popover-click" data-img="https://mdbootstrap.com/img/logo/mdb192x192.jpg">
                                    <h5>عنوان الكورس </h5>
                            <div class="card-user">
                                <i class="fa fa-money"></i>
                                <p> السعر
                                    100 $ </p>
                            </div>
                            <p>هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.</p>
                        </div>
                        <div class="card-grid-footer">
                            <div>
                                <div class="item">
                                    <i class="fas fa-eye"></i>
                                    <span>المسجلين: </span>
                                    <span>20</span>
                                </div>
                            </div>

                            <a href="{{route('singlecourse')}}" class="btn btn-sm btn-default">
                                تسجيل في الكورس
                            </a>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
</main>
<!-- Footer -->

<!-- Card -->
<div class="card promoting-card" id="mypopover" style="display: none;">

    <!-- Card content -->
    <div class="card-body d-flex flex-row">

        <!-- Avatar -->
        <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-8.jpg" class="rounded-circle mr-3"
             height="50px" width="50px" alt="avatar">

        <!-- Content -->
        <div>

            <!-- Title -->
            <h6 class="card-title font-weight-bold mb-2">اسم المحاضر : </h6>
            <!-- Subtitle -->
            <p class="card-text"><i class="far fa-clock pr-2"></i>07/24/2018</p>

        </div>

    </div>

    <!-- Card image -->
    <div class="view overlay">

        <ul class="list-group">
            <h6>
            <li class="list-group-item">
                <span class="badge">83</span>
                درس
            </li>
            </h6>
            <li class="list-group-item">
                <h6>
                <span class="badge">5</span>
                ساعات
                </h6>
            </li>
        </ul>

        <a href="#">
            <div class="mask rgba-white-slight"></div>
        </a>
    </div>

    <!-- Card content -->
    <div class="card-body">

        <div class="collapse-content">

            <!-- Text -->


             <div class="jumbotron">
                 <h5>
                     محاور الكورس
                 </h5>
            <p>
                 سيتعلم الشخص ان يفعل كذا كذا
                وكذا كذا

            </p>
        </div>


        </div>

    </div>

</div>
<!-- Card -->
@include('layouts.org_web.footer')

<script>
    var content= $('#mypopover').html();
        $('[data-toggle="popover-click"]').popover({
        html: true,
        trigger: 'click',
        placement: 'right',
        content: function () { return content; }
    });
</script>
