(function($) {
    "use strict"
    jQuery(document).ready(function() {

        // Navbar Toggle
        $(".menu-bar").on('click', function(){
            $(".category-menu").toggleClass("active");
        });

        // Main Menu
        $(".menu-toggle-bar").on('click', function(){
            $(".main-menu").toggleClass("active");
        });
        // Main Menu ToggleBar
        $(".menu-toggle-bar").on('click', function(){
            $(this).toggleClass("active");
        });

        // Category Drawer
        $(".category-dropdown.category-bar").on('click', function(){
            $(".category-drawer").toggleClass("active");
        });
        $(".drawer-crossbar").on('click', function(){
            $(".category-drawer").removeClass("active");
        });

        // MouseHover Animation
        var hoverLayer = $(".hero-section");
		var heroImgOne = $(".hero-small-image-1");
		var heroImgTwo = $(".hero-small-image-2");
		var heroImgThree = $(".hero-small-image-3");
		var heroImgFour = $(".hero-small-image-4");
		hoverLayer.mousemove(function(e) {
            var valueX = (e.pageX * -1) / 100;
            var valueY = (e.pageY * -1) / 120;
            heroImgOne.css({
                transform: "translate3d(" + valueX + "px," + valueY + "px, 0)"
            });
        });
		hoverLayer.mousemove(function(e) {
            var valueX = (e.pageX * -1) / 60;
            var valueY = (e.pageY * -1) / 80;
            heroImgTwo.css({
                transform: "translate3d(" + valueX + "px," + valueY + "px, 0)"
            });
        });
		hoverLayer.mousemove(function(e) {
            var valueX = (e.pageX * -1) / 40;
            var valueY = (e.pageY * -1) / 60;
            heroImgThree.css({
                transform: "translate3d(" + valueX + "px," + valueY + "px, 0)"
            });
        });
		hoverLayer.mousemove(function(e) {
            var valueX = (e.pageX * -1) / 80;
            var valueY = (e.pageY * -1) / 100;
            heroImgFour.css({
                transform: "translate3d(" + valueX + "px," + valueY + "px, 0)"
            });
        });

        // CounterUp
        $('.counter').counterUp({
            delay: 10,
            time: 1500
        });

        // Video Play Button
        $('.video-play-button a').magnificPopup({
            type: 'iframe'
        });

        // Footer Button Toggle
        $(".dropup-item.item-1 button").on('click', function(){
            $(".toggle-box.box-1").toggleClass("active");
        });
        $(".dropup-item.item-2 button").on('click', function(){
            $(".toggle-box.box-2").toggleClass("active");
        });

        // Blog Thumbnail Slider
        $('.blog-thumbnail-slider').slick({
            dots: false,
            infinite: true,
            speed: 1200,
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<i class="prev-arrow fa fa-arrow-left"></i>',
            nextArrow: '<i class="next-arrow fa fa-arrow-right"></i>',
        });

        // Blog Details Slider
        $('.blog-details-slider').slick({
            dots: false,
            infinite: true,
            speed: 1200,
            autoplay: true,
            autoplaySpeed: 3000,
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            prevArrow: '<i class="prev-arrow fa fa-arrow-left"></i>',
            nextArrow: '<i class="next-arrow fa fa-arrow-right"></i>',
            responsive: [{
                breakpoint: 1200,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }, ]
        });


        // Masonry Tab.
        //TODO adjust it for both langs
		var $grid = $('.grid').isotope({
			itemSelector: '.grid-item',
			percentPosition: true,
            originLeft: false,

            masonry: {
			columnWidth: 0,
                isRTL: true

            }
		});
		// Course Tab on Click
		$('.course-tab li').on( 'click', function() {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });
		});
		// Course Tab Link Switching
		$('.course-tab li').on('click', function(event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });

        // Barfiller Progress
        $('#bar1').barfiller({
            barColor: '#50be46'
        });
        $('#bar2').barfiller({
            barColor: '#50be46'
        });
        $('#bar3').barfiller({
            barColor: '#50be46'
        });
        $('#bar4').barfiller({
            barColor: '#50be46'
        });
        $('#bar5').barfiller({
            barColor: '#50be46'
        });
        $('#bar6').barfiller({
            barColor: '#50be46'
        });

        // Cart Item Remove
        $('.single-cart-item .template-button').on('click', function(e) {
            $(this).parents('.single-cart-item').hide();
            e.preventDefault();
        });

        // Payment Method Tab
        $(".payment-tab ul li").on('click', function() {
            var tabClass = $(this).attr("class");
            $(this).addClass("active").siblings().removeClass("active");
            $("." + tabClass + "-content").addClass("active").siblings().removeClass("active");
        });

        // Login Tab
        $(".login-tab ul li").on('click', function(e) {
            var tabClass = $(this).attr("class");
            $(this).addClass("active").siblings().removeClass("active");
            $("." + tabClass + "-content").addClass("active").siblings().removeClass("active");
            e.preventDefault();
        });

        // Course Details Tab
        $(".course-details-tab ul li").on('click', function() {
            var tabClass = $(this).attr("class");
            $(this).addClass("active").siblings().removeClass("active");
            $("." + tabClass + "-content").addClass("active").siblings().removeClass("active");
        });

        // Course Video Tab
        $(".course-video-tab ul li").on('click', function() {
            var tabClass = $(this).attr("class");
            $(this).addClass("active").siblings().removeClass("active");
            $("." + tabClass + "-content").addClass("active").siblings().removeClass("active");
        });

        // Brand Home 02 Slider
        $('.brand-home-2-slider').slick({
            dots: false,
            infinite: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: false,
            responsive: [ {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            }, {
                breakpoint: 576,
                settings: {
                    slidesToShow: 2,
                }
            },]
        });

        // Popular Course Tab on Click
		$('.popular-course-tab li').on( 'click', function() {
			var filterValue = $(this).attr('data-filter');
			$grid.isotope({ filter: filterValue });
		});
		// Popular Course Tab Link Switching
		$('.popular-course-tab li').on('click', function(event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });

        // Feedback Slider
        $('.feedback-slider').slick({
            dots: true,
            infinite: true,
            speed: 1000,
            autoplay: true,
            autoplaySpeed: 2000,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
        });

        // CountDown
        $('.countdown').downCount({
            date: '04/24/2021 12:00:00',
            offset: +6
        }, function () {
            alert('Countdown done!');
        });

    });

    jQuery(window).on('load', function() {

        // WOW JS
        new WOW().init();

        // Preloader
        var preLoder = $("#preloader");
        preLoder.fadeOut(0);

    });
})(jQuery);
