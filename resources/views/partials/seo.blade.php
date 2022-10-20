@if(!empty($seo))
    <meta name="title" Content="{{ $general->sitename($page_title) }}">
    <meta name="description" content="{{ $seo->description }}">
    <meta name="keywords" content="{{ implode(',',$seo->keywords) }}">
    <!-- Apple Stuff -->
    <link rel="apple-touch-icon" href="{{ get_image(config('constants.logoIcon.path')) .'/logo.png' }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ $general->sitename($page_title) }}">
    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ $general->sitename($page_title) }}">
    <meta itemprop="description" content="{{ $general->seo_description }}">
    <meta itemprop="image" content="{{ get_image(config('constants.seo.path')) .'/'. $seo->image }}">
    <!-- Facebook Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $seo->social_title }}">
    <meta property="og:description" content="{{ $seo->social_description }}">
    <meta property="og:image" content="{{ get_image(config('constants.seo.path')) .'/'. $seo->image }}"/>
    <meta property="og:image:type" content="image/{{ pathinfo(get_image(config('constants.seo.path')) .'/'. $seo->image)['extension'] }}" />
    @php $social_image_size = explode('x', config('constants.seo.size')) @endphp
    <meta property="og:image:width" content="{{ $social_image_size[0] }}" />
    <meta property="og:image:height" content="{{ $social_image_size[1] }}" />
    <meta property="og:url" content="{{ url()->current() }}">
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
@endif
