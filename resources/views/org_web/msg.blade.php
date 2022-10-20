@if (session('message'))
    <script>
        new Noty({
            layout: 'topLeft',
            text: "{{ session('message') }}",
            killer: true,
            type:'success',
            timeout: 5000,
        }).show();
    </script>
@endif

@if (session('success'))
    <script>
        new Noty({
            layout: 'topLeft',
            text: "{{ session('success') }}",
            killer: true,
            type:'success',
            timeout: 5000,
        }).show();
    </script>
@endif

@if(session()->has('status'))
    @if(session()->get('status') == 'wrong')
            <script>
                new Noty({
                    layout: 'topLeft',
                    text: "  {{ session('message') }}",
                    killer: true,
                    type: 'error',
                    timeout: 5000,
                }).show();
            </script>
    @endif
@endif

@if (session('error'))
    <script>
        new Noty({
            layout: 'topLeft',
            text: "  {{ session('error') }}",
            killer: true,
            type: 'error',
            timeout: 5000,
        }).show();
    </script>
@endif

@if (session('errors') && count($errors) > 0)
    <script>
        new Noty({
            layout: 'topLeft',
            text: " <ul>@foreach ($errors->all() as $error)<ol>{{ $error }}</ol>@endforeach</ul>",
            killer: true,
            type: 'error',
            timeout: 5000,
        }).show();
    </script>
@endif