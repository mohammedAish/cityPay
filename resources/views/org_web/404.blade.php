@include('layouts.org_web.header')

<header class="inner-head" style="margin-top:6%;">
    <div class="container">
        <h1>صفحة الخطأ 404</h1>
    </div>
</header>


<!-- Main content -->
<main class="colored-bg policy text-center">
    <div class="container">
        <section class="row policy-content">
            <div class="col-sm-12 col-md-12">
                <h4 class="text-center">
                    خطـأ
                    الصفحة غير موجودة
                </h4>

<br><br>
                <a class="btn btn-outline-success" href="{{route('index')}}">
                    عودة للرئيسية
                </a>
            </div>

        </section>

    </div>

</main>
<!-- Footer -->
@include('layouts.org_web.footer')
