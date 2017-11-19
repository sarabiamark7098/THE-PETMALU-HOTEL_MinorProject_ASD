<?php
    include 'connection.php';

    if(isset($_GET['booking_id'])) {
        $booking_id = $_GET['booking_id'];
    }

    if(isset($_GET['date_no'])) {
        $date_no = $_GET['date_no'];
    }

    if(isset($_GET['guest_id'])) {
        $guest_id = $_GET['guest_id'];
    }

    if(isset($_GET['room_no'])) {
        $room_no = $_GET['room_no'];
    }

    if(isset($booking_id) && isset($date_no) && isset($guest_id) && isset($room_no)) {
        $queryDeleteBooking = "DELETE FROM booking WHERE booking_id = $booking_id";
        $resultDeleteBooking = mysqli_query($connection, $queryDeleteBooking);
        echo $queryDeleteBooking."<br>";

        $queryDeleteDate = "DELETE FROM booking_date WHERE date_no = $date_no";
        $resultDeleteDate = mysqli_query($connection, $queryDeleteDate);
        echo $queryDeleteDate."<br>";

        $querDeleteGuest = "DELETE FROM guest WHERE guest_id = $guest_id";
        $resultDeleteGuest = mysqli_query($connection, $querDeleteGuest);
        echo $querDeleteGuest."<br>";

        $queryUpdateRoomAvail = "UPDATE avail SET avail = 0 WHERE room_no = $room_no";
        $resultUpdateRoomAvail = mysqli_query($connection, $queryUpdateRoomAvail);
        echo $queryUpdateRoomAvail."<br>";

        if($resultDeleteBooking && $resultDeleteDate && $resultDeleteGuest) {
            header("Location: booking.php");
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    mysqli_close($connection);
?>