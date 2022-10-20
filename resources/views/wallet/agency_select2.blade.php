@if(count($agencies) > 0)
    <option value="">{{cp('select_agency')}}</option>
    @foreach($agencies as $agency)
        <option value="{{$agency->id}}" all_data="{{$agency}}">{{$agency->name}}</option>
    @endforeach
@else
    <option value="">{{cp('no_results_found')}}</option>
@endif
