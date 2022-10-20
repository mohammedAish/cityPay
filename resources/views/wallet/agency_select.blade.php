<div class="select form-group">
    <span>{{$label}}</span>
    <i class="fas fa-caret-down"></i>
    <input type="hidden" required value="" id="{{$name}}" name="{{$name}}">
</div>
<ul class="dropdown-menu">

   {{-- <h3 class="text-right" style="padding: 10px; clear: both;">
        المحافظ المحلية
    </h3>--}}
    @foreach($agencies as $agency)
        @if($agency->national=="national")
            @include("wallet.li_agency_select",["all_data"=> $agency,"agency"=> $agency,"id"=>$agency->id ])

        @endif
    @endforeach
   {{-- <h3 class="text-right" style="padding: 10px">
        البنوك الألكترونية
    </h3>--}}
    @foreach($agencies as $agency)
        @if($agency->national != "national")
            @include("wallet.li_agency_select",["all_data"=> $agency,"agency"=> $agency,"id"=>$agency->id ])
        @endif
    @endforeach

</ul>
