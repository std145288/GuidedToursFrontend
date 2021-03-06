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
                        <li class="nav-item">
                            <a class="nav-link" href="Index.php">Sign In <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
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
            <div class="card scroll" style="padding-top: 5px; height: 100%; overflow-y: auto;">
                <form class="form" name="frmReg" onsubmit="return validateForm()" method="post" action="Scripts/CreateAccount.php" role="form">
                    <!--Label and input field for first name-->
                    <div class="required form-group">
                        <label class="control-label col-sm-3" for="UserFirstNameField">First Name:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="UserFirstNameField" placeholder="Type your first name" name="UserFirstNameField">
                        </div>
                    </div>
                    <!--Label and input field for last name-->
                    <div class="required form-group">
                        <label class="control-label col-sm-3" for="UserLastNameField">Last Name:</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" id="UserLastNameField" placeholder="Type your last name" name="UserLastNameField">
                        </div>
                    </div>
                       <!--Label and input field for email address-->
                    <div class="required form-group">
                        <label class="control-label col-sm-3" for="UserEmailField">Email Address:</label>
                        <div class="col-md-3">
                            <input type="email" class="form-control" id="UserEmailField" placeholder="Type a valid email address" name="UserEmailField">
                        </div>
                    </div>
                    <!--Label and input field for password-->
                    <div class="required form-group">
                        <label class="control-label col-sm-3" for="UserPasswordField">Password:</label>
                        <div class="col-md-3">
                            <input type="password" class="form-control" id="UserPasswordField" placeholder="Type your password" name="UserPasswordField" title="If your password contains less than 8 characters you must confirm it below">
                        </div>
                    </div>
                    <!--Label and input field for password validation-->
                    <div class="required form-group">
                        <label class="control-label col-sm-3" for="ReenterUserPasswordField">Reenter Password:</label>
                        <div class="col-md-3">
                            <input type="password" class="form-control" id="ReenterUserPasswordField" placeholder="Retype your password to confirm" name="ReenterUserPasswordField">
                        </div>
                    </div>
                    <!--Submit and reset buttons-->
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" name="SaveUser" class="btn btn-default">Submit account</button>
                            <button type="reset" class="btn btn-danger" value="Reset">Reset</button>
                        </div>
                    </div>
                </form><!--Τέλος φόρμας-->
            </div>
        </div>
    </body>
</html>