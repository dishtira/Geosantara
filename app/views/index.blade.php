@extends('template/BaseTemplate')

@section('content')
    @if($clue == "")
        <div class="form-group">
            <label>
                There is no clue yet.
            </label>
        </div>
    @else
        <div class="row">
            <div class="col-md-8" id="map-canvas" style="min-height:400px;" >
            </div>

            <div class="col-md-4">
                <form action="" method="">
                    <div class="form-group @if ($errors->has('clue')) has-error @endif">
                        <label>Clue</label>
                        <input type="hidden" name="clue" value=""/>
                        <textarea class="form-control" placeholder="Clue" value="Clue here" disabled="" rows="10" >{{ $clue->Clue }}</textarea>
                        @if ($errors->has('clue'))<label class="control-label" for="inputError">Clue must be filled</label> @endif
                    </div>
                    <div class="form-group @if ($errors->has('answer')) has-error @endif">
                        <label>Answer</label>
                        <textarea class="form-control" name="answer" id="answer" placeholder="Answer here..." disabled="" rows="3" value="{{ (Input::old('answer')) ? e(Input::old('answer')) : '' }}"></textarea>
                        @if ($errors->has('answer'))<label class="control-label" for="inputError">Answer must be filled</label> @endif
                    </div>
                    <div class="form-group">
                        <a href="{{ URL::route('showGame') }}"><input type="button" class="btn btn-md btn-danger" value="Next Question"></input></a>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <!-- modal -->
        <div class="modal fade" data-backdrop="false">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal title</h4>
              </div>
              <div class="modal-body">
                <p>One fine body…</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
@stop

@section('javascript')
    <script src="https://maps.googleapis.com/maps/api/js?v=3.expAIzaSyCbR7YPb7GX1sl7WQ_yCJqpy79HvupbmZM"></script>
    <script>
var map;
var data = <?= json_encode($clue->ClueID) ?>;

function showDialog(message)
{
    var res;
    var messageShow = "";
    var label = "";
    if (message == "success")
    {
       res = BootstrapDialog.TYPE_SUCCESS;
       messageShow = "Congratulation, your answer is right!";
       label = "Next Question";
    }
    else if (message == "failed")
    {
        res = BootstrapDialog.TYPE_DANGER;
        messageShow = "Sorry, wrong answer";
        label = "Ok";
    }

  BootstrapDialog.show({
    type : res,
    title : 'Result',
        message: messageShow,
        buttons : [{
          label : label,
          action : function(dialogItself)
          {
            if(message == "success")
            {
                window.location="{{ URL::route('showGame') }}";
            }
            dialogItself.close();
          }
        }]
    });
}

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
              //console.log(results[1]);
              var stringDisplay = "";
              var answerShow = results[1].address_components[2].long_name+", "+ results[1].address_components[3].long_name;

              //put answer to textarea
              document.getElementById("answer").innerHTML += answerShow+"\n";

              for (var i = 0; i < results[1].address_components.length; i++){
                //console.log(results[1].address_components[i].long_name);
                stringDisplay += results[1].address_components[i].long_name + ", ";
              }
              if (stringDisplay.length > 2){
                stringDisplay = stringDisplay.substring(0, stringDisplay.length - 2);
                
                $.post("{{URL::to('checkAnswer')}}",{dataSend:data, answerSend:answerShow}, function(res){
                  console.log("result "+res);
                  showDialog(res);
                });

                // Check answer (if exists)
                //if (stringDisplay.toLowerCase().indexOf(answer.toLowerCase()) != -1)
                //    isCOrrectAnswer = true;
            }
              //infowindow.setContent(results[1].formatted_address);
              infowindow.setContent(stringDisplay);
              infowindow.open(map, marker);
              
              // if (isCOrrectAnswer) alert("Congratulation! Your answer is correct!");
              // else alert ("Wrong answer!");
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