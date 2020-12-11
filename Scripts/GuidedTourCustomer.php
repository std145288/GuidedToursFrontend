<?php
    
    //Connection to database
    include 'Scripts/DbConnection.php';
    
    //To store current user tour start poi
    $usersGuidedToursStartPoi = array();
    //To store current user tour end poi
    $usersGuidedToursEndPoi = array();
    //Customer is connected
    if (isset($_SESSION['currentCustomerId'])){
        $CurrCustomerId=$_SESSION['currentCustomerId'];
        //Find latest tour start and end pois for customer
        //Find current tour Start Poi
        $qrCurrentTourStartPoi = "SELECT pointsofinterest.PoiId as startPoiId, pointsofinterest.PoiName as startPoiName, pointsofinterest.PoiAddress as startPoiAddress, pointsofinterest.PoiLatitude as startPoiLatidute, pointsofinterest.PoiLongitude as startPoiLongitude, pointsofinterest.PoiBriefInfo as startPoiBriefInfo, pointsofinterest.PoiPhotoName as startPoiPhotoName,  pointsofinterest.PoiPhotoPath as startPoiPhotoPath  FROM pointsofinterest JOIN guidedtours ON pointsofinterest.PoiId = guidedtours.GuidedTourStartPoi WHERE guidedtours.GuidedTourCustomer = '$CurrCustomerId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourStartPoiRes = mysqli_query($conn, $qrCurrentTourStartPoi);
        $qrCurrentTourStartPoiRCount = mysqli_num_rows($qrCurrentTourStartPoiRes); 

        //Insert records found to array
        if ($qrCurrentTourStartPoiRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourStartPoiRes)){
                $usersGuidedToursStartPoi[] = $row;
            }
        }
        
        //Find current tour End Poi
        $qrCurrentTourEndPoi = "SELECT pointsofinterest.PoiId as endPoiId, pointsofinterest.PoiName as endPoiName, pointsofinterest.PoiAddress as endPoiAddress, pointsofinterest.PoiLatitude as endPoiLatidute, pointsofinterest.PoiLongitude as endPoiLongitude, pointsofinterest.PoiBriefInfo as endPoiBriefInfo, pointsofinterest.PoiPhotoName as endPoiPhotoName,  pointsofinterest.PoiPhotoPath as endPoiPhotoPath  FROM pointsofinterest JOIN guidedtours ON pointsofinterest.PoiId = guidedtours.GuidedTourEndPoi WHERE guidedtours.GuidedTourCustomer = '$CurrCustomerId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourEndPoiRes = mysqli_query($conn, $qrCurrentTourEndPoi);
        $qrCurrentTourEndPoiRCount = mysqli_num_rows($qrCurrentTourEndPoiRes); 

        //Insert records found to array
        if ($qrCurrentTourEndPoiRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourEndPoiRes)){
                $usersGuidedToursEndPoi[] = $row;
            }
        }
        
        //Start End Pois coords
        $startLat = $usersGuidedToursStartPoi[0]['startPoiLatidute'];
        $startLng = $usersGuidedToursStartPoi[0]['startPoiLongitude'];
        $endLat = $usersGuidedToursEndPoi[0]['endPoiLatidute'];
        $endLng = $usersGuidedToursEndPoi[0]['endPoiLongitude'];
        //Find all Other Pois
        //Array to use
        $allOtherPois = array();
        //Start end pois
        $foundStartPoiId = $usersGuidedToursStartPoi[0]['startPoiId'];
        $foundEndPoiId = $usersGuidedToursEndPoi[0]['endPoiId'];
        //Query for all Other Pois
        $qrAllOtherPois = "SELECT * FROM pointsofinterest WHERE PoiId != '$foundStartPoiId' AND PoiId != '$foundEndPoiId'";
        $qrAllOtherPoisRes = mysqli_query($conn, $qrAllOtherPois);
        $qrAllOtherPoisRCount = mysqli_num_rows($qrAllOtherPoisRes);
        
        //Insert records found to array
        if ($qrAllOtherPoisRCount!=0){
            while ($row = mysqli_fetch_assoc($qrAllOtherPoisRes)){
                if(checkPoi($startLat, $startLng, $endLat, $endLng, $row['PoiLatitude'],$row['PoiLongitude'])){
                   $allOtherPois[]=$row; 
                }
            }
        }
           
    }

    
    mysqli_close($conn);

    function checkPoi($startLat, $startLng, $endLat, $endLng, $currLat, $currLng){
        $accuracyValue = 0.001;
        if(abs(($endLat-$startLat)*($currLng-$startLng)-($endLng-$startLng)*($currLat - $startLat))<$accuracyValue){
            return true;
        }else{
            return false;
        }
    }

    //function checkPoi($startLat, $startLng, $endLat, $endLng, $currLat, $currLng){
        //$accuracyValue = 0.001;
        //if(abs(($endLat-$startLat)*($currLng-$startLng)-($endLng-$startLng)*($currLat - $startLat))<$accuracyValue){
            //return true;
        //}else{
           // return false;
        //}
    //}
?>