@extends('layouts.app')

@section('patrol')

    {{Form::open(['action' => 'PatrolController@saveshift', 'method' => 'POST'])}}
        <h2>Set Schedule</h2>

        {{Form::label('user_police', 'Please select the patrol police')}}
        {{-- {{Form::select('user_police', array($police->user->name)}}
         --}}
        <select name="police" id="policenamebox">
            @foreach ($police as $policelist)
                <option value="{{$policelist->id}}">{{$policelist->name}}</option>                
            @endforeach
        </select>

        <br>
        {{Form::label('start_date', 'Enter Patrol Start Date')}}
        <input type="datetime-local" id="time" class="form-control" name="start_date" /> 
        <br>
        {{Form::label('zonlist', 'Which Zon Shift')}}
        <select name="zon" id="zonlistbox">
            @foreach ($zonlist as $list)
                <option value="{{$list->zonlist_id}}">{{$list->zon_ukm}}</option>
            @endforeach
    
        </select>
<br>
        {{Form::submit("Set Police", ['class' => 'btn btn-info'])}}
    {{Form::close()}}

    
@endsection