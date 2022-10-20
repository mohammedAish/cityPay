@extends(backpack_view('blank'))

<link rel="stylesheet" href="{{ asset('assets/admin/css/dashboard.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}">
{{--@php
    $widgets['before_content'][] =
        ['type'        => 'progress',
    'class'       => 'card text-white bg-primary mb-2',
    'value'       => '11.456',
    'description' => 'Registered users.',
    'progress'    => 90, // integer
    'hint'        => '8544 more until next milestone.',


    ] ;
@endphp--}}

@section('content')
    <div class="row">
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="ff793f" data-before="cd6133"
                 style="background: #ff793f; --before-bg-color:#cd6133;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ $total_users }}</h2>
                    <h6 class="mb-3">Total Users</h6>
                    <a href="#{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-group"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="33d9b2" data-before="218c74"
                 style="background: #33d9b2; --before-bg-color:#218c74;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ $active_users }}</h2>
                    <h6 class="mb-3">Active Users</h6>
                    <a href="{{--{{ route('admin.users.active') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-user-circle"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="ff5252" data-before="b33939"
                 style="background: #ff5252; --before-bg-color:#b33939;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ $banned_users }}</h2>
                    <h6 class="mb-3">Banned Users</h6>
                    <a href="{{--{{ route('admin.users.banned') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-user-times"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="B33771" data-before="6D214F"
                 style="background: #B33771; --before-bg-color:#6D214F;">
                <div class="details">
                    <h3 class="amount mb-2 font-weight-bold">{{ $general->cur_sym }}{{ formatter_money(isset($widget) ? collect($widget['total_users'])->sum('balance') : 0) }}</h3>
                    <h6 class="mb-3">User Balance</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="40407a" data-before="2c2c54"
                 style="background: #40407a; --before-bg-color:#2c2c54;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ $email_unerified_users }}</h2>
                    <h6 class="mb-3">Email Unerified Users</h6>
                    <a href="{{--{{ route('admin.users.emailUnverified') }}--}}" class="btn btn-sm btn-neutral">View
                        all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-envelope"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="34ace0" data-before="227093"
                 style="background: #34ace0; --before-bg-color:#227093;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ $sms_unerified_users }}</h2>
                    <h6 class="mb-3">SMS Unverified Users</h6>
                    <a href="{{--{{ route('admin.users.smsUnverified') }}--}}" class="btn btn-sm btn-neutral">View
                        all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-comments-o"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="ff793f" data-before="cd6133"
                 style="background: #ff793f; --before-bg-color:#cd6133;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ formatter_money(isset($widget) ? $widget['deposits']->total : 0) }}</h2>
                    <h6 class="mb-3">Total Deposits</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="33d9b2" data-before="218c74"
                 style="background: #33d9b2; --before-bg-color:#218c74;">
                <div class="details">
                    <h3 class="amount mb-2 font-weight-bold">{{ $general->cur_sym }}{{ formatter_money(isset($widget) ? $widget['deposits']->total_charge : 0) }}</h3>
                    <h6 class="mb-3">Total Deposit Charge</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="ff5252" data-before="b33939"
                 style="background: #ff5252; --before-bg-color:#b33939;">
                <div class="details">
                    <h3 class="amount mb-2 font-weight-bold">{{ $general->cur_sym }}{{ formatter_money(isset($widget) ? $widget['deposits']->total_amount : '') }}</h3>
                    <h6 class="mb-3">Total Deposit Amount</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="B33771" data-before="6D214F"
                 style="background: #B33771; --before-bg-color:#6D214F;">
                <div class="details">
                    <h2 class="amount mb-2 font-weight-bold">{{ formatter_money(isset($widget) ? $widget['withdrawals']->total : '') }}</h2>
                    <h6 class="mb-3">Total Withdrawals</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="40407a" data-before="2c2c54"
                 style="background: #40407a; --before-bg-color:#2c2c54;">
                <div class="details">
                    <h3 class="amount mb-2 font-weight-bold">{{ $general->cur_sym }}{{ formatter_money(isset($widget) ? $widget['withdrawals']->total_charge : 0) }}</h3>
                    <h6 class="mb-3">Total Withdrawal Charge</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-sm-6">
            <div class="dashboard-w2 slice border-radius-5" data-bg="34ace0" data-before="227093"
                 style="background: #34ace0; --before-bg-color:#227093;">
                <div class="details">
                    <h3 class="amount mb-2 font-weight-bold">{{ $general->cur_sym }}{{ formatter_money(isset($widget) ? $widget['withdrawals']->total_amount : 0) }}</h3>
                    <h6 class="mb-3">Total Withdrawal Amount</h6>
                    <a href="{{--{{ route('admin.users.all') }}--}}" class="btn btn-sm btn-neutral">View all</a>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
        </div>


    </div>
@endsection


