$(window).on('load', function () {
    $(".preloader").fadeOut(3000).delay(100, function(){
        $(this).remove();
    });
});
/*  
    Start Login/Register page scripts
*/
// Toggle active class between forms

$('.log-title').click(function(){
    $('.log-title').removeClass('active');
    $(this).addClass('active');
    let inactive_form = $('.form-type').not('.active');
    $('.form-type').removeClass('active');
    inactive_form.addClass('active');
});

// copy link to clipboard
$('#copy-link').click(function(){
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(".url").text()).select();
    document.execCommand("copy");
    $temp.remove();

    $('.alert').css('display', 'block');

    window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 2000);
});

// upvote amd downvote
$('.rate-type').one('click', function(){
    let rateResult = $('.rate-result .no');
    let currentVal = rateResult.html();
    if($(this).is('#upVote')){
        currentVal--;    
        rateResult.html(currentVal+=2);
    }else{
        rateResult.html(currentVal-=1);
    }
});

// reactions on post
$(".emojis .emoji input").change(function(e){
    $(".emojis .emoji").each(function(index){
        $(this).find('.emoji-no').html($(this).find('input').data("init"));
    });
    let changeResult = $(this).siblings('.emoji-no');
    let emojiVal = $(this).data("init");
    emojiVal--;    
    changeResult.html(emojiVal+=2);
    $(this).changeResult.html();
    
});

// append new comment
$('.new-comment :submit').click(function(e){
    e.preventDefault();
    let comment_text = $('.new-comment').find('textarea').val();
    let loc = $('.comments .list');
    let new_comment = `
        <section class="comment-card">
            <div class="row author">
                <div class="col">
                    <p class="author-name">اسم صاحب التعليق</p>
                    <p class="date">20/05/2020 - 03:15</p>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <p>` + comment_text + `</p>
                </div>
            </div>
        </section>
    `;
    loc.prepend(new_comment);
});

// Forms validations
$(function() {
    let formEmail = "قم بكتابة بريد إلكتروني صحيح",
        formPass = "تأكد من إدخال كلمة المرور الصحيحة",
        formConfirmPass = "تأكد من تطابق كلمة المرور",
        formName = "قم بكتابة الإسم صحيح";
    
    if($('.form-lang').hasClass('en-form')){
        formEmail = "Enter valid email";
        formPass = "Enter the correct password";
        formConfirmPass = "Enter matched password";
        formName = "Enter Your full name";
        
    }
    $(".login form").validate({
        messages: {
            email: formEmail,
            password: formPass
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    $(".register form").validate({
        rules: {
            password: {
                minlength: 5
            },
            confirm_password: {
                minlength: 5,
                equalTo: '#password',
            }
        },
        messages: {
            name: formName,
            email: formEmail,
            password: formPass,
            confirm_password: formConfirmPass
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
});

/*  
    End Login/Register page scripts
*/




/*  
    Start slick sliders scripts
*/
$(document).ready(function(){
    let rtlVar = false;
    if($('.autoplay-slider').hasClass('slickSlider')){
        rtlVar = true;
    }
    if($('.reviews-slider').hasClass('slickSlider')){
        rtlVar = true;
    }
    $('.offerSlider').slick({
        rtl: rtlVar,
        dots: true,
        autoplay: true,
        autoplaySpeed: 3500,
        arrows: false,
        infinite: true,
        speed: 500,
        fade: true,
        cssEase: 'linear'
    });
    $('.autoplay-slider').slick({
        rtl: rtlVar,
        mobileFirst: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        arrows: false,
        responsive: [
            {
                breakpoint: 560,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 992,
                settings: {
                    centerMode: true,
                    centerPadding: '0px',
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 4
                }
            }
          ]
    });
    $('.certificates .cert-slider').slick({
        rtl: rtlVar,
        adaptiveHeight: true,
        centerMode: true,
        centerPadding: '60px',
        autoplay: true,
        autoplaySpeed: 2500,
        slidesToShow: 3,
        arrows: false,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              centerMode: true,
              centerPadding: '20px',
              slidesToShow: 3
            }
          },
          {
            breakpoint: 480,
            settings: {
              centerMode: true,
              centerPadding: '20px',
              slidesToShow: 1
            }
          }
        ]
    }); 
    $(".services-slider").slick({
        rtl: rtlVar,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        prevArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-left"></i></button>',
    });
    $(".reviews-slider").slick({
        rtl: rtlVar,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
        // nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        // prevArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-left"></i></button>',
    });



    
});



