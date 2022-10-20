
<!-- 
    
@extends('layouts.org_web.layout')
@section('content')
    @if (!(isset($paddingTopExists) and $paddingTopExists))
        <div class="h-spacer"></div>
    @endif
    <div class="main-container">
        <div class="container">
            <div class="row">

                @if (isset($errors) and $errors->any())
                    <div class="col-xl-12">
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <ul class="list list-check">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                @if (Session::has('flash_notification'))
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">
                                @include('flash::message')
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-lg-5 col-md-8 col-sm-10 col-xs-12 login-box">
                    <div class="card card-default">
                        <div class="panel-intro text-center">
                            <h2 class="logo-title">
                                <span class="logo-icon"> </span> {{ t('reset_password') }} <span> </span>
                            </h2>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ url('password/reset') }}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="token" value="{{ $token }}">

-->     
                    <!-- 
                    
                                <?php $loginError = (isset($errors) and $errors->has('login')) ? ' is-invalid' : ''; ?>
                                <div class="form-group">
                                    <label for="login" class="control-label">{{ t('login') . ' (' . getLoginLabel() . ')' }}:</label>
                                    <input type="text" name="login" value="{{ old('login') }}" placeholder="{{ getLoginLabel() }}" class="form-control{{ $loginError }}">
                                </div>

                               
                                <?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
                                <div class="form-group">
                                    <label for="password" class="control-label">{{ t('password') }}:</label>
                                    <input type="password" name="password" placeholder="" class="form-control email{{ $passwordError }}">
                                </div>

                               
                                <?php $passwordError = (isset($errors) and $errors->has('password')) ? ' is-invalid' : ''; ?>
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-form-label">{{ t('Password Confirmation') }}:</label>
                                    <input type="password" name="password_confirmation" placeholder="" class="form-control email{{ $passwordError }}">
                                </div>

{{--
                            @includeFirst([config('larapen.core.customizedViewPath') . 'layouts.inc.tools.recaptcha', 'layouts.inc.tools.recaptcha'], ['noLabel' => true])
--}}

                            
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">{{ t('Reset the Password') }}</button>
                                </div>
                            </form>
                        </div>

                        <div class="card-footer text-center">
                            <a href="{{ \App\Helpers\UrlGen::login() }}"> {{ t('back_to_the_log_in_page') }} </a>
                        </div>
                    </div>
                    <div class="login-box-btm text-center">
                        <p>
                            {{ t('do_not_have_an_account') }} <br>
                            <a href="{{ \App\Helpers\UrlGen::register() }}"><strong>{{ t('sign_up_') }}</strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')
    <script>
        $(document).ready(function () {
            $("#pwdBtn").click(function () {
                $("#pwdForm").submit();
                return false;
            });
        });
    </script>
@endsection
    -->