@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search Restaurants</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($errors->any())
                     <div class="alert alert-warning" role="alert">
                        <h4>{{$errors->first()}}</h4>
                     </div>
                    @endif
                    <form method="post" action="/restaurants.search"  enctype="multipart/form-data">
                     @csrf    
                      <div class="form-group form-row" >
                        <label for="name" class="col-sm-3">Enter Your Location 
                        <span class="text-danger">*</span></label>
                        <select class="js-example-basic-single form-control col-sm-8" name="location">
                          <option value="HSR">HSR Layout</option>
                          <option value="ELE">Electronic City</option>
                          <option value="BTM">BTM Layout</option>
                          <option value="WF">White Field</option>
                        </select>
                        <br /><br />
                        <center>
                            <small>
                                <span>Searches restaurants within radius of 5 kms</span>
                            </small>
                        </center>
                      </div>
                      <center>
                          <button type="submit" class="btn btn-secondary">Search</button>
                      </center>
                    </form>
                    <br />
                    <input type="hidden" id="app_url" name="app_url" value="{{env('APP_URL')}}">
                    <div id="mymap"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<!-- Maps dependencies -->
<script src="https://maps.google.com/maps/api/js?key=AIzaSyDEVXKfRMEFhUAPbDInG9dTTvYlPpRCsg0&libraries=places" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gmaps.js/0.4.24/gmaps.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
    var app_url = $('#app_url').val();

    /* Geo Location */
    if( navigator.geolocation ){
       navigator.geolocation.getCurrentPosition( success );
    }
    else{
       alert("Sorry, your browser does not support geolocation services.");
    }
    function success(position){
        
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
         var mymap = new GMaps({
            el: '#mymap',
            lat: 12.9716,
            lng: 77.5946,
            zoom:11
         });
         $.ajax({
            url: '/restaurants.search',
            type: "POST",
            data: {_token: CSRF_TOKEN, ajax:true, lat: position.coords.latitude, lon: position.coords.longitude},
            dataType: 'JSON',
            success: function(data){
                var locations = data.restaurants;
                $.each( locations, function( index, value ){
                  var restaurant_details = '';
                  restaurant_details = 'Name:'+value.name+' Description:'+value.name;
                  /* Adding marker in Maps */
                  mymap.addMarker({
                    lat: value.lat,
                    lng: value.lon,
                    title: restaurant_details,
                    click: function(e) {
                      window.open(app_url+'/restaurant.details?restaurant_id='+value.id, '_blank');
                    }
                  });
                  /* End of adding marker */
               });
            },
            error: function (error) {
                alert('Auto detecting of restaurants failed. Please use manual search');  
            }
        });

        /* Event Listner for cursor movement in Map*/
        mymap.addListener("center_changed", function() {
          // 1.5 seconds after the center of the map has changed, 
          window.setTimeout(function() {
               var latitude = mymap.getCenter().lat();
               var longitude = mymap.getCenter().lng();
               
               mymap.removeMarkers();
               $.ajax({
                  url: '/restaurants.search',
                  type: "POST",
                  data: {_token: CSRF_TOKEN, ajax:true, lat: latitude, lon: longitude},
                  dataType: 'JSON',
                  success: function(data){
                      var locations = data.restaurants;                       
                      $.each( locations, function( index, value ){
                        var restaurant_details = '';
                        restaurant_details = 'Name:'+value.name+' Description:'+value.name;

                        mymap.addMarker({
                          lat: value.lat,
                          lng: value.lon,
                          title: restaurant_details,
                          click: function(e) {
                            window.open(app_url+'/restaurant.details?restaurant_id='+value.id, '_blank');
                          }
                        });
                     });
                  },
                  error: function (error) {
                      alert('Auto detecting of restaurants failed. Please use manual search');  
                  }
              });
          }, 1500);
        });
        /*End of Event Listner for cursor movement in Map*/
     }    
</script>
@endsection
