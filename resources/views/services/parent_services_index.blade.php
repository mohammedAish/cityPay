@extends('layouts.app')
@section('content')
    <div class="container" dir="{{current_direction()}}">
        @foreach($parentServices as $oneservice)
            <div class="card-body">

         <span class="h2"> {{$oneservice->name}}
             </span>
                <br/>
                @foreach($oneservice->services as $innerService)
                    - {{$innerService->name}}
                @endforeach
            </div>
            <div class="card-body">
                <br/>
                <span class="h3">
                {{__('lang.service_features')}}</span>
                <br/>
                @foreach($oneservice->serviceFeatures as $serviceFeature)
                    {!! $serviceFeature->description !!}
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
