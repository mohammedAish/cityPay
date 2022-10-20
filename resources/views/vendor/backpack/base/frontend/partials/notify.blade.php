@if($general->alert == 1) 
    <!-- iziToast -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/iziToast.min.css') }}">
    <script src="{{ asset('assets/admin/js/iziToast.min.js') }}"></script>

    @if(session()->has('notify'))
      @foreach(session('notify') as $msg)
        <script type="text/javascript">  iziToast.{{ $msg[0] }}({message:"{{ $msg[1] }}", position: "topRight"}); </script>
        @endforeach
    @endif

    @if ($errors->any())
        <script>

        @foreach ($errors->all() as $error)
            iziToast.error({
                message: '{{ $error }}',
            position: "topRight"
            });
        @endforeach
    </script>

    @endif
  

@elseif($general->alert == 2)
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/toastr.min.css') }}">
    <script src="{{ asset('assets/admin/js/toastr.min.js') }}"></script>
    @if(session()->has('notify'))
    @foreach(session('notify') as $msg)
    <script type="text/javascript">  toastr.{{ $msg[0] }}("{{ $msg[1] }}"); </script>
    @endforeach
    @endif

    
    @if ($errors->any())
        <script>

        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
    </script>

    @endif
    
@endif
