@extends('wallet.index')
@section('content')
    <div class="wallet-box-scroll" >
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-arrow-down"></i> طلبات عملية الايداع</h2>
        </div>
        <div class="container">
            <div class="row">
                <table id="example" class="table table-borderless" style="width:100%">
                    <thead>
                    <tr>
                        <th>وكالة الايداع</th>
                        <th>المبلغ</th>
                        <th>نوع الايداع</th>
                        <th>تاريخ العملية </th>
                        <th>الحالة </th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($deposit_orders as $deposit_order)
                        <tr>
                            <td>

                                <div class="wallet-transaction-name">


                                    <span>  {{$deposit_order->agencyCountry->country->name}}   | {{$deposit_order->agencyCountry->depositAgency->name}}</span>
                                </div></td>
                            <td>
                                <div class="wallet-transaction-balance">

                                    <h3>{{$deposit_order->currency->name}} {{$deposit_order->amount}}</h3>
                                </div>
                            </td>

                            <td>
                                <h3>{{$deposit_order->deposit_type}} </h3>

                            </td>
                            <td>
                                <div class="wallet-transaction-balance">
                                    <span>{{$deposit_order->deposit_date->diffForHumans()}}</span>
                                </div>
                            </td>

                            <td>
                                <div class="wallet-transaction-balance">

                                    <span> <a href="#" style="color: red"> <i class="fas fa-circle p-5-wizard " @if($deposit_order->current_status =='rejected')style="color: red;"@elseif($deposit_order->current_status =='confirmed')style="color: green;"@else style="color: red;" @endif ></i>تأكيد العملية </a></span>
                                </div>
                            </td>
                            <td>
                                <a href="#"><i class="fas fa-eye"></i> </a>


                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
