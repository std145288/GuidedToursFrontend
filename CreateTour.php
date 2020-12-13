<?php
    session_start();
    //Finds the pois from db
    include 'Scripts/FindPois.php';
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
        <script src="Scripts/CreateAccount.js"></script>

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
                        <?php else : ?>
    
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
      
        <div id="container">

            <p></p>
            <form class="form-horizontal" name="GuidedTourData" method="post" action="Scripts/InsertTour.php" role="form" enctype="multipart/form-data">
                        <!--Label and input field where the name of customer is filled-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourCustomerField">Customer :</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="GuidedTourCustomerField" name="GuidedTourCustomerField" value="<?php echo $_SESSION['currentCustomerFirstName']." - ".$_SESSION['currentCustomerLastName'] ?>">
                            </div>
                        </div>
                        <!--Label and input field for input th number of visitors-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourVisitorsNumberField">Number of visitors:</label>
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="UserLastNameField" placeholder="Type the number of visitors" name="GuidedTourVisitorsNumberField">
                            </div>
                        </div>
                           <!--Label and input field for date time selection-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourDateField">Date</label>
                            <div class="col-md-3">
                                <input type="date" class="form-control" id="GuidedTourDateField" name="GuidedTourDateField" value="2020-12-01" min="2020-01-01" max="2021-12-31">
                            </div>
                        </div>
                        <!--Label and input field for for start time selection-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourStartTimeField">Start Time:</label>
                            <div class="col-md-3">
                                <input type="time" class="form-control" id="GuidedTourStartTimeField" name="GuidedTourStartTimeField" value="2020-12-01" min="09:00" max="20:00">
                            </div>
                        </div>
                        <!--Label and input field for end time selection-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourEndTimeField">End Time:</label>
                            <div class="col-md-3">
                                <input type="time" class="form-control" id="GuidedTourEndTimeField" name="GuidedTourEndTimeField" value="2020-12-01" min="10:00" max="21:00">
                            </div>
                        </div>
                        <!--Label and input field for start poi selection-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourStartPoiField">Start poi:</label>
                            <div class="col-md-3">
                                <select class="form-control" id="GuidedTourStartPoiField" name="GuidedTourStartPoiField" >
                                    <option>Select start poi</option>
                                    <!--Filling dropdown with pois "from scripts/FindPois.php" -->
                                    <?php
                                        $count = 0;
                                        foreach ($pois as $poi) {
                                            $count++;
                                            echo "<option>".$poi['PoiName']."</option>";
                                        }
                                    ?><!--End Filling dropdown with pois-->    
                                </select><br><br>
                            </div>
                        </div>
                        <!--Label and input field for end poi selection-->
                        <div class="required form-group">
                            <label class="control-label col-sm-3" for="GuidedTourEndPoiField">End poi:</label>
                            <div class="col-md-3">
                                <select class="form-control" id="GuidedTourEndPoiField" name="GuidedTourEndPoiField" >
                                    <option>Select end poi</option>
                                    <!--Filling dropdown with pois "from scripts/FindPois.php" -->
                                    <?php
                                        $count = 0;
                                        foreach ($pois as $poi) {
                                            $count++;
                                            echo "<option>".$poi['PoiName']."</option>";
                                        }
                                    ?><!--End Filling dropdown with pois-->
                                </select><br><br>
                            </div>
                        </div>
                        <!--Submit and reset buttons-->
                        <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button type="submit" name="SaveTour" class="btn btn-default">Submit tour</button>
                                <button type="reset" class="btn btn-danger" value="Reset">Reset</button>
                            </div>
                        </div>
                         

                    </form><!--Τέλος φόρμας-->
        </div>
    </body>
</html>