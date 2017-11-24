<?php
     include 'connection.php';

    if(isset($_GET['booking_id'])){
        $booking_id = test_input($_GET['booking_id']);
        echo $booking_id."<br>";
        $query  = "UPDATE booking SET ";
        $query .= "confirm = 1 ";
        $query .= "WHERE booking_id = ".$booking_id;
        echo $query."<br>";
        $result = mysqli_query($connection, $query);
    }

    if(isset($_GET['payment_no'])) {
        $payment_no = $_GET['payment_no'];
        echo $payment_no."<br>";
        $queryUpdatePayment  = "UPDATE payment SET ";
        $queryUpdatePayment .= "status = 'OK' ";
        $queryUpdatePayment .= "WHERE payment_no = ".$payment_no;
        echo $queryUpdatePayment."<br>";
        $resultUpdatePayment = mysqli_query($connection, $queryUpdatePayment);
    }

    if($result && $resultUpdatePayment) {
        header("Location: confirmation.php");
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>