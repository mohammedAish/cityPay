
    <!-- Footer -->
    <footer>
        <section class="contact-footer">
            <div class="container">
                <section class="row contact-us">
                    <div class="col-sm-12 col-lg-6">
                        <h5>
                            {{ __('site.stayconnected') }}
                        </h5>
                        <section class="icon-link-container contactIcons">
                            <a href="tel:{{isset($footer->phone)?$footer->phone:'phone number'}}" class="icon-link phone"
                               >
                                <i class="fas fa-phone"></i>
                            </a>
                            <a href="mailto:{{(isset($footer->email)?$footer->email:'email')}}" class="icon-link email">
                                <i class="fas fa-at"></i>
                            </a>
                            <a href="https://wa.me/{{(isset($footer->whatsapp)?$footer->whatsapp:'whatsappnumber')}}" target="_blank"
                               class="icon-link whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="{{(isset($footer->telegram)?$footer->telegram:'telegram')}}" class="icon-link telegram">
                                <i class="fab fa-telegram"></i>
                            </a>
                            <a href="{{(isset($footer->messenger)?$footer->messenger:'messenger')}}" target="_blank" class="icon-link facebook">
                                <i class="fab fa-facebook-messenger"></i>
                            </a>
                            <a href="{{(isset($footer->viber)?$footer->viber:'viber')}}" target="_blank" target="_blank" class="icon-link viber">
                                <i class="fab fa-viber"></i>
                            </a>
                            <a href="skype:{{(isset($footer->skype)?$footer->skype:'skype')}}?chat" class="icon-link skype">
                                <i class="fab fa-skype"></i>
                            </a>
                            <a href="#" class="icon-link chat">
                                <i class="fas fa-comments"></i>
                            </a>
                        </section>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <h5>{{ __('site.social') }}</h5>
                        <section class="icon-link-container">
                            <div class="social-media-links">
                                <a href="{{(isset($footer->fb)?$footer->fb:'fb')}}" target="_blank" class="icon-link facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{{(isset($footer->twitter)?$footer->twitter:'twitter account here')}}" target="_blank"
                                   class="icon-link twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="{{(isset($footer->instagram)?$footer->instagram:'instagram')}}" target="_blank" class="icon-link instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{{(isset($footer->telegram)?$footer->telegram:'telegram')}}" class="icon-link telegram">
                                    <i class="fab fa-telegram"></i>
                                </a>
                                <a href="{{(isset($footer->linkdein)?$footer->linkdein:'linkdein account here')}}" target="_blank" class="icon-link linkedin">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                                <a href="{{(isset($footer->youtube)?$footer->youtube:'youtube account here')}}" target="_blank" class="icon-link youtube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </div>
                        </section>
                    </div>
                </section>
            </div>
        </section>
        <div class="container">

            <section class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="company">
                        <div class="company-logo" ><img src="{{asset('/app/public/'.'logo.png')}}"  style="border-radius: 0%;" alt=""></div>
                        <div class="logo-title">


                        </div>

                    </div>

                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="footer-links links">
                        <h5 class="footer-title">
                            {{ __('site.oursite') }}
                        </h5>
                        <ul>
                            <li class="footer-nav-link">
                                <a href="{{route('aboutus')}}"> {{ __('site.about_company') }}</a>
                            </li>
                            <li class="footer-nav-link">
                                <a href="{{route('news')}}">{{ __('site.news') }}</a>
                            </li>
                            <li class="footer-nav-link">
                                <a href="{{route('services')}}">{{ __('site.services') }}</a>
                            </li>
                            <li class="footer-nav-link">
                                <a href="{{route('offers')}}">{{ __('site.offers') }}</a>
                            </li>
                            <li class="footer-nav-link">
                                <a href="{{route('blog')}}">{{ __('site.blog') }}</a>
                            </li>
                            <li class="footer-nav-link">
                                <a href="{{route('privacyPolicy')}}"> {{ __('site.privacyPolicy') }} </a>
                            </li>
                            <li class="footer-nav-link">
                                <a href="{{route('accessPolicy')}}">{{ __('site.accessPolicy') }}</a>
                            </li>

                        <li class="footer-nav-link">
                            <a  href="{{route('contact')}}"> {{ __('site.contact') }} </a>
                        </li>
                        </ul>
                    </div>
                    <div class="newsletter">
                        <h5 class="footer-title">{{ __('site.newsletters_subscribe_in') }}</h5>
                        <form role="form" action="#" method="post" class="m-t-15">
                            {{csrf_field()}}
                        <div class="input-group">
                            <input type="email" name="email" class="form-control" placeholder="{{ __('site.enter email') }}" aria-label="email" aria-describedby="button-addon">
                            <div class="input-group-append">
                                <button class="btn" type="submit" id="button-addon" style="margin-top: 0rem;">
                                    {{ __('site.subscribe') }}
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
        <section class="copyrights">
            <div class="row" style="margin-right: 0px; margin-left: 0px;">
            <div class="col-lg-2">
            </div>
            <div class="col-lg-6">
                    </p>

            </div>
            <div class="col-lg-4" style="text-align: left !important;">
                    <span >Powered By <a href="https://www.romoz.co/" target="_blank">ROMOZ CO</a> </span>
            </div>
            </div>
        </section>




    </footer>

    <!--  -->
