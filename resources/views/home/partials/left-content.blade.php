<div class="col-md-3 ">
    <aside class="sidebar">
        <ul>
            <li class="@if(Request::routeIs('user.moneyTransfer')) active @endif"><a href="{{route('user.moneyTransfer')}}"><i class="ti-direction"></i>@lang('Money Transfer')</a></li>
            <li class="@if(Request::routeIs('user.home')) active @endif"><a href="{{route('user.home')}}"><i class="ti-direction-alt"></i>@lang('Transactions')</a></li>
            <li class="@if(Request::routeIs('user.exchange')) active @endif"><a href="{{route('user.exchange')}}"><i class="ti-exchange-vertical"></i>@lang('Currency Exchange')</a></li>
            <li class="@if(Request::routeIs('user.ticket')) active @endif"><a href="{{route('user.ticket')}}"><i class="ti-help-alt"></i>@lang('Support')</a></li>

        </ul>
    </aside>
</div>
