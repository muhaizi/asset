@extends('layouts.app')

@section('content')
<style>
    #myMap {
       height: 350px;
       width: 680px;
    }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Halaman Utama</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asset.index') }}">Senarai Aset</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('asset.show', $asset->id) }}">Maklumat Aset</a></li>
                    <li class="breadcrumb-item active">Maklumat Asas</li>
                  </ol>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __('Paparan Aset') }}
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Maklumat Aset
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Asas</a>
                              <a class="dropdown-item" href="#">Kos</a>
                              <a class="dropdown-item" href="#">Status</a>
                              <a class="dropdown-item" href="#">Tanah</a>
                              <a class="dropdown-item" href="#">Gambar & Fail</a>
                            </div>
                          </div>
                    </div>
                    <div class="card-body">
                          <div class="form-row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationDefault01">Map</label>
                                    <div class="input-group mb-3">
                                        <div id="myMap"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationDefault01">Premise</label>
                                    <div class="input-group mb-3">
                                        <textarea id="address" name="address" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="validationDefault02">Latitude & Longtitude</label>
                                    <div class="input-group mb-3">
                                        
                                        <input type="text" disabled id="latitude" class="form-control" placeholder="Latitude"/>
                                        <input type="text" disabled id="longitude" class="form-control" placeholder="Longitude"/>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end align-items-center">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyC6giq0pKdAaX7wM2TSQy6zqYKfBZZeOxo"></script>
<script type="text/javascript">
       var map;
            var marker;
            var myLatlng = new google.maps.LatLng({{ $map->lat}}, {{ $map->lng}});
            var geocoder = new google.maps.Geocoder();
            var infowindow = new google.maps.InfoWindow();
            function initialize(){
                var mapOptions = {
                    zoom: 18,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };

                map = new google.maps.Map(document.getElementById("myMap"), mapOptions);

                marker = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true
                });

                geocoder.geocode({'latLng': myLatlng }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#address').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });


                google.maps.event.addListener(marker, 'dragend', function() {

                geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#address').val(results[0].formatted_address);
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        }
                    }
                });
            });

            }

            google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection
    