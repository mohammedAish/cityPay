@if(Config::get('settings.toasts')==1)
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
@elseif(Config::get('settings.toasts')==2)
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
@endif
