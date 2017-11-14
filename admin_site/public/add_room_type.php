<?php
    include 'connection.php';

    $room_no = 0;
    $room_type = ""; 
    $type_no = 0;

    if(isset($_POST['room_no'])){
        $room_no = $_POST['room_no'];
    }

    if(isset($_POST['room_type'])){
        $room_type = test_input($_POST['room_type']);
    }

    $getHotel_ID = "SELECT hotel_id FROM hotel LIMIT 1";
    $result_hotel_id = mysqli_query($connection, $getHotel_ID);

    $hotel_id;

    while($row = mysqli_fetch_assoc($result_hotel_id)) {
        $hotel_id = $row['hotel_id'];
    }

    $insertRoom = "INSERT INTO room (room_no, hotel_id) VALUES ($room_no, $hotel_id)";
    $result_insert_room = mysqli_query($connection, $insertRoom);

    $type_no;

    $getType_no = "SELECT type_no FROM type WHERE type_name = '{$room_type}' LIMIT 1";
    $result_get_type_no = mysqli_query($connection, $getType_no);

    while($row = mysqli_fetch_assoc($result_get_type_no)) {
        $type_no = $row['type_no'];
    }

    $avail = 0;
    $avail_no = $room_no;

    $insert_roomAvail = "INSERT INTO avail (room_no, avail) VALUES ($avail_no, $avail)";
    $result_roomType = mysqli_query($connection, $insert_roomAvail);

    $insert_roomType = "INSERT INTO room_type (room_no, type_no) VALUES ($room_no, $type_no)";
    $result_roomType = mysqli_query($connection, $insert_roomType);

    if($result_insert_room) {
        header("Location: room.php");
    }else {
        echo "failed " . $insertRoom;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>