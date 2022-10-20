<?php
header("Content-Type:text/css");
$color = "#f0f"; // Change your Color Here
$secondColor = "#ff8"; // Change your Color Here

function checkhexcolor($color){
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}

if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#e51c39";
}


function checkhexcolor2($secondColor){
    return preg_match('/^#[a-f0-9]{6}$/i', $secondColor);
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor2($secondColor)) {
    $secondColor = "#e51c39";
}
?>

<style>



/* ---------------------------------------

[Main Stylesheet]

Project:    	  eWallet - The next generation online payment gateway
Version:    	  1.0
Primary Use:      Online money transection system

------------------------------------------

[Table of contents]

1. Fonts
2. Reset Css
3. Global Settings
4. Section Styles
5. Colors
6. Margin and Padding
7. Background Overlay
8. Buttons Style
9. Preloader
10. ScrollUp Button
11. Main Header style
12. Hero Area
13. Features Area
14. Custom Hero
15. Promo Area
16. Our Partners
17. Pricing Table
18. Why Choose us
19. Parallax Area
20. Testimonial Area
21. Counter Area
22. App Area
23. Blog Area
24. Footer Area
25. Custom Banner
26. About Area
27. Award Area
28. Card Features
29. All Partners Area
30. Team Area
31. Card Apply Form
32. Become Partner Area
33. Card Details Area
34. Choose Card
35. Faq Area
36. Error Area

-------------------------------------------*/
/***

===============
Fonts
===============


 font-family: Almarai,sans-serif;
 font-family: Almarai,sans-serif;

***/
@import url('https://fonts.googleapis.com/css?family=Lato:300i,400,400i,700|Rajdhani:300,400,500,600,700&display=swap');
/***

===============
Reset Css
===============

***/
* {
margin: 0px;
padding: 0px;
border: none;
outline: none;
}

/***

===================
Global Settings
===================

***/
body {
font-size: 16px;
color: #111111;
line-height: 1.7em;
font-weight: 400;
background: #ffffff;
-webkit-font-smoothing: antialiased;
-moz-font-smoothing: antialiased;
font-family: Almarai,sans-serif;
}

a {
text-decoration: none;
cursor: pointer;
transition: .3s;
color: #111111;
}

button,
a:hover, a:focus, a:visited {
text-decoration: none;
outline: none !important;
transition: .3s;
}

h1, h2, h3, h4, h5, h6 {
position: relative;
font-weight: 700;
margin: 0px;
background: none;
line-height: 1.2em;
 font-family: Almarai,sans-serif;
}

h1 {
font-size: 52px;
}

h2 {
font-size: 40px;
}

h3 {
font-size: 30px;
}

h4 {
font-size: 24px;
}

h5 {
font-size: 20px;
}

h6 {
font-size: 18px;
}

input, button, select, textarea {
outline: none;
}

textarea {
overflow: hidden;
}

p {
position: relative;
font-family: Almarai,sans-serif;
}

img {
-webkit-user-drag: none;
-khtml-user-drag: none;
-moz-user-drag: none;
-o-user-drag: none;
display: inline-block;
max-width: 100%;
}

ul, li {
list-style: none;
padding: 0px;
margin: 0px;
}

img {
display: inline-block;
max-width: 100%;
}

::selection {
background-color: <?php echo $color; ?>;
color: #fff;
}

-moz-::selection {
background-color: <?php echo $color; ?>;
color: #fff;
}

-webkit-::selection {
background-color: <?php echo $color; ?>;
color: #fff;
}

-o-::selection {
background-color: <?php echo $color; ?>;
color: #fff;
}

.page-wrapper {
position: relative;
margin: 0 auto;
width: 100%;
min-width: 300px;
overflow: hidden;
}

.btn.focus, .btn:focus {
box-shadow: none;
}

.border-0 {
border: 0px;
}

.radius-50 {
border-radius: 50px !important;
}

.radius-0 {
border-radius: 0px !important;
}

.centered {
text-align: center;
}

/*
Flaticon icon font: Flaticon
*/
@font-face {
font-family: "Flaticon";
src: url("../fonts/Flaticon.eot");
src: url("../fonts/Flaticon.eot?#iefix") format("embedded-opentype"), url("../fonts/Flaticon.woff") format("woff"), url("../fonts/Flaticon.ttf") format("truetype"), url("../fonts/Flaticon.svg#Flaticon") format("svg");
font-weight: normal;
font-style: normal;
}

@media screen and (-webkit-min-device-pixel-ratio: 0) {
@    font-face {
font-family: "Flaticon";
src: url("../fonts/Flaticon.svg#Flaticon") format("svg");
}
}

[class^="flaticon-"]:before, [class*=" flaticon-"]:before,
[class^="flaticon-"]:after, [class*=" flaticon-"]:after {
font-family: Flaticon;
font-style: normal;
}

.flaticon-add:before {
content: "\f100";
}

.flaticon-bag:before {
content: "\f101";
}

.flaticon-battery:before {
content: "\f102";
}

.flaticon-bell:before {
content: "\f103";
}

.flaticon-bluetooth:before {
content: "\f104";
}

.flaticon-bookmark:before {
content: "\f105";
}

.flaticon-briefcase:before {
content: "\f106";
}

.flaticon-calendar:before {
content: "\f107";
}

.flaticon-cancel:before {
content: "\f108";
}

.flaticon-cancel-1:before {
content: "\f109";
}

.flaticon-clip:before {
content: "\f10a";
}

.flaticon-clock:before {
content: "\f10b";
}

.flaticon-clock-1:before {
content: "\f10c";
}

.flaticon-cloud:before {
content: "\f10d";
}

.flaticon-correct:before {
content: "\f10e";
}

.flaticon-credit-card:before {
content: "\f10f";
}

.flaticon-cursor:before {
content: "\f110";
}

.flaticon-cursor-1:before {
content: "\f111";
}

.flaticon-cut:before {
content: "\f112";
}

.flaticon-cutlery:before {
content: "\f113";
}

.flaticon-down-arrow:before {
content: "\f114";
}

.flaticon-download:before {
content: "\f115";
}

.flaticon-edit:before {
content: "\f116";
}

.flaticon-envelope:before {
content: "\f117";
}

.flaticon-export:before {
content: "\f118";
}

.flaticon-favorite:before {
content: "\f119";
}

.flaticon-file:before {
content: "\f11a";
}

.flaticon-folder:before {
content: "\f11b";
}

.flaticon-forward:before {
content: "\f11c";
}

.flaticon-gallery:before {
content: "\f11d";
}

.flaticon-gamepad:before {
content: "\f11e";
}

.flaticon-garbage:before {
content: "\f11f";
}

.flaticon-headphones:before {
content: "\f120";
}

.flaticon-heart:before {
content: "\f121";
}

.flaticon-help:before {
content: "\f122";
}

.flaticon-home:before {
content: "\f123";
}

.flaticon-hourglass:before {
content: "\f124";
}

.flaticon-info:before {
content: "\f125";
}

.flaticon-layer:before {
content: "\f126";
}

.flaticon-layout:before {
content: "\f127";
}

.flaticon-left-arrow:before {
content: "\f128";
}

.flaticon-left-arrow-1:before {
content: "\f129";
}

.flaticon-lightning:before {
content: "\f12a";
}

.flaticon-link:before {
content: "\f12b";
}

.flaticon-logout:before {
content: "\f12c";
}

.flaticon-magnet:before {
content: "\f12d";
}

.flaticon-map:before {
content: "\f12e";
}

.flaticon-menu:before {
content: "\f12f";
}

.flaticon-monitor:before {
content: "\f130";
}

.flaticon-moon:before {
content: "\f131";
}

.flaticon-padnote:before {
content: "\f132";
}

.flaticon-paint:before {
content: "\f133";
}

.flaticon-pause:before {
content: "\f134";
}

.flaticon-photo-camera:before {
content: "\f135";
}

.flaticon-placeholder:before {
content: "\f136";
}

.flaticon-play-button:before {
content: "\f137";
}

.flaticon-power:before {
content: "\f138";
}

.flaticon-presentation:before {
content: "\f139";
}

.flaticon-printer:before {
content: "\f13a";
}

.flaticon-profile:before {
content: "\f13b";
}

.flaticon-prohibition:before {
content: "\f13c";
}

.flaticon-push-pin:before {
content: "\f13d";
}

.flaticon-puzzle:before {
content: "\f13e";
}

.flaticon-refresh:before {
content: "\f13f";
}

.flaticon-remove:before {
content: "\f140";
}

.flaticon-rewind:before {
content: "\f141";
}

.flaticon-right-arrow:before {
content: "\f142";
}

.flaticon-right-arrow-1:before {
content: "\f143";
}

.flaticon-rocket-launch:before {
content: "\f144";
}

.flaticon-screen:before {
content: "\f145";
}

.flaticon-search:before {
content: "\f146";
}

.flaticon-settings:before {
content: "\f147";
}

.flaticon-settings-1:before {
content: "\f148";
}

.flaticon-settings-2:before {
content: "\f149";
}

.flaticon-share:before {
content: "\f14a";
}

.flaticon-shield:before {
content: "\f14b";
}

.flaticon-shopping-cart:before {
content: "\f14c";
}

.flaticon-shutter:before {
content: "\f14d";
}

.flaticon-smartphone:before {
content: "\f14e";
}

.flaticon-speech-bubble:before {
content: "\f14f";
}

.flaticon-speedometer:before {
content: "\f150";
}

.flaticon-stats:before {
content: "\f151";
}

.flaticon-store:before {
content: "\f152";
}

.flaticon-sun:before {
content: "\f153";
}

.flaticon-switch:before {
content: "\f154";
}

.flaticon-tag:before {
content: "\f155";
}

.flaticon-target:before {
content: "\f156";
}

.flaticon-timer:before {
content: "\f157";
}

.flaticon-unlock:before {
content: "\f158";
}

.flaticon-up-arrow:before {
content: "\f159";
}

.flaticon-upload:before {
content: "\f15a";
}

.flaticon-video:before {
content: "\f15b";
}

.flaticon-video-camera:before {
content: "\f15c";
}

.flaticon-visible:before {
content: "\f15d";
}

.flaticon-voice-recorder:before {
content: "\f15e";
}

.flaticon-volume:before {
content: "\f15f";
}

.flaticon-waiting:before {
content: "\f160";
}

.flaticon-wifi:before {
content: "\f161";
}

.flaticon-zoom:before {
content: "\f162";
}

.flaticon-zoom-out:before {
content: "\f163";
}

/***

==================
Color Classes
==================

***/
.cl-black {
color: #111111;
}

.cl-primary {
color: <?php echo $color; ?>;
}

.cl-white {
color: #ffffff;
}

.cl-blue {
color: #052146;
}

.cl-blue-2 {
color: #053560;
}

.cl-green {
color: #86BC42;
}

.cl-mint {
color: #0865f1;
}

.cl-yellow {
color: #ffb142;
}

.cl-gray {
color: #F9F9F9;
}

.cl-facebook {
color: <?php echo  $color?>;
}

.cl-twitter {
color: #55ACEE;
}

.cl-youtube {
color: #CD201F;
}

.cl-pinterest {
color: #BD081C;
}

.cl-instagram {
color: #F5214A;
}

.facebook-bg {
background: #3B5999;
}

.twitter-bg {
background: #55ACEE;
}

.youtube-bg {
background: #CD201F;
}

.pinterest-bg {
background: #BD081C;
}

.google-plus-bg {
background: #DD5144;
}

.linkedin-bg {
background: #0077B5;
}

.instagram-bg {
background: #F5214A;
}

/***

==================
Section Styles
==================

***/
.container {
max-width: 1200px;
}

.section-padding {
padding: 100px 0;
}

.section-padding-2 {
padding-top: 100px;
padding-bottom: 70px;
}

.section-title {
margin-bottom: 35px;
}

.section-title h2 {
position: relative;
display: inline-block;
font-size: 32px;
font-weight: 700;
line-height: 1.4;
z-index: 1;
text-transform: capitalize;
margin-bottom: 15px;
margin-top: -6px;
}

.section-title h2 span {
color: <?php echo $color; ?>;
}

.section-title h4 {
font-size: 16px;
 font-family: Almarai,sans-serif;
margin-bottom: 10px;
text-transform: uppercase;
font-weight: 600;
}

.section-title p {
margin-bottom: 50px;
}

@media (max-width: 991px) {
.section-padding {
padding: 70px 0;
}

.section-padding-2 {
padding-top: 70px;
padding-bottom: 70px;
}
}

@media (max-width: 767px) {
.section-padding {
padding: 50px 0;
}

.section-padding-2 {
padding-top: 50px;
padding-bottom: 20px;
}
}

@media (max-width: 575px) {
.section-title h2 {
font-size: 36px;
}
}

@media (max-width: 450px) {
.section-title h2 {
font-size: 32px;
}
}

/***

=======================
Margin and Padding
=======================

***/
/*
Margin Top styles
*/
.mar-0 {
margin: 0;
}

.mt-10 {
margin-top: 10px;
}

.mt-20 {
margin-top: 20px;
}

.mt-30 {
margin-top: 30px;
}

.mt-40 {
margin-top: 40px;
}

.mt-50 {
margin-top: 50px;
}

.mt-60 {
margin-top: 60px;
}

/*
Margin Bottom Styles
*/
.mb-10 {
margin-bottom: 10px;
}

.mb-20 {
margin-bottom: 20px;
}

.mb-30 {
margin-bottom: 30px;
}

.mb-40 {
margin-bottom: 40px;
}

.mb-50 {
margin-bottom: 50px;
}

.mb-60 {
margin-bottom: 60px;
}

/*
Margin Right Styles
*/
.mr-10 {
margin-right: 10px;
}

.mr-20 {
margin-right: 20px;
}

.mr-30 {
margin-right: 30px;
}

.mr-40 {
margin-right: 40px;
}

.mr-50 {
margin-right: 50px;
}

.mr-60 {
margin-right: 60px;
}

/*
Padding Top Styles
*/
.pad-0 {
padding: 0;
}

.pt-10 {
padding-top: 10px;
}

.pt-20 {
padding-top: 20px;
}

.pt-30 {
padding-top: 30px;
}

.pt-40 {
padding-top: 40px;
}

.pt-50 {
padding-top: 50px;
}

.pt-60 {
padding-top: 60px;
}

.pad-15 {
padding: 15px !important;
}

/*
Padding Bottom Styles
*/
.pb-10 {
padding-bottom: 10px;
}

.pb-20 {
padding-bottom: 20px;
}

.pb-30 {
padding-bottom: 30px;
}

.pb-40 {
padding-bottom: 40px;
}

.pb-50 {
padding-bottom: 50px;
}

.pb-60 {
padding-bottom: 60px;
}

/***

============================
Background and Overlay
============================

***/
.gray-bg {
background: #F9F9F9;
}

.black-bg {
background: #292929;
}

.black-bg-2 {
background: #555555;
}

.primary-bg {
background: <?php echo $color; ?>;
}

.primary-light-bg {
background: #00C9B72c;
}

.primary-bg-dark {
background: #037EBD;
}

.white-bg {
background: #ffffff;
}

.blue-bg {
background: #052146;
}

.blue-2-bg {
background: #234BA5;
}

.green-bg {
background: #86BC42;
}

.blue-bg-2 {
background: #000040;
}

.yellow-bg {
background: #FDB62F;
}

.yellow-light-bg {
background: #FEEDCD;
}

.purple-bg {
background: #8E0EF0;
}

.purple-light-bg {
background: #E8CFFC;
}

.mint-bg {
background: #0865f1;
}

.transparent-bg {
background: transparent;
}

.gradient-bg {
background-image: linear-gradient(to left, #30cfd0 0%, #330867 100%);
}

.dark-overlay {
background-size: cover !important;
position: relative;
z-index: 1;
}

.dark-overlay:after {
position: absolute;
left: 0;
top: 0;
height: 100%;
width: 100%;
background: #111;
content: "";
z-index: -1;
opacity: .6;
}

.mint-overlay {
background-size: cover !important;
position: relative;
z-index: 1;
}

.mint-overlay:after {
position: absolute;
left: 0;
top: 0;
height: 100%;
width: 100%;
background: #0865f1;
content: "";
z-index: -1;
opacity: .7;
}

.blue-overlay {
background-size: cover !important;
position: relative;
z-index: 1;
}

.blue-overlay:after {
position: absolute;
left: 0;
top: 0;
height: 100%;
width: 100%;
background: #052146;
content: "";
z-index: -1;
opacity: .85;
}

.home-gradient-overlay {
background-size: cover !important;
position: relative;
z-index: 1;
}

.home-gradient-overlay:after {
position: absolute;
left: 0;
top: 0;
height: 100%;
width: 100%;
background-image: linear-gradient(90deg, #02004c 0%, #02004b 31%, #02004b 100%);
content: "";
z-index: -1;
opacity: .5;
}

.gradient-overlay {
background-size: cover !important;
position: relative;
z-index: 1;
}

.gradient-overlay:after {
position: absolute;
left: 0;
top: 0;
height: 100%;
width: 100%;
background: #000036;
content: "";
z-index: -1;
<!-- opacity: .95; -->
}
.gradient-overlay.breadcrumb-area:after {
    opacity: 1;
}


.pm.gradient-overlay:after {

background: #000036;
content: "";
z-index: -1;
opacity: .75;
}

.work.gradient-overlay:after {

background: #000036;
content: "";
z-index: -1;
opacity: .75;
}



/***

===================
Buttons Style
===================

***/
.bttn-mid {
position: relative;
font-size: 14px;
font-weight: 700;
padding: 14px 40px;
display: inline-block;
border-radius: 50px;
cursor: pointer;
text-transform: uppercase;
transition: 0.4s;
 font-family: Almarai,sans-serif;
}

.bttn-small {
position: relative;
font-size: 14px;
font-weight: 700;
padding: 6px 30px;
display: inline-block;
border-radius: 50px;
cursor: pointer;
transition: 0.4s;
font-family: Almarai,sans-serif;
text-transform: uppercase;
}

.bttn-mid i, .bttn-small i {
margin-right: 7px;
}

.btn-fill {
color: #ffffff;
background: <?php echo  $color?>;
}

.btn-fill:hover {
background: #052146;
color: #ffffff;
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
}

.bttn-mid.btn-emt {
padding: 12px 41px;
}
.bttn-mid.btn-emt.white-btn {
background: #fff;
color: #000036;
}

.btn-emt {
background: transparent;
color: #ffffff;
border: 2px solid #ffffff;
}

.btn-emt:hover {
color: #111111;
box-shadow: none;
background: #ffffff;
}

.btn-wht {
background: #ffffff;
color: <?php echo $color; ?>;
}

.btn-wht:hover {
background: <?php echo $color; ?>;
color: #ffffff;
}

/* ==============================
Preloader
============================== */
.preloader {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
z-index: 99999;
display: flex;
flex-flow: row nowrap;
justify-content: center;
align-items: center;
background: none repeat scroll 0 0 #ffffff;
}

.spinner {
border: 1px solid transparent;
border-radius: 3px;
position: relative;
}

.spinner:before {
content: '';
box-sizing: border-box;
position: absolute;
top: 50%;
left: 50%;
width: 60px;
height: 60px;
margin-top: -10px;
margin-left: -10px;
border-radius: 50%;
border: 4px solid #052146;
border-top-color: #ffffff;
animation: spinner 1s linear infinite;
}

@keyframes spinner {
to {
transform: rotate(360deg);
}
}

/*
==============================
ScrollUp Button
==============================
*/
a#scrollUp {
right: 10px;
bottom: 10px;
width: 40px;
height: 40px;
border-radius: 50%;
display: flex;
flex-direction: column;
justify-content: center;
background: <?php echo  $color?>;
box-shadow: 0px 0px 15px 0px rgba(72, 67, 211, 0.12);
text-align: center;
color: #ffffff;
font-size: 14px;
}

/*

==========================
Main Header style
==========================

*/
.header-area {
padding: 15px 0;
position: fixed;
top: 0;
width: 100%;
z-index: 3;
transition: 0.2s;
border-bottom: 1px solid transparent;
}

@media (max-width: 575px) {
.header-area {
padding: 15px;
}
}

.header-area.sticky-header {
background: #000036;
padding: 10px 0;
border-color: rgba(255, 255, 255, .3);
}

@media (max-width: 575px) {
.header-area.sticky-header {
padding: 15px;
}
}

.header-area .main-menu {
padding-left: 0;
padding-right: 0;
}

.header-area .main-menu ul li {
margin-right: 25px;
}

.header-area .main-menu ul li:last-child {
margin-right: 0px;
}

.header-area .main-menu ul li:hover a,
.header-area .main-menu ul li.active a {
color: <?php echo  $color?>;
}

.header-area .main-menu ul li a {
color: #ffffff;
font-weight: 700;
font-family: Almarai,sans-serif;
}

.header-area .main-menu ul li:nth-last-of-type(1) .dropdown-menu .dropdown-menu, .header-area .main-menu ul li:nth-last-of-type(2) .dropdown-menu .dropdown-menu, .header-area .main-menu ul li:nth-last-of-type(3) .dropdown-menu .dropdown-menu {
left: -100%;
top: 0;
}

.header-area .main-menu .header-btn a {
margin-left: 10px;
}

@media (max-width: 991px) {
.header-area .main-menu .header-btn a {
margin-left: 0;
margin-right: 5px;
}
}

.header-btn a {
margin-left: 10px;
}

@media (max-width: 991px) {
.header-btn a {
margin-left: 0;
margin-right: 5px;
}
}

/** Custom Select **/
.custom-select-wrapper {
position: relative;
display: inline-block;
user-select: none;
margin-left: 10px;
}

@media (max-width: 991px) {
.custom-select-wrapper {
margin-left: 0px;
margin-bottom: 15px;
}
}

.custom-select-wrapper select {
display: none;
}

.custom-select-2 {
position: relative;
display: inline-block;
}

.custom-select-trigger {
position: relative;
display: block;
font-size: 14px;
color: #fff;
cursor: pointer;
width: 100px;
padding: 6px 0;
border: 2px solid #fff;
padding-left: 10px;
border-radius: 50px;
text-align: center;
padding-right: 20px;
background: #000036;
}

.custom-select-trigger:after {
position: absolute;
display: block;
content: '';
width: 7px;
height: 7px;
top: 50%;
right: 10px;
margin-top: -3px;
border-bottom: 1px solid #fff;
border-right: 1px solid #fff;
transform: rotate(45deg) translateY(-50%);
transition: all .4s ease-in-out;
transform-origin: 50% 0;
}

.custom-select-2.opened .custom-select-trigger:after {
margin-top: 3px;
transform: rotate(-135deg) translateY(-50%);
}

.custom-options {
z-index: 1;
position: absolute;
display: block;
top: 100%;
left: 0;
right: 0;
min-width: 100%;
margin: 15px 0;
border-radius: 4px;
box-sizing: border-box;
box-shadow: 0 2px 1px rgba(0, 0, 0, 0.07);
background: #0865f1;
transition: all .4s ease-in-out;
opacity: 0;
visibility: hidden;
pointer-events: none;
transform: translateY(-15px);
}

.custom-select-2.opened .custom-options {
opacity: 1;
visibility: visible;
pointer-events: all;
transform: translateY(0);
}

.custom-options:before {
position: absolute;
display: block;
content: '';
bottom: 100%;
right: 25px;
width: 7px;
height: 7px;
margin-bottom: -4px;
border-top: 1px solid #052146;
border-left: 1px solid #052146;
background: #0865f1;
transform: rotate(45deg);
transition: all .4s ease-in-out;
}

.option-hover:before {
background: #f9f9f9;
}

.custom-option {
position: relative;
display: block;
padding: 0 22px;
font-weight: 600;
color: #ffffff;
line-height: 35px;
cursor: pointer;
transition: all .4s ease-in-out;
}

.custom-option:first-of-type {
border-radius: 4px 4px 0 0;
}

.custom-option:last-of-type {
border-bottom: 0;
border-radius: 0 0 4px 4px;
}

.custom-option:hover,
.custom-option.selection {
background: #0865f1;
}

.navbar-brand img {
height: 40px;
width: auto;
}

ul.dropdown-menu li a {
text-transform: capitalize;
}

li.nav-item.dropdown .dropdown-toggle {
position: relative;
}

li.nav-item.dropdown .dropdown-toggle:before {
position: absolute;
content: "\e64b";
 font-family: Almarai,sans-serif;
font-size: 8px;
font-weight: normal;
right: -7px;
top: 50%;
transform: translateY(-50%);
}

@media (max-width: 1199px) {
li.nav-item.dropdown .dropdown-toggle:before {
display: none;
}
}

.dropdown-menu li.nav-item.dropdown:before {
position: absolute;
content: "\f107";
font-family: 'FontAwesome';
font-size: 16px;
right: 15px;
top: 48%;
transform: translateY(-48%) rotate(-90deg);
color: #111111;
}

.dropdown a {
transition: 0.4s;
}

.dropdown-menu {
opacity: 0;
visibility: hidden;
transition: all 0.5s;
display: block;
background: #ffffff;
margin-top: 23px;
width: 220px;
border-radius: 0;
border: 0;
-webkit-box-shadow: 0px 7px 20px -14px rgba(34, 54, 60, 0.74);
box-shadow: 0px 7px 20px -14px rgba(34, 54, 60, 0.74);
}

.dropdown:hover > .dropdown-menu {
opacity: 1;
visibility: visible;
transform: translate3d(0, -5px, 0);
}

.dropdown-menu a {
padding-top: 7px;
padding-bottom: 7px;
font-size: 14px;
color: #111111 !important;
}

.dropdown-menu a:hover {
background: transparent;
}

.dropdown-menu a:active {
background: transparent;
}

ul.dropdown-menu li .dropdown-menu {
left: 100%;
top: 0;
}

@media (max-width: 991px) {
ul.dropdown-menu li .dropdown-menu.show {
visibility: visible;
opacity: 1;
}
}

.main-menu ul li ul li {
margin-right: 0;
}

.menu-toggle {
position: relative;
display: block;
width: 25px;
height: 20px;
background: transparent;
border-top: 2px solid #ffffff;
border-bottom: 2px solid #ffffff;
color: #111111;
font-size: 0;
-webkit-transition: all 0.25s ease-in-out;
-o-transition: all 0.25s ease-in-out;
transition: all 0.25s ease-in-out;
}

.menu-toggle:before, .menu-toggle:after {
content: '';
display: block;
width: 100%;
height: 2px;
position: absolute;
top: 50%;
left: 50%;
background: #ffffff;
-webkit-transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
transform: translate(-50%, -50%);
transition: -webkit-transform 0.25s ease-in-out;
-webkit-transition: -webkit-transform 0.25s ease-in-out;
-o-transition: -webkit-transform 0.25s ease-in-out;
transition: transform 0.25s ease-in-out;
-moz-transition: -webkit-transform 0.25s ease-in-out;
-ms-transition: -webkit-transform 0.25s ease-in-out;
}

span.is-active {
border-color: transparent;
}

span.is-active:before {
-webkit-transform: translate(-50%, -50%) rotate(45deg);
-ms-transform: translate(-50%, -50%) rotate(45deg);
transform: translate(-50%, -50%) rotate(45deg);
}

span.is-active:after {
-webkit-transform: translate(-50%, -50%) rotate(-45deg);
-ms-transform: translate(-50%, -50%) rotate(-45deg);
transform: translate(-50%, -50%) rotate(-45deg);
}

span.menu-toggle:hover {
color: #ffb606;
}

span.is-active {
border-color: transparent;
}

span.is-active:before {
-webkit-transform: translate(-50%, -50%) rotate(45deg);
-ms-transform: translate(-50%, -50%) rotate(45deg);
transform: translate(-50%, -50%) rotate(45deg);
}

span.is-active:after {
-webkit-transform: translate(-50%, -50%) rotate(-45deg);
-ms-transform: translate(-50%, -50%) rotate(-45deg);
transform: translate(-50%, -50%) rotate(-45deg);
}

.dropdown-toggle::after {
display: none;
}

.black-bg .menu-toggle {
border-top: 2px solid #ffffff;
border-bottom: 2px solid #ffffff;
}

.black-bg .menu-toggle::before, .black-bg .menu-toggle::after {
background: #ffffff;
}

.black-bg .menu-toggle.is-active {
border-color: transparent;
}

.main-menu ul li:nth-last-of-type(1) .dropdown-menu .dropdown-menu, .main-menu ul li:nth-last-of-type(2) .dropdown-menu .dropdown-menu, .main-menu ul li:nth-last-of-type(3) .dropdown-menu .dropdown-menu {
left: -100%;
top: 0;
}

@media (max-width: 991px) {
.navbar-brand {
margin-left: 15px;
}

.main-menu ul li {
margin-right: 0;
position: relative;
margin: 3px 0;
}

.main-menu ul li.dropdown a {
z-index: 999;
position: relative;
color: #ffffff;
}

.main-menu ul li a {
color: #ffffff;
}

.main-menu ul li.dropdown:after {
position: absolute;
content: "\f107";
font-family: FontAwesome;
right: 0;
top: 0;
color: #ffffff;
line-height: 35px;
overflow: hidden;
z-index: 1;
width: 35px;
border-radius: 50%;
text-align: center;
background: <?php echo $color; ?>;
}

.dropdown-menu {
display: none;
}

.dropdown-menu {
width: auto;
margin: 10px 15px 10px 0;
background: #ffffff;
}

.navbar-collapse {
margin-top: 20px;
padding-left: 15px;
max-height: 450px;
overflow: auto;
 background: #052146;
padding-bottom: 20px;
}

.cart-btn {
margin-left: 0;
margin-top: 15px;
}

li.nav-item.dropdown:before {
display: none;
}
}

@media (max-width: 575px) {
.main-menu {
padding-left: 15px;
padding-right: 15px;
}

.navbar-brand {
margin-left: 0;
}

.navbar-toggler {
padding-right: 0;
}
}
.header-area-2 {
    padding: 10px 0;
    background: #000036;
    border-bottom: 1px solid #344b68;
}

.header-area-2 .dashboard-menu ul li {
margin: 0 7px;
}
.header-area-2 .dashboard-menu ul li.active a,
.header-area-2 .dashboard-menu ul li:hover a {
color: <?php echo $color?>;
}

.header-area-2 .dashboard-menu ul li a {
color: #ffffff;
font-size: 14px;
font-weight: 700;
}

.header-area-2 .dashboard-menu ul li ul.dropdown-menu li {
margin: 0 10px;
}

.header-area-2 .dashboard-menu ul li ul.dropdown-menu li a {
font-size: 14px;
padding: 10px;
}

/*

===============================
Footer Area
===============================

*/
.footer-area {
position: relative;
z-index: 1;
overflow: hidden;
}

.footer-area .footer-widget {
margin-bottom: 30px;
color: #ffffff;
}

.footer-area .footer-widget img {
margin-bottom: 20px;
}

.footer-area .footer-widget h3 {
font-size: 15px;
margin-bottom: 20px;
font-weight: 700;
position: relative;
color: <?php echo  $color?>;
text-transform: uppercase;
}

.footer-area .footer-widget p {
margin-bottom: 20px;
color: #ffffff;
font-size: 14px;
}

.footer-area .footer-widget .social a {
height: 35px;
width: 35px;
line-height: 37px;
border-radius: 50%;
background: #ffffff;
font-size: 13px;
text-align: center;
margin-right: 5px;
display: inline-block;
}

.footer-area .footer-widget .social a:hover {
background: <?php echo  $color?>;
color: #ffffff;
}

.footer-area .footer-widget.footer-nav {
margin-bottom: 30px;
}

.footer-area .footer-widget.footer-nav ul li {
margin-bottom: 10px;
position: relative;
transition: 0.4s;
}

.footer-area .footer-widget.footer-nav ul li:last-child {
margin-bottom: 0;
}

.footer-area .footer-widget.footer-nav ul li a {
color: #ffffff;
text-transform: capitalize;
 font-family: Almarai,sans-serif;
position: relative;
font-size: 15px;
}

.footer-area .footer-widget.footer-nav ul li a:hover {
text-decoration: underline;
}

.footer-area .footer-widget.footer-insta .row {
margin: 0 -2px;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] {
padding: 0 2px;
margin-bottom: 4px;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] a {
position: relative;
display: block;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] a img {
width: 100%;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] a::before {
position: absolute;
width: 100%;
height: 100%;
content: "";
left: 0;
top: 0;
background: #052146;
opacity: 0;
transition: 0.4s;
z-index: 1;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] a:after {
position: absolute;
left: 50%;
top: 50%;
transform: translate(-50%, -50%);
color: #ffffff;
font-size: 16px;
content: "\f06e";
font-family: Fontawesome;
opacity: 0;
z-index: 2;
transition: 0.4s;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] a:hover::before {
opacity: 0.8;
}

.footer-area .footer-widget.footer-insta .row [class*="col"] a:hover:after {
opacity: 1;
}

.footer-area .footer-widget .m-app {
text-align: center;
}

.footer-area .footer-widget .m-app a {
display: block;
margin-bottom: 15px;
padding: 16px;
border: 2px solid #ffffff;
border-radius: 4px;
color: #ffffff;
}

.footer-area .footer-widget .m-app a i {
margin-right: 8px;
}

.footer-area .footer-widget .m-app a:hover {
background: <?php echo $color?>;
border-color: <?php echo $color?>;
}



.footer-bottom-section {
border-top: 1px solid #fff;
padding-top: 10px;
margin-top: 15px;
}
@keyframes animate {
0% {
background-position: 0;
}

100% {
background-position: 1360px;
}
}

@keyframes animate-reverse {
0% {
background-position: 1360px;
}

100% {
background-position: 0px;
}
}

/*

===============================
Copyright Area
===============================

*/
.copyright p {
color: #ffffff;
font-size: 14px;
margin: 0;
}

@media (max-width: 767px) {
.copyright p {
text-align: center;
margin-bottom: 15px;
}
}



@media (max-width: 767px) {
.copyright ul {
float: none;
text-align: center;
}
}

.copyright ul li {
display: inline-block;
margin-left: 10px;
}

@media (max-width: 767px) {
.copyright ul li {
margin-left: 0px;
}
}

.copyright ul li a {
color: #111111;
}

.copyright ul li a:hover {
color: #0865f1;
}

/*

===============================
Hero Area
===============================

*/
.hero-section {
position: relative;
background-size: cover;
background-repeat: no-repeat;
background-position: center center;
}

.hero-section .hero-area .single-hero {
background-size: cover !important;
}

.hero-section .hero-area .single-hero .hero-sub {
display: table;
height: calc(100vh - 88px);
width: 100%;
color: #ffffff;
position: relative;
z-index: 2;
}

@media (max-width: 1333px) {
.hero-section .hero-area .single-hero .hero-sub {
text-align: center;
}
}

@media (max-width: 1024px) {
.hero-section .hero-area .single-hero .hero-sub {
height: auto;
padding: 200px 0 150px 0;
}
}

.hero-section .hero-area .single-hero .hero-sub .table-cell {
display: table-cell;
vertical-align: middle;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left h4 {
color: <?php echo  $color?>;
margin-bottom: 20px;
text-transform: uppercase;
 font-family: Almarai,sans-serif;
font-weight: 600;
font-size: 26px;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left h2 {
font-size: 42px;
font-weight: 900;
margin-bottom: 30px;
text-transform: uppercase;
}

@media (max-width: 575px) {
.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left h2 {
font-size: 36px;
}
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left h1 {
font-size: 60px;
font-weight: 900;
margin-bottom: 30px;
letter-spacing: -2px;
text-transform: uppercase;
}

@media (max-width: 575px) {
.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left h1 {
font-size: 36px;
}
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left p {
margin-bottom: 30px;
font-weight: 400;
line-height: 1.5em;
color: #ffffff75;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left a {
margin: 0 5px;
}

@media (max-width: 350px) {
.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left a {
margin: 0;
margin-top: 15px;
}
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left a.btn-fill:hover {
background: #ffffff;
color: #052146;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form {
color: #ffffff;
overflow: hidden;
border-radius: 4px;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form input,
.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form select
{
width: 100%;
height: 60px;
margin-bottom: 20px;
text-indent: 15px;
border: 2px solid #F9F9F9;
transition: 0.2s;
position: relative;
font-size: 16px;
font-weight: 700;
background: transparent;
border-radius: 4px;
color: #ffffff;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form select option {
background: #052146;
font-size: 14px;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form input:focus {
border-color: rgba(2, 169, 243, 0.8);
caret-color: #ffffff;
background-color: rgba(67, 114, 170, 0.341);
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form input::-webkit-input-placeholder {
color: #ccc;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form input::-ms-input-placeholder {
color: #ccc;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form input::placeholder {
color: #ccc;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form label {
float: left;
font-size: 14px;
color: #ffffff75;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form button {
border-radius: 4px;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form form button:hover {
color: #ffffff;
background: #1E1B40;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form .extra-links {
margin-top: 20px;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form .extra-links a {
float: left;
font-size: 14px;
text-transform: uppercase;
 font-family: Almarai,sans-serif;
font-weight: 700;
color: #ffffff;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form .extra-links a + a {
float: right;
}

.hero-section .hero-area .single-hero .hero-sub .table-cell .hero-left .account-form .extra-links a:hover {
text-decoration: underline;
}

/* ---- particles.js container ---- */
#particles-js {
position: absolute;
width: 100%;
left: 0;
top: 0;
background-color: transparent;
z-index: 1;
height: 100%;
}

/*

===============================
Widgets Area
===============================

*/
.widgets-area {
margin-top: -90px;
z-index: 1;
position: relative;
}

@media (max-width: 991px) {
.widgets-area {
margin-top: 120px;
}
}

.widgets-area .single-widget {
padding: 50px 40px;
color: #ffffff;
text-align: center;
position: relative;
border-radius: 5px;
}

@media (max-width: 991px) {
.widgets-area .single-widget {
margin-bottom: 70px;
}
}

.widgets-area .single-widget i {
font-size: 32px;
height: 90px;
width: 90px;
line-height: 90px;
text-align: center;
display: inline-block;
border-radius: 50%;
color: #ffffff;
z-index: 999999;
position: absolute;
left: 50%;
top: -50px;
transform: translateX(-50%);
}

.widgets-area .single-widget h4 {
margin-bottom: 20px;
margin-top: 15px;
font-size: 24px;
text-transform: capitalize;
}

.widgets-area .single-widget p {
margin: 0;
}

/*

===============================
About Area
===============================

*/
.about-area {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-ms-flex-wrap: nowrap;
flex-wrap: nowrap;
overflow: hidden;
align-items: center;
}

@media (max-width: 991px) {
.about-area {
flex-direction: column;
}
}

.about-area .about-left {
width: 50%;
background-position: center;
background-size: cover;
}

.about-area .about-left img {
     max-width: unset;
}
@media (max-width: 991px) {
.about-area .about-left {
 height: 450px;
 width: 100%;
display: none;
}
}

.about-area .about-left .about-img-wrap {
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-pack: center;
-ms-flex-pack: center;
justify-content: center;
height: 100%;
}

.about-area .about-left .left-img-wrap {
height: 100%;
width: 100%;
<!-- display: flex; -->
<!-- flex-wrap: wrap; -->
<!-- justify-content: center; -->
<!-- align-items: center; -->
}

.about-area .about-left .left-img-wrap a {
background: #0865f1;
height: 80px;
width: 80px;
border-radius: 50%;
text-align: center;
line-height: 78px;
}

.about-area .about-left .left-img-wrap a img {
height: 25px;
width: auto;
}

.about-area .about-content {
width: 50%;
z-index: 2;
padding: 120px 0 120px 0;
}

@media (max-width: 991px) {
.about-area .about-content {
width: 100%;
padding-bottom: 40px;
padding-top: 90px;
}
}

@media (max-width: 575px) {
.about-area .about-content {
padding-bottom: 50px;
padding-top: 50px;
}
}

.about-area .about-content .about-content-inner {
max-width: 585px;
padding-left: 60px;
margin-top: -10px;
}

@media (max-width: 1024px) {
.about-area .about-content .about-content-inner {
padding-right: 30px;
}
}

@media (max-width: 767px) {
.about-area .about-content .about-content-inner {
max-width: 100%;
}
}

@media (max-width: 450px) {
.about-area .about-content .about-content-inner {
padding: 0 20px;
text-align: center;
}
}

.about-area .about-content .about-content-inner p {
margin-bottom: 30px;
}

.about-area .about-content .about-content-inner ul {
margin-bottom: 20px;
}

.about-area .about-content .about-content-inner ul li {
margin-bottom: 15px;
}

.about-area .about-content .about-content-inner ul li:last-child {
margin-bottom: 0;
}

.about-area .about-content .about-content-inner ul li i {
color: <?php echo $color; ?>;
margin-right: 5px;
}

.about-area .about-content .about-content-inner .section-title h2:after {
left: 25px;
}

.about-area .about-content .about-content-inner-2 {
width: 585px;
margin: auto;
text-align: left;
margin-right: 0;
padding-right: 60px;
}

@media (max-width: 1180px) {
.about-area .about-content .about-content-inner-2 {
padding: 0 20px;
}
}

@media (max-width: 1024px) {
.about-area .about-content .about-content-inner-2 {
padding-right: 80px;
}
}

@media (max-width: 991px) {
.about-area .about-content .about-content-inner-2 {
width: 100%;
padding: 0 60px;
}
}

@media (max-width: 450px) {
.about-area .about-content .about-content-inner-2 {
width: 100%;
padding: 0 15px;
}
}

.about-area .about-content .about-content-inner-2 p {
margin-bottom: 30px;
}

.about-area .about-content .about-content-inner-2 .sign {
width: 180px;
}

.about-area .about-content .about-content-inner-2 ul li {
margin-bottom: 15px;
}

.about-area .about-content .about-content-inner-2 ul li:last-child {
margin-bottom: 0;
}

.about-area .about-content .about-content-inner-2 ul li i {
color: <?php echo $color; ?>;
margin-right: 5px;
}

@media (max-width: 767px) {
.about-area.section-padding {
padding-top: 0;
}
}

.about-area .single-about {
text-align: center;
position: relative;
}

.about-area .single-about img {
width: 100%;
}

.about-area .single-about a {
background: <?php echo $color; ?>;
height: 70px;
width: 70px;
border-radius: 50%;
text-align: center;
line-height: 68px;
display: block;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
}

.about-area .single-about a img {
height: 25px;
width: auto;
}

.about-area .single-about .counting b {
text-align: center;
border-right: 1px solid #ddd;
font-size: 14px;
font-weight: 600;
display: inline-block;
padding: 0 25px;
}

@media (max-width: 450px) {
.about-area .single-about .counting b {
border-right: 0px;
margin-bottom: 20px;
}
}

.about-area .single-about .counting b span {
display: block;
font-size: 24px;
margin-bottom: 5px;
}

.about-area .single-about .counting b:last-child {
border-right: 0;
}

/*

===============================
Services Area
===============================

*/
.services-area .single-service {
margin-bottom: 30px;
overflow: hidden;
}

.services-area .single-service .service-icon {
float: left;
margin-right: 8px;
width: 15%;
}

.services-area .single-service .service-icon i {
font-size: 38px;
margin-top: 6px;
display: inline-block;
color: <?php echo $color; ?>;
transition: 0.4s;
}

.services-area .single-service .service-content {
float: left;
width: 80%;
}

.services-area .single-service .service-content h4 {
margin-bottom: 10px;
font-size: 20px;
font-weight: 600;
transition: 0.4s;
}

.services-area .single-service .service-content h4 a {
color: #111111;
}

.services-area .single-service .service-content p {
margin-bottom: 0px;
}

.services-area .single-service:hover h4 a, .services-area .single-service:hover i {
color: #052146;
}

.services-area .single-service-2 {
padding: 30px;
border: 1px solid #b7b5b52e;
margin-bottom: 60px;
transition: 0.4s;
position: relative;
}

.services-area .single-service-2 .service-icon {
margin-top: -60px;
margin-bottom: 20px;
}

.services-area .single-service-2 .service-icon i {
font-size: 24px;
display: inline-block;
color: #052146;
transition: 0.4s;
height: 60px;
width: 60px;
line-height: 60px;
border-radius: 50%;
text-align: center;
box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);
background: #ffffff;
}

.services-area .single-service-2 .service-content h4 {
margin-bottom: 10px;
font-size: 20px;
font-weight: 600;
transition: 0.4s;
}

.services-area .single-service-2 .service-content h4 a {
color: #111111;
}

.services-area .single-service-2 .service-content h4 a span {
font-size: 42px;
font-weight: 700;
color: #5350ff17;
position: absolute;
top: -20px;
right: -10px;
transition: 0.4s;
}

.services-area .single-service-2 .service-content p {
margin-bottom: 0;
}

.services-area .single-service-2:hover {
box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.2);
}

.services-area .single-service-2:hover .service-icon i {
box-shadow: none;
background: #052146;
color: #ffffff;
}

.services-area .single-service-2:hover .service-content h4 a {
color: #052146;
}

.services-area .single-service-2:hover .service-content h4 a span {
color: #5350ff6b;
}

.services-area .single-service-3 {
padding: 50px 30px;
border: 1px solid #4843d31a;
margin-bottom: 30px;
border-radius: 4px;
text-align: center;
transition: 0.4s;
}

.services-area .single-service-3 .service-icon {
margin-bottom: 20px;
}

.services-area .single-service-3 .service-icon i {
font-size: 46px;
display: inline-block;
color: #052146;
transition: 0.4s;
}

.services-area .single-service-3 .service-content h4 {
margin-bottom: 10px;
font-size: 20px;
font-weight: 600;
transition: 0.4s;
}

.services-area .single-service-3 .service-content h4 a {
color: #111111;
}

.services-area .single-service-3 .service-content p {
margin-bottom: 0;
}

.services-area .single-service-3:hover {
box-shadow: 0px 0px 15px 0px rgba(72, 67, 211, 0.12);
}

.services-area .single-service-3:hover .service-icon i {
animation-name: heartbeat;
-webkit-animation-name: heartbeat;
-moz-animation-name: heartbeat;
-o-animation-name: heartbeat;
animation-duration: 500ms;
-webkit-animation-duration: 500ms;
-moz-animation-duration: 500ms;
-o-animation-duration: 500ms;
transform-origin: 50% 50%;
-webkit-transform-origin: 50% 50%;
-moz-transform-origin: 50% 50%;
-o-transform-origin: 50% 50%;
animation-iteration-count: 2;
-webkit-animation-iteration-count: 2;
-moz-animation-iteration-count: 2;
-o-animation-iteration-count: 2;
animation-timing-function: linear;
-webkit-animation-timing-function: linear;
-moz-animation-timing-function: linear;
-o-animation-timing-function: linear;
}

.services-area .single-service-3:hover .service-content h4 a {
color: #052146;
}

.services-area .service-details img {
margin-bottom: 30px;
width: 100%;
}

.services-area .service-details h3 {
margin-bottom: 20px;
}

.services-area .service-details h4 {
margin-bottom: 10px;
}

.services-area .service-details p {
margin-bottom: 20px;
}

/*

===============================
Review Area
===============================

*/
.review-area .reviews {
padding: 40px;
box-shadow: 0px 0px 21px 9px rgba(0, 0, 0, 0.05);
border-radius: 10px;
}

@media (max-width: 400px) {
.review-area .reviews {
padding: 20px;
}
}
.single-review {
text-align: center;
-webkit-transition: all ease 0.3s;
-moz-transition: all ease 0.3s;
transition: all ease 0.3s;
background: #fff;
border: 1px solid #e5e5e5;
border-bottom: 5px solid #e5e5e5;
-webkit-border-radius: 0 40px 0 40px;
-moz-border-radius: 0 40px 0 40px;
border-radius: 0 40px 0 40px;
padding: 60px 30px;
}
.single-review:hover {
background-color: <?php echo $color?>;
color: #fff;
-webkit-border-radius: 40px 0 40px 0;
-moz-border-radius: 40px 0 40px 0;
border-radius: 40px 0 40px 0;
}
.review-area .reviews .single-review .reviewer-thumb {
margin-bottom: 20px;
overflow: hidden;
color: #434a53;
}

.review-area .reviews .single-review .reviewer-thumb img {
height: 60px;
width: 60px;
border-radius: 50%;
float: left;
margin-right: 10px;
}

.review-area .reviews .single-review .reviewer-thumb h3 {
font-weight: 600;
font-size: 20px;
margin-top: 0px;
display: inline-block;
}

.review-area .reviews .single-review .reviewer-thumb span {
display: block;
font-size: 14px;
color: #052146;
}

.review-area .reviews .single-review .reviewer-thumb .stars i {
color: #ffb142;
font-size: 14px;
}

.review-area .reviews .single-review p {
margin-bottom: 60px;
font-size: 14px;
font-weight: 400;
line-height: 1.8em;
color: #111111;
font-style: italic;
}

.review-area .reviews .owl-dots {
position: absolute;
left: 50%;
bottom: 40px;
display: block;
transform: translateX(-50%);
}

.review-area .reviews .owl-dots .owl-dot {
border: 2px solid #434a53;
margin: 0 5px;
height: 10px;
width: 10px;
border-radius: 50%;
}

.review-area .reviews .owl-dots .owl-dot.active {
border-color: #052146;
background: #052146;
}

@media (max-width: 400px) {
.review-area .reviews .owl-dots {
display: none;
}
}

.review-area .testimonials {
padding-bottom: 60px;
<!--background: #000036;-->
<!--color: #ffffff;-->
border-radius: 8px;
position: relative;
}
.review-area .testimonials::after {
position: absolute;
content: "";
right: 30px;
top: 45px;
background: url("../images/quote.png") no-repeat;
height: 50px;
width: 50px;
display: none;
}

@media (max-width: 400px) {
.review-area .testimonials {
padding: 20px;
}
}

.review-area .testimonials .single-review .reviewer-thumb {
margin-bottom: 10px;
overflow: hidden;
}

.review-area .testimonials .single-review .reviewer-thumb img {
height: 60px;
width: 60px;
border-radius: 50%;
margin-left: auto;
margin-right: auto;
margin-bottom: 10px;
}

.review-area .testimonials .single-review .reviewer-thumb h3 {
font-weight: 700;
font-size: 20px;
margin-top: 0px;
display: inline-block;
}

.review-area .testimonials .single-review .reviewer-thumb span {
display: block;
font-size: 12px;
}

.review-area .testimonials .single-review p {
margin-bottom: 0;
font-size: 18px;
font-weight: 400;
line-height: 1.8em;
 font-family: Almarai,sans-serif;
}

.review-area .testimonials .owl-nav {
position: absolute;
left: 50%;
bottom: 0px;
display: block;
transform: translateX(-50%);
-webkit-transform: translateX(-50%);
-moz-transform: translateX(-50%);
}

.review-area .testimonials .owl-nav button i {
color: #c4c4c7;
border: 2px solid #c4c4c7;
font-size: 14px;
margin: 0 5px;
height: 35px;
width: 35px;
line-height: 32px;
text-align: center;
border-radius: 50%;
transition: 0.4s;
}

.review-area .testimonials .owl-nav button i:hover {
color: <?php echo  $color?>;
border: 2px solid <?php echo  $color?>;
}

@media (max-width: 400px) {
.review-area .testimonials .owl-nav {
display: none;
}
}

.review-area .buyer-review .single-buyer-review p {
font-style: italic;
}

.review-area .buyer-review .single-buyer-review .thum-info img {
height: 60px;
width: 60px;
margin: auto;
margin-bottom: 20px;
}

.review-area .buyer-review .single-buyer-review .thum-info h5 {
font-weight: 600;
font-size: 20px;
}

/*

===============================
Team Area
===============================

*/
.team-area .single-team {
text-align: center;
transition: 0.4s;
margin-bottom: 30px;
}

.team-area .single-team img {
width: 100%;
}

.team-area .single-team .team-content {
padding: 30px 30px 40px 30px;
box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.15);
background: #ffffff;
clip-path: polygon(0% 10%, 100% 0%, 100% 90%, 0 100%);
transition: 0.4s;
margin-top: -20px;
}

.team-area .single-team .team-content h4 {
font-size: 20px;
font-weight: 600;
margin-bottom: 5px;
transition: 0.4s;
}

.team-area .single-team .team-content p {
font-size: 14px;
color: #434a53;
}

.team-area .single-team .team-content .social a {
margin: 0 5px;
font-size: 18px;
}

.team-area .single-team .team-content .social a:hover {
color: <?php echo $color; ?>;
}

.team-area .single-team:hover .team-content {
clip-path: polygon(0 0, 100% 10%, 100% 100%, 0 90%);
}

.team-area .single-team:hover .team-content h4 {
color: <?php echo $color; ?>;
}

.team-area .single-team-2 {
text-align: center;
transition: 0.4s;
position: relative;
box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.15);
margin-bottom: 30px;
}

.team-area .single-team-2 .social {
position: absolute;
width: 50px;
left: 0;
box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.15);
background: #ffffff;
transition: 0.5s;
opacity: 0;
}

.team-area .single-team-2 .social a {
margin: 20px 0px;
font-size: 18px;
display: block;
}

.team-area .single-team-2 .social a:hover {
color: <?php echo $color; ?>;
}

.team-area .single-team-2 img {
width: 100%;
}

.team-area .single-team-2 .team-content {
padding: 30px 30px 40px 30px;
background: #ffffff;
transition: 0.4s;
}

.team-area .single-team-2 .team-content h4 {
font-size: 20px;
font-weight: 600;
margin-bottom: 5px;
transition: 0.4s;
}

.team-area .single-team-2 .team-content p {
color: #434a53;
margin-bottom: 0;
}

.team-area .single-team-2:hover .social {
opacity: 1;
}

.team-area .single-team-2:hover .team-content h4 {
color: <?php echo $color; ?>;
}

.team-area .single-team-3 {
transition: 0.4s;
position: relative;
box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.11);
margin-bottom: 30px;
background: #ffffff;
}

.team-area .single-team-3 img {
width: 100%;
height: 100%;
}

.team-area .single-team-3 .team-content {
padding: 30px 10px 30px 0;
transition: 0.4s;
}

@media (max-width: 575px) {
.team-area .single-team-3 .team-content {
padding: 30px;
}
}

.team-area .single-team-3 .team-content h4 {
font-size: 20px;
font-weight: 600;
margin-bottom: 5px;
transition: 0.4s;
}

.team-area .single-team-3 .team-content span {
color: #86BC42;
margin-bottom: 10px;
font-size: 14px;
}

.team-area .single-team-3 .team-content p {
color: #434a53;
margin-bottom: 0px;
text-transform: capitalize;
}

.team-area .single-team-3 .team-content .social {
margin-bottom: 10px;
}

.team-area .single-team-3 .team-content .social a {
margin-right: 10px;
font-size: 14px;
display: inline-block;
}

.team-area .single-team-3 .team-content .social a:hover {
color: <?php echo $color; ?>;
}

.team-area .single-team-4 {
text-align: center;
transition: 0.4s;
position: relative;
box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.15);
margin-bottom: 30px;
}

.team-area .single-team-4 img {
width: 100%;
}

.team-area .single-team-4 .team-content {
padding: 20px;
background: #ffffff;
transition: 0.5s;
position: absolute;
width: 100%;
bottom: -10px;
opacity: 0;
}

.team-area .single-team-4 .team-content .social {
transition: 0.5s;
}

.team-area .single-team-4 .team-content .social a {
margin: 0 5px;
font-size: 14px;
}

.team-area .single-team-4 .team-content .social a:hover {
color: <?php echo $color?>;
}

.team-area .single-team-4 .team-content h4 {
font-size: 18px;
font-weight: 600;
margin-bottom: 10px;
transition: 0.4s;
}

.team-area .single-team-4 .team-content p {
margin-bottom: 8px;
font-size: 13px;
}

.team-area .single-team-4:hover .team-content {
opacity: 1;
bottom: 0px;
}

/*

===============================
brands Area
===============================

*/
.single-brands {
text-align: center;
}

.single-brands a {
display: block;
background: #fff;
padding: 20px;
border: 2px solid #eaeaea;
}

.single-brands a:hover img {
transform: scale(1.1);
}

.single-brands a img {
height: 100px;
width: auto !important;
margin: auto;
transition: 0.4s;
}
.mb-30-none {
    margin-bottom: -30px;
}
/*

===============================
Counter Area
===============================

*/
.counter-area {
background-size: cover;
}

.counter-area .single-counter {
margin-bottom: 30px;
text-align: center;
color: #ffffff;
}

@media (max-width: 575px) {
.counter-area .single-counter {
margin-bottom: 50px;
}
}

.counter-area .single-counter h3 {
font-size: 62px;
font-weight: 300;
margin-bottom: 10px;
letter-spacing: 2px;
margin-top: -15px;
}

.counter-area .single-counter h5 {
font-size: 20px;
font-weight: 300;
text-transform: capitalize;
}

/*

===============================
Call to action Area
===============================

*/
.call-to-action {
padding: 70px 0;
color: #fff;
}

.call-to-action h2 {
font-weight: 700;
color: #fff;
font-size: 42px;
margin-bottom: 10px;
text-transform: capitalize;
}

.call-to-action p {
font-weight: 400;
font-size: 18px;
margin-bottom: 0;
}

.call-to-action .get-service-btn {
float: right;
margin-top: 20px;
}

@media (max-width: 991px) {
.call-to-action .get-service-btn {
float: none;
text-align: center;
}
}

@media (max-width: 991px) {
.call-to-action {
text-align: center;
}

.call-to-action h3 {
margin-bottom: 10px;
}

.call-to-action p {
margin-bottom: 20px;
}
}

/* ==============================
Portfolio area
============================== */
.portfolio {
margin-bottom: -15px;
}

.portfolio.no-gutter {
margin-bottom: 0px;
}

.portfolio-filter {
margin: 0;
margin-top: -5px;
padding: 0;
list-style: none;
}

.port-filter-center {
text-align: center;
}

.portfolio-filter li {
display: inline-block;
}

.portfolio-filter li a {
font-size: 16px;
text-transform: capitalize;
margin: 0 15px;
color: #ffffff;
font-weight: 600;
transition: 0.4s;
text-decoration: none;
position: relative;
 font-family: Almarai,sans-serif;
}

.portfolio-filter li a:hover,
.portfolio-filter li.active a,
.f-link li a:hover,
.f-link li.active a {
color: #ffffff;
background: <?php echo $color; ?>;
}

/*----------------------------*/
.portfolio .portfolio-item {
float: left;
}

.portfolio .portfolio-item .thumb {
position: relative;
display: block;
}

.portfolio .portfolio-item .thumb {
position: relative;
display: block;
}

.portfolio .portfolio-item .thumb img {
display: block;
width: 100%;
height: auto;
}

.portfolio-hover {
position: absolute;
top: 0;
right: 0;
bottom: 0;
left: 0;
overflow: hidden;
cursor: pointer;
-webkit-transition: all .3s;
transition: all .3s;
opacity: 0;
background-image: linear-gradient(to left, #a756ffcc 0%, #5b98ffd1 100%);
background-image: -moz-linear-gradient(to left, #a756ffcc 0%, #5b98ffd1 100%);
background-image: -webkit-linear-gradient(to left, #a756ffcc 0%, #5b98ffd1 100%);
background-image: -ms-linear-gradient(to left, #a756ffcc 0%, #5b98ffd1 100%);
}

.portfolio-item:hover .portfolio-hover,
.portfolio-item:hover .portfolio-hover .portfolio-description,
.portfolio-item:hover .portfolio-hover .action-btn {
opacity: 1;
}

.portfolio-item:hover .portfolio-hover .portfolio-description {
top: 50%;
}

.portfolio-hover .portfolio-description {
position: absolute;
top: 58%;
left: 0;
width: 100%;
padding: 10%;
-webkit-transition: all .3s .3s;
transition: all .3s .3s;
-webkit-transform: translateY(-50%);
-ms-transform: translateY(-50%);
transform: translateY(-50%);
opacity: 0;
}

.portfolio-description,
.portfolio-description h4,
.portfolio-description h4 a,
.portfolio-hover .action-btn a {
text-align: center;
color: #fff;
}

.portfolio-description h4 {
font-size: 16px;
font-weight: 400;
margin-bottom: 0;
text-transform: uppercase;
}

.portfolio-description p {
font-weight: 600;
margin-top: 5px;
}

.portfolio-description i {
font-size: 24px;
color: #fff;
line-height: 50px;
text-align: center;
display: inline-block;
}

.portfolio-description a,
.portfolio-title a {
color: #fff;
}

/*gutter*/
.portfolio.gutter .portfolio-item {
padding: 15px;
}

/*portfolio 2 grid*/
.portfolio.column-2 .portfolio-item {
width: 49.99%;
}

/*portfolio 3 grid*/
.portfolio.column-3 .portfolio-item {
width: 33.3333333%;
}

/*portfolio 4 grid*/
.portfolio.column-4 .portfolio-item {
width: 24.98%;
}

/*portfolio 5 grid*/
.portfolio.column-5 .portfolio-item {
width: 19.99%;
}

/*portfolio 6 grid*/
.portfolio.column-6 .portfolio-item {
width: 16.666666667%;
}

/* ----------------------------------------------------------------
Isotope Filtering
-----------------------------------------------------------------*/
.isotope-item {
z-index: 2;
}

.isotope-hidden.isotope-item {
z-index: 1;
pointer-events: none;
}

/*Isotope CSS3 transitions */
.isotope,
.isotope .isotope-item {
-webkit-transition-duration: .8s;
transition-duration: .8s;
}

.isotope {
-webkit-transition-property: height, width;
transition-property: height, width;
}

.isotope .isotope-item {
-webkit-transition-property: -webkit-transform, opacity;
-webkit-transition-property: opacity, -webkit-transform;
transition-property: opacity, -webkit-transform;
transition-property: transform, opacity;
transition-property: transform, opacity, -webkit-transform;
}

/*disabling Isotope CSS3 transitions */
.isotope.no-transition,
.isotope.no-transition .isotope-item,
.isotope .isotope-item.no-transition {
-webkit-transition-duration: 0s;
transition-duration: 0s;
}

/* disable CSS transitions for containers with infinite scrolling*/
.isotope.infinite-scrolling {
-webkit-transition: none;
transition: none;
}

/*--------------------------------------
responsive styles
--------------------------------------*/
@media screen and (max-width: 1024px) {
/*portfolio   grid*/
.portfolio.column-2 .portfolio-item,
.portfolio.column-3 .portfolio-item,
.portfolio.column-4 .portfolio-item,
.portfolio.column-5 .portfolio-item,
.portfolio.column-6 .portfolio-item {
width: 50%;
}

.portfolio-box {
width: 100%;
}
}

@media screen and (max-width: 767px) {
.portfolio-filter li {
margin-bottom: 25px;
}
}

@media screen and (max-width: 480px) {
/*portfolio   grid*/
.portfolio.column-2 .portfolio-item,
.portfolio.column-3 .portfolio-item,
.portfolio.column-4 .portfolio-item,
.portfolio.column-5 .portfolio-item,
.portfolio.column-6 .portfolio-item,
.testimonial.grid-2 li {
width: 100%;
}
}

@media (max-width: 767px) {
.portfolio-filter li {
margin-bottom: 10px;
}

.portfolio-filter li a {
display: block;
margin-bottom: 10px;
}
}

.portfolio-details h3, .portfolio-details h4 {
margin-bottom: 10px;
}

.portfolio-details img {
width: 100%;
margin-bottom: 30px;
}

.portfolio-details p {
margin-bottom: 20px;
}

.portfolio-details p.italic-text {
font-style: italic;
font-size: 20px;
color: #434a53;
}

.portfolio-details .prev-next {
margin-top: 20px;
}

.portfolio-details .prev-next a {
padding: 12px 30px;
border-radius: 50px;
display: inline-block;
color: #434a53;
background: #f5f5f5;
font-weight: 400;
font-size: 14px;
}

.portfolio-details .prev-next a:hover {
background: #052146;
color: #ffffff;
}

.portfolio-details .prev-next a .prev-btn {
float: left;
}

.portfolio-details .prev-next a.active {
background: #052146;
color: #ffffff;
}

@media (max-width: 400px) {
.portfolio-details .prev-next a.active {
display: block;
margin-bottom: 15px;
text-align: center;
}
}

.portfolio-details .prev-next .next-btn {
float: right;
}

@media (max-width: 400px) {
.portfolio-details .prev-next .next-btn {
float: none;
text-align: center;
display: block;
}
}

/*

===============================
Work Area
===============================

*/
.work-area .single-work {
display: flex;
align-items: center;
justify-content: center;
height: 100%;
flex-direction: column;
text-align: center;
color: #ffffff;
}

.work-area .single-work img {
width: 100%;
height: 100%;
}

.work-area .single-work .single-work-content {
padding: 0 50px;
}

@media (max-width: 1200px) {
.work-area .single-work .single-work-content {
padding: 0 20px;
}
}

@media (max-width: 575px) {
.work-area .single-work .single-work-content {
padding: 70px 30px;
}
}

.work-area .single-work .single-work-content h4 {
font-size: 24px;
font-weight: 600;
margin-bottom: 30px;
}

@media (max-width: 1200px) {
.work-area .single-work .single-work-content h4 {
margin-bottom: 10px;
}
}

.work-area .single-work .single-work-content p {
margin-bottom: 30px;
}

@media (max-width: 1200px) {
.work-area .single-work .single-work-content p {
margin-bottom: 10px;
}
}

.work-area .single-work .single-work-content a {
font-weight: 700;
 font-family: Almarai,sans-serif;
}

.work-area .single-work.img {
position: relative;
}

.work-area .single-work.img:after {
position: absolute;
content: "";
height: 100%;
width: 100%;
left: 0;
top: 0;
background: #111111;
opacity: 0.5;
z-index: 1;
}

/*

===============================
Pricing Plan Area
===============================

*/
.pricing-area .single-pricing {
padding: 55px 40px;
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
border-radius: 10px;
text-align: center;
}

.pricing-area .single-pricing i {
font-size: 42px;
margin-bottom: 40px;
display: block;
color: <?php echo $color; ?>;
}

.pricing-area .single-pricing h1 {
font-size: 52px;
color: #434a53;
margin-bottom: 10px;
}

.pricing-area .single-pricing h1 span {
position: relative;
bottom: 30px;
font-size: 26px;
margin-right: 0px;
font-weight: 700;
}

.pricing-area .single-pricing h1 b {
font-weight: 400;
font-size: 18px;
}

.pricing-area .single-pricing h2 {
font-size: 28px;
margin-bottom: 30px;
}

.pricing-area .single-pricing ul {
margin-bottom: 30px;
}

.pricing-area .single-pricing ul li {
position: relative;
text-transform: capitalize;
margin-bottom: 15px;
}

/*

===============================
growth-stat
===============================

*/
.growth-stat img {
width: 100%;
}

@media (max-width: 575px) {
.growth-stat img {
order: 1;
}
}
.growth-stat .growth-content {
    padding: 50px 0;
}
@media (max-width: 991px) {
    .growth-stat .growth-content {
        padding: 20px 0;
    }
}

.growth-stat .growth-content h3 {
    margin-bottom: 20px;
    font-size: 22px;
}

.growth-stat .growth-content h3 span {
font-size: 16px;
height: 40px;
width: 40px;
line-height: 40px;
background: #000036;
color: #fff;
display: inline-block;
text-align: center;
border-radius: 50%;
margin-right: 10px;
}

.growth-stat .growth-content p {
margin-bottom: 20px;
}
.growth-stat .growth-content p:last-child {
margin-bottom: 0px;
}

@media (max-width: 575px) {
.growth-stat .growth-content {
order: 2;
}
}
.growth-item {
text-align: center;
padding: 50px 30px;
margin-bottom: 30px;
background: #ffffff;
transition: all ease .5s;
-webkit-transition: all ease .5s;
-moz-transition: all ease .5s;
border: 1px solid #e5e5e5;
}
.growth-item:hover {
background: <?php echo  $color; ?>;
border-color: <?php echo $color; ?>;
}
.growth-item:hover .growth-content {
color: #ffffff;
}
.growth-item .growth-thumb {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    justify-content: center;
    align-items: center;
}
.growth-item .growth-thumb img {
    max-width: 70%;
    max-height: 70%;
}
.growth-item .growth-content {
    color: #111111;
    padding: 0;
}
.growth-item .growth-content p {
    margin-bottom: -8px;
}
@media screen and (max-width: 575px) {
    .growth-item {
        padding: 50px 15px;
    }
}
@media screen and (max-width: 1199px) and (min-width: 992px) {
    .growth-item {
        padding: 50px 15px;
    }
}
.gradient-overlay .growth-item {
    background: #fff !important;
}
.gradient-overlay .growth-item .growth-content, .gradient-overlay .growth-item .growth-content p {
    color: #111111;
}
.gradient-overlay .growth-item .growth-thumb {
    border: 2px solid #000036;
}
/*

===============================
Blog Area
===============================

*/
.blog-area {
/* Pagination */
}

.blog-area .single-blog {
margin-bottom: 30px;
}

.blog-area .single-blog:hover .single-blog-img::before {
opacity: 0.7;
}

.blog-area .single-blog:hover .single-blog-img a {
opacity: 1;
}

.blog-area .single-blog .single-blog-img {
position: relative;
}

.blog-area .single-blog .single-blog-img img {
width: 100%;
border-radius: 8px;
}

.blog-area .single-blog .single-blog-img a {
font-size: 26px;
color: #ffffff;
position: absolute;
left: 50%;
top: 45%;
transform: translate(-45%, -50%);
opacity: 0;
transition: 0.3s;
}

.blog-area .single-blog .single-blog-img a:hover {
color: <?php echo $color; ?>;
}

.blog-area .single-blog .single-blog-img:before {
position: absolute;
content: "";
width: 100%;
height: 100%;
left: 0;
top: 0;
background: #111111;
opacity: 0;
transition: 0.4s;
border-radius: 8px;
}

.blog-area .single-blog .single-blog-content {
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
padding: 30px;
background: #fff;
width: 90%;
margin: auto;
margin-top: -70px;
position: relative;
}

.blog-area .single-blog .single-blog-content .blog-meta {
margin-bottom: 10px;
}

.blog-area .single-blog .single-blog-content .blog-meta span a {
margin-right: 10px;
font-size: 14px;
display: inline-block;
color: #434a53;
}

.blog-area .single-blog .single-blog-content .blog-meta span a:hover {
color: <?php echo $color; ?>;
}

.blog-area .single-blog .single-blog-content .blog-meta span a i {
color: <?php echo $color; ?>;
font-size: 16px;
font-weight: bold;
margin-right: 5px;
}

.blog-area .single-blog .single-blog-content h3 {
font-size: 20px;
text-transform: capitalize;
margin-bottom: 0;
line-height: 1.4em;
}

.blog-area .single-blog .single-blog-content h3 a {
color: #111111;
}

.blog-area .single-blog .single-blog-content h3 a:hover {
color: <?php echo $color; ?>;
text-decoration: underline;
}

.blog-area .single-blog-2 {
margin-bottom: 30px;
}

.blog-area .single-blog-2:hover .single-blog-img::before {
opacity: 0.7;
}

.blog-area .single-blog-2:hover .single-blog-img a {
opacity: 1;
}

.blog-area .single-blog-2 .single-blog-img {
position: relative;
}

.blog-area .single-blog-2 .single-blog-img img {
width: 100%;
}

.blog-area .single-blog-2 .single-blog-img a {
font-size: 30px;
color: #ffffff;
position: absolute;
left: 50%;
top: 50%;
line-height: 1;
transform: translate(-50%, -50%);
opacity: 0;
transition: 0.3s;
display: block;
}

.blog-area .single-blog-2 .single-blog-img a:hover {
color: <?php echo $color; ?>;
}

.blog-area .single-blog-2 .single-blog-img:before {
position: absolute;
content: "";
width: 100%;
height: 100%;
left: 0;
top: 0;
background: #111111;
opacity: 0;
transition: 0.4s;
}
.blog-area .single-blog-2 .single-blog-content {
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
padding: 30px;
background: #000036;
position: relative;
}

.blog-area .single-blog-2 .single-blog-content .blog-meta {
margin-bottom: 10px;
}

.blog-area .single-blog-2 .single-blog-content .blog-meta span a {
margin-right: 10px;
font-size: 14px;
display: inline-block;
color: #ffffff;
opacity: .8;
}

.blog-area .single-blog-2 .single-blog-content .blog-meta span a:hover {
color: <?php echo $color; ?>;
}

.blog-area .single-blog-2 .single-blog-content .blog-meta span a i {
color: #fff;
font-size: 14px;
font-weight: bold;
margin-right: 5px;
}

.blog-area .single-blog-2 .single-blog-content h3 {
font-size: 20px;
text-transform: capitalize;
margin-bottom: 10px;
line-height: 1.4em;
}

.blog-area .single-blog-2 .single-blog-content h3 a {
color: #fff;
}

.blog-area .single-blog-2 .single-blog-content h3 a:hover {
color: <?php echo $color; ?>;
text-decoration: underline;
}

.blog-area .single-blog-2 .single-blog-content p {
margin-bottom: 0;
color: #ffffff;
opacity: .8;
}

.gradient-overlay.blog-area .single-blog-2 .single-blog-content {
    background: #fff;
}
.gradient-overlay.blog-area .single-blog-2 .single-blog-content p ,
.gradient-overlay.blog-area .single-blog-2 .single-blog-content .blog-meta span a ,
.gradient-overlay.blog-area .single-blog-2 .single-blog-content .blog-meta span a i,
.gradient-overlay.blog-area .single-blog-2 .single-blog-content h3 a {
    color: #000036;
}
.blog-area .single-blog-3 {
margin-bottom: 30px;
}

.blog-area .single-blog-3:hover .single-blog-img::before {
opacity: 0.7;
}

.blog-area .single-blog-3:hover .single-blog-img a {
opacity: 1;
}

.blog-area .single-blog-3 .single-blog-img {
position: relative;
}

.blog-area .single-blog-3 .single-blog-img img {
width: 100%;
}

.blog-area .single-blog-3 .single-blog-img .blog-meta {
color: #ffffff;
position: absolute;
left: 0;
bottom: 0;
}

.blog-area .single-blog-3 .single-blog-img .blog-meta span {
text-transform: uppercase;
background: #052146;
padding: 8px 22px;
display: block;
text-align: center;
line-height: 20px;
font-size: 14px;
}

.blog-area .single-blog-3 .single-blog-img:before {
position: absolute;
content: "";
width: 100%;
height: 100%;
left: 0;
top: 0;
background: #111111;
opacity: 0;
transition: 0.4s;
}

.blog-area .single-blog-3 .single-blog-content {
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
padding: 30px;
background: #ffffff;
position: relative;
}

.blog-area .single-blog-3 .single-blog-content h3 {
font-size: 20px;
text-transform: capitalize;
margin-bottom: 10px;
line-height: 1.4em;
}

.blog-area .single-blog-3 .single-blog-content h3 a {
color: #111111;
}

.blog-area .single-blog-3 .single-blog-content h3 a:hover {
color: #052146;
text-decoration: underline;
}

.blog-area .single-blog-3 .single-blog-content p {
margin-bottom: 0;
}

.blog-area .styled-pagination {
position: relative;
margin-bottom: 30px;
}

.blog-area .styled-pagination li {
position: relative;
display: inline-block;
margin: 0px 3px 0px 0px;
}

.blog-area .styled-pagination li.previous a, .blog-area .styled-pagination li.next a {
color: #111111;
}

.blog-area .styled-pagination li a {
position: relative;
display: inline-block;
line-height: 40px;
height: 40px;
font-size: 16px;
min-width: 40px;
border-radius: 50%;
color: #111111;
text-align: center;
text-transform: capitalize;
transition: all 500ms ease;
-webkit-transition: all 500ms ease;
-ms-transition: all 500ms ease;
-o-transition: all 500ms ease;
-moz-transition: all 500ms ease;
background-color: #f1f1f1;
cursor: pointer;
}

.blog-area .styled-pagination li a:hover, .blog-area .styled-pagination li a.active {
color: #ffffff;
background-color: #052146;
}

.blog-area .blog-details img {
width: 100%;
margin-bottom: 30px;
}

.blog-area .blog-details .blog-meta {
margin-bottom: 10px;
}

.blog-area .blog-details .blog-meta span a {
margin-right: 10px;
font-size: 14px;
display: inline-block;
color: #434a53;
}

.blog-area .blog-details .blog-meta span a:hover {
color: #052146;
}

.blog-area .blog-details .blog-meta span a i {
color: #052146;
font-size: 16px;
font-weight: bold;
margin-right: 5px;
}

.blog-area .blog-details h2 {
margin-bottom: 20px;
font-weight: 700;
font-size: 30px;
}

.blog-area .blog-details .blockquote {
font-size: 16px;
border-left: 2px solid #052146;
font-style: italic;
padding-left: 15px;
margin: 20px 0;
}

.blog-area .blog-all-comments h3 {
margin-bottom: 20px;
font-weight: 600;
}

.blog-area .blog-all-comments .blog-comments {
margin-bottom: 40px;
padding: 30px 40px;
overflow: hidden;
background: #f9f9f9;
}

.blog-area .blog-all-comments .blog-comments div {
overflow: hidden;
}

.blog-area .blog-all-comments .blog-comments .author-thumb {
width: 20%;
float: left;
}

.blog-area .blog-all-comments .blog-comments .author-thumb img {
border-radius: 50%;
width: 70px;
}

.blog-area .blog-all-comments .blog-comments .author-comments .author-details h4 {
float: left;
font-size: 18px;
}

.blog-area .blog-all-comments .blog-comments .author-comments .author-details .comment-reply-btn {
float: right;
}

.blog-area .blog-all-comments .blog-comments .author-comments .author-designation {
font-weight: 700;
font-size: 14px;
margin-bottom: 5px;
}

.blog-area .blog-comment-form {
margin-bottom: 30px;
}

.blog-area .blog-comment-form h3 {
margin-bottom: 15px;
text-transform: uppercase;
}

.blog-area .blog-comment-form input, .blog-area .blog-comment-form textarea {
width: 100%;
border: 2px solid #E5E5E5;
text-indent: 20px;
margin-bottom: 30px;
transition: .3s;
background: transparent;
}

.blog-area .blog-comment-form input:focus, .blog-area .blog-comment-form textarea:focus {
border-color: #052146;
}

.blog-area .blog-comment-form input {
height: 50px;
}

.blog-area .blog-comment-form textarea {
padding-top: 15px;
}

.blog-area .blog-comments + .blog-comments {
margin-left: 15%;
}

@media (max-width: 767px) {
.blog-area .blog-comment-form {
margin-bottom: 40px;
}
}

.blog-area .post-share-and-tag {
margin: 40px 0 60px 0;
}

.blog-area .post-share-and-tag .social {
float: right;
}

@media (max-width: 767px) {
.blog-area .post-share-and-tag .social {
float: none;
text-align: left;
margin-top: 20px;
}
}

.blog-area .post-share-and-tag .social span {
font-size: 20px;
font-weight: 700;
}

.blog-area .post-share-and-tag .social a {
font-size: 18px;
text-align: center;
display: inline-block;
margin: 0 5px;
}

.blog-area .post-share-and-tag .tags a {
color: #434a53;
text-transform: capitalize;
}

.blog-area .post-share-and-tag .tags a:hover {
color: #052146;
}

/*

===============================
FAQ Area
===============================

*/
.faq-contents {
display: block;
height: auto;
margin-bottom: 0px;
display: -webkit-box;
display: -moz-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
flex-wrap: wrap;
justify-content: space-between;
}

.faq-contents .accordion {
list-style: none;
padding: 0;
width: 100%;
}

.faq-contents .accordion li {
position: relative;
margin-bottom: 20px;
border: 1px solid #D9D9D9;
border-radius: 4px;
}


.faq-contents .accordion li p {
display: none;
padding: 10px 30px 20px 20px;
color: #111111;
font-size: 16px;
background: transparent;
margin-bottom: 0;
line-height: 2;
border-radius: 4px;
}

.faq-contents .accordion li a {
width: 100%;
display: block;
cursor: pointer;
font-size: 18px;
padding-left: 20px;
padding-right: 50px;
padding-top: 15px;
padding-bottom: 15px;
color: #111111;
user-select: none;
font-weight: 600;
}

.faq-contents .accordion li a i {
font-size: 18px;
color: #111111;
margin-right: 10px;
}

.faq-contents .accordion li a.active {
color: <?php echo $color?>;
border: 0;
}

.faq-contents .accordion li a.active::after {
transform: rotate(225deg);
-webkit-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
border-right: 2px solid <?php echo $color?>;
border-bottom: 2px solid <?php echo $color?>;
}

.faq-contents .accordion li a::after {
width: 10px;
height: 10px;
border-right: 2px solid #111111;
border-bottom: 2px solid #111111;
position: absolute;
right: 25px;
content: " ";
top: 22px;
transform: rotate(45deg);
-webkit-transition: all 0.2s ease-in-out;
-moz-transition: all 0.2s ease-in-out;
transition: all 0.2s ease-in-out;
}
/*

===============================
Loan area
===============================

*/
.loan-area label {
display: block;
font-size: 18px;
color: #111111;
margin-bottom: 10px;
}

.loan-area input {
width: 100%;
border: 2px solid #efefef;
height: 55px;
text-indent: 20px;
margin-bottom: 15px;
}

.loan-area small {
font-size: 14px;
}

.loan-area .loan-confirm-form {
padding: 30px 40px;
border: 4px solid #efefef;
}

.loan-area .loan-confirm-form p {
font-size: 30px;
margin-bottom: 45px;
font-weight: 300;
color: #052146;
}

.loan-area .loan-confirm-form p strong {
display: block;
font-size: 18px;
color: #434a53;
margin-bottom: 20px;
}

/*

===============================
feature area
===============================

*/
.feature-area .single-feature {
margin-bottom: 30px;
border: 2px solid #efefef;
padding: 45px 30px;
text-align: center;
}

.feature-area .single-feature img {
width: 65px;
height: 65px;
margin-bottom: 30px;
transition: 0.4s;
}

.feature-area .single-feature h4 {
font-weight: 300;
color: #111111;
margin-bottom: 15px;
text-transform: capitalize;
}

.feature-area .single-feature p {
color: #434a53;
margin-bottom: 15px;
}

.feature-area .single-feature a {
font-size: 17px;
font-weight: 400;
color: #111111;
}

.feature-area .single-feature a:hover {
color: #052146;
text-decoration: underline;
}

.feature-area .single-feature:hover img {
transform: scale(1.2);
}

.feature-area .single-feature-2 {
margin-bottom: 30px;
padding: 0 30px;
text-align: center;
color: #ffffff;
position: relative;
}

.feature-area .single-feature-2.bottom-after:after {
content: '';
position: absolute;
width: 70%;
height: 32px;
top: 0px;
left: 70%;
background: url(../images/after-1.png) center center no-repeat;
-webkit-transition: all 0.3s ease 0s;
-moz-transition: all 0.3s ease 0s;
-o-transition: all 0.3s ease 0s;
transition: all 0.3s ease 0s;
}

@media (max-width: 991px) {
.feature-area .single-feature-2.bottom-after:after {
display: none;
}
}

.feature-area .single-feature-2.bottom-before:after {
content: '';
position: absolute;
width: 70%;
height: 32px;
bottom: 150px;
left: 68%;
background: url(../images/after-2.png) center center no-repeat;
-webkit-transition: all 0.3s ease 0s;
-moz-transition: all 0.3s ease 0s;
-o-transition: all 0.3s ease 0s;
transition: all 0.3s ease 0s;
}

@media (max-width: 991px) {
.feature-area .single-feature-2.bottom-before:after {
display: none;
}
}

.feature-area .single-feature-2 i {
font-size: 34px;
height: 90px;
width: 90px;
line-height: 90px;
border-radius: 50%;
text-align: center;
color: #ffffff;
display: block;
margin: auto;
margin-bottom: 30px;
box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
border: 2px solid #ffffff;
transition: 0.4s;
}

.feature-area .single-feature-2 h4 {
font-weight: 600;
margin-bottom: 15px;
text-transform: capitalize;
transition: 0.4s;
}

.feature-area .single-feature-2 p {
margin-bottom: -5px;
}

.feature-area .single-feature-2:hover i {
background: #ffffff;
color: #052146;
}

/*

===============================
Breadcrumb area
===============================

*/
.breadcrumb-area {
padding: 100px 0 100px 0;
position: relative;
overflow: hidden;
}

.breadcrumb-area .banner-title h2 {
font-size: 38px;
font-weight: 700;
 font-family: Almarai,sans-serif;
color: #ffffff;
margin-bottom: 10px;
text-transform: capitalize;
position: relative;
z-index: 99;
}

@media (max-width: 767px) {
.breadcrumb-area .banner-title h2 {
font-size: 42px;
}
}

.breadcrumb-area ul li {
display: inline-block;
font-weight: 400;
color: #ffffff;
font-size: 14px;
}

.breadcrumb-area ul li a {
margin-right: 20px;
position: relative;
color: #ffffff;
}

.breadcrumb-area ul li a:hover {
color: <?php echo $color; ?>;
}

.breadcrumb-area ul li a:after {
position: absolute;
content: "\e649";
 font-family: Almarai,sans-serif;
font-size: 10px;
right: -15px;
top: -2px;
}

.breadcrumb-area.fixed-head {
padding: 170px 0 100px 0;
}

@media (max-width: 767px) {
.custom-banner {
text-align: center;
}

.page-breadcrumb ul {
float: none;
}

.banner-title {
margin-bottom: 20px;
}
}
.breadcrumb {
    background: transparent;
    margin: 0;
    padding: 10px 0;
    justify-content: center;
}
.breadcrumb li , .breadcrumb li a {
    font-weight: 700;
     font-family: Almarai,sans-serif;
    text-transform: uppercase;
}
.breadcrumb li a {
    position: relative;
    margin-right: 20px;
}
.breadcrumb li a::after {
    position: absolute;
    content: "\e649";
     font-family: Almarai,sans-serif;
    font-size: 10px;
    right: -15px;
    top: 0px;
}
@media (min-width:576px) {
    .breadcrumb li , .breadcrumb li a {
        font-size: 18px;
    }
}
/*

===============================
Privacy polices area
===============================

*/
.polices-content {
margin-top: -6px;
}

.polices-content h2 {
margin-bottom: 20px;
font-size: 30px;
}

.polices-content h3 {
margin-bottom: 20px;
font-size: 24px;
}

.polices-content p {
margin-bottom: 30px;
}

.polices-content ul li {
position: relative;
margin-bottom: 20px;
padding-left: 25px;
}

.polices-content ul li::before {
position: absolute;
left: 0;
top: 0;
content: "\f111";
font-family: Fontawesome;
color: #052146;
font-size: 8px;
}

.polices-content ul li:last-child {
margin-bottom: 0px;
}

.polices-content.cl-white ul li:before {
color: #ffffff;
}

/*

===============================
Contact area
===============================

*/
.contact-form {
margin-bottom: 30px;
}

.contact-form form h4 {
font-weight: 600;
font-size: 24px;
margin-bottom: 5px;
}

.contact-form form p {
 font-family: Almarai,sans-serif;
font-size: 16px;
margin-bottom: 15px;
}

.contact-form form input, .contact-form form textarea {
width: 100%;
border: 2px solid #000036;
text-indent: 15px;
margin-bottom: 15px;
 font-family: Almarai,sans-serif;
font-size: 16px;
background: #000036;
color: #ffffff;
font-weight: 600;
}
.contact-form form input::placeholder, .contact-form form textarea::placeholder {
    font-weight: 600;
    color: #ffffff;
}
.contact-form form input:focus, .contact-form form textarea:focus {
border: 2px solid #052146;
}

.contact-form form input {
height: 50px;
}
.contact-form form button {
padding: 12px 50px;
font-size: 16px;
}

.contact-form form textarea {
padding-top: 10px;
}

.contact-content {
height: 100%;
width: 100%;
display: flex;
justify-content: center;
flex-direction: column;
padding: 40px;
}

.contact-content h4 {
font-weight: 400;
margin-bottom: 15px;
}

.contact-content h5 {
font-weight: 400;
font-size: 20px;
margin-bottom: 10px;
margin-top: 20px;
}

.contact-content p {
 font-family: Almarai,sans-serif;
font-size: 14px;
margin-bottom: 5px;
}

.contact-content .social {
margin-top: 20px;
}

.contact-content .social a {
height: 30px;
width: 30px;
font-size: 12px;
color: #ffffff;
line-height: 32px;
display: inline-block;
margin-right: 4px;
text-align: center;
border-radius: 50%;
}

/*

===============================
newslatter area
===============================

*/
.newslatter form {
position: relative;
overflow: hidden;
}

.newslatter form input {
width: 100%;
height: 60px;
float: left;
box-shadow: 0px 0px 9px 1px rgba(253, 77, 64, 0.1);
font-size: 16px;
text-indent: 25px;
background: rgba(0, 0, 54, 1);
border-radius: 50px;
color: #ffffff;
padding-left: 30px;
}
.newslatter form input::placeholder {
    color: #fff;
}
.newslatter form button {
position: absolute;
top: 4px;
right: 4px;
width: 100px;
height: 52px;
color: <?php echo  $color?>;
background: #fff;
border-radius: 50px;
font-size: 18px;
}

.newslatter form button:hover {
background: #fff;
color: <?php echo  $color?>;
}

.newslatter p {
margin: 0;
font-size: 10px;
display: block;
}

.newslatter p i {
margin-right: 5px;
}

/*

===============================
MIssion Vission area
===============================

*/
.single-mission-vission {
padding: 60px;
color: #ffffff;
background: url("../images/mission-vission-bf.jpg") no-repeat;
background-size: cover;
box-shadow: 0px 0px 25px 0px rgba(0, 0, 0, 0.09);
position: relative;
margin-bottom: 30px;
}

@media (max-width: 450px) {
.single-mission-vission {
padding: 45px;
}
}

@media (max-width: 350px) {
.single-mission-vission {
padding: 30px;
}
}

.single-mission-vission::before {
position: absolute;
content: "";
height: 100%;
width: 100%;
background: #052146;
left: 0;
top: 0;
opacity: 0.9;
transition: 0.4s;
}

.single-mission-vission h4 {
margin-bottom: 15px;
transition: 0.4s;
position: relative;
display: inline-block;
}

.single-mission-vission h4::after {
position: absolute;
content: "";
height: 2px;
width: 40px;
background: #ffffff;
right: -50px;
top: 15px;
}

.single-mission-vission p {
margin-bottom: 20px;
line-height: 1.7em;
transition: 0.4s;
font-size: 20px;
font-weight: 300;
}

.single-mission-vission:hover {
background: #ffffff;
}

.single-mission-vission:hover h4 {
color: #052146;
}

.single-mission-vission:hover h4::after {
background: #052146;
}

.single-mission-vission:hover p {
color: #434a53;
}

.single-mission-vission:hover a {
background: #052146;
color: #ffffff;
}

.single-mission-vission:hover:before {
background: #ffffff;
opacity: 1;
}

/*
right-sticky-wapper
*/
.right-sticky-wapper {
position: fixed;
transition: all ease .35s;
top: 30%;
right: -320px;
width: 320px;
height: auto;
left: auto;
height: auto;
min-height: 120px;
background: #fff;
z-index: 999;
}

@media (max-width: 450px) {
.right-sticky-wapper {
right: -260px;
width: 260px;
}
}

.right-sticky-wapper .right-sticky-trigger {
position: absolute;
right: 100%;
top: 0;
height: 50px;
min-width: 50px;
background: #ffffff;
line-height: 50px;
padding: 0 4px;
text-align: center;
color: #052146;
box-shadow: 0px 0px 15px 0px rgba(72, 67, 211, 0.12);
}

.right-sticky-wapper .right-sticky-content {
background: #ffffff;
padding: 20px;
text-align: left;
max-height: 350px;
overflow-y: scroll;
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
}

.right-sticky-wapper .right-sticky-content form input, .right-sticky-wapper .right-sticky-content form textarea {
width: 100%;
border: 2px solid #ddd;
padding: 0 15px;
transition: 0.3s;
margin-bottom: 15px;
}

.right-sticky-wapper .right-sticky-content form input:focus, .right-sticky-wapper .right-sticky-content form textarea:focus {
border: 2px solid #052146;
}

.right-sticky-wapper .right-sticky-content form input {
height: 45px;
}

.right-sticky-wapper .right-sticky-content form textarea {
padding-top: 10px;
padding-bottom: 10px;
}

.right-sticky-wapper.active {
right: 0 !important;
}

/* Loan details */
.empty-image {
padding: 300px 0;
}

.single-loan-feature {
margin-bottom: 30px;
}

.single-loan-feature i {
font-size: 36px;
height: 95px;
width: 95px;
line-height: 95px;
text-align: center;
color: #052146;
border-radius: 50%;
background: #5350ff14;
display: inline-block;
margin-bottom: 20px;
transition: 0.4s;
}

.single-loan-feature h4 {
font-weight: 500;
font-size: 20px;
}

.single-loan-feature:hover i {
background: #052146;
color: #ffffff;
}

.loan-criteria ul li {
position: relative;
padding-left: 25px;
font-size: 16px;
margin-bottom: 15px;
}

.loan-criteria ul li:last-child {
margin-bottom: 0;
}

.loan-criteria ul li::before {
position: absolute;
content: "\f209";
font-family: Fontawesome;
left: 0;
top: 0;
font-size: 18px;
color: #052146;
}

.single-faq {
color: #ffffff;
margin-bottom: 40px;
}

.single-faq h4 {
font-weight: 700;
font-size: 20px;
margin-bottom: 10px;
}

.single-faq p {
margin-bottom: 0;
font-size: 14px;
}

/*

===============================
Error Area
===============================

*/
.error-cont {
height: 100%;
display: flex;
flex-direction: column;
justify-content: center;
}

.error-cont h3 {
font-size: 36px;
margin-bottom: 15px;
font-weight: 400;
}

.error-cont p {
 font-family: Almarai,sans-serif;
}

.error-cont form {
position: relative;
}

.error-cont form input {
width: 100%;
border: 2px solid #ddd;
text-indent: 20px;
height: 50px;
transition: 0.3s;
 font-family: Almarai,sans-serif;
}

.error-cont form input:focus {
border: 2px solid #052146;
}

.error-cont form button {
position: absolute;
top: 0;
right: 0;
height: 50px;
width: 50px;
background: transparent;
color: #052146;
}

/*

===============================
Job Post Area
===============================

*/
.single-job {
overflow: hidden;
border: 3px solid #e4e4e4;
border-radius: 4px;
margin-bottom: 20px;
padding: 30px;
transition: 0.3s;
}

.single-job:last-child {
margin-bottom: 0px;
}

.single-job:hover {
border-color: #052146;
}

.single-job .job-des {
width: 75%;
float: left;
}

@media (max-width: 767px) {
.single-job .job-des {
width: 100%;
margin-bottom: 20px;
}
}

.single-job .job-des h3 {
font-size: 22px;
margin-bottom: 5px;
}

.single-job .job-des h3 a {
color: #434a53;
}

.single-job .job-des h3 a:hover {
color: #052146;
}

.single-job .job-des p {
margin-bottom: 0px;
font-size: 14px;
}

.single-job .job-apply-btn {
width: 25%;
float: left;
}

@media (max-width: 767px) {
.single-job .job-apply-btn {
width: 100%;
float: none;
}
}

.single-job .job-apply-btn a {
float: right;
}

@media (max-width: 767px) {
.single-job .job-apply-btn a {
float: none;
}
}

/*

===============================
Online Apply Form
===============================

*/
.apply-form .single-block-form {
margin-bottom: 40px;
}

.single-block-form:last-child {
margin-bottom: 0px;
}

.apply-form h3 {
font-size: 16px;
text-transform: uppercase;
font-weight: 500;
letter-spacing: 2px;
color: #111111;
margin-bottom: 25px;
}

.apply-form h3 span {
height: 35px;
width: 35px;
line-height: 35px;
color: #ffffff;
border-radius: 50%;
background: #434a53;
margin-right: 8px;
display: inline-block;
text-align: center;
font-size: 18px;
}

.apply-form input, .apply-form select {
width: 100%;
margin-bottom: 20px;
height: 55px;
text-indent: 15px;
border: 2px solid #e4e4e4;
border-radius: 4px;
color: #434a53;
background: #ffffff;
font-size: 14px;
}

.select-bar {
width: 100%;
margin-bottom: 20px;
border: 2px solid #e4e4e4;
height: 55px;
line-height: 52px;
}

.select-bar:focus {
border: 2px solid #052146;
}

.select-bar .list {
width: 100%;
border: 2px solid #052146;
}

.select-bar:after {
height: 7px;
width: 7px;
right: 15px;
}

.apply-form textarea {
width: 100%;
margin-bottom: 20px;
text-indent: 15px;
padding-top: 10px;
border: 2px solid #e4e4e4;
border-radius: 4px;
color: #434a53;
background: #ffffff;
font-size: 14px;
}

.apply-form input:focus, .apply-form select:focus, .apply-form textarea:focus {
border: 2px solid #052146;
}

.apply-form input[type="checkbox"] {
width: initial;
height: initial;
}

.apply-form label {
display: inline-block;
font-size: 14px;
color: #052146;
}

.apply-form a {
display: block;
color: #052146;
margin-bottom: 10px;
font-size: 14px;
font-weight: 500;
}

.apply-form a:hover {
text-decoration: underline;
}

/*

===============================
Dashboard content
===============================

*/
.sidebar {
background: #000036;
margin-bottom: 30px;
border: 2px solid #2c3e50;
border-radius: 4px;
}

.sidebar ul li {
border-bottom: 2px solid #2c3e50;
}

.sidebar ul li:last-child {
border-bottom: 0px;
}

.sidebar ul li a {
display: block;
color: #ffffff;
padding: 16px;
font-size: 14px;
}

.sidebar ul li a:hover {
background: #2c3e50;
}

.sidebar ul li a i {
margin-right: 10px;
}

.sidebar ul li.active a {
background: #2c3e50;
}

.dashboard-content .single-currency-box {
padding: 40px;
box-shadow: 0px 0px 16px 4px rgba(0, 0, 0, 0.05);
margin-bottom: 30px;
border-radius: 4px;
transition: 0.4s;
}

.dashboard-content .single-currency-box h4 {
font-size: 22px;
font-weight: 700;
margin-bottom: 15px;
}

.dashboard-content .single-currency-box p {
margin-bottom: 0;
}

.dashboard-content .single-currency-box:hover {
transform: translate3d(0, -10px, 0);
box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
}
.dashboard-content .dashboard-inner-content .card:nth-child(odd) {
    background: #ecf0f1;
}

.dashboard-content .dashboard-inner-content .card:nth-child(even) {
background: #2c3e50;
}
.dashboard-content .dashboard-inner-content .card:nth-child(even) .date-site {
    background: #ecf0f1;
}
.dashboard-content .dashboard-inner-content .card:nth-child(even) .date-site * {
    color: <?php echo $color?>;
}
.dashboard-content .dashboard-inner-content .card:nth-child(even) * {
    color: #fff;
}
.dashboard-content .dashboard-inner-content > .card {
    border-radius: 5px;
    overflow: hidden;
}
.dashboard-content .dashboard-inner-content .card {
    border: none;
}

.dashboard-content .dashboard-inner-content .card .card-header {
background: #000036;
color: #ffffff;
padding-top: 15px;
padding-bottom: 15px;
display: -webkit-box;
display: -moz-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: space-between;
border-radius: 0;
}

@media (max-width: 575px) {
.dashboard-content .dashboard-inner-content .card .card-header {
text-align: center;
}
}

.dashboard-content .dashboard-inner-content .card .card-header a {
<!-- float: right; -->
padding: 7px 20px;
border-radius: 4px;
border: 2px solid #fff;
color: #ffffff;
line-height: initial;
display: -webkit-box;
display: -moz-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: center;

}
.ash-bg {
    background: #2c3e50 ;
}
.ash-bg-2 {
    background: #2c3e50 !important;
}
.ash-bg label,
.ash-bg ul li,
.ash-bg table *,
.ash-bg a {
    color: #fff;
}
.ash-bg .table-striped tbody tr:nth-of-type(odd),
.ash-bg-2 .table-striped tbody tr:nth-of-type(odd) {
    background: #fff;
    border: none !important;
}
.ash-bg .table-striped tbody tr:nth-of-type(even),
.ash-bg-2 .table-striped tbody tr:nth-of-type(even) {
    background: #d9dedf;
    border: none !important;
}

.ash-bg-3 {
    background: #fff;
}
.ash-bg .card-footer ,
.ash-bg-2 .card-footer {
    border-color: rgba(255, 255, 255, .4);
}
.login-card-body {
    border-top: 1px solid #e5e5e5;
}
.login-card-body .table-striped tbody {
    padding: 15px;
}
.login-card-body .table-striped tbody tr:nth-of-type(odd) {
    background: #34495e;
}
.login-card-body .table-striped tbody tr {
    color: rgba(255, 255, 255, .9);
}
.login-card-body .table-striped tbody tr i {
    color: <?php echo $color?>;
    font-size: 14px;
}
.login-card-body .custom-btn {
    font-size: 18px;
     font-family: Almarai,sans-serif;
}
.login-card-body .table-striped tbody tr:nth-of-type(even) {
    background: #2c3e50;
}
.table-striped td i {
    margin-right: 5px;
    margin-left: 15px;
    display: inline-block;
}
.table-striped.style-two td i {
    margin-left: 5px;
}
.ash-bg .text-muted {
    color: #aeaeae  !important;
}
.dashboard-content .dashboard-inner-content .card .card-footer .custom-btn {
    padding: 0 30px;
    margin-bottom: 0;
    font-size: 18px;
     font-family: Almarai,sans-serif;
    font-weight: 700;
    line-height: 55px;
}
@media (max-width: 575px) {
.dashboard-content .dashboard-inner-content .card .card-header a {
display: block;
float: none;
text-align: center;
}
}

.dashboard-content .dashboard-inner-content .card .card-header a i {
<!-- margin-right: 7px; -->
}

.dashboard-content .dashboard-inner-content .card .card-header a:hover {
color: <?php echo $color?>;
}

.dashboard-content .dashboard-inner-content .t-log-title {
padding: 15px;
cursor: pointer;
}

.dashboard-content .dashboard-inner-content .t-log-title .row {
margin: 0 -1px;
}

.dashboard-content .dashboard-inner-content .t-log-title .row [class*="col"] {
padding: 0 1px;
}

.dashboard-content .dashboard-inner-content .t-log-title span {
display: block;
font-size: 14px;
font-weight: 700;
text-transform: uppercase;
}

@media (max-width: 480px) {
.dashboard-content .dashboard-inner-content .t-log-title span {
font-size: 12px;
}
}

.dashboard-content .dashboard-inner-content .t-log-title span + span {
font-size: 20px;
}

@media (max-width: 480px) {
.dashboard-content .dashboard-inner-content .t-log-title span + span {
font-size: 18px;
}
}

.dashboard-content .dashboard-inner-content .t-log-title p {
margin-bottom: 0;
font-size: 18px;
 font-family: Almarai,sans-serif;
font-weight: 700;
}

@media (max-width: 480px) {
.dashboard-content .dashboard-inner-content .t-log-title p {
font-size: 14px;
width: 12ch;
overflow: hidden;
white-space: nowrap;
text-overflow: ellipsis;
}
}

.dashboard-content .dashboard-inner-content .t-log-title p + p {
font-size: 12px;
font-family: "Lato", sans-serif;
}

@media (max-width: 480px) {
.dashboard-content .dashboard-inner-content .t-log-title p + p {
font-size: 11px;
width: 16ch;
font-weight: 500;
line-height: 18px;
}
}

@media (max-width: 480px) {
.dashboard-content .dashboard-inner-content .t-log-title p {
font-size: 16px;
}
}

.dashboard-content .dashboard-inner-content .t-log-title .trans-amnt {
float: right;
height: 100%;
display: flex;
flex-direction: column;
justify-content: center;
font-weight: 700;
 font-family: Almarai,sans-serif;
}
<!-- .dashboard-content .dashboard-inner-content .t-log-title .trans-amnt.text-danger {
    color: #c44e00 !important;
} -->
.dashboard-content .dashboard-inner-content .t-log-title .trans-amnt.text-success {
    color: #27ae60 !important;
}

@media (max-width: 480px) {
.dashboard-content .dashboard-inner-content .t-log-title .trans-amnt {
text-align: right;
font-size: 14px;
}
}

.dashboard-content .dashboard-inner-content form label {
display: block;
}

.dashboard-content .dashboard-inner-content form input,
.dashboard-content .dashboard-inner-content form select
{
width: 100%;
height: 55px;
border: 2px solid #ddd;
border-radius: 4px;
text-indent: 15px;
margin-bottom: 30px;
}

.dashboard-content .dashboard-inner-content form select:focus,
.dashboard-content .dashboard-inner-content form input:focus {
border-color: #052146;
}

.dashboard-content .dashboard-inner-content form textarea {
width: 100%;
border: 2px solid #ddd;
border-radius: 4px;
padding-left: 15px;
padding-top: 10px;
}

.dashboard-content .dashboard-inner-content form textarea:focus {
border-color: #052146;
}

.dashboard-content .dashboard-inner-content form button {
/*height: 55px;*/
/*width: 100%;*/
/*!*background: #0865f1;*!*/
/*border-radius: 4px;*/
/*color: #ffffff;*/
/*font-size: 12px;*/
/*font-weight: 700;*/
/*text-transform: uppercase;*/
margin-bottom: 0px;
}

.dashboard-content .dashboard-inner-content form button:hover {
background: <?php echo  $color?>;
border: 1px solid <?php echo  $color?>;
}

.dashboard-content .dashboard-inner-content .essen-btns {
float: right;
margin-bottom: 20px;
}

@media (max-width: 991px) {
.dashboard-content .dashboard-inner-content .essen-btns {
float: none;
text-align: center;
}
}

.dashboard-content .dashboard-inner-content .essen-btns a {
display: inline-block;
padding: 7px 20px;
background: #fff;
margin: 0;
font-size: 14px;
font-weight: 700;
color: #111111;
}

.dashboard-content .dashboard-inner-content .essen-btns a i {
margin-right: 7px;
}

.dashboard-content .dashboard-inner-content .essen-btns a.active, .dashboard-content .dashboard-inner-content .essen-btns a:hover {
background: <?php echo  $color; ?>;
color: #ffffff;
}

@media (max-width: 575px) {
.dashboard-content .dashboard-inner-content .essen-btns a {
display: block;
margin-bottom: 10px;
}
}

.single-box {
position: relative;
padding: 40px;
border-radius: 10px;
background: transparent;
z-index: 1;
margin-bottom: 30px;
border: 1px solid #e5e5e5;
}
.single-box::before {
background: #ffffff;
position: absolute;
left: 0;
top: 0;
width: 100%;
transition: all ease .5s;
-webkit-transition: all ease .5s;
-moz-transition: all ease .5s;
height: 100%;
content: '';
z-index: -1;
border-radius: 10px;
}

.single-box:hover::before {
background: <?php echo  $color; ?>;
}
.single-box:hover p,
.single-box:hover h3
{
color: #fff;
}
.single-box img {
margin-bottom: 30px;
width: 60px;
}

.single-box h3 {
font-size: 24px;
margin-bottom: 10px;
}

.single-box p {
margin-bottom: 20px;
color: #111111;
opacity: .85;
}

.poly-particle {
position: relative;
overflow: hidden;
}

.poly-particle:before {
position: absolute;
content: "";
width: 270px;
height: 287px;
right: 30px;
top: 50px;
background: url(../images/poligonal.png);
animation: rotateCircle 20s linear 0s infinite normal none running;
}

@keyframes rotateCircle {
0% {
-webkit-transform: rotate(0deg);
transform: rotate(0deg);
}

100% {
-webkit-transform: rotate(1turn);
transform: rotate(1turn);
}
}

.triangle-particle {
position: relative;
overflow: hidden;
}

.triangle-particle:after {
position: absolute;
content: "";
width: 80px;
height: 58px;
left: 100px;
bottom: 50px;
background: url(../images/triangle.png);
animation: rotateCircle2 20s linear 0s infinite normal none running;
}

@keyframes rotateCircle2 {
0% {
-webkit-transform: rotate(0deg);
transform: rotate(0deg);
}

100% {
-webkit-transform: rotate(1turn);
transform: rotate(1turn);
}
}

.dev-first {
display: flex;
height: 100%;
flex-direction: column;
justify-content: center;
}

/*

===============================
Sidebar
===============================

*/
.site-sidebar .single-sidebar {
margin-bottom: 40px;
padding: 30px;
box-shadow: 0px 0px 8px 0px rgba(96, 187, 191, 0.15);
}

.site-sidebar .single-sidebar div {
overflow: hidden;
}

.site-sidebar .single-sidebar:last-child {
margin-bottom: 0;
}

.site-sidebar .single-sidebar h3 {
font-size: 24px;
font-weight: 600;
position: relative;
margin-bottom: 20px;
text-transform: capitalize;
}

.site-sidebar .single-sidebar form {
width: 100%;
position: relative;
height: 50px;
border-radius: 4px;
}

.site-sidebar .single-sidebar form input {
width: 100%;
height: 100%;
transition: 0.4s;
text-indent: 15px;
border: 2px solid #e4e4e4;
}

.site-sidebar .single-sidebar form input:hover, .site-sidebar .single-sidebar form input:focus {
border-color: #052146;
}

.site-sidebar .single-sidebar form button {
position: absolute;
right: 0;
top: 50%;
transform: translateY(-50%);
background: none;
color: #052146;
height: 100%;
width: 50px;
}

.site-sidebar .single-sidebar ul li {
margin-bottom: 20px;
position: relative;
transition: 0.4s;
}

.site-sidebar .single-sidebar ul li:last-child {
margin-bottom: 0;
}

.site-sidebar .single-sidebar ul li:before {
position: absolute;
content: "\f101";
font-family: 'Fontawesome';
color: #052146;
left: -10px;
opacity: 0;
transition: 0.4s;
}

.site-sidebar .single-sidebar ul li:hover {
padding-left: 15px;
}

.site-sidebar .single-sidebar ul li:hover:before {
left: 0px;
opacity: 1;
}

.site-sidebar .single-sidebar ul li a {
color: #434a53;
display: block;
text-transform: capitalize;
}

.site-sidebar .single-sidebar ul li a:hover {
color: #052146;
}

.site-sidebar .single-sidebar .social-follow a {
padding: 25px 25px;
border-radius: 4px;
color: #ffffff;
text-align: center;
display: inline-block;
 font-family: Almarai,sans-serif;
margin: 0 1px;
}

.site-sidebar .single-sidebar .social-follow a:hover {
background: #052146;
}

.site-sidebar .single-sidebar .social-follow a i {
display: block;
font-size: 18px;
}

@media (max-width: 991px) {
.site-sidebar .single-sidebar .social-follow a {
margin-bottom: 5px;
}
}

@media (max-width: 767px) {
.site-sidebar .single-sidebar .social-follow a {
width: 100%;
}
}

.site-sidebar .single-sidebar .archives a {
display: block;
margin-bottom: 15px;
 font-family: Almarai,sans-serif;
color: #111111;
}

.site-sidebar .single-sidebar .archives a:hover {
color: #052146;
}

.site-bg {
background-color: #000036 !important;
}

.site-sidebar .single-sidebar .archives a:last-child {
margin-bottom: 0;
}

.site-sidebar .single-sidebar .archives a span {
float: right;
}

.site-sidebar .single-sidebar a img {
width: 100%;
}

.single-faq *{
color: #fff !important;
}
.nic-text *{
color: #fff !important;
}
@media only screen and (max-width: 992px) {
table {
border: 0;
}
table thead {
border: none;
clip: rect(0 0 0 0);
height: 1px;
margin: -1px;
overflow: hidden;
padding: 0;
position: absolute;
width: 1px;
}
table tr {
border-bottom: 3px solid #ddd;
display: block;
margin-bottom: .625em;
}
table td {
border-bottom: 1px solid #ddd;
display: block;
font-size: .8em;
text-align: right;
}
table td:before {
/*
* aria-label has no advantage, it won't be read inside a table
content: attr(aria-label);
*/
content: attr(data-label);
float: left;
font-weight: bold;
text-transform: uppercase;
}
table td:last-child {
border-bottom: 0;
}
}




/* Exchange rate calculate */

.single-exchange-value {
float: left;
width: 100%;
position: relative;
}

.single-exchange-value:after {
position: absolute;
content: '\f0ec';
font-family: FontAwesome;
right: -35px;
top: -10px;
height: 40px;
width: 40px;
line-height: 40px;
text-align: center;
-webkit-border-radius: 50%;
-moz-border-radius: 50%;
border-radius: 50%;
border: 1px solid #ccc;
}
.single-exchange-value-none:after {
display: none;
}

.single-exchange-value h3 {
font-size: 26px;
margin-bottom: 30px;
border-bottom:1px solid #e4e4e4;
}
.single-exchange-value h2 {
font-size: 36px;
margin-bottom: 20px;
}
.single-exchange-value h3 span {
font-size: 12px;
}

.exchange-rate-amoount span {
color: green;
margin-right: 10px;
}
.exchange-rate-amoount span + span {
color: red;
margin-right: 0px;
}
.exchange-rate-amoount-sapn a {
border-radius: 4px;
}


.custom-btn{
height: 55px;
width: 100%;
background: <?php echo  $color?>;
padding: 15px 30px;
border-radius: 4px;
color: #ffffff;
font-size: 12px;
font-weight: 700;
text-transform: uppercase;
margin-bottom: 30px;
cursor: pointer;
}

.custom-btn:hover,
.custom-btn:focus
{
color: #fff;
}

.card-header a.accor{
border: none!important;
text-decoration: none;
}
.card-header a.accor:hover{
border: none!important;
color: #fff !important;
}



.myform input,
.myform select
{
width: 100%;
height: 55px;
border: 2px solid #ddd;
border-radius: 4px;
text-indent: 15px;
margin-bottom: 30px;
}

.myform select:focus,
.myform input:focus {
border-color: #052146;
}

.myform textarea {
width: 100%;
border: 2px solid #ddd;
border-radius: 4px;
padding-left: 15px;
padding-top: 10px;
}

.myform textarea:focus {
border-color: #052146;
}

.myCard{
background: #052146;
color: #ffffff;
padding-top: 15px;
padding-bottom: 15px;
}

.card {
border: 1px solid #052146;
}

.cash-card .card-body {
display: -ms-flexbox;
display: flex;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
align-items: center;
}
.cash-thumb {
width: 85px;
height: 85px;
border-radius: 50%;
display: inline-block;
overflow: hidden;
box-shadow: 0 8px 15px 0 rgba(0, 0, 0, 0.15);
}
.cash-content {
-ms-flex: 0 0 calc(100% - 100px);
flex: 0 0 calc(100% - 100px);
max-width: calc(100% - 100px);
padding-left: 15px;
text-align: left;
}
.cash-content .card-title {
margin-bottom: 10px;
}
.cash-content p {
font-size: 14px;
text-transform: capitalize;
}

.height-100vh{
height: 100vh;
}
.contact-box {
background: #000036;
padding: 30px;
-webkit-border-radius: 4px;
-moz-border-radius: 4px;
border-radius: 4px;
}
.contact-box p {
margin-bottom: 0;
}


.dashboard-w2 {
display: block;
padding: 30px 30px;
display: flex;
align-items: center;
justify-content: space-between;
position: relative;
margin-bottom: 30px;
overflow: hidden;
z-index: 9;
background: #000036;
}
.border-radius-5, .custom-file-label.border-radius-5::after {
border-radius: 5px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
-ms-border-radius: 5px;
-o-border-radius: 5px;
}
.dashboard-w2 .icon {
font-size: 62px;
}
.btn-sqr{
height: 36px;
width: 36px;
text-align: center;
padding: 6px !important;
font-size: 20px;
}
.wallet-cls {
width: 60px;
opacity: 0.70;
filter: grayscale(1);
}
.dashboard-w2 .wallet-cls {
opacity: 1;
filter: grayscale(0);
}
.bg_img {
background-size: cover;
background-position: center center;
background-repeat: no-repeat;
}
.theme-bg {
background: #000036;
}
.gradient-overlay.review-area .testimonials {
color: #111111;
}
.table .thead-dark th {
background: #000036;
border-color: transparent;
}
@media screen and (min-width:500px) {
.date-site {
width: 60px;
padding: 10px 0;
text-align: center;
color: #fff;
background: <?php echo $color?>;
display: -webkit-box;
display: -moz-box;
display: -webkit-flex;
display: -ms-flexbox;
display: flex;
flex-wrap: wrap;
align-items: center;
justify-content: center;
flex-direction: column;
max-width: 100%;
}
}
@media screen and (max-width:499px) {
.date-site {
color: <?php echo $color?>;
background: transparent !important;
}
}
.ff-rajdhani {
 font-family: Almarai,sans-serif;
text-align: center;
}
.ff-rajdhani input, .ff-rajdhani span {
font-weight: 700;
}
.ff-rajdhani span {
line-height: 33px;
}
.button-raj {
display: inline-block;
 font-family: Almarai,sans-serif;
font-weight: 700;
padding: .5rem 2rem;
}
#makrasha {
position: absolute;
top: 0;
left: 0;
width: 100%;
height: 100%;
}
@media screen and (min-width: 576px) {
.modal-dialog {
max-width: 750px;
}
}
.dyna-bg {
background: <?php echo $color?>;
border-color: <?php echo $color?>;
}
.protect-button {
width: auto;
padding: 15px 40px;
border: 1px solid <?php echo $color?>;
}
.border-1 {
border-bottom: 1px solid #e5e5e5;
}
.border-2 {
border-top: 1px solid #e5e5e5;
}
.ash-bg .table .thead-dark th,
.ash-bg-2 .table .thead-dark th {
    background: #000036;
    color: #fff;
}
.bosao-button {
    position: relative;
}
.bosao-button input {
    height: 50px;
}
.bosao-button button {
    height: 50px;
    position: absolute;
    right: 0;
    bottom: 0;
}

//sas

theme-bg.wave-animation
{
border-top: 1px solid #fff;
}

.single-box i {
font-size: 34px;
height: 90px;
width: 90px;
line-height: 90px;
border-radius: 50%;
text-align: center;
color: <?php echo $color?>;
display: block;
margin: auto;
margin-bottom: auto;
margin-bottom: 30px;
box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
border: 2px solid <?php echo $color?>;
transition: 0.4s;
}
.single-box:hover i {
color: #fff;
border: 2px solid #fff;
}


@media (min-width: 1200px) and (max-width: 1300px) {
    .header-area .main-menu ul li {
        margin-right: 14px;
    }
}
@media (min-width: 992px) and (max-width: 1199px) {
.navbar-brand {
margin-left: 15px
}
}
</style>
