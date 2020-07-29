@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <tr>
            <th>
                Police in Charge
            </th>
            <th>
                Zon UKM 
            </th>
            <th>
                Starting time
            </th>
            <th></th>
        </tr>
        @foreach ($saveshift as $list)
            <tr>
                <td>
                    {{$list->police_id}}
                </td>
                <td>
                    {{$list->zonlist_id}}
                </td>
                <td>
                    {{$list->start_shift}}
                </td>
                <td>
                    {{-- {{Form::open(['action' => ['PatrolController@zon',$list->id, $list->zonlist_id, $list->police_id], 'method' => 'Post'])}}
                    
                    {{Form::submit('View Schedule', ['class' => 'btn btn-info'])}}
                    {{Form::close}} --}}
                    <a href="/zon/{{$list->id}}/{{$list->zonlist_id}}/{{$list->police_id}}">View Routing</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection