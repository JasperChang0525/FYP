<style>
.round-button {
    display:block;
    width:80px;
    height:80px;
    line-height:80px;
    border: 2px solid #f5f5f5;
    border-radius: 50%;
    color:#f5f5f5;
    text-align:center;
    text-decoration:none;
    background: #FF0000;
    box-shadow: 0 0 3px gray;
    font-size:20px;
    font-weight:bold;
}
.round-button:hover {
    background: #777555;
}
    </style>

@extends('layouts.app')

@section('content')
    <div class="button">
        {{Form::open(['action' => 'PatrolController@savesos', 'method' => 'POST'])}}
            <input type="hidden" id='lat' name="lat">
            <input type="hidden" id='lng' name="lng">
            <script>
                if(navigator.geolocation)
                {
                    navigator.geolocation.getCurrentPosition(function(position)
                        {
                                var lat = position.coords.latitude;
                                var lng = position.coords.longitude;
                                document.getElementById('lat').value = lat
                                console.log(document.getElementById('lat').value);
                                document.getElementById('lng').value = lng;
                                console.log(document.getElementById('lng').value);
                            })
                }
            </script>
            {{Form::submit('SOS', ['class' => 'round-button'])}}
        {{Form::close()}}
    </div>
@endsection