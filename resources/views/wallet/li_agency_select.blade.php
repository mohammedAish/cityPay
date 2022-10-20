<li class="agency_li" style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:97%;"
    all_data="{{$all_data}}" id="{{$id}}">
    <div class="row col-md-12">
        <div class="col-md-4">
            <img src="{{asset($agency->img_path)}}" alt=""
                 style="max-width: 40px;">
        </div>
        <div class="col-md-7">
            <div class="method">
                <h3>{{$agency->name}} </h3>
            </div>
        </div>
    </div>
</li>
