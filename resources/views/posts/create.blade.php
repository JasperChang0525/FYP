@extends('layouts.app')

@section('content')
<h1> Report Incident </h1>    
{!! Form::open(['action'=>'PostsController@store','method'=> 'POST', 'enctype' => 'multipart/form-data']) !!}
<div class="form-group">
    {{Form::label('title','Title')}}
    {{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
</div>



<div class="form-group">
        {{Form::label('body', 'Desciption')}}
        {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>
        <td width="40%" ></td>
        <td width="30"><span class="text-muted">jpeg, png, jpg, gif, svg</span></td>
        <td width="30%" ></td>
        <br>
        <input type="hidden" name="commentlat" id="commentlat">
        <input type="hidden" name="commentlon" id="commentlon">
        <script>
            if(navigator.geolocation)
            {
                navigator.geolocation.getCurrentPosition(function(position)
                {
                    let commentlat = position.coords.latitude;
                    let commentlon = position.coords.longitude;
                    document.getElementById('commentlat').value = position.coords.latitude;
                    document.getElementById('commentlon').value = position.coords.longitude;
                    console.log(commentlat);
                    console.log(commentlon);
                });
            }
        </script>
       <div>
    {{Form::submit('Report Incident', ['class'=>'btn btn-danger'])}}
    {!! Form::close() !!}
       </div>
@endsection