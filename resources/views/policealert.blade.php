@extends('layouts.app')

@section('content')
    @foreach ($alert as $item)
        <div class="well">
            @foreach ($user as $username)
                @if ($username->id == $item->police_id)
                    <h2>Police: {{$username->name}}</h2>
                @endif
            @endforeach
        <small>Coordinate: {{$item->lat}}, {{$item->lat}}</small>
        <br>
        <small>Location: {{$item->address}}</small>
        {{Form::open(['action' => ['AdminController@solvesos', $item->id], 'method' => 'POST'])}}
            <button type="submit" class='btn btn-danger'>Solved</button>
        {{Form::close()}}
        </div>
        
    @endforeach
@endsection