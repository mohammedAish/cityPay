<!--route wallet.faccounts
@extends('wallet.index')-->
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2 class="mb-5"> <i class="fas fa-user"></i>حسابات احبائك المالية  </h2><div class="row">

            </div>
            <div class="container mt-0">
                <!-- Table -->

                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">حسابات احبائي </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>

                                    <th scope="col">اسم البنك</th>
                                    <th scope="col">الأسم</th>
                                    <th scope="col">الدولة</th>

                                    <th scope="col">نوع الحساب</th>
                                    <th scope="col">العملة </th>
                                    <th scope="col">بيانات الحساب</th>
                                    <th scope="col">
                                        <a href={{url('/wallet/add_lovers')}}><i class="fas fa-plus"></i> </a>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>


                                    <th scope="row">

                                        <div class="media align-items-center">
                                            <img src="{{asset('org_assets/dist/img/wizardimages/cacbank.png')}}" alt="Loader" class="wizardimg" style="width: 100%">


                                        </div>
                                    </th>
                                    <td>
                                        ايمان محمد مطهر اللوندي
                                    </td>

                                    <td>
                                        اليمن
                                    </td>
                                    <td>
                      <span class="badge badge-dot mr-4">
                        حساب بنكي

                      </span>
                                    </td>
                                    <td>
                                        ريال يمني
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">45464684145644545</span>

                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <a href="#"><i class="fas fa-eye p-5-wizard"></i> </a>

                                        <a href="#"><i class="fas fa-edit p-5-wizard"></i> </a>
                                        <a href="#"><i class="fas fa-trash  p-5-wizard"></i> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">

                                        <div class="media align-items-center">
                                            <img src="{{asset('org_assets/dist/img/wizardimages/paypal.png')}}" alt="Loader" class="wizardimg " style="width: 100%">



                                        </div>
                                    </th>
                                    <td>
                                        ايمان محمد مطهر اللوندي
                                    </td>

                                    <td>
                                        -
                                    </td>
                                    <td>
                      <span class="badge badge-dot mr-4">
                           حساب بنك الكتروني

                      </span>
                                    </td>
                                    <td>
                                        دولار امريكي
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">emanlowndi@gmail.com</span>

                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <a href="#"><i class="fas fa-eye p-5-wizard"></i> </a>

                                        <a href="#"><i class="fas fa-edit p-5-wizard"></i> </a>
                                        <a href="#"><i class="fas fa-trash  p-5-wizard"></i> </a>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        {{--                        <div class="card-footer py-4">--}}
                        {{--                            <nav aria-label="...">--}}
                        {{--                                <ul class="pagination justify-content-end mb-0">--}}
                        {{--                                    <li class="page-item disabled">--}}
                        {{--                                        <a class="page-link" href="#" tabindex="-1">--}}
                        {{--                                            <i class="fas fa-angle-left"></i>--}}
                        {{--                                            <span class="sr-only">Previous</span>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item active">--}}
                        {{--                                        <a class="page-link" href="#">1</a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item">--}}
                        {{--                                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>--}}
                        {{--                                    </li>--}}
                        {{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                        {{--                                    <li class="page-item">--}}
                        {{--                                        <a class="page-link" href="#">--}}
                        {{--                                            <i class="fas fa-angle-right"></i>--}}
                        {{--                                            <span class="sr-only">Next</span>--}}
                        {{--                                        </a>--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                            </nav>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

@endsection
