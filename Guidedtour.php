<?php
    session_start();
    //Check if customer, guide or driver connected
    //If customer connected
    if ($_SESSION['currentCustomerId']){
        include 'Scripts/GuidedTourCustomer.php'; 
    }
    
    

?>

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
            <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                        </li>
                        <?php if (isset($_SESSION['currentCustomerId'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User Profile</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <form name="frmUserInfo" method="post" action="Scripts/Logout.php" role="form">
                                <h6>Στοιχεία σύνδεσης</h6>
                                <div class="form-group" >
                                    <i class="fa fa-user-circle" aria-hidden="true"></i><label><?php echo $_SESSION['currentCustomerFirstName']." ".$_SESSION['currentCustomerLastName'] ?></label>
                                </div>
                                <div class="form-group" >
                                    <i class="fa fa-address-card" aria-hidden="true"></i><label><?php echo $_SESSION['currentCustomerEmail'] ?></label>
                                </div>
                                <button class="btn btn-block btn-danger" id="btnLogout" type="submit">Έξοδος</button>
                                </form>
                            </div>
                        </li>
                        <?php else: ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User profile</a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <div class="form-group" ><span class="glyphicon glyphicon-user"></span>
                                    <i class="fa fa-user-circle"></i><label><?php echo "Not connected user" ?></label>
                                </div>
                                <div class="form-group" ><span class="glyphicon glyphicon-user"></span>
                                    <a class="dropdown-item" href="CreateAccount.php">Signup</a>
                                </div>
                                
                            </div>
                        </li>
                        <?php endif ?>
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
      
        <div id="container">
            <div id="mapid"></div>
                
            <script>
                //Access the elements of the sql query arrays
                //Tour Start poi query results
                var jsStartPoiRecords = <?php echo json_encode($usersGuidedToursStartPoi); ?>;
                //Tour End poi query results
                var jsEndPoiRecords = <?php echo json_encode($usersGuidedToursEndPoi); ?>;
                
                //All Other between start end pois
                var jsIntermediatePois = <?php echo json_encode($allOtherPois); ?>;
                
                //Map and markers variables
                var mymap, addedmarker;
    
                //Map                
                $(function(){
                    
                /* Specific location on map*/
                   mymap = L.map('mapid').setView([jsStartPoiRecords[0]['startPoiLatidute'], jsStartPoiRecords[0]['startPoiLongitude']], 18);
                    // Adding map with configuration
                   L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                   maxZoom: 18,
                   attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                     '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                     'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                   id: 'mapbox/streets-v11',
                   tileSize: 512,
                   zoomOffset: -1
                }).addTo(mymap);
                    //Creating a group of markers
                    savedMarkers = new L.LayerGroup();
                    //call the function that adds the markers on map
                    addMarkers();
                    //mymap.on('click', addNewMarker); 
                });
                
                //function that adds the markers on map
                function addMarkers(){ 
                    
                    //Start Poi marker------------------------------------------------------------------------------------------------
                    //Start Poi Info from query to variable
                    var objStartPoi = jsStartPoiRecords[0];
                        for (var key in objStartPoi){
                            var startPoiNm = objStartPoi['startPoiName'];
                            var startPoiAddrs = objStartPoi['startPoiAddress'];
                            var startPoiLatd = objStartPoi['startPoiLatidute'];
                            var startPoiLongd = objStartPoi['startPoiLongitude'];
                            var startPoiInf = objStartPoi['startPoiBriefInfo'];
                            var startPoiPhotoName = objStartPoi['startPoiPhotoName'];
                            var startPoiPhotoPath = objStartPoi['startPoiPhotoPath'];
                    }
                    
                    //Creating the custom popup with bootstrap card for start poi
                    var popupCardStartPoi = '<div class="card" style="width: 15rem; height: 30rem; ">'+
                                              '<img src="'+startPoiPhotoPath+startPoiPhotoName+'" class="card-img-top" alt="...">'+
                                              '<div class="card-title">'+
                                                '<h5>'+startPoiNm+'</h5>'+
                                              '</div>'+
                                              '<div class="card-body scroll" style="overflow-y: auto;">'+
                                                '<p class="card-text">'+startPoiInf+'</p>'+
                                              '</div>'+
                                              '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Address: '+startPoiAddrs+'</li>'+
                                                '<li class="list-group-item">Latidute: '+startPoiLatd+'</li>'+
                                                '<li class="list-group-item">Longitude: '+startPoiLongd+'</li>'+
                                              '</ul>'+
                                            '</div>';
                    //Icon for start poi
                    //var starticon = L.icon({
                        //iconUrl: 'Images/StartIcon.png',
                        //iconSize:     [38, 38], // size of the icon
                        //shadowSize:   [50, 64], // size of the shadow
                        //iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                        //shadowAnchor: [4, 62],  // the same for the shadow
                        //popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                    //});
                        
                    //Add current marker of start poi using latidude and longitude
                    addedmarker = new L.marker([startPoiLatd,startPoiLongd]).addTo(mymap);
                    //Bind tooltip to added marker
                    addedmarker.bindTooltip("Start", {permanent: true, direction: 'right'});
                    //Add custom popup with the start poi info
                    addedmarker.bindPopup(popupCardStartPoi).openPopup();
                    //Start Poi marker------------------------------------------------------------------------------------------------
                    
                    //End Poi marker--------------------------------------------------------------------------------------------------
                    //Poi Info from query to variable
                    var objEndPoi = jsEndPoiRecords[0];
                        for (var key in objEndPoi){
                            var endPoiNm = objEndPoi['endPoiName'];
                            var endPoiAddrs = objEndPoi['endPoiAddress'];
                            var endPoiLatd = objEndPoi['endPoiLatidute'];
                            var endPoiLongd = objEndPoi['endPoiLongitude'];
                            var endPoiInf = objEndPoi['endPoiBriefInfo'];
                            var endPoiPhotoName = objEndPoi['endPoiPhotoName'];
                            var endPoiPhotoPath = objEndPoi['endPoiPhotoPath'];
                    }
                    
                    //Creating the custom popup with bootstrap card for end poi
                    var popupCardEndPoi = '<div class="card" style="width: 15rem; height: 30rem;">'+
                                              '<img src="'+endPoiPhotoPath+endPoiPhotoName+'" class="card-img-top" alt="...">'+
                                              '<div class="card-title">'+
                                                '<h5>'+endPoiNm+'</h5>'+
                                              '</div>'+
                                              '<div class="card-body scroll" style="overflow-y: auto;">'+
                                                '<p class="card-text">'+startPoiInf+'</p>'+
                                              '</div>'+
                                              '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Address: '+endPoiAddrs+'</li>'+
                                                '<li class="list-group-item">Latidute: '+endPoiLatd+'</li>'+
                                                '<li class="list-group-item">Longitude: '+endPoiLongd+'</li>'+
                                              '</ul>'+
                                            '</div>';

                    
                    
                    //Add current marker of end poi using latidude and longitude
                    addedmarker = new L.marker([endPoiLatd,endPoiLongd]).addTo(mymap);
                    //Bind tooltip to added marker
                    addedmarker.bindTooltip("End", {permanent: true, direction: 'right'});
                    
                    //Add custom popup with the end poi info
                    addedmarker.bindPopup(popupCardEndPoi);
                    //End Poi marker--------------------------------------------------------------------------------------------------
                    
                    //Adding other markers--------------------------------------------------------------------------------------------
                    for(var j = 0;  j < jsIntermediatePois.length; j++){
						   
							var obj = jsIntermediatePois[j];
								for (var key in obj){
									var poiNm = obj['PoiName'];
									var poiAddrs = obj['PoiAddress'];
									var poiLatd = obj['PoiLatitude'];
									var poiLongd = obj['PoiLongitude'];
									var poiInf = obj['PoiBriefInfo'];
                                    var poiPhotoName = obj['PoiPhotoName'];
                                    var poiPhotoPath = obj['PoiPhotoPath'];
								}
							
							 //Creating the custom popup with bootstrap card for end poi
                            var popupCardOtherPoi = '<div class="card" style="width: 15rem; height: 30rem; ">'+
                                              '<img src="'+poiPhotoPath+poiPhotoName+'" class="card-img-top" alt="...">'+
                                              '<div class="card-title">'+
                                                '<h5>'+poiNm+'</h5>'+
                                              '</div>'+
                                              '<div class="card-body scroll" style="overflow-y: auto;">'+
                                                '<p class="card-text">'+poiInf+'</p>'+
                                              '</div>'+
                                              '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Address: '+poiAddrs+'</li>'+
                                                '<li class="list-group-item">Latidute: '+poiLatd+'</li>'+
                                                '<li class="list-group-item">Longitude: '+poiLongd+'</li>'+
                                              '</ul>'+
                                            '</div>';
							
							//Προσθήκη του τρέχοντα marker με όρισμα τα latidude και longitude
							addedmarker = new L.marker([poiLatd,poiLongd]).addTo(mymap);
							
							//Προσθήκη του castom popup και αντιστοίχιση των πληροφοριών
							addedmarker.bindPopup(popupCardOtherPoi);
							
				    }
                    //Adding other markers end--------------------------------------------------------------------------------------------
                }  
            </script>
        </div>
    </body>
</html>