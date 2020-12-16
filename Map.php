<html>
    <head>
        <title>Amazing Guided Tours</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--Bootstrap-->
        <!--Bootstrap css stylesheet-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link href="Css/Guidedtour.css" rel="stylesheet">
        <!--Bootstrap jquery popper.js Bootstrap js -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        
        <!--Icons fontawasome-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        
        <!--Leaflet-->
         <!-- Load Leaflet css -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <!-- Load Leaflet css end -->
    
        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    </head>

    <body>
        <div class="menuarea">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <a class="navbar-brand" href="home.php">AmGdTr</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="Map.php">Map</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Index.php">Sign In <span class="sr-only">(current)</span></a>
                        </li
                        <li class="nav-item">
                            <a class="nav-link" href="CreateAccount.php">Create Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="About.php">About</a>
                        </li>
                    </ul>
                    <!--form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="text" placeholder="Search POI" aria-label="Search">
                      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form-->
                </div>
            </nav>
        </div>
      
        <div id="container">
            <div id="mapid"></div>
            <!-- ---------------------------------------------------------------------------------------------------------------------------- -->
             <!--Connect to database and retrieve pois-->
                <?php
                    //Connect to database
                    include 'Scripts/DbConnection.php';
                    //Results array
                    $poiRecords = array();
                    //Get all pois from data base
                    $qrNearByPois = "SELECT * FROM pointsofinterest";
                    $qrNearPoisRes = mysqli_query($conn, $qrNearByPois);
                    $qrNearPoisRCount = mysqli_num_rows($qrNearPoisRes);
                    //Fiil array with records
                    if ($qrNearPoisRCount != 0){
                        while($row = mysqli_fetch_assoc($qrNearPoisRes)){
                            $poiRecords[] = $row;
                        }
                    }
                    //Close connection
                    mysqli_close($conn);
                ?>
              <!-- ---------------------------------------------------------------------------------------------------------------------------- -->
            <script>
                // Access the elements of the php return array
	            var jsPoiRecords = <?php echo json_encode($poiRecords); ?>;
                //Global variables
                var map = L.map('mapid').fitWorld();
                var position, radius, addedmarker;
                
                //Map added to page
                $(function(){

                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 18,
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11',
                    tileSize: 512,
                    zoomOffset: -1
                }).addTo(map);
                     //Creating a group of markers
                    //savedMarkers = new L.LayerGroup();
                    //call the function that adds the markers on map
                    //addMarkers(); 
                    
                });
                
                //if found location
                function onLocationFound(e) {
                    //Setting radius
                    radius = e.accuracy / 2;
                    //Position
                    L.marker(e.latlng).addTo(map).bindPopup("Your current position is" + radius + " meters away to this point").openPopup();
                    position = e.latlng;
                    //Range of position
                    curRange = L.circle(e.latlng, radius).addTo(map);
                    //Creating a group of markers
                    savedMarkers = new L.LayerGroup();
                    //call the function that adds the markers on map
                    addMarkers(); 
                    
                }
                
                //If location not fount
                function onLocationError(e) {
                    alert(e.message);
                }
                
                //Add markers function
                function addMarkers(){ 
                    //Iterate array
                    for(var j = 0;  j < jsPoiRecords.length; j++){
                        var obj = jsPoiRecords[j];
                            //Find values
                            for (var key in obj){
                                //var positionLatLong = "{Lat: "+ obj['PoiLatitude'] +", " +"Lng: "+ obj['PoiLongitude'] + "}"; 
                                //console.log(positionLatLong);
                                var locNm = obj['PoiName'];
                                var locAddr= obj['PoiAddress'];
                                var latd = obj['PoiLatitude'];
                                var longd = obj['PoiLongitude'];
                              
                            }
                        
                        //Create popup form with info
                         var popupform = '<h4>Πληροφορίες τοποθεσίας</h3>'+
                                '<form name="locationData" role ="form">'+
                                '<label for="locationNameTxt">Όνομα τοποθεσίας:</label><br>'+
                                '<input type="text" id="locationNameTxt" name="locationNameTxt" value="'+locNm+'"><br>'+
                                '<label for="locationAddressTxt">Διεύθυνση:</label><br>'+
                                '<input type="text" id="locationAddressTxt" name="locationAddressTxt" value="'+locAddr+'"><br>'+
                                '<label for="locationLatitudeTxt">Γεωγραφικό πλάτος:</label><br>'+
                                '<input type="text" id="locationLatitudeTxt" name="locationLatitudeTxt" value="'+latd+'"><br>'+
                                '<label for="locationLongitudeTxt">Γεωγραφικό μήκος:</label><br>'+
                                '<input type="text" id="locationLongitudeTxt" name="locationLongitudeTxt" value="'+longd+'"><br>'+
                                '</form>';
                        
                        //Add create current point latlng
                        var newLatLng = new L.LatLng(latd, longd);
                        //Add currebt marker if in range
                        if (newLatLng.distanceTo(position)<radius){
                            //Add marker to map
                            addedmarker = new L.marker([latd,longd]).addTo(map);
                        
                            //Add the castom popup to marker
                            addedmarker.bindPopup(popupform).openPopup();
                        }
                    }
                }
                
                //Create circle and markers of pois on radious if location found
                map.on('locationfound', onLocationFound);
                //Print error message
                map.on('locationerror', onLocationError);
                //Find current location
                map.locate({setView: true, maxZoom: 18});
                
            </script>
        </div>
    </body>
</html>