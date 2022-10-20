@php
    $value = data_get($entry, $column['name']);
@endphp

<div class="">
    <a href="{{asset($value)}}" target="_blank">{{$value}}</a>
</div>
