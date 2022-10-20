@extends('wallet.index')
@section('content')

    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            <h2><i class="fas fa-history"></i> Transaction</h2>
        </div>
        <div class="container">
            <div class="row">
                <table id="example" class="table table-borderless" style="width:100%">
                    <thead>
                    <tr>
                        <th>اسم العملية</th>
                        <th>مبلغ السحب</th>
                        <th>البنك</th>
                        <th>العمولة</th>
                        <th> نسبة العمولة</th>
                        <th>الحالة</th>
                        <th>تاريخ العملية</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($withdraw_orders as $withdraw_orders)
                        <tr>
                            <td>

                                <div class="wallet-transaction-name">

                                    <h3><i class="fas fa-arrow-down"></i>
                                        {{trans('lang.Withdrawal')}}</h3>
                                    {{--                                    <span>  {{$withdraw_orders->agencyCountry->countries->name}}   | {{$withdraw_orders->agencyCountry->depositAgency->name}}</span>--}}
                                </div>
                            </td>
                            <td>
                                <div class="wallet-transaction-balance">

                                    <h3> {{$withdraw_orders->amount}} </h3>
                                    <h2 class="small"> {{ $withdraw_orders->currency->name}}</h2>
                                </div>
                            </td>

                            <td>
                                <h3>{{$withdraw_orders->agencyCountry->depositAgency->name}} </h3>

                            </td>
                            <td>
                                <div class="wallet-transaction-balance">
                                    <span>{{$withdraw_orders->amount_fee}}</span>
                                </div>
                            </td>
                            <td>
                                <span>{{$withdraw_orders->fee_percent}}</span>
                            </td>
                            <td>
                                <div class="wallet-transaction-balance">

                                    <span> <a href="#"> <i class="fas fa-circle p-5-wizard "
                                                           @if($withdraw_orders->current_status =='rejected')style="color: red;"
                                                           @elseif($withdraw_orders->current_status =='confirmed')style="color: green;"
                                                           @else style="color: darkgoldenrod;" @endif ></i>{{$withdraw_orders->current_status}} </a></span>
                                </div>
                            </td>
                            <td>
                                {{$withdraw_orders->created_at->format('d-m-Y H:m')}}
                                <h2 class="small"> {{ $withdraw_orders->created_at->diffForHumans()}}</h2>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection
