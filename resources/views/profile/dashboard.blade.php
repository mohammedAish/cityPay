@extends('profile.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            @include('layouts.profile.tabs')

            <h2><i class="fas fa-tachometer-alt"></i>
                {{trans('lang.welcome')}}, {{trans('lang.ur-current-balance-is')}}
                {{$profile_data['balance']}}, {{trans('lang.loyalty-program-points')}}
                 {{$profile_data['countLoyalties']+12}} {{trans('lang.point')}}</h2>
        </div>
        <div class="wallet-balance-area clearfix">

            <div class="row col-md-12">
                <div class="row col-md-12">
                    <div class="wallet-balance-box " style="width: 100%">
                        <div class="wallet-balance-ico">
                            <h1 style="color: green">  <i class="fas fa-money-bill-alt"></i></h1>
                        </div>
                        <h3>{{trans('lang.balance')}}</h3>
                        <h3>{{$profile_data['balance']}}</h3>
                              </div>


                </div>

              {{--  <div class="wallet-balance-box ">
                    <div class="wallet-balance-ico">
                        <h1 style="color: green">
                            <i class="fas fa-cart-plus"></i></h1>
                    </div>
                    <h3>{{trans('lang.digital_cards')}}</h3>
                    {{$profile_data['countDigitalCard']}}

                </div>
                <div class="wallet-balance-box  ">
                    <div class="wallet-balance-ico">
                        <h1 style="color: green">  <i class="fas fa-chalkboard-teacher"></i></h1>
                    </div>
                    <h3>{{trans('lang.courses')}}</h3>
                    <h3>{{$profile_data['countTrainingCourses']}}</h3>

                </div>
                <div class="wallet-balance-box ">
                    <div class="wallet-balance-ico">
                        <h1 style="color: green">  <i class="fas fa-hands-helping"></i></h1>
                    </div>
                    <h3>{{trans('lang.consultants')}}</h3>
                    <h3> <!--البيانات القادمة من السيرفر  -->
                        {{$profile_data['countConsultants']}}

                    </h3>
                </div>--}}
            </div>
        </div>


    </div>


@endsection
