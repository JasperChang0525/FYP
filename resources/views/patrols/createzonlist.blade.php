@extends('layouts.app')

@section('content')
@if (count($zon) > 0)
<table class="table table-bordered">
    <tr>
        <th>Checkpoint</th>
        <th></th>
    </tr>
        @foreach ($zon as $zonlist)
        <tr>
        <td>
            {{$zonlist->checkpoint}}
        </td>
        <td>
            {{Form::open(['action' => ['ZonController@destroy',$zonlist->zonlist_id,$zonlist->zon_ukm,$zonlist->id], 'method' => 'POST'])}}
            <input type="hidden" id="checkpointid" value="{{$zonlist->id}}">
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {{Form::close()}}
        </td>
        </tr>
    @endforeach
    @else
    No checkpoint
    @endif
    
</table>

<a href="/zonlist/addcheckpoint" class="btn btn-success">Add Checkpoint</a>
@endsection

