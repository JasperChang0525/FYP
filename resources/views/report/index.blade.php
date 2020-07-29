@extends('layouts.app')

@section('content')
    
@foreach ($user as $item)
<div class="well">
    <a href="/admin/report/{{$item->id}}">{{$item->name}}</a>

</div>
@endforeach

@endsection