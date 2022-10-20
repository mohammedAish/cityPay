@extends('layouts.org_web.layout')

@section('keywords')
    <meta name="keywords" content=" {{ isset($serviceItem->service_keyword)?$header->service_keyword:'تداول' }}" />
@endsection

@section('content')

    <header class="inner-header no-overlay service-header service4" style="margin-top:6%;
        background: linear-gradient(to bottom, rgba(11,72,121,0.25), rgba(11,72,121,0.75)),url({{asset('/app/public/'.(isset($serviceItem->service_background)?$serviceItem->service_background:'1.jpg'))}});
        background-size: cover;
        background-position: bottom;">
        <div class="container">
            <div class="section-heading">

                <h1>{{$parentServices->name}}</h1>
                <p>{{$parentServices->description}}</p>
                @auth
                @else
                    <button class="btn">

                        {{ __('site.subscribe') }}
                    </button>
                @endauth

            </div>
        </div>
    </header>

    <!-- Main content -->
    <main class="inner-service-page">
        <section class="clients light">
            <div class="container">
                <div class="section-heading">
                    <h1>{{isset($parentServices->name)?$parentServices->name:''}}</h1>
                </div>
                <div class="row">
                    <p class="text-center">{!! isset($parentServices->description)?$parentServices->description:'' !!}</p>
                </div>
            <!--    <div class="slickSlider autoplay-slider">
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                    <div class="client-logo">
                        <img src="{{asset('/org_assets/dist/img/logo-placeholder.png')}}" alt="">
                    </div>
                </div>
                -->
            </div>
        </section>
        <section class="category-section">
            <div class="container">

                <div class="row justify-content-center">
                    @foreach($parentServices->services as $services)

                        <div class="col-lg-3 col-md-6">

                            <a  href="{{$services->view_link}}"  >
                                <div class="single-category-item">
                                    <div class="category-image">
                                        <img src="{{config('app.url').$services->img_path}}" alt="image">
                                        <img src="{{asset('org_assets/dist/img/courseimg/round-shape-3.png')}}" alt="shape"
                                             class="feature-round-shape-3">
                                    </div>
                                    <div class="category-title margin-bottom-10">
                                        <h4 style="color: dimgrey;">{{$services->name}}</h4>
                                    </div>
{{--                                    <span>{{$consultants_cat->consultants->count()}} استشارات </span>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <section class="">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        {{ __('site.service_features') }}
                    </h1>
                    <!-- <p>هذا وصف فرعي للعنوان الرئيسي</p> -->
                </div>

                <div class="row features">


                    @if(isset($parentServices->serviceFeatures) && count($parentServices->serviceFeatures)>0)
                        @foreach($parentServices->serviceFeatures as $index =>$service_feature)
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="card-grid">
                                    <div class="card-grid-content">
                                        <div class="feature">
                                            <span>{{ ++$index }}</span>
                                            <img src="{{asset('/org_assets/dist/img/svg/star-green.svg')}}" alt="">
                                        </div>
{{--                                        <h5>{!! isset($service_feature->feature_title)?$service_feature->feature_title:'' !!}</h5>--}}
                                        <h5>{!! isset($service_feature->description)?$service_feature->description:'' !!}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    @else

                        <h5>
                            {{ __('site.nofeatures') }}
                        </h5>

                    @endif


                </div>
            </div>
        </section>
        @auth
        @else


        <section class="light login-service">
            <div class="container">
                <div class="section-heading">
                    <h1>
                        {!! $parentServices->name !!}
                    </h1>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <p class="text-center">
                            {!! $parentServices->short_description !!}
                        </p>
                    </div>
                    <div class="col-sm-12 text-center btns">
                        <button class="btn" data-toggle="modal" data-target="#loginModal">{{ __('site.userLogin') }}</button>
                        <button class="btn register-btn" data-toggle="modal" data-target="#registerModal">{{ __('site.userRegister') }}</button>
                    </div>
                </div>
            </div>
        </section>


        <!-- login modal -->
        <div class="modal fade formModal" id="loginModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('site.userLogin') }} </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('org_assets/dist/img/svg/login.svg') }}">
                        <section class="login">
                            <form class="login-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="email">
                                        {{ __('site.email') }}

                                        <sup>*</sup></label>
                                    <input type="email" class="form-control" name="email" placeholder="{{ __('site.enter email') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">
                                        {{ __('site.password') }}
                                        <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password" placeholder="{{ __('site.enter password') }}" required>
                                </div>
                                <div class="check">
                                    <div class="form-group form-check">
                                        <input name="remember-me" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="remember-me">
                                            {{ __('auth.RememberMe') }}
                                        </label>
                                    </div>
                                    <a data-toggle="modal" data-target="#restorePasswordModal">  {{ __('auth.Forgot Your Password?') }}</a>
                                </div>
                                <button type="submit" class="btn">
                                    {{ __('site.userLogin') }}
                                </button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <!-- register modal -->
        <div class="modal fade formModal" id="registerModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('site.userRegister') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('org_assets/dist/img/svg/login.svg') }}">
                        <section class="register">
                            <form action="{{route('userRegister_post')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">{{ __('site.fullname') }} <sup>*</sup></label>
                                    <input type="text" class="form-control" name="name" placeholder="{{ __('site.Please enter your full name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="userName"> {{ __('site.userName') }} <sup>*</sup></label>
                                    <input type="text" class="form-control" name="userName" placeholder=" {{ __('site.enter userName') }} " required>
                                </div>
                                <div class="form-group">
                                    <label for="email">{{ __('site.email') }} <sup>*</sup></label>
                                    <input type="email" class="form-control" name="email" placeholder="{{ __('site.enter email') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="country">{{ __('site.country') }}</label>
                                        <select class="countries_select form-control" name="countries">
                                            <option value="Afganistan">Afghanistan</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antigua & Barbuda">Antigua & Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bonaire">Bonaire</option>
                                            <option value="Bosnia & Herzegovina">Bosnia & Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Canary Islands">Canary Islands</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Channel Islands">Channel Islands</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos Island">Cocos Island</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote DIvoire">Cote DIvoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Curaco">Curacao</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Ter">French Southern Ter</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Great Britain">Great Britain</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Hawaii">Hawaii</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="India">India</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea North">Korea North</option>
                                            <option value="Korea Sout">Korea South</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macau">Macau</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Midway Islands">Midway Islands</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Nambia">Nambia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherland Antilles">Netherland Antilles</option>
                                            <option value="Netherlands">Netherlands (Holland, Europe)</option>
                                            <option value="Nevis">Nevis</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau Island">Palau Island</option>
                                            <option value="Palestine">Palestine</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Phillipines">Philippines</option>
                                            <option value="Pitcairn Island">Pitcairn Island</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Republic of Montenegro">Republic of Montenegro</option>
                                            <option value="Republic of Serbia">Republic of Serbia</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="St Barthelemy">St Barthelemy</option>
                                            <option value="St Eustatius">St Eustatius</option>
                                            <option value="St Helena">St Helena</option>
                                            <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                                            <option value="St Lucia">St Lucia</option>
                                            <option value="St Maarten">St Maarten</option>
                                            <option value="St Pierre & Miquelon">St Pierre & Miquelon</option>
                                            <option value="St Vincent & Grenadines">St Vincent & Grenadines</option>
                                            <option value="Saipan">Saipan</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="Samoa American">Samoa American</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome & Principe">Sao Tome & Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Tahiti">Tahiti</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad & Tobago">Trinidad & Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks & Caicos Is">Turks & Caicos Is</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Erimates">United Arab Emirates</option>
                                            <option value="United States of America">United States of America</option>
                                            <option value="Uraguay">Uruguay</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City State">Vatican City State</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                                            <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                                            <option value="Wake Island">Wake Island</option>
                                            <option value="Wallis & Futana Is">Wallis & Futana Is</option>
                                            <option value="Yemen" selected>Yemen</option>
                                            <option value="Zaire">Zaire</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>


                                    </div>
                                  {{--  <div class="col-sm-12 col-md-4 form-group">
                                        <label for="country">
                                            {{ __('site.usertype') }}
                                        </label>
                                        <select class="countries_select form-control" name="level">
                                            <option value="user" selected>{{__('site.userAccount')}}</option>
                                            <option value="marking">{{__('site.marking')}}</option>
                                        </select>
                                    </div>--}}
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="phone_number">{{ __('site.phone') }}</label>
                                        <input type="tel" class="form-control" name="phone_number" placeholder="{{ __('site.enter your phone') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="whatsUp_Number">{{ __('site.whatsUp Number') }}</label>
                                        <input type="tel" class="form-control" name="whatsUp_Number" placeholder="{{ __('site.enter your whatsApp') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-4 form-group">
                                        <label for="facebook_Account"> {{ __('site.facebook Account') }}</label>
                                        <input type="url" class="form-control" name="facebook_Account" placeholder="{{ __('site.enter facebook_Account') }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">{{ __('site.password') }} <sup>*</sup></label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="{{ __('site.enter password') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="password-confirm">{{ __('site.pass_confirm') }} <sup>*</sup></label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="{{ __('site.pass_con_again') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">{{ __('site.not_robot') }}  <sup>*</sup></label>
                                    @if(env('GOOGLE_RECAPTCHA_KEY'))
                                        <div class="g-recaptcha"
                                             data-sitekey="{{env('GOOGLE_RECAPTCHA_KEY')}}">
                                        </div>
                                    @endif

                                </div>

                                <div class="check">
                                    <div class="form-group form-check">
                                        <input name="agree" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="forgot-password">
                                            {{ __('site.agree') }} <a href="{{ route('privacyPolicy') }}">{{ __('site.rules') }}</a>
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn">{{ __('site.userRegister') }}</button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </main>
    <!-- Footer -->
@endsection
