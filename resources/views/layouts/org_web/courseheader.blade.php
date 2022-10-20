<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>يمن تداول الدولية للخدمات المالية</title>
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/61ff7d8555.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/slick.min.css')}}">
    <link rel="stylesheet" href="{{asset('/org_assets/dist/css/main.min.css')}}">
    <link type="text/css"
          href="https://www.udemy.com/staticx/udemy/js/webpack/entry-main-legacy.5154037f682edf14174d.css"
          rel="stylesheet"/>
    <link type="text/css" rel="stylesheet"
          data-href="https://www.udemy.com/staticx/udemy/js/webpack/udlite-common-css.7608282407cb789373cf.css"/>
{{--    for multy select in filter--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.16/css/bootstrap-multiselect.css" integrity="sha512-DJ1SGx61zfspL2OycyUiXuLtxNqA3GxsXNinUX3AnvnwxbZ+YQxBARtX8G/zHvWRG9aFZz+C7HxcWMB0+heo3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>.legal-notice--toast--1iLrp {
            background: #1e1e1c;
            color: #fff;
            padding: 1.6rem 5.6rem 1.6rem 2.4rem;
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 1040
        }

        .legal-notice--toast--1iLrp a {
            color: #fff;
            text-decoration: underline
        }

        .legal-notice--close-btn--2BZfw {
            position: absolute;
            top: .8rem;
            right: .8rem
        }

        .bai-banner--bai-banner--25Ewk {
            padding-top: 1.6rem;
            padding-bottom: 1.6rem
        }

        .bai-banner--subtitle--36Adc {
            padding: .8rem 0
        }

        @media screen and (min-width: 43.81em) {
            .bai-banner--bai-banner--25Ewk {
                display: flex;
                justify-content: space-between;
                align-items: center
            }

            .bai-banner--button-container--32up8 {
                flex-shrink: 0;
                padding-left: .8rem
            }
        }

        .udlite-select-container {
            position: relative;
            min-width: 24rem;
            max-width: 60rem
        }

        .udlite-select {
            background: #fff;
            border-radius: 4px;
            border: 1px solid #989586;
            cursor: pointer;
            display: block;
            padding: 0 4rem 0 1.6rem;
            width: 100%;
            appearance: none;
            -moz-appearance: none;
            -webkit-appearance: none
        }

        .udlite-select:hover {
            border-color: #797667
        }

        .udlite-select:focus {
            border-color: #73726c
        }

        .udlite-select:invalid, .udlite-select [disabled] {
            color: #73726c;
            border-color: #989586
        }

        .udlite-select-icon-container {
            pointer-events: none;
            display: flex;
            align-items: center;
            position: absolute;
            top: 0;
            height: 100%;
            padding: 0 .8rem
        }

        .udlite-select-icon-left {
            left: 0;
            justify-content: flex-end
        }

        .udlite-select-icon-right {
            right: 0
        }

        .udlite-select-container-large .udlite-select {
            height: 4.8rem
        }

        .udlite-select-container-large .udlite-select-with-icon {
            padding-left: 4rem
        }

        .udlite-select-container-large .udlite-select-icon-container {
            width: 4rem
        }

        .udlite-select-container-small .udlite-select {
            height: 4rem
        }

        .udlite-select-container-small .udlite-select-with-icon {
            padding-left: 3.6rem
        }

        .udlite-select-container-small .udlite-select-icon-container {
            width: 3.6rem
        }

        .ufb-notice--notice--12AAi {
            padding-top: 2.4rem;
            padding-bottom: 2.4rem
        }

        .ufb-notice--notice--12AAi a {
            font-weight: inherit
        }

        .ufb-notice--partner-logos--3HzrN img {
            margin: 0 2.4rem 2.4rem 0;
            vertical-align: middle
        }

        .ufb-notice--partner-logos--3HzrN img:last-child {
            margin-right: 0
        }

        @media screen and (min-width: 75.06em) {
            .ufb-notice--notice-row--3tUOv {
                display: flex;
                justify-content: space-between;
                align-items: center
            }

            .ufb-notice--notice--12AAi {
                padding: 2.4rem 3.2rem 2.4rem 0
            }

            .ufb-notice--partner-logos--3HzrN {
                text-align: right;
                min-width: 68.5rem
            }

            .ufb-notice--partner-logos--3HzrN img {
                margin-bottom: 0
            }
        }

        .udlite-footer .footer-section {
            background: #fff;
            border-top: 1px solid #dcdacb;
            padding-left: 2.4rem;
            padding-right: 2.4rem
        }

        .udlite-footer .locale-select-container, .udlite-footer .logo-container {
            padding: 1.6rem 0
        }

        .udlite-footer .logo-container {
            display: flex;
            align-items: center
        }

        .udlite-footer .benesse-logo {
            margin: -0.8rem 0 0 2.4rem
        }

        .udlite-footer .link {
            display: block;
            padding: .4rem 0
        }

        .udlite-footer .copyright-container {
            color: #73726c;
            padding-bottom: 1.6rem
        }

        @media screen and (min-width: 43.81em) {
            .udlite-footer .footer-section-main {
                padding-top: 2.4rem
            }

            .udlite-footer .links-and-locale {
                display: flex
            }

            .udlite-footer .locale-select-container {
                padding: 0;
                order: 1;
                flex-shrink: 0;
                margin-left: auto
            }

            .udlite-footer .link-column {
                flex-basis: 25.6rem;
                margin-right: 1.6rem;
                margin-bottom: 0
            }

            .udlite-footer .logo-and-copyright {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 6.4rem 0 4.8rem 0
            }

            .udlite-footer .logo-and-copyright .logo-container {
                padding: 0
            }

            .udlite-footer .logo-and-copyright .copyright-container {
                padding: 0;
                height: 100%;
                top: 50%;
                color: #73726c
            }
        }

        @media screen and (min-width: 61.31em) {
            .udlite-footer .footer-section {
                padding-left: 3.2rem;
                padding-right: 3.2rem
            }
        }

        @media screen and (min-width: 75.06em) {
            .udlite-footer .footer-section {
                padding-left: 4.8rem;
                padding-right: 4.8rem
            }
        }

        .udlite-text-input {
            border-radius: 4px;
            border: 1px solid #989586;
            display: block;
            padding: 0 1.6rem;
            min-width: 24rem;
            width: 100%;
            max-width: 60rem
        }

        .udlite-text-input::-moz-placeholder {
            color: #73726c;
            opacity: 1
        }

        .udlite-text-input:-ms-input-placeholder {
            color: #73726c
        }

        .udlite-text-input::-webkit-input-placeholder {
            color: #73726c
        }

        .udlite-text-input:hover {
            border-color: #797667
        }

        .udlite-text-input:focus {
            border-color: #3c3b37
        }

        .udlite-text-input-large {
            height: 4.8rem
        }

        .udlite-text-input-small {
            height: 4rem
        }

        .udlite-search-form-autocomplete {
            position: relative;
            min-width: 24rem;
            max-width: 60rem
        }

        .udlite-search-form-autocomplete .udlite-search-form-autocomplete-input {
            border: 0;
            flex: 1;
            min-width: 0
        }

        .udlite-search-form-autocomplete .udlite-search-form-autocomplete-suggestions {
            animation: udlite-search-form-autocomplete-expand 150ms cubic-bezier(0, 0, .38, .9);
            background: #fff;
            border: 1px solid #dcdacb;
            left: -1px;
            padding: 1.6rem;
            position: absolute;
            right: 0;
            top: 100%;
            transform-origin: top;
            width: calc(100% + 2px);
            max-width: none;
            z-index: 1000
        }

        .udlite-search-form-autocomplete-input-group {
            display: flex;
            align-items: center;
            height: 100%
        }

        .udlite-search-form-autocomplete-input-group-reversed {
            flex-direction: row-reverse
        }

        .udlite-search-form-autocomplete-input-group-reversed .udlite-search-form-autocomplete-input {
            padding-left: .4rem
        }

        .udlite-search-form-autocomplete-suggestion {
            animation: udlite-search-form-autocomplete-fade-in 150ms linear 150ms forwards;
            opacity: 0
        }

        @media (max-width: 23.44em) {
            .udlite-search-form-autocomplete-suggestions .udlite-search-form-autocomplete-suggestion {
                padding: .4rem 0
            }
        }

        .udlite-search-form-autocomplete-suggestion-focus {
            outline: 4px solid #f0bd4f
        }

        .udlite-search-form-autocomplete-suggestion-content {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        @keyframes udlite-search-form-autocomplete-fade-in {
            from {
                opacity: 0
            }
            to {
                opacity: 1
            }
        }

        @keyframes udlite-search-form-autocomplete-expand {
            from {
                transform: scaleY(0)
            }
            to {
                transform: scaleY(1)
            }
        }

        .smart-bar--smart-bar--32jNQ {
            display: flex;
            position: relative;
            z-index: 1010
        }

        .smart-bar--instructor-bar--purple--34JvV, .smart-bar--smart-bar--purple--2BIMb {
            color: #420e31;
            background: #d99bc4
        }

        .smart-bar--smart-bar--teal--1Hv2o {
            color: #003640;
            background: #8ed1dc
        }

        .smart-bar--smart-bar--yellow--3RXTf {
            color: #593d00;
            background: #ffe799
        }

        .smart-bar--smart-bar__action-url--29ljD {
            cursor: default;
            color: inherit
        }

        .smart-bar--smart-bar__close--2Xuuy {
            color: #3c3b37 !important;
            background: transparent !important;
            margin: .8rem
        }

        .smart-bar--smart-bar__content--3Y6xq {
            flex-basis: 100%;
            padding-top: 1.6rem;
            padding-bottom: 1.6rem;
            padding-left: 2.4rem
        }

        .smart-bar--smart-bar__subtitle--1MYlO a {
            text-decoration: underline
        }

        .smart-bar--smart-bar__title--3tKKr {
            font-weight: 700;
            margin-right: .4rem
        }

        .smart-bar--basic-bar-content--1cTYB {
            text-align: left
        }

        @media (min-width: 43.81em) {
            .smart-bar--basic-bar-content--1cTYB {
                font-family: 'SF Pro Text', -apple-system, BlinkMacSystemFont, Roboto, 'Segoe UI', Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol';
                font-weight: 400;
                line-height: 1.4;
                font-size: 1.6rem
            }
        }

        @media (min-width: 61.31em) {
            .smart-bar--basic-bar-content--1cTYB {
                text-align: center
            }
        }

        .udlite-notification-badge {
            background: #ec5252;
            color: #fff;
            display: inline-block;
            font-weight: 700;
            text-align: center
        }

        .udlite-notification-counter {
            border-radius: 9999px;
            font-size: 0.9em;
            min-width: 2em;
            padding: .4rem .8rem
        }

        .udlite-notification-dot {
            font-size: 1.2rem;
            border-radius: 50%;
            height: 1em;
            width: 1em
        }

        .udlite-avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            object-fit: cover;
            color: #fff
        }

        .udlite-avatar-image {
            border: 1px solid #dcdacb
        }

        .styles--show-cache-debug-container--f7q1j {
            right: 10px;
            padding: 10px;
            position: fixed;
            bottom: 50px;
            z-index: 1050
        }

        .alert-banner--alert-banner--3j6wd {
            border: 1px solid #dcdacb;
            border-radius: 4px;
            display: flex;
            padding: 1.6rem
        }

        .alert-banner--alert-banner-cta-container--2z7OK {
            display: flex
        }

        .alert-banner--alert-banner-information--1fccT {
            background: #fff;
            border-color: #dcdacb;
            color: #3c3b37
        }

        .alert-banner--alert-banner-success--KTCxy {
            background: #f4fbf6;
            border-color: #99dbaa;
            color: #003b0f
        }

        .alert-banner--alert-banner-error--wiW6I {
            background: #fdf7f7;
            border-color: #f99;
            color: #521818
        }

        .alert-banner--alert-banner-warning--SFgHl {
            background: #fff7f0;
            border-color: #ffc48c;
            color: #592b00
        }

        .alert-banner--alert-banner-icon-container--XnEA8 {
            margin-right: 1.6rem
        }

        .alert-banner--alert-banner-text-frame--2j6aF {
            display: flex;
            flex-direction: column;
            margin: .8rem 0
        }

        .alert-banner--text-frame-with-icon--2wK1l {
            margin-top: .4rem;
            justify-content: center;
            min-height: 3.2rem
        }

        .alert-banner--alert-banner-text--2avme {
            margin-top: .4rem
        }

        .alert-banner--button--21v33 + .alert-banner--button--21v33 {
            margin-left: 1.6rem
        }

        .udlite-in-udheavy .alert-banner--alert-banner--3j6wd h2, .udlite-in-udheavy .alert-banner--alert-banner--3j6wd p {
            margin: 0
        }

        .udlite-in-udheavy .alert-banner--alert-banner--3j6wd p.alert-banner--alert-banner-text--2avme {
            margin-top: .4rem
        }

        .full-page-overlay--full-page-overlay--2EGvi {
            background: rgba(30, 30, 28, 0.8);
            left: 0;
            opacity: 0;
            transform: scale(0);
            position: fixed;
            top: 0;
            width: 100%;
            height: 100%;
            transition: opacity 100ms linear, transform 0ms linear 100ms;
            z-index: 1030
        }

        .full-page-overlay-checkbox:checked ~ .full-page-overlay--full-page-overlay--2EGvi, .full-page-overlay-checkbox:checked ~ .full-page-overlay-container .full-page-overlay--full-page-overlay--2EGvi {
            opacity: 1;
            cursor: pointer;
            transform: scale(1);
            transition: opacity 100ms linear
        }

        .close-button--close-btn--CjQjb {
            background: #fff;
            border: 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.08);
            position: absolute
        }

        .mobile-nav--nav-item--1hfFJ {
            margin-bottom: 0
        }

        .mobile-nav--nav--1brOS .mobile-nav--nav-item--1hfFJ {
            padding-left: 1.6rem;
            padding-right: 1.6rem
        }

        .mobile-nav--nav--1brOS .mobile-nav--nav-item--1hfFJ.mobile-nav--bold--P2i_i {
            font-weight: 700
        }

        .mobile-nav--nav--1brOS .mobile-nav--highlighted--M1nGW {
            background: #FBFBF8
        }

        .mobile-nav--nav--1brOS .mobile-nav--underlined--ODjSi {
            border-bottom: 1px solid #dcdacb
        }

        .mobile-nav--nav-section--Fc5GU {
            padding: .8rem 0
        }

        .mobile-nav--nav--1brOS .mobile-nav--profile-section--22AiC .mobile-nav--nav-item--1hfFJ, .mobile-nav--profile-section-content---u4ow {
            display: flex;
            align-items: center
        }

        .mobile-nav--nav-section-heading--3OccJ {
            color: #73726c;
            padding: 1.6rem 1.6rem 0 1.6rem;
            margin-bottom: -0.4rem
        }

        .mobile-nav--nav-section--Fc5GU ~ .mobile-nav--nav-section-heading--3OccJ, .mobile-nav--nav-section--Fc5GU + .mobile-nav--nav-section--Fc5GU {
            border-top: 1px solid #dcdacb
        }

        .mobile-nav--profile-section-content---u4ow .mobile-nav--profile-badge--1EH_N {
            position: absolute;
            font-size: 1.6rem;
            top: 0;
            right: 2%
        }

        .mobile-nav--profile-name--39fkZ {
            margin: 0 .8rem 0 1.6rem;
            word-break: break-word
        }

        .mobile-nav--profile-welcome--Z65dC {
            color: #73726c;
            margin: 0 .8rem 0 1.6rem
        }

        .side-drawer--side-drawer--2btsf {
            display: block;
            position: fixed;
            top: 0;
            width: 28rem;
            max-width: 78%;
            height: 100%;
            background: #fff;
            z-index: 1030;
            transition: transform 150ms cubic-bezier(.2, 0, 1, .9)
        }

        .side-drawer--side-drawer--2btsf .side-drawer--side-drawer--2btsf {
            position: absolute;
            max-width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.08)
        }

        .side-drawer--side-drawer--2btsf .side-drawer--close-btn--B3lni {
            top: 0;
            margin: 1.6rem;
            transform: scale(0);
            transition: transform 150ms cubic-bezier(.2, 0, 1, .9)
        }

        .side-drawer--main-drawer-checkbox--MjJ8D:checked ~ .side-drawer--side-drawer--2btsf, .side-drawer--side-drawer--2btsf .side-drawer--drawer-radio--2rJDZ:checked + .side-drawer--side-drawer--2btsf, .side-drawer--side-drawer--2btsf .side-drawer--drawer-radio--2rJDZ:checked ~ .side-drawer--side-drawer--2btsf:last-of-type + .side-drawer--drawer-radio--2rJDZ + .side-drawer--side-drawer--2btsf {
            transform: translateX(0);
            transition: transform 250ms cubic-bezier(0, 0, .38, .9)
        }

        .side-drawer--main-drawer-checkbox--MjJ8D:checked ~ .side-drawer--side-drawer--2btsf .side-drawer--close-btn--B3lni, .side-drawer--side-drawer--2btsf .side-drawer--drawer-radio--2rJDZ:checked + .side-drawer--side-drawer--2btsf .side-drawer--close-btn--B3lni, .side-drawer--side-drawer--2btsf .side-drawer--drawer-radio--2rJDZ:checked ~ .side-drawer--side-drawer--2btsf:last-of-type + .side-drawer--drawer-radio--2rJDZ + .side-drawer--side-drawer--2btsf .side-drawer--close-btn--B3lni {
            transform: scale(1);
            transition: transform 100ms cubic-bezier(0, 0, .38, .9) 400ms
        }

        .side-drawer--main-drawer-checkbox--MjJ8D:checked ~ .side-drawer--side-drawer--2btsf .side-drawer--drawer-container--fv87h, .side-drawer--side-drawer--2btsf .side-drawer--drawer-radio--2rJDZ:checked + .side-drawer--side-drawer--2btsf .side-drawer--drawer-container--fv87h, .side-drawer--side-drawer--2btsf .side-drawer--drawer-radio--2rJDZ:checked ~ .side-drawer--side-drawer--2btsf:last-of-type + .side-drawer--drawer-radio--2rJDZ + .side-drawer--side-drawer--2btsf .side-drawer--drawer-container--fv87h {
            opacity: 1;
            transition: opacity 250ms linear 250ms
        }

        .side-drawer--drawer-container--fv87h {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            clip: rect(auto, auto, auto, auto);
            opacity: 0;
            transition: opacity 150ms linear
        }

        .side-drawer--drawer-content--1xUDo {
            height: 100%;
            overflow: auto;
            padding-bottom: 3.2rem
        }

        .side-drawer--side-left--Pmw8k {
            left: 0;
            transform: translateX(-34.4rem)
        }

        .side-drawer--side-left--Pmw8k .side-drawer--side-drawer--2btsf {
            transform: translateX(34.4rem)
        }

        .side-drawer--side-left--Pmw8k .side-drawer--close-btn--B3lni {
            left: 100%
        }

        .side-drawer--side-right--15KUh {
            right: 0;
            transform: translateX(34.4rem)
        }

        .side-drawer--side-right--15KUh .side-drawer--side-drawer--2btsf {
            transform: translateX(34.4rem)
        }

        .side-drawer--side-right--15KUh .side-drawer--close-btn--B3lni {
            right: 100%
        }

        .side-drawer--main-drawer-checkbox--MjJ8D:not(:checked) ~ .side-drawer--side-drawer--2btsf .side-drawer--close-btn--B3lni, .side-drawer--main-drawer-checkbox--MjJ8D:not(:checked) ~ .side-drawer--side-drawer--2btsf .side-drawer--drawer-content--1xUDo, .side-drawer--drawer-radio--2rJDZ:not(:checked) + .side-drawer--side-drawer--2btsf > .side-drawer--drawer-content--1xUDo, .side-drawer--drawer-radio--2rJDZ:not(:checked) + .side-drawer--side-drawer--2btsf > .side-drawer--drawer-container--fv87h > .side-drawer--drawer-content--1xUDo {
            visibility: hidden;
            transition: visibility 0ms linear 150ms
        }

        .udlite-header {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.08);
            z-index: 1010
        }

        .header--header--1ffLd {
            background: #fff;
            padding: .4rem;
            position: relative;
            z-index: 1010
        }

        .header--row--29n3s {
            display: flex;
            align-items: center
        }

        .header--middle--F2ENI {
            flex: 1;
            justify-content: center
        }

        .header--button-spacer--2-y_b {
            width: 4.8rem;
            height: 4.8rem;
            visibility: hidden
        }

        .header--search-bar--1M3Y7 {
            background: inherit;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%
        }

        .header--search-bar--1M3Y7 .header--search-bar-form--2OElp {
            padding: .4rem 5.6rem .4rem .4rem
        }

        .header--search-bar-close--WDisN {
            position: absolute;
            top: .4rem;
            right: .4rem;
            z-index: 1
        }

        #header-toggle-search-bar:not(:checked) ~ * .header--search-bar-layer--2Wow0 {
            display: none
        }

        .header--header--1ffLd .header--cart-badge--Qq2Wb {
            position: absolute;
            font-size: 1.2rem;
            margin: 0 0 0 -0.4rem;
            top: 0;
            left: 50%
        }

        .toast--container--3aQgO {
            width: 100%;
            transform: translateX(100%);
            transition: transform 250ms cubic-bezier(0, 0, .38, .9);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08), 0 4px 12px rgba(0, 0, 0, 0.08)
        }

        .toast--container--3aQgO.toast--visible--pTuH4 {
            transform: translateX(0)
        }

        .toaster--toaster--1jSiU {
            z-index: 1040;
            position: fixed;
            right: 0;
            bottom: 0;
            margin: 0 2.4rem 2.4rem;
            max-width: 36.6rem;
            width: calc(100% - 2 * 2.4rem);
            display: flex;
            flex-direction: column-reverse
        }

        @media (min-width: 37.56em) {
            .toaster--toaster--1jSiU {
                width: 32rem
            }
        }

        .toaster--toaster--1jSiU > * {
            margin-top: 1.6rem
        }

        /*# sourceMappingURL=udlite-common-css.7608282407cb789373cf.css.map*/</style>
    <script>(window.webpackJsonp = window.webpackJsonp || []).push([["udlite-common-css"], []]);
        //# sourceMappingURL=udlite-common-css.583b900d4a55e3a80c9d.js.map</script>


    <style>/* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OX-hpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OVuhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXuhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+1F00-1FFF;
        }

        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OUehpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+0370-03FF;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXehpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OUuhpKKSTjw.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN_r8OXOhv.woff) format('woff');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFWJ0bf8pkAp6a.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFUZ0bf8pkAp6a.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFWZ0bf8pkAp6a.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+1F00-1FFF;
        }

        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFVp0bf8pkAp6a.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+0370-03FF;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFWp0bf8pkAp6a.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50bf8pkAp6a.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 400;
            src: local('Open Sans Regular'), local('OpenSans-Regular'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFVZ0bf8pkAg.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem8YaGs126MiZpBA-UFW50d.woff) format('woff');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOX-hpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOVuhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXuhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+1F00-1FFF;
        }

        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOUehpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+0370-03FF;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXehpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 600;
            src: local('Open Sans SemiBold'), local('OpenSans-SemiBold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOUuhpKKSTjw.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UNirkOXOhv.woff) format('woff');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* cyrillic-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOX-hpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F;
        }

        /* cyrillic */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOVuhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* greek-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXuhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+1F00-1FFF;
        }

        /* greek */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOUehpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+0370-03FF;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXehpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhpKKSTj5PW.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-display: fallback;
            font-weight: 700;
            src: local('Open Sans Bold'), local('OpenSans-Bold'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOUuhpKKSTjw.woff2) format('woff2'), url(https://fonts.gstatic.com/s/opensans/v15/mem5YaGs126MiZpBA-UN7rgOXOhv.woff) format('woff');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }</style>
    <style>
        .org-logo {
            background-image: url('https://www.udemy.com/staticx/udemy/images/v6/logo-coral.svg');
        }

        @media (min-resolution: 2dppx),
        (min-resolution: 192dpi),
        (-webkit-min-device-pixel-ratio: 2) {
            @-ms-viewport {
                width: device-width;
                zoom: 1.0;
            }
            .org-logo {
                /*retina display*/
                background-image: url('https://www.udemy.com/staticx/udemy/images/v6/logo-coral.svg');
            }
        }
    </style>
    <link type="text/css"
          href="https://www.udemy.com/staticx/udemy/js/webpack/course-landing-page/desktop/hb.c0a310a2397bbe8cc985.css"
          rel="stylesheet"/>
    <script type="text/javascript">
        (function () {
            var head,
                regExp = "",
                version = -1,
                userAgent = navigator.userAgent;

            if (navigator.appName == 'Microsoft Internet Explorer') {
                regExp = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
            } else if (navigator.appName == 'Netscape') {
                regExp = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
            }
            if (regExp && regExp.exec(userAgent) != null) {
                version = parseFloat(RegExp.$1);
            }

            if (version > 9) {
                head = document.getElementsByTagName("html")[0];
                head.className = head.className + " ie";
                if (version == 10) {
                    head.className = head.className + " ie10";
                }
            }
        })();
    </script>

    <script>
        if (window.performance && typeof window.performance.mark === 'function'
            && typeof window.performance.measure === 'function') {
            UD.performance = {
                _trackedResources: [],
                _eventNamePrefix: 'UD-',
                trackResourceTiming: function (resourceName, resourceUrl) {
                    this._trackedResources.push({name: resourceName, url: resourceUrl});
                },
                mark: function (name) {
                    window.performance.mark(this._eventNamePrefix + name);
                },
                start: function (name) {
                    window.performance.mark(this._eventNamePrefix + '_' + name + '-start');
                },
                end: function (name) {
                    var endMark = this._eventNamePrefix + '_' + name + '-end';
                    var startMark = this._eventNamePrefix + '_' + name + '-start';
                    window.performance.mark(endMark);

                    if (window.performance.getEntriesByName(startMark).length > 0) {
                        window.performance.measure(this._eventNamePrefix + name, startMark, endMark);
                    }
                },
                sync: function () {

                    window.dispatchEvent(new CustomEvent('syncPerf',
                        {detail: {trackedResources: this._trackedResources}}
                    ));
                }
            };
        } else {
            UD.performance = {
                trackResourceTiming: Function.prototype,
                mark: Function.prototype,
                start: Function.prototype,
                end: Function.prototype,
                sync: Function.prototype
            };
        }
    </script>


    <link rel="canonical"
          href="https://www.udemy.com/course/beginner-to-pro-in-excel-financial-modeling-and-valuation/">

    <link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
    <script src="http://vjs.zencdn.net/4.12/video.js"></script>

    <style>
        .fade.in {
            opacity: 1 !important;
        }

        .modal.in .modal-dialog {
            -webkit-transform: translate(0, 0) !important;
            -o-transform: translate(0, 0) !important;
            transform: translate(0, 0) !important;
        }

        .modal-backdrop .fade .in {
            opacity: 0.5 !important;
        }

        .modal-backdrop.fade {
            opacity: 0.5 !important;
        }
    </style>
</head>
<body id="udemy" class="
    landing-page ud-app-loader
  udemy " data-clp-course-id="321410" data-module-id="course-landing-components"
      data-module-args="{&quot;course_id&quot;:321410,&quot;is_paid&quot;:true,&quot;subcategoryId&quot;:24,&quot;sourcePage&quot;:&quot;clp&quot;,&quot;vectors&quot;:{&quot;device&quot;:&quot;desktop&quot;,&quot;bandwidth&quot;:&quot;hb&quot;},&quot;initial_components&quot;:[&quot;buy_button&quot;,&quot;discount_expiration&quot;,&quot;gift_this_course&quot;,&quot;purchase&quot;,&quot;deal_badge&quot;,&quot;redeem_coupon&quot;],&quot;is_wishlisted&quot;:false,&quot;grouped_components&quot;:[[&quot;introduction_asset&quot;,&quot;curriculum&quot;,&quot;practice_test_bundle&quot;,&quot;recommendation&quot;,&quot;instructor_bio&quot;,&quot;caching_intent&quot;]],&quot;title&quot;:&quot;Beginner to Pro in Excel: Financial Modeling and Valuation&quot;,&quot;is_private&quot;:false,&quot;datadogTags&quot;:{&quot;frame&quot;:&quot;seo_cacheable&quot;,&quot;view&quot;:&quot;default&quot;,&quot;localized&quot;:false,&quot;root&quot;:&quot;course_landing_page/frames/desktop/hb&quot;},&quot;isFreeSEOExp&quot;:false,&quot;rating&quot;:4.51171,&quot;url&quot;:&quot;/course/beginner-to-pro-in-excel-financial-modeling-and-valuation/&quot;,&quot;is_published&quot;:true}">
<div class="preloader">
    <div class="preloader_image"></div>
    <!-- <img src="./dist/img/loading.gif" alt=""> -->
</div>
<!-- up btn -->
<section class="upPage">
    <div class="item btn-group dropup">
        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
            <i class="fas fa-comment-dots"></i>
            <i class="fas fa-times"></i>
        </button>
        <div class="dropdown-menu">
            <div class="icons">
                <a href="https://wa.me/967776433336" class="icon-link whatsapp">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="" class="icon-link telegram">
                    <i class="fab fa-telegram"></i>
                </a>
                <a href="" class="icon-link facebook">
                    <i class="fab fa-facebook-messenger"></i>
                </a>
                <a href="" class="icon-link viber">
                    <i class="fab fa-viber"></i>
                </a>
                <a href="" class="icon-link skype">
                    <i class="fab fa-skype"></i>
                </a>
                <a href="" class="icon-link chat">
                    <i class="fas fa-comments"></i>
                </a>
            </div>
        </div>
    </div>
    <a class="item upBtn" href="#top"><i class="fas fa-chevron-up"></i></a>
</section>
<!-- Navbars -->
<section id="top" class="navbars-container">
    <nav class="sec-nav navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <div class="language">
                <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-globe"></i>
                    <span>اللغة</span>
                </a>
                <div class="dropdown-menu" aria-labelledby="langDropdown">
                    <a class="dropdown-item" href="{{route('index')}}">English</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('index')}}">اللغة العربية</a>
                </div>
            </div>
            <form class="form-inline my-0">
                <input class="form-control" type="search" placeholder="بحث" aria-label="Search">
                <i class="fas fa-search"></i>
            </form>

        </div>
    </nav>
    <nav class="main-nav navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">
                <img src="{{asset('/org_assets/dist/img/logo.png')}}" alt="Company logo">
                <div class="logo-title">
                    <p>يمن تداول الدولية للخدمات المالية</p>
                    <p>Yemen Tadawul International Financial Services</p>
                </div>
            </a>


            <div class="navbar">
                <form class="form-inline my-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="بحث" aria-label="Search">
                    <i class="fas fa-search"></i>
                </form>
                <div class="language">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-globe"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="langDropdown">
                        <a class="dropdown-item" href="./en/index.html">English</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./index.html">اللغة العربية</a>
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
                        aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('aboutus')}}">عن الشركة<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('news')}}">الأخبار</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('services')}}">الخدمات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('offers')}}">العروض</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog')}}">المدونة</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            السياسات والقوانين
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('privacyPolicy')}}">سياسات الخصوصية</a>
                            <a class="dropdown-item" href="{{route('accessPolicy')}}">سياسات الوصول</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('contact')}}">اتصل بنا</a>
                    </li>
                    <li class="nav-item btns">
                        <a href="{{route('userLogin')}}" type="button" class="nav-link btn btn-success">دخول</a>
                        <a href="{{route('userRegister')}}" type="button" class="nav-link btn register-btn">إنشاء
                            حساب</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
