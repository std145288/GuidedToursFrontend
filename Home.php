<?php
    session_start();
    

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
                    <form class="form-inline my-2 my-lg-0">
                      <input class="form-control mr-sm-2" type="text" placeholder="Search POI" aria-label="Search">
                      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </nav>
        </div>
        <div clas="container">
            <div class="d-flex mt-5 justify-content-center">
                <div class="accordion" id="accordionExample">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Welcome to our services
                            </button>
                          </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            Amazing guided tours is a company that provides online guided tours creation service. You can select the the point of interest that you want to start your tour, the point of interest that you will end your tour and your time availabillity.
                            Then a suitable vehicle, a driver and a guide will be assigned and your tour will be created.
                            <?php if (!isset($_SESSION['currentCustomerId'])) : ?>
                            You must have created an acount so as to use our services. If you haven't an account, <a href="CreateAccount.php">create</a> one first it is simple.
                            <?php endif ?>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              See the guided tours you have created
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                            <?php if (isset($_SESSION['currentCustomerId'])) : ?>
                             Guided tours here
                            <?php else : ?> 
                            <a href="CreateAccount.php">Create</a> an account or <a href="Index.php">sign in</a> to see your tours
                            <?php endif ?>  
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingThree">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                              Create a guided tour
                            </button>
                          </h2>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                          <div class="card-body">
                            <?php if (isset($_SESSION['currentCustomerId'])) : ?>
                            <a href="CreateTour.php">Create</a> a new guided tour!
                            <?php else : ?> 
                            <a href="CreateAccount.php">Create</a> an account or <a href="Index.php">sign in</a> to be able to create a tour!
                            <?php endif ?>  
                          </div>
                        </div>
                      </div>
                    <div class="card">
                        <div class="card-header" id="headingFour">
                          <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                              See your latest guided tour
                            </button>
                          </h2>
                        </div>
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                          <div class="card-body">
                            <?php if (isset($_SESSION['currentCustomerId'])) : ?>
                            See <a href="Guidedtour.php">here </a> your latest guided tour!
                            <?php else : ?> 
                            <a href="CreateAccount.php">Create</a> an account or <a href="Index.php">sign in</a> to be able to create a tour!
                            <?php endif ?>  
                          </div>
                        </div>
                      </div>
                    </div>
            </div>
        </div>
    </body>
</html>