<!--PHP for inserting user to database-->
<?php
    //Connection to database
    include 'DbConnection.php';
    //Insert form data to database
    if(isset($_POST['SaveUser'])){
        //User account data
        $usrFName=$_POST['UserFirstNameField'];
        $usrLName=$_POST['UserLastNameField'];
        $usrEmail=$_POST['UserEmailField'];
        $usrPassword=$_POST['UserPasswordField'];
        //User is not admin
        $usrAcnType=0;
        //Text for insert user SQL query
        $insertSqlTxt="INSERT INTO UserAccounts (UserFirstName, UserLastName, UserEmail, UserPassword, UserAccountType) values ('$usrFName', '$usrLName', '$usrEmail', '$usrPassword', '$usrAcnType')";
        //Insert user to database SQL query 
        $insertNewRecord=mysqli_query($conn, $insertSqlTxt);
        if($insertNewRecord){
            echo("User added succesfully");
        }else{
            echo("Error. Please try again!");
        }
    }
    mysqli_close($conn);
?>