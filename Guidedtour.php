<?php
    session_start();
    //Check if customer, guide or driver connected
    
    //If customer connected
    if (isset($_SESSION['currentCustomerId'])){
        include 'Scripts/GuidedTourCustomer.php';    
    }
    
     //If driver connected
    if (isset($_SESSION['currentDriverId'])){
        include 'Scripts/GuidedTourDriver.php'; 
    }

     //If driver connected
    if (isset($_SESSION['currentGuideId'])){
        include 'Scripts/GuidedTourGuide.php'; 
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
            <a class="navbar-brand" href="Home.php">AmGdTr</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="Map.php">Map</a>
                        </li>
                        <?php if (isset($_SESSION['currentCustomerId'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['currentCustomerEmail'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <form name="frmUserInfo" method="post" action="Scripts/Logout.php" role="form">
                                <h6>User info</h6>
                                <div class="form-group" >
                                    <i class="fa fa-user-circle" aria-hidden="true"></i><label><?php echo $_SESSION['currentCustomerFirstName']." ".$_SESSION['currentCustomerLastName'] ?></label>
                                </div>
                                <div class="form-group" >
                                    <i class="fa fa-address-card" aria-hidden="true"></i><label><?php echo $_SESSION['currentCustomerEmail'] ?></label>
                                </div>
                                <button class="btn btn-block btn-danger" id="btnLogout" type="submit">Exit</button>
                                </form>
                            </div>
                        </li>
                        <?php endif ?>
                        <?php if (isset($_SESSION['currentDriverId'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['currentDriverEmail'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <form name="frmUserInfo" method="post" action="Scripts/Logout.php" role="form">
                                <h6>Driver info</h6>
                                <div class="form-group" >
                                    <i class="fa fa-user-circle" aria-hidden="true"></i><label><?php echo $_SESSION['currentDriverFirstName']." ".$_SESSION['currentDriverLastName'] ?></label>
                                </div>
                                <div class="form-group" >
                                    <i class="fa fa-address-card" aria-hidden="true"></i><label><?php echo $_SESSION['currentDriverEmail'] ?></label>
                                </div>
                                <button class="btn btn-block btn-danger" id="btnLogout" type="submit">Exit</button>
                                </form>
                            </div>
                        </li>
                        <?php endif ?>
                        
                        <?php if (isset($_SESSION['currentGuideId'])) : ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['currentGuideEmail'] ?></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown01">
                                <form name="frmUserInfo" method="post" action="Scripts/Logout.php" role="form">
                                <h6>Guide info</h6>
                                <div class="form-group" >
                                    <i class="fa fa-user-circle" aria-hidden="true"></i><label><?php echo $_SESSION['currentGuideFirstName']." ".$_SESSION['currentGuideLastName'] ?></label>
                                </div>
                                <div class="form-group" >
                                    <i class="fa fa-address-card" aria-hidden="true"></i><label><?php echo $_SESSION['currentGuideEmail'] ?></label>
                                </div>
                                <button class="btn btn-block btn-danger" id="btnLogout" type="submit">Exit</button>
                                </form>
                            </div>
                        </li>
                        <?php endif ?>
                        
                        <?php if (!isset($_SESSION['currentCustomerId']) and !isset($_SESSION['currentDriverId']) and !isset($_SESSION['currentGuideId'])) : ?>
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
            <!--If customer is connected------------------------------------------------------------------------------------------------- -->
            <?php if (isset($_SESSION['currentCustomerId'])) : ?>
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
                    var popupCardStartPoi = '<div class="card" style="width: 15rem; height: 34rem; ">'+
                                              '<div class="card-title">'+
                                                '<h6>'+startPoiNm+'</h6>'+
                                              '</div>'+
                                              '<img src="'+startPoiPhotoPath+startPoiPhotoName+'" class="card-img-top" alt="...">'+
                                                '<div class="accordion" id="accordionExample">'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingOne">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                                              'POI Location info'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                                          '<div class="card-body">'+
                                                            '<ul class="list-group list-group-flush">'+
                                                                    '<li class="list-group-item">Address: '+startPoiAddrs+'</li>'+
                                                                    '<li class="list-group-item">Latidute: '+startPoiLatd+'</li>'+
                                                                    '<li class="list-group-item">Longitude: '+startPoiLongd+'</li>'+
                                                            '</ul>'+
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingTwo">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                                              'POI Information'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                                          '<div class="card-body scroll" style=" height: 12rem; overflow-y: auto;">'+
                                                             '<class="card-text">'+startPoiInf+
                                                          '</div>'+ 
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                    '</div>';
                                            '</div>';
                    
                        
                    //Add current marker of start poi using latidude and longitude
                    addedmarker = new L.marker([startPoiLatd,startPoiLongd]).addTo(mymap);
                    //Bind tooltip to added marker
                    addedmarker.bindTooltip("Start", {permanent: true, direction: 'right'});
                    //Add custom popup with the start poi info
                    addedmarker.bindPopup(popupCardStartPoi).openPopup();
                    
                    //Start Poi marker end------------------------------------------------------------------------------------------------
                    
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
                    
                    
                     var popupCardEndPoi ='<div class="card" style="width: 15rem; height: 34rem; ">'+
                                              '<div class="card-title">'+
                                                '<h6>'+endPoiNm+'</h6>'+
                                              '</div>'+
                                              '<img src="'+endPoiPhotoPath+endPoiPhotoName+'" class="card-img-top" alt="...">'+
                                                '<div class="accordion" id="accordionExample">'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingOne">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                                              'POI Location info'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                                          '<div class="card-body">'+
                                                            '<ul class="list-group list-group-flush">'+
                                                                    '<li class="list-group-item">Address: '+endPoiAddrs+'</li>'+
                                                                    '<li class="list-group-item">Latidute: '+endPoiLatd+'</li>'+
                                                                    '<li class="list-group-item">Longitude: '+endPoiLongd+'</li>'+
                                                            '</ul>'+
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingTwo">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                                              'POI Information'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                                          '<div class="card-body scroll" style=" height: 12rem; overflow-y: auto;">'+
                                                             '<class="card-text">'+endPoiInf+
                                                          '</div>'+ 
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                    '</div>';
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

                        var popupCardOtherPoi ='<div class="card" style="width: 15rem; height: 34rem; ">'+
                                              '<div class="card-title">'+
                                                '<h6>'+poiNm+'</h6>'+
                                              '</div>'+
                                              '<img src="'+poiPhotoPath+poiPhotoName+'" class="card-img-top" alt="..." >'+
                                                '<div class="accordion" id="accordionExample">'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingOne">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                                              'POI Location info'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                                          '<div class="card-body">'+
                                                            '<ul class="list-group list-group-flush">'+
                                                                    '<li class="list-group-item">Address: '+poiAddrs+'</li>'+
                                                                    '<li class="list-group-item">Latidute: '+poiLatd+'</li>'+
                                                                    '<li class="list-group-item">Longitude: '+poiLongd+'</li>'+
                                                            '</ul>'+
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingTwo">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                                              'POI Information'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                                          '<div class="card-body scroll" style=" height: 12rem; overflow-y: auto;">'+
                                                             '<class="card-text">'+poiInf+
                                                          '</div>'+ 
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                    '</div>';
                                            '</div>';
							
							//Προσθήκη του τρέχοντα marker με όρισμα τα latidude και longitude
							addedmarker = new L.marker([poiLatd,poiLongd]).addTo(mymap);
							
							//Προσθήκη του castom popup και αντιστοίχιση των πληροφοριών
							addedmarker.bindPopup(popupCardOtherPoi);
				    }
                    //Adding other markers end--------------------------------------------------------------------------------------------
                }  
            </script>
            <?php endif ?>
            <!-- ----------------------------------------------------------------------------------------------------------------------- -->
            
            <!--If driver is connected ------------------------------------------------------------------------------------------------- -->
            <?php if (isset($_SESSION['currentDriverId'])) : ?>
            <script>
                //Access the elements of the sql query arrays
                //Guided tour
                var jsGuidedTour = <?php echo json_encode($driversGuidedTours); ?>;
                //Tour Start poi query results
                var jsStartPoiRecords = <?php echo json_encode($driversGuidedToursStartPoi); ?>;
                //Tour End poi query results
                var jsEndPoiRecords = <?php echo json_encode($driversGuidedToursEndPoi); ?>;
                
                //All Other between start end pois
                var jsIntermediatePois = <?php echo json_encode($allOtherPois); ?>;
                
                //Tour Vehicle
                var jsGuidedTourVehicle = <?php echo json_encode($driversGuidedToursVehicle); ?>;
                //Tour Guide
                var jsGuidedTourGuide = <?php echo json_encode($driversGuidedToursGuide); ?>;
                //Tour customer
                var jsGuidedTourCustomer = <?php echo json_encode($driversGuidedToursCustomer); ?>;
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
                    //Info from Guided tour
                    
                    
                    //Start Poi marker------------------------------------------------------------------------------------------------
                    //Start Poi Info from query to variable
                    var objStartPoi = jsStartPoiRecords[0];
                        for (var key in objStartPoi){
                            var startPoiNm = objStartPoi['startPoiName'];
                            var startPoiAddrs = objStartPoi['startPoiAddress'];
                            var startPoiLatd = objStartPoi['startPoiLatidute'];
                            var startPoiLongd = objStartPoi['startPoiLongitude'];
                            var startPoiPhotoName = objStartPoi['startPoiPhotoName'];
                            var startPoiPhotoPath = objStartPoi['startPoiPhotoPath'];
                    }
                    //Creating the custom popup with bootstrap card for start poi
                    var popupCardStartPoi = '<div class="accordion" id="accordionExample">'+
                                  '<div class="card">'+
                                    '<div class="card-header" id="headingOne">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                          'Upcoming Tour Info'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                        '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Tour Date: '+jsGuidedTour[0]['GuidedTourDate']+'</li>'+
                                                '<li class="list-group-item">Tour start time: '+jsGuidedTour[0]['GuidedTourStartTime']+'</li>'+
                                                '<li class="list-group-item">Tour end time: '+jsGuidedTour[0]['GuidedTourEndTime']+'</li>'+
                                                '<li class="list-group-item">Number of visitors: '+jsGuidedTour[0]['NumberOfVisitors']+'</li>'+
                                                '<li class="list-group-item">Start poi: '+startPoiNm+'</li>'+
                                              '</ul>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="card">'+
                                    '<div class="card-header" id="headingTwo">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                          'Customer Contact Info'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                        '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Customer first name: '+jsGuidedTourCustomer[0]['tourCustomerFirstName']+'</li>'+
                                                '<li class="list-group-item">Customer last name: '+jsGuidedTourCustomer[0]['tourCustomerLastName']+'</li>'+
                                                '<li class="list-group-item">Customer email address: '+jsGuidedTourCustomer[0]['tourCustomerEmailAddress']+'</li>'+
                                              '</ul>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="card">'+
                                    '<div class="card-header" id="headingThree">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">'+
                                          'Assigned Vehicle'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseThree" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                         '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Vehicle Number: '+jsGuidedTourVehicle[0]['tourVehicleNumber']+'</li>'+
                                                '<li class="list-group-item">Vehicle Plate Number: '+jsGuidedTourVehicle[0]['tourVehiclePlateNumber']+'</li>'+
                                              '</ul>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="card">'+
                                    '<div class="card-header" id="headingThree">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">'+
                                          'Assigned Guide'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                        '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Guide Name: '+jsGuidedTourGuide[0]['tourGuideFirstName']+'</li>'+
                                                '<li class="list-group-item">Guide Last Name: '+jsGuidedTourGuide[0]['tourGuideLastName']+'</li>'+
                                                '<li class="list-group-item">Guide Email Address: '+jsGuidedTourGuide[0]['tourGuideEmailAddress']+'</li>'+
                                              '</ul>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>';
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
                            var endPoiPhotoName = objEndPoi['endPoiPhotoName'];
                            var endPoiPhotoPath = objEndPoi['endPoiPhotoPath'];
                    }
                    
                    //Creating the custom popup with bootstrap card for end poi
                    var popupCardEndPoi = '<div class="card" style="width: 15rem; height: 30rem;">'+
                                              '<img src="'+endPoiPhotoPath+endPoiPhotoName+'" class="card-img-top" alt="...">'+
                                              '<div class="card-title">'+
                                                '<h5>'+endPoiNm+'</h5>'+
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
                                    var poiPhotoName = obj['PoiPhotoName'];
                                    var poiPhotoPath = obj['PoiPhotoPath'];
								}
							
							 //Creating the custom popup with bootstrap card for end poi
                            var popupCardOtherPoi = '<div class="card" style="width: 15rem; height: 30rem; ">'+
                                              '<img src="'+poiPhotoPath+poiPhotoName+'" class="card-img-top" alt="...">'+
                                              '<div class="card-title">'+
                                                '<h5>'+poiNm+'</h5>'+
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
            <?php endif ?>
            <!-- ----------------------------------------------------------------------------------------------------------------------- -->
            
             <!--If guide is connected ------------------------------------------------------------------------------------------------- -->
            <?php if (isset($_SESSION['currentGuideId'])) : ?>
            <script>
                //Access the elements of the sql query arrays
                //Guided tour
                var jsGuidedTour = <?php echo json_encode($guidesGuidedTours); ?>;
                //Tour Start poi query results
                var jsStartPoiRecords = <?php echo json_encode($guidesGuidedToursStartPoi); ?>;
                //Tour End poi query results
                var jsEndPoiRecords = <?php echo json_encode($guidesGuidedToursEndPoi); ?>;
                
                //All Other between start end pois
                var jsIntermediatePois = <?php echo json_encode($allOtherPois); ?>;
                
                //Tour Vehicle
                var jsGuidedTourVehicle = <?php echo json_encode($guidesGuidedToursVehicle); ?>;
                //Tour Guide
                var jsGuidedTourDriver = <?php echo json_encode($guidesGuidedToursDriver); ?>;
                //Tour customer
                var jsGuidedTourCustomer = <?php echo json_encode($guidesGuidedToursCustomer); ?>;
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
                    //Info from Guided tour
                    
                    
                    //Start Poi marker------------------------------------------------------------------------------------------------
                    //Start Poi Info from query to variable
                    var objStartPoi = jsStartPoiRecords[0];
                        for (var key in objStartPoi){
                            var startPoiNm = objStartPoi['startPoiName'];
                            var startPoiAddrs = objStartPoi['startPoiAddress'];
                            var startPoiLatd = objStartPoi['startPoiLatidute'];
                            var startPoiLongd = objStartPoi['startPoiLongitude'];
                            var poiInf = objStartPoi['startPoiDetailedInfo'];
                    }
                    
                    //Creating the custom popup with bootstrap card for start poi  
                    var popupCardStartPoi = '<div class="accordion" id="accordionExample">'+
                                  '<div class="card">'+
                                    '<div class="card-header" id="headingOne">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                          'Upcoming Tour Info'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                        '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Tour Date: '+jsGuidedTour[0]['GuidedTourDate']+'</li>'+
                                                '<li class="list-group-item">Tour start time: '+jsGuidedTour[0]['GuidedTourStartTime']+'</li>'+
                                                '<li class="list-group-item">Tour end time: '+jsGuidedTour[0]['GuidedTourEndTime']+'</li>'+
                                                '<li class="list-group-item">Number of visitors: '+jsGuidedTour[0]['NumberOfVisitors']+'</li>'+
                                                '<li class="list-group-item">Start poi: '+startPoiNm+'</li>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="card">'+
                                    '<div class="card-header" id="headingTwo">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                          'Customer Contact Info'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                        '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Customer first name: '+jsGuidedTourCustomer[0]['tourCustomerFirstName']+'</li>'+
                                                '<li class="list-group-item">Customer last name: '+jsGuidedTourCustomer[0]['tourCustomerLastName']+'</li>'+
                                                '<li class="list-group-item">Customer email address: '+jsGuidedTourCustomer[0]['tourCustomerEmailAddress']+'</li>'+
                                              '</ul>'+
                                      '</div>'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="card">'+
                                    '<div class="card-header" id="headingThree">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">'+
                                          'Assigned Vehicle'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                         '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Vehicle Number: '+jsGuidedTourVehicle[0]['tourVehicleNumber']+'</li>'+
                                                '<li class="list-group-item">Vehicle Plate Number: '+jsGuidedTourVehicle[0]['tourVehiclePlateNumber']+'</li>'+
                                              '</ul>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="card">'+
                                    '<div class="card-header" id="headingFour">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">'+
                                          'Assigned Guide'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">'+
                                      '<div class="card-body">'+
                                        '<ul class="list-group list-group-flush">'+
                                                '<li class="list-group-item">Guide Name: '+jsGuidedTourDriver[0]['tourDriverFirstName']+'</li>'+
                                                '<li class="list-group-item">Guide Last Name: '+jsGuidedTourDriver[0]['tourDriverLastName']+'</li>'+
                                                '<li class="list-group-item">Guide Email Address: '+jsGuidedTourDriver[0]['tourDriverEmailAddress']+'</li>'+
                                              '</ul>'+
                                    '</div>'+
                                  '</div>'+
                                '</div>'+
                                '<div class="card">'+
                                    '<div class="card-header" id="headingFive">'+
                                      '<h2 class="mb-0">'+
                                        '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">'+
                                          'Poi info'+
                                        '</button>'+
                                      '</h2>'+
                                    '</div>'+
                                    '<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">'+
                                      '<div class="card-body scroll" style=" height: 14rem; overflow-y: auto;">'+
                                         '<class="card-text">'+poiInf+
                                      '</div>'+ 
                                    '</div>'+
                                  '</div>'+
                                '</div>';
                        
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
                            var endPoiInf =  objEndPoi['endPoiDetailedInfo'];
                            var endPoiPhotoName = objEndPoi['endPoiPhotoName'];
                            var endPoiPhotoPath = objEndPoi['endPoiPhotoPath'];
                    }
                    
                    //Creating the custom popup with bootstrap card for end poi                    
                    var popupCardEndPoi='<div class="card" style="width: 15rem; height: 34rem; ">'+
                                              '<div class="card-title">'+
                                                '<h6>'+endPoiNm+'</h6>'+
                                              '</div>'+
                                              '<img src="'+endPoiPhotoPath+endPoiPhotoName+'" class="card-img-top" alt="..." >'+
                                                '<div class="accordion" id="accordionExample">'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingOne">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                                              'POI Location info'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                                          '<div class="card-body">'+
                                                            '<ul class="list-group list-group-flush">'+
                                                                    '<li class="list-group-item">Address: '+endPoiAddrs+'</li>'+
                                                                    '<li class="list-group-item">Latidute: '+endPoiLatd+'</li>'+
                                                                    '<li class="list-group-item">Longitude: '+endPoiLongd+'</li>'+
                                                            '</ul>'+
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingTwo">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                                              'POI Information'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                                          '<div class="card-body scroll" style=" height: 12rem; overflow-y: auto;">'+
                                                             '<class="card-text">'+endPoiInf+
                                                          '</div>'+ 
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                    '</div>';
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
                                    var poiInfo = obj['PoiDetailedInfo'];
                                    var poiPhotoName = obj['PoiPhotoName'];
                                    var poiPhotoPath = obj['PoiPhotoPath'];
								}
							
							 //Creating the custom popup with bootstrap card for end poi
                        
                        var popupCardOtherPoi ='<div class="card" style="width: 15rem; height: 34rem; ">'+
                                              '<div class="card-title">'+
                                                '<h6>'+poiNm+'</h6>'+
                                              '</div>'+
                                              '<img src="'+poiPhotoPath+poiPhotoName+'" class="card-img-top" alt="..." >'+
                                                '<div class="accordion" id="accordionExample">'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingOne">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">'+
                                                              'POI Location info'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">'+
                                                          '<div class="card-body">'+
                                                            '<ul class="list-group list-group-flush">'+
                                                                    '<li class="list-group-item">Address: '+poiAddrs+'</li>'+
                                                                    '<li class="list-group-item">Latidute: '+poiLatd+'</li>'+
                                                                    '<li class="list-group-item">Longitude: '+poiLongd+'</li>'+
                                                            '</ul>'+
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                      '<div class="card">'+
                                                        '<div class="card-header" id="headingTwo">'+
                                                          '<h2 class="mb-0">'+
                                                            '<button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">'+
                                                              'POI Information'+
                                                            '</button>'+
                                                          '</h2>'+
                                                        '</div>'+
                                                        '<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">'+
                                                          '<div class="card-body scroll" style=" height: 12rem; overflow-y: auto;">'+
                                                             '<class="card-text">'+poiInfo+
                                                          '</div>'+ 
                                                          '</div>'+
                                                        '</div>'+
                                                      '</div>'+
                                                    '</div>';
                                            '</div>';
							
							//Προσθήκη του τρέχοντα marker με όρισμα τα latidude και longitude
							addedmarker = new L.marker([poiLatd,poiLongd]).addTo(mymap);
							
							//Προσθήκη του castom popup και αντιστοίχιση των πληροφοριών
							addedmarker.bindPopup(popupCardOtherPoi);
							
				    }
                    //Adding other markers end--------------------------------------------------------------------------------------------
                }  
            </script>
            <?php endif ?>
            <!-- ----------------------------------------------------------------------------------------------------------------------- -->
        </div>
    </body>
</html>