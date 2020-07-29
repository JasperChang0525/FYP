@extends('layouts.app')

@section('content')
    <h1>Incident Details</h1>
    <img style="width:20%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>  
    <div>Description:
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}}</small>
    <hr>
    <small>Reported by {{Auth::user()->name}}</small>
    <hr>
    <small>Address: {{$post->address}}</small>
    <hr>
    <a href ="/posts" class="btn btn-default">Go Back</a>
        
    
       



@endsection