@extends('template/BaseTemplate')

@section('content')
<div id="map-canvas" class="col-md-3" style="min-height:400px;">
	asd
</div>
@stop

@section('javascript')
	<script src="https://maps.googleapis.com/maps/api/js?v=3.expAIzaSyCbR7YPb7GX1sl7WQ_yCJqpy79HvupbmZM"></script>
    <script>
var map;
var answer = "south duri";

function initialize() {
	var initLang = -0.166384;
	var initLng = 117.704118;
	var initZoom = 5;
  var mapOptions = {
    zoom: initZoom,
    center: new google.maps.LatLng(initLang, initLng)
  };
  geocoder = new google.maps.Geocoder();
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
	  
	  google.maps.event.addListener(map, 'click', function(event){
		var isCOrrectAnswer = false;
		//alert('Latitude: ' + event.latLng.lat() + ' ' + ', Longitude: ' + event.latLng.lng());   
		//marker = new google.maps.Marker({position: event.latLng, map: map});
		//alert("outside");
		geocoder.geocode({'latLng': event.latLng}, function(results, status) {
			//alert("inside");
		  if (status == google.maps.GeocoderStatus.OK) {
			//alert("Geocoder");
			if (results[1]) {
				//alert("inside if");
			  map.setZoom(11);
			  //alert("after if, before marker");
			  marker = new google.maps.Marker({
				  position: event.latLng,
				  map: map
			  });
			  //alert("after marker");
			  var infowindow = new google.maps.InfoWindow();
			  console.log(results[1]);
			  var stringDisplay = "";
			  for (var i = 0; i < results[1].address_components.length; i++){
				console.log(results[1].address_components[i].long_name);
				stringDisplay += results[1].address_components[i].long_name + ", ";
			  }
			  if (stringDisplay.length > 2){
				stringDisplay = stringDisplay.substring(0, stringDisplay.length - 2);
				
				// Check answer (if exists)
				console.log("asd "+stringDisplay);
				console.log("qwe "+stringDisplay.toLowerCase().indexOf("gambir, central jakarta"));
				if (stringDisplay.toLowerCase().indexOf(answer.toLowerCase()) != -1)
					isCOrrectAnswer = true;
			}
			  //infowindow.setContent(results[1].formatted_address);
			  infowindow.setContent(stringDisplay);
			  infowindow.open(map, marker);
			  
			  if (isCOrrectAnswer) alert("Congratulation! Your answer is correct!");
			  else alert ("Wrong answer!");
			}
		  } else {
			alert("Geocoder failed due to: " + status);
		  }
		});
	});
}

	google.maps.event.addDomListener(window, 'load', initialize);

	var update_timeout = null;

	

    </script>

@stop