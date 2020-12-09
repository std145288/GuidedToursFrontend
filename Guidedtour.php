<?php

    session_start();
    //Connection to database
    include 'Scripts/DbConnection.php';

    //To store current user tours
    $usersGuidedTours = array();
    //Customer is connected
    if (isset($_SESSION['currentCustomerId'])){
        $CurrCustomerId=$_SESSION['currentCustomerId'];
        //Find latest tour for customer
        $qrCurrentTour = "SELECT * FROM guidedtours WHERE GuidedTourCustomer = '$CurrCustomerId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourRes = mysqli_query($conn, $qrCurrentTour);
        $qrCurrentTourRCount = mysqli_num_rows($qrCurrentTourRes); 
        
        //Εισαγωγή των άρθρων που βρέθηκαν σε πίνακα
        if ($qrCurrentTourRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourRes)){
                $usersGuidedTours[] = $row;
            }
        }
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
                 var mymap, addedmarker;
                                
                            navigator.geolocation.getCurrentPosition(function(location) {
                            /* Specified location on map from current location or fixed*/
                                var latlng = new L.LatLng(location.coords.latitude, location.coords.longitude);
                                mymap = L.map('mapid').setView(latlng, 18);
                                //Adding the map and configuring it
                                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                                maxZoom: 18,
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                                    '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                id: 'mapbox/streets-v11',
                                tileSize: 512,
                                zoomOffset: -1
                                }).addTo(mymap);
                                //New group of markers
                                newMarkers = new L.LayerGroup();
                                //Listener that calls the function that on user's click adds a marker on the map
                                mymap.on('click', addNewMarker); 
                            });
                        
                            function addNewMarker(e){
                                /* Marker at point that user clicked*/
                                addedmarker = new L.marker([e.latlng.lat,e.latlng.lng]).addTo(mymap);
                                //Mapping the custom popup form to marker
                                //addedmarker.bindPopup(popupform).openPopup();
                                document.getElementById('PoiLatitudeField').setAttribute("value", e.latlng.lat);
                                document.getElementById('PoiLongitudeField').setAttribute("value", e.latlng.lng);
                            }
            </script>
        </div>
    </body>
</html>