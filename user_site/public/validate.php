<?php
    session_start();

    include 'connection.php';

    $success = false;

    $check_in = $_SESSION['check_in'];
    $check_out = $_SESSION['check_out'];
    $room_no = $_SESSION['room_no'];
    $date_no = 0;
    
    if(isset($_GET['guest-submit'])) {

        $queryGetHotelId = "SELECT hotel_id FROM hotel";
        echo $queryGetHotelId."<br>";
        $resultGetHotelId = mysqli_query($connection, $queryGetHotelId);
        while($row = mysqli_fetch_assoc($resultGetHotelId)) {
            $hotel_id = $row['hotel_id'];
        }

        echo $hotel_id."<br>";

        if(isset($check_in) && isset($check_out)) {
            $booking_date = date("Y-m-d");
            $queryInsertDate  = "INSERT INTO booking_date (check_in, check_out, booking_date) ";
            $queryInsertDate .= "VALUES ";
            $queryInsertDate .= "('{$check_in}', '{$check_out}', '{$booking_date}')";
            echo $queryInsertDate."<br>";
            $resultInsertDate = mysqli_query($connection, $queryInsertDate);

            $queryGetDateNo = "SELECT date_no FROM booking_date";
            echo $queryGetDateNo."<br>";
            $resultGetDateNo = mysqli_query($connection, $queryGetDateNo);
            while($row = mysqli_fetch_assoc($resultGetDateNo)) {
               $date_no = $row['date_no'];
            }
            echo $date_no."<br >";
        }

        if(isset($room_no)) {
            $queryUpdateRoomAvail  = "UPDATE avail SET ";
            $queryUpdateRoomAvail .= "avail = 1 ";
            $queryUpdateRoomAvail .= "WHERE room_no = $room_no";
            echo $queryUpdateRoomAvail."<br>";
            $resultUpdateRoomAvail = mysqli_query($connection, $queryUpdateRoomAvail);

            $queryInsertDateAvail  = "INSERT INTO date_avail ";
            $queryInsertDateAvail .= "(date_no, room_no) ";
            $queryInsertDateAvail .= "VALUES ";
            $queryInsertDateAvail .= "($date_no, $room_no)";
            $resultInsertDateAvail = mysqli_query($connection, $queryInsertDateAvail);
        }

        if(isset($_GET['firstname'])){
            $firstname = $_GET['firstname'];
            $success = true;
        }
        if(isset($_GET['lastname'])){
            $lastname = $_GET['lastname'];
            $success = true;
        }

        if(isset($_GET['middleI'])){
            $middleI = $_GET['middleI'];
            $success = true;
        }

        if(isset($_GET['address'])){
            $address = $_GET['address'];
            $success = true;
        }

        if(isset($_GET['contact_no'])){
            $contact_no = $_GET['contact_no'];
            $success = true;
        }

        if(isset($_GET['email_add'])){
            $email_add = $_GET['email_add'];
            $success = true;
        }

        if(isset($_GET['mail'])){
            $mail = $_GET['mail'];
            $success = true;
        }

        if($success) {
            $queryInsertGuest  = "INSERT INTO guest (firstname, lastname, middle_Initial, address, contact_no, email_address, mail) "; 
            $queryInsertGuest .= "VALUES ('".$firstname."', '".$lastname."', '".$middleI."', '".$address."', '".$contact_no."', '".$email_add."', '".$mail."')";
            echo $queryInsertGuest."<br>";
            $resultInsertGuest = mysqli_query($connection, $queryInsertGuest);

            $queryGetGuestID = "SELECT guest_id FROM guest";
            echo $queryGetGuestID."<br>";
            $resultGetGuestId = mysqli_query($connection, $queryGetGuestID);
            while($row = mysqli_fetch_assoc($resultGetGuestId)) {
                $guest_id = $row['guest_id'];
            }
            echo $guest_id."<br>";
        }

        if(isset($date_no) && isset($room_no) && isset($guest_id) && isset($hotel_id)) {
            $queryInsetBooking  = "INSERT INTO booking (room_no, hotel_id, date_no, guest_id, confirm) ";
            $queryInsetBooking .= "VALUES ";
            $queryInsetBooking .= "(".$room_no.", ".$hotel_id.", ".$date_no.", ".$guest_id.", 0)";
            echo $queryInsetBooking."<br>";
            $resultInsertBooking = mysqli_query($connection, $queryInsetBooking);
        }

    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   
?>