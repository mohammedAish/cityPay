@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach($services as $service)
            <br/>
            {{$service->id}} - {{$service->name}}
        @endforeach
    </div>


@endsection
