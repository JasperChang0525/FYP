@extends('layouts.app')

@section('zon')
<div id="map"></div>

    <style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 60%;
      width: 80%;
      margin: inherit;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: auto;
      padding: auto;
    }
    </style>

    <script>
        function initMap() {
            var options ={
            center: {lat: 2.9292, lng: 101.7771},
            zoom: 15
        }
        var map = new google.maps.Map(document.getElementById('map'),options);
        var marker = new google.maps.Marker({
                position:{lat: 2.9292, lng: 101.7771},
                draggable: true,
                map: map
                });
        google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('lat').value =event.latLng.lat();
        document.getElementById('lng').value =event.latLng.lng();
        
	 });        
        

        }
  
    </script>

    <script async defer 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIw269bXf_I8SJmtTRlxs6GqvfEdKKo1I&callback=initMap">
</script>
<br>
<div class ="container">
    {{Form::open(['action' => 'ZonController@addcheckpointlist', 'method' => 'POST'])}}
    <div class="form-group">
        <label for="checkpoint_name">Checkpoint Name</label>
        <input type="text" class="form-control input-sm" id="checkpoint" name="checkpoint">
    </div>

    <div class="form-group">
        <label for=""> Latitude </label>
        <input type="text" class="form-control input-sm" name="lat" id="lat">
    </div>

    <div class="form-group">
	    <label for=""> Longitude </label>
	    <input type="text" class="form-control input-sm" name="lng" id="lng">
    </div>
    
        <button type="submit" class="btn btn-danger">Save Checkpoint</button>
    {{Form::close()}}
</div>
@endsection