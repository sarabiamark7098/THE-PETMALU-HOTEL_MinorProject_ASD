<?php
    include 'connection.php';

    $room_no; $type_name;
    if(isset($_GET['room_no'])) {
        $room_no = $_GET['room_no'];
    }

    if(isset($_GET['type_name'])) {
        $type_name = $_GET['type_name'];
    }

    $queryDeleteRoom  = "DELETE FROM room WHERE room_no = $room_no;";
    $resultDeleteRoom = mysqli_query($connection, $queryDeleteRoom);

    $queryDeleteRoomType = "DELETE FROM room_type WHERE room_no = $room_no";
    $resultDeleteRoomType = mysqli_query($connection, $queryDeleteRoomType);

    $queryGetType_no  = "SELECT type_no FROM type WHERE type_name = '{$type_name}' LIMIT 1";
    $resultGetType_no = mysqli_query($connection, $queryGetType_no);

    $type_no;

    while($row = mysqli_fetch_assoc($resultGetType_no)) {
        $type_no = $row['type_no'];
    }

    if($resultDeleteRoom && $resultDeleteRoomType) {
        echo "success";
        header("Location: room.php");
    }else {
        echo "failed";
    }



?>