@extends('layouts.app')

@section('content')
{{Form::open(['action' => 'ZonController@createzonlist', 'method' => 'POST'])}}
{{Form::submit("Create New Zon List", ['class' => 'btn btn-info'])}}
{{Form::close()}}
    @if (count($zonlist) > 0)
        @foreach ($zonlist as $zonlistlist)
            <h2>
                <div class="well">
                    {{-- <h2>{{$zonlistlist->zonlist_id}}</h2> --}}
                    <a href="/zonlist/{{$zonlistlist->zonlist_id}}/{{$zonlistlist->zon_ukm}}"><h3>{{$zonlistlist->zon_ukm}}</h3></a>
                </div>
            </h2>
        @endforeach
    @else
    No current zonlist
    @endif

@endsection