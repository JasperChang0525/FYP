@extends('layouts.app')


@section('zon')
<div id="map"></div>
<style>
    /* Always set the map height explicitly to define the size of the div
     * element that contains the map. */
    #map {
      height: 100%;
      width: 100%;
    }
    /* Optional: Makes the sample page fill the window. */
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
    }
  </style>
  <script>
    var mapsarray = [];
    var shiftarray = [];
  </script>
  @foreach ($zons as $zonlist)
      <script>
        var lat = parseFloat({{$zonlist->lat}});
        var lon = parseFloat({{$zonlist->lng}});
        var time = {{$zonlist->created_at->format('y-m-d')}};
        array = [
          parseFloat({{$zonlist->lat}}) ,parseFloat({{$zonlist->lng}}),
        ];
        mapsarray.push(array);
      </script>
  @endforeach

    @foreach ($shift as $shiftlist)
        <script>
            var sllat = parseFloat({{$shiftlist->lat}});
            var sllon = parseFloat({{$shiftlist->lng}});
            array = [
            parseFloat({{$shiftlist->lat}}) ,parseFloat({{$shiftlist->lng}}), "{{$shiftlist->created_at}}",
            ];
            shiftarray.push(array);
        </script>
    @endforeach
  <script>
  
 
  
    function initMap() {
      var poi = new google.maps.LatLng(lat,lon);
      var map = new google.maps.Map(document.getElementById('map'), {
          center: poi,
          zoom: 15
        });
        function addMarker(props)
        {
          marker = new google.maps.Marker({
            position:props.coords,
            map:map,
            icon: props.color,
          });
          marker['infowindow'] = new google.maps.InfoWindow({
              content: props.content,
          });
          
          google.maps.event.addListener(marker, 'mouseover', function()
            {
                this['infowindow'].open(map, this); 
            });

        }
        function policeMarker(props)
        {
          marker = new google.maps.Marker({
            position:props.coords,
            map:map,
            icon: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",
          });
          marker['infowindow'] = new google.maps.InfoWindow({
              content: props.content,
          });
          
          google.maps.event.addListener(marker, 'mouseover', function()
            {
                this['infowindow'].open(map, this); 
            });
       }
  
        for (let i = 0; i < mapsarray.length; i++) { 
          console.log(mapsarray);  

          addMarker({ 
            coords: {lat:mapsarray[i][0], lng:mapsarray[i][1]},
            content : "" + (i+1) ,
            color: "http://maps.google.com/mapfiles/ms/icons/green-dot.png",    
        });
            var circle = new google.maps.Circle({
            map: map,
            strokeColor: "#000000",
            center: {lat: mapsarray[i][0], lng: mapsarray[i][1]},
            fillColor: "#00FF00",
            radius: 10,
        });
          
        }

        for (let i = 0; i < shiftarray.length; i++) { 
          // console.log(i);   
          policeMarker({ 
            coords: {lat:shiftarray[i][0], lng:shiftarray[i][1]},
            content: shiftarray[i][2],   
        });
        }
    //Display a map on the web page
     }
  
  </script>
  
  
  <script async defer 
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAIw269bXf_I8SJmtTRlxs6GqvfEdKKo1I&callback=initMap&libraries=geometry"
      ></script>
@endsection

