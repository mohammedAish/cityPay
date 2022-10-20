<div class="select form-group">
    <span id="form_provider_text">{{$label}}</span>
    <i class="fas fa-caret-down"></i>
    <input type="hidden" id="form_provider_id" required value="" name="{{$name}}">
</div>
<ul class="dropdown-menu">
    @foreach($agencies as $agency)
        <li class="provider_li" style="background-color: #f2f2f2; border-radius: 30px; height: 60px; width:97%;"
            all_data="{{$agency}}" id="{{$agency->id}}">
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
    @endforeach

</ul>