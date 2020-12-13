<?php
    //Connection to database
    include 'DbConnection.php';
    $selectpois = "SELECT * FROM pointsofinterest";
    $poisset = mysqli_query($conn, $selectpois) or die("database error:". mysqli_error($conn));

    $pois = array();
    while( $rows = mysqli_fetch_assoc($poisset) ) {
        $pois[] = $rows;
    }

    mysqli_close($conn);

?>