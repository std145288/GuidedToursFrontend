<?php
    //Connection to database
    include 'DbConnection.php';
    //Insert form data to database
    if(isset($_POST['SaveTour'])){
        //tour data
        //Selected customer
        $tourCustomerName=$_POST['GuidedTourCustomerField'];
        //Find Customer user id
        //Split Customer name to UserFirstName and UserLastName
        $userNameParts = explode(" - ", $tourCustomerName);
        //Query text for finding user id
        $finduserid = "SELECT UserId FROM useraccounts WHERE UserFirstName = '$userNameParts[0]' AND UserLastName = '$userNameParts[1]'";
        $useridset = mysqli_query($conn, $finduserid);
        $qrFindUsrRowCount = mysqli_num_rows($useridset);
        if ($qrFindUsrRowCount!=0){
            $userIdRecord = mysqli_fetch_row($useridset);
            //This goes to insert query    
            $customerUserId = $userIdRecord[0];
        }else{
            echo '<html><meta charset="UTF-8"><script language="javascript">alert("Error during inserting customer data "); document.location="../InsertGuidedTour.php";</script></html>';
        }
        
        //Number of visitors
        $tourVisitorsNum=$_POST['GuidedTourVisitorsNumberField'];
        //Tour Date
        $tourDate=$_POST['GuidedTourDateField'];
        //Tour start time
        $tourStartTime=$_POST['GuidedTourStartTimeField'];
        //Tour end time
        $tourEndTime=$_POST['GuidedTourEndTimeField'];
        
        //Selected start poi
        $tourSelectedStartPoi = $_POST['GuidedTourStartPoiField'];
        //Find start poi id
        //Query text for finding poi id
        $findspoiid = "SELECT PoiId FROM pointsofinterest WHERE PoiName = '$tourSelectedStartPoi'";
        $poisidset = mysqli_query($conn, $findspoiid);
        $qrFindSPoiRowCount = mysqli_num_rows($poisidset);
        if ($qrFindSPoiRowCount!=0){
            $spoiIdRecord = mysqli_fetch_row($poisidset);
            //This goes to insert query    
            $tourStartPoiId = $spoiIdRecord[0];
        }else{
            echo '<html><meta charset="UTF-8"><script language="javascript">alert("Error during inserting start poi data"); document.location="../InsertGuidedTour.php";</script></html>';
        }
        
        //Selected end poi
        $tourSelectedEndPoi = $_POST['GuidedTourEndPoiField'];
        //Find start poi id
        //Query text for finding poi id
        $findepoiid = "SELECT PoiId FROM pointsofinterest WHERE PoiName = '$tourSelectedEndPoi'";
        $poieidset = mysqli_query($conn, $findepoiid);
        $qrFindEPoiRowCount = mysqli_num_rows($poieidset);
        if ($qrFindEPoiRowCount!=0){
            $epoiIdRecord = mysqli_fetch_row($poieidset);
            //This goes to insert query    
            $tourEndPoiId = $epoiIdRecord[0];
        }else{
            echo '<html><meta charset="UTF-8"><script language="javascript">alert("Error during inserting end poi data"); document.location="../InsertGuidedTour.php";</script></html>';
        }
        
       
        
        //Insert Guided Tour To DB
        //Sql query text
        $insertTourSqlTxt="INSERT INTO guidedtours (GuidedTourCustomer, NumberOfVisitors, GuidedTourDate, GuidedTourStartTime, GuidedTourEndTime, GuidedTourStartPoi, GuidedTourEndPoi, GuidedTourConfirmed) values ('$customerUserId', '$tourVisitorsNum', '$tourDate', '$tourStartTime', '$tourEndTime','$tourStartPoiId','$tourEndPoiId','0')";
       
        //Insert user to database SQL query 
        $insertNewTourRecord=mysqli_query($conn, $insertTourSqlTxt);
        if($insertNewTourRecord){
            echo("Guided tour added succesfully");
        }else{
            echo("Error. Please try again!");
        }
        
    }
?>