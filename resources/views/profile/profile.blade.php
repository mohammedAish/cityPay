@extends('profile.index')
@section('content')
    <div class="wallet-box-scroll">
        <div class="wallet-bradcrumb">
            @include('layouts.profile.tabs')
            <h2><i class="fas fa-user"></i>{{trans('lang.profile')}}</h2>
        </div>
        <div class="profile-page-area clearfix">
            <div class="profile-page-area-main">
                <div class="profile-information">
                    <div class="editprofile-images">
                        <div class="edit-images">
                            <img id="img_path" src="{{asset($profile_info['img_profile'] )}}" alt="Profile">
                            <span class="edit-label show_add_file_model"><i class="fas fa-camera"></i></span>
                        </div>
                    </div>
                </div>
                <form name="profile" action="{{route('update_profile')}}" method="POST">
                    @csrf
                    {{ method_field('POST') }}
                    <div class="profile-information-right">
                        <div class="profile-information-box">
                            <div class="theme-input-box">
                                <label>{{trans('lang.full-name')}} </label>
                                <input type="text" name="first_name" value="{{$profile_info['first_name']}}"
                                       class="theme-input">
                            </div>
                            <div class="theme-input-box">
                                <label>{{trans('lang.user-name')}}</label>
                                <input type="text" name="last_name" value="{{$profile_info['last_name']}}"
                                       class="theme-input">
                            </div>
                            <div class="theme-input-box">
                                <label>{{trans('lang.email')}}</label>
                                <input type="email" disabled value="{{auth('customers')->user()->email}}" name="" class="theme-input">

                            </div>
                            <div class="theme-input-box">
                                <label>{{trans('lang.phone-number')}}</label>
                                <input type="text" name="phone" value="{{auth('customers')->user()->phone}}"
                                       class="theme-input">
                            </div>
                            <div class="theme-input-box">
                                <label>{{trans('lang.whatsapp-number')}}</label>
                                <input type="text" name="whatsapp_acc"
                                       value="{{auth('customers')->user()->whatsapp_acc}}" class="theme-input">
                            </div>
                            <div class="theme-input-box">
                                <label>{{trans('lang.facebook-account')}}</label>
                                <input type="text" name="facebook_acc"
                                       value="{{auth('customers')->user()->facebook_acc}}" class="theme-input">
                            </div>
                            <div class="theme-input-box">
                                <label>{{trans('lang.country')}}</label>
                                <span>{{auth('customers')->user()->country->name}}</span>

                            </div> <div class="theme-input-box">
                                <label>{{trans('lang.referrer_id')}}</label>
                                <span>{{url('?referrer=').auth()->user()->reference_id}}</span>
                            </div>
                         {{--   <div class="theme-input-box">
                                <label>{{trans('lang.account-type')}}</label>

                                <input type="text" name="customer_type"
                                       value="{{auth('customers')->user()->customer_type}}" class="theme-input">



                            </div>--}}
                            <div class="profile-btn">
                                <button class="theme-btn">{{trans('lang.save')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="profile-reset-password">
                <form name="password_form" action="{{route('update_password')}}" method="POST">
                    @csrf
                    {{ method_field('POST') }}
                <div class="profile-information-box">
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
                    <h2 class="">{{trans('lang.reset-password')}}</h2>
                    <div class="theme-input-box">
                        <label>{{trans('lang.email')}}</label>
                        <input type="email" disabled value="{{auth('customers')->user()->email}}" name="" class="theme-input">
                    </div>
                    <div class="theme-input-box">
                        <label>{{trans('lang.old-password')}}</label>
                        <input type="Password" name="old_password" class="theme-input">
                    </div>
                    <div class="theme-input-box">
                        <label>{{trans('lang.new-password')}}</label>
                        <input type="Password" name="password" class="theme-input">
                    </div>
                    <div class="theme-input-box">
                        <label>{{trans('lang.confirm-password')}}</label>
                        <input type="Password" name="password_confirmation" class="theme-input">
                    </div>
                    <div class="profile-btn">
                        <button class="theme-btn">{{trans('lang.update')}}</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="profile_image_modal" tabindex="-1" role="dialog" aria-labelledby="modal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header   col-md-12">
                    <div class=" col-md-10 row ">
                        <div class="col-md-2 text-right">
                            <div class="circle_icon " style="background-color: red"><i
                                    class="fas fa-info"></i></div>
                        </div>
                    </div>


                    <div class=" text-left">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                </div>
                <div class="modal-body">
                    <div class="inner">
                        <div class="form-row form-row-date">
                            <div class="form-holder form-holder-2 col-md-12">
                                <div class="container" style="text-align: center;">
                                    <form id="data" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12 col-md-offset-3 "
                                                 style="text-align: center;">
                                                <div class="btn-container">
                                                    <!--the three icons: default, ok file (img), error file (not an img)-->

                                                    <h1 class="imgupload"><i
                                                            class="zmdi zmdi-cloud-upload"
                                                            style="color: #0B4879;"></i>
                                                    </h1>
                                                    <h1 class="imgupload ok"><i
                                                            class="zmdi zmdi-check"></i></h1>
                                                    <h1 class="imgupload stop"><i
                                                            class="zmdi zmdi-close-circle"></i>
                                                    </h1>
                                                    <!--this field changes dinamically displaying the filename we are trying to upload-->
                                                    <p id="namefile">{{trans('lang.img-extension')}}
                                                        (jpg,jpeg,bmp,png)</p>
                                                    <!--our custom btn which which stays under the actual one-->
                                                    <button type="button" id="btnup" class="btn  btn-lg"
                                                            style="background-color: #0B4879; color: white">
                                                        {{trans('lang.brows-imgs')}}
                                                    </button>
                                                    <!--this is the actual file input, is set with opacity=0 beacause we wanna see our custom one-->
                                                    <input type="file" value="" name="fileup"
                                                           id="fileup">
                                                    <input type="hidden" name="order_id" id="model_order_id" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!--additional fields-->


                                </div>


                            </div>

                        </div>

                    </div>

                </div>
                {{--                                        <div class="modal-footer">--}}
                {{--                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                {{--                                            <button type="button" class="btn btn-primary">Save changes</button>--}}
                {{--                                        </div>--}}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).on("click", '.show_add_file_model', function (e) {
            e.preventDefault();
            $('#profile_image_modal').modal('show');

        });

        $('#fileup').change(function () {

            // Check file selected or not
            // if (files.length > 0)

//here we take the file extension and set an array of valid extensions
            var res = $('#fileup').val();
            var arr = res.split("\\");
            var filename = arr.slice(-1)[0];
            filextension = filename.split(".");
            filext = "." + filextension.slice(-1)[0];
            valid = [".jpg", ".png", ".jpeg", ".bmp"];
//if file is not valid we show the error icon, the red alert, and hide the submit button
            if (valid.indexOf(filext.toLowerCase()) == -1) {
                $(".imgupload").hide("slow");
                $(".imgupload.ok").hide("slow");
                $(".imgupload.stop").show("slow");

                $('#namefile').css({"color": "red", "font-weight": 700});
                $('#namefile').html("File " + filename + " is not  pic!");

                $("#submitbtn").hide();
                $("#fakebtn").show();
            } else {
                var formData = new FormData($("form#data")[0]);
                $.ajax({
                    url: "{{route('update_img_profile')}}",
                    type: "post",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: function (response) {
                        $("#img_path").attr("src", response.data);
                        $("#prfile_image_nav").attr("src", response.data);
                        console.log(response);
                        $.toast({
                            heading: "success",
                            position: {
                                right: 10,
                                top: 10
                            },
                            text: response.message,
                            icon: 'success'
                        });

                        $('#profile_image_modal').modal('hide');
                    }
                });


                $(".imgupload").hide("slow");
                $(".imgupload.stop").hide("slow");
                $(".imgupload.ok").show("slow");

                $('#namefile').css({"color": "green", "font-weight": 700});
                $('#namefile').html(filename);

                $("#submitbtn").show();
                $("#fakebtn").hide();
            }
        });

    </script>
@endsection
