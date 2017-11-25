<?php 
    session_start();

    include 'connection.php';

    if(isset($_GET['type_name'])) {
        $type_name = $_GET['type_name'];
    }else {
        echo "failed" + $_GET['type_name'];
    }

    $check_in = $_SESSION['check_in'];
    $check_out = $_SESSION['check_out'];

    if($type_name === 'all') {
        $query = "SELECT room.`room_no`, type.`type_name`, type.`image_data`, type.`price` 
        FROM 
        room,
        `type`,
        room_type
        WHERE
        room.`room_no` = room_type.`room_no` AND
        type.`type_no`= room_type.`type_no` AND
        room.`room_no` NOT IN(SELECT DISTINCT booking.`room_no` FROM
        booking,
        booking_date
        WHERE 
        booking.`date_no` = booking_Date.`date_no` AND
        (booking_Date.`check_in` >= '$check_in' AND booking_date.`check_in` < '$check_out')
        OR
        (booking_Date.`check_out` >= '$check_in' AND booking_Date.`check_out` < '$check_out')
        )   
        ORDER BY room.`room_no` ASC";

        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) {
            $room_no = $row['room_no'];
            echo "<tr><td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'><img width='100' height='100' src='data:image;base64,". $row['image_data'] ."'></td>
            <td style='font-size: 12px;'>". $row['price'] ."</td>
            <td>
            <a href='customer_Info.php?room_no=$room_no' class='btn btn-default'>
            <img src='images/Book_48px.png' style='width: 20px; height: 20px;'>Book</a>
            </td>";
        }
        mysqli_free_result($result);
    }else {
        $query = "SELECT room.`room_no`, type.`type_name`, type.`image_data`, type.`price` 
        FROM 
        room,
        `type`,
        room_type
        WHERE
        room.`room_no` = room_type.`room_no` AND
        type.`type_no`= room_type.`type_no` AND
        room.`room_no` NOT IN(SELECT DISTINCT booking.`room_no` FROM
        booking,
        booking_date
        WHERE 
        booking.`date_no` = booking_Date.`date_no` AND
        (booking_Date.`check_in` >= '$check_in' AND booking_date.`check_in` < '$check_out')
        OR
        (booking_Date.`check_out` >= '$check_in' AND booking_Date.`check_out` < '$check_out')
        )
        AND type.`type_name` = '$type_name' ORDER BY room.`room_no` ASC";
        /*
        $query = "SELECT DISTINCT a.`room_no`, c.`type_name`, c.`image_data`, c.`price`, d.`avail`
        FROM 
        `room` a, 
        `room_type` b, 
        `type` c,
        `avail` d
        WHERE 
        a.`room_no` = b.`room_no` AND
        b.`type_no` = c.`type_no` AND
        a.`room_no` = d.`room_no` AND
        c.type_name = '$type_name' AND
        d.avail = 0 ORDER BY a.`room_no` ASC";
        */
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) {
            $room_no = $row['room_no'];
            echo "<tr><td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'><img width='100' height='100' src='data:image;base64,". $row['image_data'] ."'></td>
            <td style='font-size: 12px;'>". $row['price'] ."</td>
            <td>
            <a href='customer_Info.php?room_no=$room_no' class='btn btn-default'>
            <img src='images/Book_48px.png' style='width: 20px; height: 20px;'>Book</a>
            </td>";
        }
        mysqli_free_result($result);
    }
?>
