@extends('profile.index')
@section('content')


    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2 class="mb-5"> <i class="fas fa-user"></i>المستندات الشخصية </h2><div class="row">

            </div>
            <div class="container mt-0">
                <!-- Table -->

                <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <h3 class="mb-0">المستندات الشخصية </h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>

                                    <th scope="col"></th>
                                    <th scope="col">نوع الهوية</th>
                                    <th scope="col">تأكيد الهوية </th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>



                                    <td style="width: 20%">
                                        <div class="media align-items-center" >
                                            <img src="{{asset('org_assets/dist/img/id.jpg')}}" alt="Loader" class="wizardimg" style="width: 100%">


                                        </div>

                                    </td>
                                    <td>
                                        بطاقة شخصية
                                    </td>


                                    <td>
                                        <div class="wallet-transaction-balance">

                                            <span>  <i class="fas fa-circle p-5-wizard " style="color: #87d682"></i>قيد الانتظار </span>
                                        </div>

                                    </td>


                                </tr>
                                <tr>



                                    <td style="width: 20%">
                                        <div class="media align-items-center" >
                                            <img src="{{asset('org_assets/dist/img/elc.jpg')}}" alt="Loader" class="wizardimg" style="width: 100%">


                                        </div>

                                    </td>
                                    <td>
                                        اثبات العنوان
                                    </td>


                                    <td>
                                        <div class="wallet-transaction-balance">

                                            <span>  <i class="fas fa-circle p-5-wizard " style="color: #87d682"></i>قيد الانتظار </span>
                                        </div>

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
    </div>


@endsection
