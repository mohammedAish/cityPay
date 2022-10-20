<div class="card m-5 ">
    <div class="row ">
        <div class="col-md-12 ">
            <div class="page-title style-boder-titel-card d-flex flex-column   ">
                <h1 class="style-title-card px-4 py-4">
                                                <span class="fw-bolder mb-2 text-dark">
                                                    {{cp('restore_password')}}
                                                </span>
                </h1>

            </div>
        </div>
    </div>

    <div class="card-body">

        <form name="password_form" action="{{route('update_password')}}" method="POST">
            @csrf
            <div class="row justify-content-between">

                <div class="col-md-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('msg'))
                        <div class="alert alert-success ">
                            <ul>
                                <li>{{ session('msg')}}</li>
                            </ul>
                        </div>
                    @endif
                        
                    <div class="row">
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('e_mail')}}</label>
                            <input type="email" disabled value="{{auth('customers')->user()->email}}" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('old-password')}} </label>
                            <input type="password" name="old_password" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('new_password')}} </label>
                            <input type="password" name="password" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <label class="style-label-form">{{cp('confirm_password')}} </label>
                            <input type="password" name="password_confirmation" class="form-control"/>
                        </div>
                        <div class="col-md-6 my-2">
                            <button class="form-control BntAdd-Modal"
{{--                                    type="button" onclick="ClicksuccesSaveChangePassword()"--}}
                            >{{cp('save')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>