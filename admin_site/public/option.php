<?php
    include 'connection.php';

    session_start();
    
    if($_GET['option'] === 'all') {
        $query = "SELECT e.booking_id, d.`guest_id`, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`date_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name`, i.`payment_method`, i.`status`, i.`payment_no`
                                FROM
                                `booking_date` a,
                                `room` b,
                                `hotel` c,
                                `guest` d,
                                `booking` e,
                                `room_type` f,
                                `type` g,
                                `avail` h,
                                `payment` i
                                WHERE
                                a.`date_no` = e.`date_no` AND
                                b.`room_no` = e.`room_no` AND
                                c.`hotel_id` = e.`hotel_id` AND
                                d.`guest_id` = e.`guest_id` AND
                                b.`room_no` = f.`room_no` AND
                                f.`type_no` = g.`type_no` AND
                                b.`room_no` = h.`room_no` AND
                                d.`payment_no` = i.`payment_no` AND
                                e.`confirm` = 1
        ";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
            <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
            <td style='font-size: 12px;'>". $row['address']."</td>
            <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
            <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
            <td style='font-size: 12px;'>". $row['check_in'] ."</td>
            <td style='font-size: 12px;'>". $row['check_out'] ."</td>
            <td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'>". $row['payment_method'] ."</td>
            <td style='font-size: 12px;'>". $row['status'] ."</td>
            <td>
            <a href='edit.php?
            id={$row['booking_id']}&
            firstname={$row['firstname']}&
            lastname={$row['lastname']}&
            middle={$row['middle_Initial']}&
            address={$row['address']}&
            contact={$row['contact_no']}&'>
            <img src='images/Edit_48px.png' style='width: 20px; height: 20px;'>
            </a>
            <a href='delete.php?
            booking_id={$row['booking_id']}&
            date_no={$row['date_no']}&
            guest_id={$row['guest_id']}&
            room_no={$row['room_no']}& 
            payment_no={$row['payment_no']}'>
            <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'>
            </a>
            </td>";
        }
        mysqli_free_result($result);
    }
    
    if($_GET['option'] === 'in') {
        $queryGetDate = "SELECT NOW()";
        $resultGetDate = mysqli_query($connection, $queryGetDate);
        $row = mysqli_fetch_array($resultGetDate);
        $now = $row[0];
        $now = date("Y-m-d", strtotime($now));

        $query = "SELECT e.booking_id, d.`guest_id`, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`date_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name`, i.`payment_method`, i.`status`, i.`payment_no`
                                FROM
                                `booking_date` a,
                                `room` b,
                                `hotel` c,
                                `guest` d,
                                `booking` e,
                                `room_type` f,
                                `type` g,
                                `avail` h,
                                `payment` i
                                WHERE
                                a.`date_no` = e.`date_no` AND
                                b.`room_no` = e.`room_no` AND
                                c.`hotel_id` = e.`hotel_id` AND
                                d.`guest_id` = e.`guest_id` AND
                                b.`room_no` = f.`room_no` AND
                                f.`type_no` = g.`type_no` AND
                                b.`room_no` = h.`room_no` AND
                                d.`payment_no` = i.`payment_no` AND
                                e.`confirm` = 1 AND 
                                a.`check_in` = '$now';
        ";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
            <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
            <td style='font-size: 12px;'>". $row['address']."</td>
            <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
            <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
            <td style='font-size: 12px;'>". $row['check_in'] ."</td>
            <td style='font-size: 12px;'>". $row['check_out'] ."</td>
            <td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'>". $row['payment_method'] ."</td>
            <td style='font-size: 12px;'>". $row['status'] ."</td>
            <td>
            <a href='edit.php?
            id={$row['booking_id']}&
            firstname={$row['firstname']}&
            lastname={$row['lastname']}&
            middle={$row['middle_Initial']}&
            address={$row['address']}&
            contact={$row['contact_no']}&'>
            <img src='images/Edit_48px.png' style='width: 20px; height: 20px;'>
            </a>
            <a href='delete.php?
            booking_id={$row['booking_id']}&
            date_no={$row['date_no']}&
            guest_id={$row['guest_id']}&
            room_no={$row['room_no']}& 
            payment_no={$row['payment_no']}'>
            <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'>
            </a>
            </td>";
        }
        mysqli_free_result($result);
    }

    if($_GET['option'] === 'out') {
        $queryGetDate = "SELECT NOW()";
        $resultGetDate = mysqli_query($connection, $queryGetDate);
        $row = mysqli_fetch_array($resultGetDate);
        $now = $row[0];
        $now = date("Y-m-d", strtotime($now));

        $query = "SELECT e.booking_id, d.`guest_id`, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`date_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name`, i.`payment_method`, i.`status`, i.`payment_no`
                                FROM
                                `booking_date` a,
                                `room` b,
                                `hotel` c,
                                `guest` d,
                                `booking` e,
                                `room_type` f,
                                `type` g,
                                `avail` h,
                                `payment` i
                                WHERE
                                a.`date_no` = e.`date_no` AND
                                b.`room_no` = e.`room_no` AND
                                c.`hotel_id` = e.`hotel_id` AND
                                d.`guest_id` = e.`guest_id` AND
                                b.`room_no` = f.`room_no` AND
                                f.`type_no` = g.`type_no` AND
                                b.`room_no` = h.`room_no` AND
                                d.`payment_no` = i.`payment_no` AND
                                e.`confirm` = 1 AND 
                                a.`check_out` = '$now';
        ";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        while($row = mysqli_fetch_assoc($result)) { 
            echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
            <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
            <td style='font-size: 12px;'>". $row['address']."</td>
            <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
            <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
            <td style='font-size: 12px;'>". $row['check_in'] ."</td>
            <td style='font-size: 12px;'>". $row['check_out'] ."</td>
            <td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'>". $row['payment_method'] ."</td>
            <td style='font-size: 12px;'>". $row['status'] ."</td>
            <td>
            <a href='edit.php?
            id={$row['booking_id']}&
            firstname={$row['firstname']}&
            lastname={$row['lastname']}&
            middle={$row['middle_Initial']}&
            address={$row['address']}&
            contact={$row['contact_no']}&'>
            <img src='images/Edit_48px.png' style='width: 20px; height: 20px;'>
            </a>
            <a href='delete.php?
            booking_id={$row['booking_id']}&
            date_no={$row['date_no']}&
            guest_id={$row['guest_id']}&
            room_no={$row['room_no']}& 
            payment_no={$row['payment_no']}'>
            <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'>
            </a>
            </td>";
        }
        mysqli_free_result($result);
    }

?>