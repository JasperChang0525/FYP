@extends('layouts.app')

@section('content')
    
@foreach ($save as $item)
<div class="well">
    <a href="/admin/{{$item->id}}/{{$item->zonlist_id}}">Schedule {{$item->id}}</a>
</div>
@endforeach

@endsection