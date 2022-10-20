$(document).ready(function () {
    let rtlVar = false;
    if ($('.course-slider').hasClass('slickSlider')) {
        rtlVar = true;
    }
    if ($('.reviews-slider').hasClass('slickSlider')) {
        rtlVar = true;
    }
    if ($('.featured-course-slider').hasClass('slickSlider')) {
        rtlVar = true;
    }
    if ($('.popular-course-slider').hasClass('slickSlider')) {
        rtlVar = true;
    }
    $('.course-slider').slick({
        rtl: rtlVar,
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        prevArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-left"></i></button>',
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.featured-course-slider').slick({
        rtl: rtlVar,
        dots: true,
        autoplay: true,
        infinite: false,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        prevArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-left"></i></button>',
    });
    $('.popular-course-slider').slick({
        rtl: rtlVar,
        mobileFirst: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        prevArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-left"></i></button>',
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
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 6
                }
            }
        ]
    });

    $(".reviews-slider").slick({
        rtl: rtlVar,
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        arrows: false,
    });
});


/* 1. Visualizing things on Hover - See next part for action on click */
$('#stars .star').mouseover(function () {
    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

    // Now highlight all the stars that's not after the current hovered star
    $(this).parent().children('.star').each(function (e) {
        if (e < onStar) {
            $(this).addClass('hover');
        } else {
            $(this).removeClass('hover');
        }
    });

}).mouseout(function () {
    $(this).parent().children('.star').each(function (e) {
        $(this).removeClass('hover');
    });
});


/* 2. Action to perform on click */
$('#stars .star').click(function () {
    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
    var stars = $(this).parent().children('.star');

    for (i = 0; i < stars.length; i++) {
        $(stars[i]).removeClass('selected');
    }

    for (i = 0; i < onStar; i++) {
        $(stars[i]).addClass('selected');
    }
});

function changeVideo(videoUrl) {
    // let myVideo = videojs('my-video');
    // myVideo.src([
    //     {type: "video/*", src: videoUrl}
    // ]);
    // var video = document.getElementById('my-video');
    // var player = new Vimeo.Player(video);
    $('#my-video').attr('src', videoUrl);


}

$(function () {
    $(".nested-comment").slice(0, 3).show();
    if ($(".nested-comment:hidden").length == 0) {
        $("#loadMore").hide();
    }
    $("#loadMore").on('click', function (e) {
        e.preventDefault();
        $(".nested-comment:hidden").slice(0, 3).slideDown();
        if ($(".nested-comment:hidden").length == 0) {
            $("#loadMore").fadeOut('slow');
        }
    });
});
