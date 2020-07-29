@extends('layouts.app')

@section('zon')

<div class=container>
<h1>My Google Map</h1>
</div>
{{--  --}}
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
<script async defer 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIw269bXf_I8SJmtTRlxs6GqvfEdKKo1I&callback=initMap&libraries=geometry"
></script>

<script>
  let checkinchecker = 0;
  var mapsarray = [];
  if(navigator.geolocation)
  {
    var options ={
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    }
    function error(err) {
      console.warn(`ERROR(${err.code}): ${err.message}`);
    }
      navigator.geolocation.getCurrentPosition(function(position)
      {
        
        var zonlat = position.coords.latitude;
        var zonlng = position.coords.longitude;
        document.getElementById('zonlat').value = zonlat
        document.getElementById('zonlng').value = zonlng;
        policelocation = new google.maps.LatLng(zonlat,zonlng);
        console.log(policelocation);
        poi = new google.maps.LatLng(testlat,testlon);
        var computed = google.maps.geometry.spherical.computeDistanceBetween(poi, policelocation);
        
        console.log(computed);
        checkinchecker = computed;
        document.getElementById('distance').value = computed;
        document.getElementById('computedcounter').value = computed;
        if(computed > 5)
        {
          alert("you are too far from the point" + checkinchecker + "meter");
        }
      },error,options);

  }
    // var computed = google.maps.geometry.spherical.computeDistanceBetween(poi, policelocation);
    // console.log(computed); 
  // document.getElementById('distance').value = computed;
  
  // console.log("hi"+ computed);
  // console.log(computed);
</script>
@foreach ($zons as $zonlist)
    <script>
      var testlat = parseFloat({{$zonlist->lat}});
      var testlon = parseFloat({{$zonlist->lng}});
      array = [
        parseFloat({{$zonlist->lat}}) ,parseFloat({{$zonlist->lng}})
      ];
      mapsarray.push(array);
    </script>
@endforeach
<script>
  function initMap() {
    // console.log(testlat);
    let poi = new google.maps.LatLng(testlat,testlon);
    console.log(poi);
    let policelocation;

    var map = new google.maps.Map(document.getElementById('map'), {
        center: poi,
        zoom: 15
      });
      function addMarker(props)
      {
        marker = new google.maps.Marker({
          position:props.coords,
          map:map,
          icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
        });
      }

      for (let i = 0; i < mapsarray.length; i++) { 
        // console.log(i);   
        addMarker({ 
          coords: {lat:mapsarray[i][0], lng:mapsarray[i][1]}
          });
      }

      
  //Display a map on the web page
   }

</script>


<script>

</script>
<br>

<div class="container">
<h3>Location</h3>
<table class="table table-bordered">
  <tr>
    <th>Checkpoint</th>
    <th>Latitude</th>
    <th>Longitude</th>
    <th>Check-in</th>
  </tr>

  @foreach ($zons as $zon)
 
  <tr>
    <td>{{$zon->checkpoint}}</td>
    <td>{{$zon->lat}}</td>
    <td>{{$zon->lng}}</td>

    @php
        $counter;
    @endphp
    <script>
      var user;
      
    </script>
    {{-- {{$counter}} --}}
    {{Form::open(['action' => ['PatrolController@checkin',$id,$zon->zonlist_id,$police_id], 'method' => 'POST'])}}
    <td>

        

      <input type="text" id="distance" name="distance">
      <input type="hidden" id="zonlat" name="zonlat">
      <input type="hidden" id="zonlng" name="zonlng">
      <input type="hidden" name='computedcounter' id="computedcounter">
        {{-- @if ($counter == $checker) --}}
      <button type="submit" onclick="checkinchecker()">Check in</button>
      
      
        {{-- @endif --}}
    </td>
    {{Form::close()}}  
  </div>
  </tr>
@endforeach
{{$zons->render()}}

@endsection