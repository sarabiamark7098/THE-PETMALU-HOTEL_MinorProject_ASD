<?php 
    session_start();

    include 'connection.php';

    if(isset($_GET['type_name'])) {
        $type_name = $_GET['type_name'];
    }else {
        echo "failed" + $_GET['type_name'];
    }
    $query = "SELECT a.`room_no`, c.`type_name`, c.`image_data`, c.`price`, d.`avail`
    FROM 
    `room` a, 
    `room_type` b, 
    `type` c,
    `avail` d
    WHERE 
    a.`room_no` = b.`room_no` AND
    b.`type_no` = c.`type_no` AND
    a.`room_no` = d.`room_no` AND
    c.type_name = '$type_name' ORDER BY a.`room_no` ASC";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        die("Database query failed.");
    }
    while($row = mysqli_fetch_assoc($result)) {
        $room_no = $row['room_no'];
        $_SESSION['room_no'] = $room_no;
        echo "<tr><td style='font-size: 12px;'>". $row['room_no'] ."</td>
        <td style='font-size: 12px;'>". $row['type_name'] ."</td>
        <td style='font-size: 12px;'><img width='100' height='100' src='data:image;base64,". $row['image_data'] ."'></td>
        <td style='font-size: 12px;'>". $row['price'] ."</td>
        <td style='font-size: 12px;'>" . $row['avail'] . "</td>
        <td>
        <a href='customer_Info.php'>
        <img src='images/Book_48px.png' style='width: 20px; height: 20px;'></a>
        </td>";
    }
    mysqli_free_result($result);
?>
