@extends('layouts.app')

@section('content')
<h1> Incidents </h1>    
@if(count($posts)>0)
@foreach ($posts as $post)
<div class="well">
<div class="row">
            <div class="col-md-4 col-sm-4">
                <img style="width:30%" src="/storage/cover_images/{{$post->cover_image}}">
            </div>
            <div class="col-md-8 col-sm-8">
                <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                
                @foreach ($user as $item)
                    @if ($item->id == $post->user_id)
                    <h6>Reported by: {{$item->name}}</h6>
                    @endif
                @endforeach
                
                <h6>Address: {{$post->address}}</h6>
                <small>Wrtten on {{$post->created_at}}</small>
                {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST', 'class'=>'pull-right'])!!}
                {{Form::hidden('_method','DELETE')}}
                {{Form::submit('Solved',['class'=>'btn btn-danger'])}}
                {!!Form::close()!!}
            </div>
            </div>
    </div>
@endforeach
       {{$posts->links()}}
@else
    <p>No posts found</p>
    @endif
@endsection