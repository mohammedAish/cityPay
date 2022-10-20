<section class="upPage">
    <div class="item btn-group dropup">

    <div id="body">

{{--        <div id="chat-circle" class="btn btn-raised">--}}
{{--            <div id="chat-overlay"></div>--}}
{{--            <i class="material-icons">message</i>--}}
{{--        </div>--}}

{{--        <div class="chat-box">--}}
{{--            <div class="chat-box-header">--}}
{{--                ابدأ الدردشة--}}
{{--                <span class="chat-box-toggle"><i class="material-icons">close</i></span>--}}
{{--            </div>--}}
{{--            <div class="chat-box-body">--}}
{{--                <div class="chat-box-overlay">--}}
{{--                </div>--}}
{{--                <div class="chat-logs">--}}

{{--                </div><!--chat-log -->--}}
{{--            </div>--}}
{{--            <div class="chat-input">--}}
{{--                <form>--}}
{{--                    <input type="text" id="chat-input" placeholder="Send a message..."/>--}}
{{--                    <button type="submit" class="chat-submit" id="chat-submit"><i class="material-icons">send</i></button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}




    </div>
    </div>
    <div class="item btn-group dropup">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <i class="fas fa-comment-dots"></i>
            <i class="fas fa-times"></i>
        </button>
        <div class="dropdown-menu">
            <div class="icons">
                <a href="https://wa.me/{{(isset($footer->whatsapp)?$footer->whatsapp:'whatsappnumber')}}"
                   class="icon-link whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="{{(isset($footer->telegram)?$footer->telegram:'telegram number here')}}"
                   class="icon-link telegram">
                    <i class="fab fa-telegram"></i>
                </a>
                <a href="{{(isset($footer->messenger)?$footer->messenger:'messenger account here')}}"
                   class="icon-link facebook">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
                <a href="{{(isset($footer->viber)?$footer->viber:'viber number here')}}" class="icon-link viber">
                    <i class="fab fa-viber"></i>
                </a>
                <a href="{{(isset($footer->skype)?$footer->skype:'skype number here')}}" class="icon-link skype">
                    <i class="fab fa-skype"></i>
                </a>


            </div>
        </div>
    </div>
    <button class="item upBtn" onclick="scrollToTop()"><i class="fas fa-chevron-up"></i></button>
</section>
