<?php
    
    //Connection to database
    include 'Scripts/DbConnection.php';
    
    //To store current user tour start poi
    $guidesGuidedToursStartPoi = array();
    //To store current user tour end poi
    $guidesGuidedToursEndPoi = array();
    //Customer is connected
    if (isset($_SESSION['currentGuideId'])){
        $CurrGuideId=$_SESSION['currentGuideId'];
        //Find Latest Guided Tour
        //Array to use
        $guidesGuidedTours = array();
        //Query
        $qrCurrentTour = "SELECT * FROM guidedtours WHERE GuidedTourVehicleGuide = '$CurrGuideId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourRes = mysqli_query($conn, $qrCurrentTour);
        $qrCurrentTourRCount = mysqli_num_rows($qrCurrentTourRes); 

        //Insert records found to array
        if ($qrCurrentTourRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourRes)){
                $guidesGuidedTours[] = $row;
            }
        }
        
        //Find latest tour start and end pois for customer
        //Find current tour Start Poi
        $qrCurrentTourStartPoi = "SELECT pointsofinterest.PoiId as startPoiId, pointsofinterest.PoiName as startPoiName, pointsofinterest.PoiAddress as startPoiAddress, pointsofinterest.PoiLatitude as startPoiLatidute, pointsofinterest.PoiLongitude as startPoiLongitude, pointsofinterest.PoiDetailedInfo as startPoiDetailedInfo, pointsofinterest.PoiPhotoName as startPoiPhotoName,  pointsofinterest.PoiPhotoPath as startPoiPhotoPath  FROM pointsofinterest JOIN guidedtours ON pointsofinterest.PoiId = guidedtours.GuidedTourStartPoi WHERE guidedtours.GuidedTourVehicleGuide = '$CurrGuideId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourStartPoiRes = mysqli_query($conn, $qrCurrentTourStartPoi);
        $qrCurrentTourStartPoiRCount = mysqli_num_rows($qrCurrentTourStartPoiRes); 

        //Insert records found to array
        if ($qrCurrentTourStartPoiRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourStartPoiRes)){
                $guidesGuidedToursStartPoi[] = $row;
            }
        }
        
        //Find current tour End Poi
        $qrCurrentTourEndPoi = "SELECT pointsofinterest.PoiId as endPoiId, pointsofinterest.PoiName as endPoiName, pointsofinterest.PoiAddress as endPoiAddress, pointsofinterest.PoiLatitude as endPoiLatidute, pointsofinterest.PoiLongitude as endPoiLongitude, pointsofinterest.PoiDetailedInfo as endPoiDetailedInfo, pointsofinterest.PoiPhotoName as endPoiPhotoName,  pointsofinterest.PoiPhotoPath as endPoiPhotoPath  FROM pointsofinterest JOIN guidedtours ON pointsofinterest.PoiId = guidedtours.GuidedTourEndPoi WHERE guidedtours.GuidedTourVehicleGuide = '$CurrGuideId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourEndPoiRes = mysqli_query($conn, $qrCurrentTourEndPoi);
        $qrCurrentTourEndPoiRCount = mysqli_num_rows($qrCurrentTourEndPoiRes); 

        //Insert records found to array
        if ($qrCurrentTourEndPoiRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourEndPoiRes)){
                $guidesGuidedToursEndPoi[] = $row;
            }
        }
        
        //Start End Pois coords
        $startLat = $guidesGuidedToursStartPoi[0]['startPoiLatidute'];
        $startLng = $guidesGuidedToursStartPoi[0]['startPoiLongitude'];
        $endLat = $guidesGuidedToursEndPoi[0]['endPoiLatidute'];
        $endLng = $guidesGuidedToursEndPoi[0]['endPoiLongitude'];
        //Find all Other Pois
        //Array to use
        $allOtherPois = array();
        //Start end pois
        $foundStartPoiId = $guidesGuidedToursStartPoi[0]['startPoiId'];
        $foundEndPoiId = $guidesGuidedToursEndPoi[0]['endPoiId'];
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
        $guidesGuidedToursVehicle = array();
        //Query
        $qrCurrentTourVehicle = "SELECT vehicles.VehicleId as tourVehicleId, vehicles.VehicleNumber as tourVehicleNumber, vehicles.VehiclePlateNumber as tourVehiclePlateNumber FROM vehicles JOIN guidedtours ON vehicles.VehicleId = guidedtours.GuidedTourVehicle WHERE guidedtours.GuidedTourVehicleGuide = '$CurrGuideId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourVehicleRes = mysqli_query($conn, $qrCurrentTourVehicle);
        $qrCurrentTourVehicleRCount = mysqli_num_rows($qrCurrentTourVehicleRes); 

        //Insert records found to array
        if ($qrCurrentTourVehicleRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourVehicleRes)){
                $guidesGuidedToursVehicle[] = $row;
            }
        }
        
        //Find current Guide
        //Array to use
        $guidesGuidedToursDriver = array();
        //Query
        $qrCurrentTourDriver = "SELECT drivers.DriverFirstName as tourDriverFirstName, drivers.DriverLastName as tourDriverLastName, drivers.DriverEmailAddress as tourDriverEmailAddress FROM drivers JOIN guidedtours ON drivers.DriverId = guidedtours.GuidedTourVehicleDriver WHERE guidedtours.GuidedTourVehicleGuide = '$CurrGuideId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourDriverRes = mysqli_query($conn, $qrCurrentTourDriver);
        $qrCurrentTourDriverRCount = mysqli_num_rows($qrCurrentTourDriverRes); 

        //Insert records found to array
        if ($qrCurrentTourDriverRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourDriverRes)){
                $guidesGuidedToursDriver[] = $row;
            }
        }
        
        //Find current Customer
        //Array to use
        $guidesGuidedToursCustomer = array();
        //Query
        $qrCurrentTourCustomer= "SELECT useraccounts.UserFirstName as tourCustomerFirstName, useraccounts.UserLastName as tourCustomerLastName, useraccounts.UserEmail as tourCustomerEmailAddress FROM useraccounts JOIN guidedtours ON useraccounts.UserId = guidedtours.GuidedTourCustomer WHERE guidedtours.GuidedTourVehicleDriver = '$CurrGuideId' ORDER BY GuidedTourDate DESC";
        $qrCurrentTourCustomerRes = mysqli_query($conn, $qrCurrentTourCustomer);
        $qrCurrentTourCustomerRCount = mysqli_num_rows($qrCurrentTourCustomerRes); 

        //Insert records found to array
        if ($qrCurrentTourCustomerRCount!=0){
            while($row = mysqli_fetch_assoc($qrCurrentTourCustomerRes)){
                $guidesGuidedToursCustomer[] = $row;
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

?>