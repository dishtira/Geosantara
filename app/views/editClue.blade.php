@extends('template/BaseTemplate')

@section('content')
<div class="col-md-8" style="min-height:400px;" id="map-canvas" style="margin-right:5px;">
    
</div>

<div class="col-md-4">
	<form action="{{ URL::route('postEditClue') }}" method="post" >
		<div class="form-group @if ($errors->has('clueID')) has-error @endif">
            <label>Clue ID</label>
            <input type="hidden" name="clueID" value="{{ (Input::old('clueID')) ? e(Input::old('clueID')) : $clue->ClueID }}"/>
            <input class="form-control" placeholder="ClueID" value="{{ (Input::old('clueID')) ? e(Input::old('clueID')) : $clue->ClueID }}" disabled="" />
            @if ($errors->has('clueID'))<label class="control-label" for="inputError">ClueID must be filled</label> @endif
        </div>
        <div class="form-group @if ($errors->has('clue')) has-error @endif">
            <label>Clue</label>
            <textarea class="form-control" placeholder="Clue" name="clue" >{{ (Input::old('clue')) ? e(Input::old('clue')) : $clue->Clue }}</textarea>
            @if ($errors->has('clue'))<label class="control-label" for="inputError">Clue must be filled</label> @endif
        </div>
        <div class="form-group @if ($errors->has('answer')) has-error @endif">
            <label>Answer</label>
            <textarea class="form-control" id="answer" placeholder="Answer" name="answer">{{ (Input::old('answer')) ? e(Input::old('answer')) : $clue->Answer }}</textarea>
            @if ($errors->has('answer'))<label class="control-label" for="inputError">Answer must be filled</label> @endif
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-success" value="Submit"></input>
            <input type="reset" class="btn btn-md btn-danger" value="Reset"></input>
        </div>
	</form>
</div>
@stop

@section('javascript')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.expAIzaSyCbR7YPb7GX1sl7WQ_yCJqpy79HvupbmZM"></script>
    <script>
var map;

function initialize() {
    var initLang = -0.166384;
    var initLng = 117.704118;
    var initZoom = 4;
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
              var answerShow = results[1].address_components[2].long_name+", "+ results[1].address_components[3].long_name;

              //put answer to textarea
              document.getElementById("answer").innerHTML = answerShow;

            for (var i = 0; i < results[1].address_components.length; i++){
                console.log(results[1].address_components[i].long_name);
                stringDisplay += results[1].address_components[i].long_name + ", ";
            }
            if (stringDisplay.length > 2){
                    stringDisplay = stringDisplay.substring(0, stringDisplay.length - 2);
            }
              //infowindow.setContent(results[1].formatted_address);
              infowindow.setContent(stringDisplay);
              infowindow.open(map, marker);
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