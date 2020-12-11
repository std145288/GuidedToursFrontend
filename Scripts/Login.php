<?php
    //Έναρξη συνόδου
ob_start();
session_start();
    // Σύνδεση στην βάση δεδομένων
    //Connection to database
    include 'DbConnection.php';

    //Στοιχεία σύνδεσης
    //$conn = $_SESSION['connection'];

	$emailAdrressInput=$_POST['UserAccountEmailField'];
	$passwordInput=$_POST['UserAccountPasswordField'];

    //Query for customers
    $qrSearchCustomer = "SELECT * FROM useraccounts WHERE UserEmail = '$emailAdrressInput'";
    $qrSearchCustomerRes = mysqli_query($conn, $qrSearchCustomer);
    $qrSearchCustomerRCount = mysqli_num_rows($qrSearchCustomerRes);

    //Query for guides
    $qrSearchGuide = "SELECT * FROM guides WHERE GuideEmailAddress = '$emailAdrressInput'";
    $qrSearchGuideRes = mysqli_query($conn, $qrSearchGuide);
    $qrSearchGuideRCount = mysqli_num_rows($qrSearchGuideRes);

    //Query for drivers
    $qrSearchDriver = "SELECT * FROM drivers WHERE DriverEmailAddress = '$emailAdrressInput'";
    $qrSearchDriverRes = mysqli_query($conn, $qrSearchDriver);
    $qrSearchDriverRCount = mysqli_num_rows($qrSearchDriverRes);


    
    //Message that user not found
    if ($qrSearchCustomerRCount == 0 and $qrSearchGuideRCount == 0 and $qrSearchDriverRCount == 0){
		echo '<html><meta charset="UTF-8"><script language="javascript">alert("User not found with this email address!"); document.location="../Index.php";</script></html>';
		exit();
	}

     //Customer info that saccesfully connected
    if ($qrSearchCustomerRCount != 0){
		$customerRecord = mysqli_fetch_row($qrSearchCustomerRes);

		$customerId = $customerRecord[0];
		$customerFName = $customerRecord[1];
		$customerLNname = $customerRecord[2];
		$customerEmail = $customerRecord[3];
		$customerPassword = $customerRecord[4];

        // Έλεγχος password συνδρομητή
		if($passwordInput != $customerPassword){
			echo '<html><meta charset="UTF-8"><script language="javascript">alert("Wrong password! Try again"); document.location="../Index.php";</script></html>';
			exit();
		}
    else{

            $_SESSION['currentCustomerId'] = $customerId;
			$_SESSION['currentCustomerFirstName'] = $customerFName;
			$_SESSION['currentCustomerLastName'] = $customerLNname;
			$_SESSION['currentCustomerEmail'] = $customerEmail;


            //Εδώ να πηγαίνει στο χάρτη για ατον πελάτη
			header("Location: ../Guidedtour.php");
		}
	}

    //Guide info that saccesfully connected
    if ($qrSearchGuideRCount != 0){
		$guideRecord = mysqli_fetch_row($qrSearchGuideRes);

		$guideId = $guideRecord[0];
		$guideFName = $guideRecord[1];
		$guideLNname = $guideRecord[2];
		$guideEmail = $guideRecord[3];
		$guidePassword = $guideRecord[4];

        // Έλεγχος password συνδρομητή
		if($passwordInput != $guidePassword){
			echo '<html><meta charset="UTF-8"><script language="javascript">alert("Wrong password! Try again"); document.location="../Index.php";</script></html>';
			exit();
		}
    else{

            $_SESSION['currentGuideId'] = $guideId;
			$_SESSION['currentGuideFirstName'] = $guideFName;
			$_SESSION['currentGuideLastName'] = $guideLNname;
			$_SESSION['currentGuideEmail'] = $guideEmail;


            //Εδώ να πηγαίνει στο χάρτη για τον ξεναγό
			header("Location: ../Guidedtour.php");
		}
	}

    //Driver info that saccesfully connected
    if ($qrSearchDriverRCount != 0){
		$driverRecord = mysqli_fetch_row($qrSearchDriverRes);

		$driverId = $driverRecord[0];
		$driverFName = $driverRecord[1];
		$driverLNname = $driverRecord[2];
		$driverEmail = $driverRecord[3];
		$driverPassword = $driverRecord[4];

        // Έλεγχος password συνδρομητή
		if($passwordInput != $driverPassword){
			echo '<html><meta charset="UTF-8"><script language="javascript">alert("Wrong password! Try again"); document.location="../Index.php";</script></html>';
			exit();
		}
    else{

            $_SESSION['currentDriverId'] = $driverId;
			$_SESSION['currentDriverFirstName'] = $driverFName;
			$_SESSION['currentDriverLastName'] = $driverLNname;
			$_SESSION['currentDriverEmail'] = $driverEmail;


            //Εδώ να πηγαίνει στο χάρτη για τον οδηγό
			header("Location: ../Guidedtour.php");
		}
	}

    
ob_end_flush();        
mysqli_close($conn);


?>