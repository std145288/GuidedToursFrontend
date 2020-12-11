<?php
    
    //Connection to database
    include 'Scripts/DbConnection.php';
    
    //To store current user tour start poi
    $driversGuidedToursStartPoi = array();
    //To store current user tour end poi
    $driversGuidedToursEndPoi = array();
    //Customer is connected
    if (isset($_SESSION['currentDriverId'])){
        $CurrDriverId=$_SESSION['currentDriverId'];
        //Find Latest Guided Tour
        //Array to use
        $driversGuidedTours = array();
        //Query
        $qrCurrentTour = "SELECT * FROM guidedtours WHERE GuidedTourVehicleDriver = '$CurrDriverId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourRes = mysqli_query($conn, $qrCurrentTour);
        $qrCurrentTourRCount = mysqli_num_rows($qrCurrentTourRes); 

        //Insert records found to array
        if ($qrCurrentTourRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourRes)){
                $driversGuidedTours[] = $row;
            }
        }
        
        //Find latest tour start and end pois for customer
        //Find current tour Start Poi
        $qrCurrentTourStartPoi = "SELECT pointsofinterest.PoiId as startPoiId, pointsofinterest.PoiName as startPoiName, pointsofinterest.PoiAddress as startPoiAddress, pointsofinterest.PoiLatitude as startPoiLatidute, pointsofinterest.PoiLongitude as startPoiLongitude, pointsofinterest.PoiPhotoName as startPoiPhotoName,  pointsofinterest.PoiPhotoPath as startPoiPhotoPath  FROM pointsofinterest JOIN guidedtours ON pointsofinterest.PoiId = guidedtours.GuidedTourStartPoi WHERE guidedtours.GuidedTourVehicleDriver = '$CurrDriverId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourStartPoiRes = mysqli_query($conn, $qrCurrentTourStartPoi);
        $qrCurrentTourStartPoiRCount = mysqli_num_rows($qrCurrentTourStartPoiRes); 

        //Insert records found to array
        if ($qrCurrentTourStartPoiRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourStartPoiRes)){
                $driversGuidedToursStartPoi[] = $row;
            }
        }
        
        //Find current tour End Poi
        $qrCurrentTourEndPoi = "SELECT pointsofinterest.PoiId as endPoiId, pointsofinterest.PoiName as endPoiName, pointsofinterest.PoiAddress as endPoiAddress, pointsofinterest.PoiLatitude as endPoiLatidute, pointsofinterest.PoiLongitude as endPoiLongitude, pointsofinterest.PoiPhotoName as endPoiPhotoName,  pointsofinterest.PoiPhotoPath as endPoiPhotoPath  FROM pointsofinterest JOIN guidedtours ON pointsofinterest.PoiId = guidedtours.GuidedTourEndPoi WHERE guidedtours.GuidedTourVehicleDriver = '$CurrDriverId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourEndPoiRes = mysqli_query($conn, $qrCurrentTourEndPoi);
        $qrCurrentTourEndPoiRCount = mysqli_num_rows($qrCurrentTourEndPoiRes); 

        //Insert records found to array
        if ($qrCurrentTourEndPoiRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourEndPoiRes)){
                $driversGuidedToursEndPoi[] = $row;
            }
        }
        
        //Start End Pois coords
        $startLat = $driversGuidedToursStartPoi[0]['startPoiLatidute'];
        $startLng = $driversGuidedToursStartPoi[0]['startPoiLongitude'];
        $endLat = $driversGuidedToursEndPoi[0]['endPoiLatidute'];
        $endLng = $driversGuidedToursEndPoi[0]['endPoiLongitude'];
        //Find all Other Pois
        //Array to use
        $allOtherPois = array();
        //Start end pois
        $foundStartPoiId = $driversGuidedToursStartPoi[0]['startPoiId'];
        $foundEndPoiId = $driversGuidedToursEndPoi[0]['endPoiId'];
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
        
        
        //Find current tour vehicle
        //Array to use
        $driversGuidedToursVehicle = array();
        //Query
        $qrCurrentTourVehicle = "SELECT vehicles.VehicleId as tourVehicleId, vehicles.VehicleNumber as tourVehicleNumber, vehicles.VehiclePlateNumber as tourVehiclePlateNumber FROM vehicles JOIN guidedtours ON vehicles.VehicleId = guidedtours.GuidedTourVehicle WHERE guidedtours.GuidedTourVehicleDriver = '$CurrDriverId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourVehicleRes = mysqli_query($conn, $qrCurrentTourVehicle);
        $qrCurrentTourVehicleRCount = mysqli_num_rows($qrCurrentTourVehicleRes); 

        //Insert records found to array
        if ($qrCurrentTourVehicleRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourVehicleRes)){
                $driversGuidedToursVehicle[] = $row;
            }
        }
        
        //Find current Guide
        //Array to use
        $driversGuidedToursGuide = array();
        //Query
        $qrCurrentTourGuide = "SELECT guides.GuideFirstName as tourGuideFirstName, guides.GuideLastName as tourGuideLastName, guides.GuideEmailAddress as tourGuideEmailAddress FROM guides JOIN guidedtours ON guides.GuideId = guidedtours.GuidedTourVehicleGuide WHERE guidedtours.GuidedTourVehicleDriver = '$CurrDriverId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourGuideRes = mysqli_query($conn, $qrCurrentTourGuide);
        $qrCurrentTourGuideRCount = mysqli_num_rows($qrCurrentTourGuideRes); 

        //Insert records found to array
        if ($qrCurrentTourGuideRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourGuideRes)){
                $driversGuidedToursGuide[] = $row;
            }
        }
        
        //Find current Customer
        //Array to use
        $driversGuidedToursCustomer = array();
        //Query
        $qrCurrentTourCustomer= "SELECT useraccounts.UserFirstName as tourCustomerFirstName, useraccounts.UserLastName as tourCustomerLastName, useraccounts.UserEmail as tourCustomerEmailAddress FROM useraccounts JOIN guidedtours ON useraccounts.UserId = guidedtours.GuidedTourCustomer WHERE guidedtours.GuidedTourVehicleDriver = '$CurrDriverId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourCustomerRes = mysqli_query($conn, $qrCurrentTourCustomer);
        $qrCurrentTourCustomerRCount = mysqli_num_rows($qrCurrentTourCustomerRes); 

        //Insert records found to array
        if ($qrCurrentTourCustomerRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourCustomerRes)){
                $driversGuidedToursCustomer[] = $row;
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