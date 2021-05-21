@extends('layouts.admin')
@section('content')
  <style>
    .input-group-prepend{width:35%;}
    .input-group-text{width:100%;}
    .darkblue{background-color:darkblue;color:white}
  </style>
  <div class="content-wrapper" style="min-height: 1416.81px;">
    <div class="container bg-gradient-white card-body">
      <!-- Default form subscription -->
      <form class="text-center border border-light card  p-5 m-auto" method="POST" style="width:50%" action="{{route('admin.vendors.store')}}" enctype="multipart/form-data">
        @csrf
        <p style="text-align: left">
          <a href="{{route('admin.vendors')}}" target="_self"><i class="fa fa-angle-left "></i> Back</a>
        </p>
        <p class="h4 mb-4 p-2 card bg-blue">Add New Vendor</p>
        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Name</span>
            </div>
            <input type="text" name="name" id="defaultSubscriptionFormPassword" class="form-control">
          </div>
          @error('name')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>
        <!-- Name -->
        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Mobile Number</span>
            </div>
            <input type="text" name="mobile" id="defaultSubscriptionFormPassword" class="form-control">
          </div>
          @error('mobile')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">E-mail </span>
            </div>
            <input type="text" name="email" id="defaultSubscriptionFormPassword" class="form-control">
          </div>
          @error('email')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Main Category</span>
            </div>
              @if($categories&&$categories->count()>0)
                  <select name="category_id" class="select2 form-control">
                @foreach($categories as $category)
              <option class="text-bold " value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
                  </select>
              @endif
              @if($categories&&$categories->count()<=0)<select  name="category_id" class="select2 form-control"><option value="-1">No Categories To Show</option></select> @endif
          </div>
          @error('category_id')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Status</span>
            </div>
            <div class="p-1 pl-5" >
              <div class="switchToggle">
                <input name="status" value="1" type="checkbox" id="switch" hidden>
                <label for="switch">Toggle</label>
              </div>
            </div>
          </div>
          @error('status')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="inputGroupFile01" name="logo"
                       aria-describedby="inputGroupFileAddon01">
                <label class="custom-file-label text-left" for="inputGroupFile01" >Upload Vendor Logo</label>
              </div>
            </div>
          </div>
          @error('logo')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>

        <div class="mb-4">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text bg-blue" id="inputGroup-sizing-default">Address </span>
            </div>
            <input type="text" name="address" id="pac-input" class="form-control">
          </div>
          @error('address')
          <span class="card bg-red mt-1" role="alert">
            <strong>{{$message}}</strong>
          </span>
          @enderror
        </div>
        <div id="map" style="width: 100%;height: 350px"></div>
        <!-- Sign in button -->
        <button class="btn btn-success btn-block mt-2" type="submit">Save Changes</button>


      </form>
      <!-- Default form subscription -->  </div>
  </div>

  <script>
      $("#pac-input").focusin(function() {
          $(this).val('');
      });
      $('#latitude').val('');
      $('#longitude').val('');
      // This example adds a search box to a map, using the Google Place Autocomplete
      // feature. People can enter geographical searches. The search box will return a
      // pick list containing a mix of places and predicted search terms.
      // This example requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      function initAutocomplete() {
          var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: 24.740691, lng: 46.6528521 },
              zoom: 13,
              mapTypeId: 'roadmap'
          });
          // move pin and current location
          infoWindow = new google.maps.InfoWindow;
          geocoder = new google.maps.Geocoder();
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function(position) {
                  var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                  };
                  map.setCenter(pos);
                  var marker = new google.maps.Marker({
                      position: new google.maps.LatLng(pos),
                      map: map,
                      title: 'موقعك الحالي'
                  });
                  markers.push(marker);
                  marker.addListener('click', function() {
                      geocodeLatLng(geocoder, map, infoWindow,marker);
                  });
                  // to get current position address on load
                  google.maps.event.trigger(marker, 'click');
              }, function() {
                  handleLocationError(true, infoWindow, map.getCenter());
              });
          } else {
              // Browser doesn't support Geolocation
              console.log('dsdsdsdsddsd');
              handleLocationError(false, infoWindow, map.getCenter());
          }
          var geocoder = new google.maps.Geocoder();
          google.maps.event.addListener(map, 'click', function(event) {
              SelectedLatLng = event.latLng;
              geocoder.geocode({
                  'latLng': event.latLng
              }, function(results, status) {
                  if (status == google.maps.GeocoderStatus.OK) {
                      if (results[0]) {
                          deleteMarkers();
                          addMarkerRunTime(event.latLng);
                          SelectedLocation = results[0].formatted_address;
                          console.log( results[0].formatted_address);
                          splitLatLng(String(event.latLng));
                          $("#pac-input").val(results[0].formatted_address);
                      }
                  }
              });
          });
          function geocodeLatLng(geocoder, map, infowindow,markerCurrent) {
              var latlng = {lat: markerCurrent.position.lat(), lng: markerCurrent.position.lng()};
              /* $('#branch-latLng').val("("+markerCurrent.position.lat() +","+markerCurrent.position.lng()+")");*/
              $('#latitude').val(markerCurrent.position.lat());
              $('#longitude').val(markerCurrent.position.lng());
              geocoder.geocode({'location': latlng}, function(results, status) {
                  if (status === 'OK') {
                      if (results[0]) {
                          map.setZoom(8);
                          var marker = new google.maps.Marker({
                              position: latlng,
                              map: map
                          });
                          markers.push(marker);
                          infowindow.setContent(results[0].formatted_address);
                          SelectedLocation = results[0].formatted_address;
                          $("#pac-input").val(results[0].formatted_address);
                          infowindow.open(map, marker);
                      } else {
                          window.alert('No results found');
                      }
                  } else {
                      window.alert('Geocoder failed due to: ' + status);
                  }
              });
              SelectedLatLng =(markerCurrent.position.lat(),markerCurrent.position.lng());
          }
          function addMarkerRunTime(location) {
              var marker = new google.maps.Marker({
                  position: location,
                  map: map
              });
              markers.push(marker);
          }
          function setMapOnAll(map) {
              for (var i = 0; i < markers.length; i++) {
                  markers[i].setMap(map);
              }
          }
          function clearMarkers() {
              setMapOnAll(null);
          }
          function deleteMarkers() {
              clearMarkers();
              markers = [];
          }
          // Create the search box and link it to the UI element.
          var input = document.getElementById('pac-input');
          $("#pac-input").val("أبحث هنا ");
          var searchBox = new google.maps.places.SearchBox(input);
          map.controls[google.maps.ControlPosition.TOP_RIGHT].push(input);
          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
              searchBox.setBounds(map.getBounds());
          });
          var markers = [];
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
              var places = searchBox.getPlaces();
              if (places.length == 0) {
                  return;
              }
              // Clear out the old markers.
              markers.forEach(function(marker) {
                  marker.setMap(null);
              });
              markers = [];
              // For each place, get the icon, name and location.
              var bounds = new google.maps.LatLngBounds();
              places.forEach(function(place) {
                  if (!place.geometry) {
                      console.log("Returned place contains no geometry");
                      return;
                  }
                  var icon = {
                      url: place.icon,
                      size: new google.maps.Size(100, 100),
                      origin: new google.maps.Point(0, 0),
                      anchor: new google.maps.Point(17, 34),
                      scaledSize: new google.maps.Size(25, 25)
                  };
                  // Create a marker for each place.
                  markers.push(new google.maps.Marker({
                      map: map,
                      icon: icon,
                      title: place.name,
                      position: place.geometry.location
                  }));
                  $('#latitude').val(place.geometry.location.lat());
                  $('#longitude').val(place.geometry.location.lng());
                  if (place.geometry.viewport) {
                      // Only geocodes have viewport.
                      bounds.union(place.geometry.viewport);
                  } else {
                      bounds.extend(place.geometry.location);
                  }
              });
              map.fitBounds(bounds);
          });
      }
      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
          infoWindow.setPosition(pos);
          infoWindow.setContent(browserHasGeolocation ?
              'Error: The Geolocation service failed.' :
              'Error: Your browser doesn\'t support geolocation.');
          infoWindow.open(map);
      }
      function splitLatLng(latLng){
          var newString = latLng.substring(0, latLng.length-1);
          var newString2 = newString.substring(1);
          var trainindIdArray = newString2.split(',');
          var lat = trainindIdArray[0];
          var Lng  = trainindIdArray[1];
          $("#latitude").val(lat);
          $("#longitude").val(Lng);
      }
  </script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoO4DZKtIVcM8BSMSDTxUwfVRQrMDDmvs&libraries=places&callback=initAutocomplete&language=en&region=EG
         async defer"></script>
@endsection

