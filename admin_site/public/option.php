<?php
    include 'connection.php';

    $now = date("Y-m-d");

    if($_GET['option'] === 'all') {
        //Table 
        // 2. Perform database query
        $query = "SELECT e.booking_id, d.`guest_id`, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`date_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name` 
        FROM
        `booking_date` a,
        `room` b,
        `hotel` c,
        `guest` d,
        `booking` e,
        `room_type` f,
        `type` g,
        `avail` h
        WHERE
        a.`date_no` = e.`date_no` AND
        b.`room_no` = e.`room_no` AND
        c.`hotel_id` = e.`hotel_id` AND
        d.`guest_id` = e.`guest_id` AND
        b.`room_no` = f.`room_no` AND
        f.`type_no` = g.`type_no` AND
        b.`room_no` = h.`room_no` AND
        e.`confirm` = 1
        ";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        //3. Use return data (if any)
        while($row = mysqli_fetch_assoc($result)) {
            //output data from each row
            echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
            <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
            <td style='font-size: 12px;'>". $row['address']."</td>
            <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
            <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
            <td style='font-size: 12px;'>". $row['check_in'] ."</td>
            <td style='font-size: 12px;'>". $row['check_out'] ."</td>
            <td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'>N/A</td>
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
            room_no={$row['room_no']}'>
            <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'>
            </a>
            </td>";
        }
        mysqli_free_result($result);
    }
    
    if($_GET['option'] === 'in') {
        //Table 
        // 2. Perform database query
        $query = "SELECT e.booking_id, d.`guest_id`, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`date_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name` 
        FROM
        `booking_date` a,
        `room` b,
        `hotel` c,
        `guest` d,
        `booking` e,
        `room_type` f,
        `type` g,
        `avail` h
        WHERE
        a.`date_no` = e.`date_no` AND
        b.`room_no` = e.`room_no` AND
        c.`hotel_id` = e.`hotel_id` AND
        d.`guest_id` = e.`guest_id` AND
        b.`room_no` = f.`room_no` AND
        f.`type_no` = g.`type_no` AND
        b.`room_no` = h.`room_no` AND
        e.`confirm` = 1 AND 
        a.`check_in` = '$now';
        ";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        //3. Use return data (if any)
        while($row = mysqli_fetch_assoc($result)) {
            //output data from each row
            echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
            <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
            <td style='font-size: 12px;'>". $row['address']."</td>
            <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
            <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
            <td style='font-size: 12px;'>". $row['check_in'] ."</td>
            <td style='font-size: 12px;'>". $row['check_out'] ."</td>
            <td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'>N/A</td>
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
            room_no={$row['room_no']}'>
            <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'>
            </a>
            </td>";
        }
        mysqli_free_result($result);
    }

    if($_GET['option'] === 'out') {
        //Table 
        // 2. Perform database query
        $query = "SELECT e.booking_id, d.`guest_id`, d.`firstname`, d.`middle_Initial`, d.`lastname`, d.`address`, d.`contact_no`, a.`date_no`, a.`booking_date`, a.`check_in`, a.`check_out`, b.`room_no`, g.`type_name` 
        FROM
        `booking_date` a,
        `room` b,
        `hotel` c,
        `guest` d,
        `booking` e,
        `room_type` f,
        `type` g,
        `avail` h
        WHERE
        a.`date_no` = e.`date_no` AND
        b.`room_no` = e.`room_no` AND
        c.`hotel_id` = e.`hotel_id` AND
        d.`guest_id` = e.`guest_id` AND
        b.`room_no` = f.`room_no` AND
        f.`type_no` = g.`type_no` AND
        b.`room_no` = h.`room_no` AND
        e.`confirm` = 1 AND 
        a.`check_out` = '$now';
        ";
        $result = mysqli_query($connection, $query);
        if(!$result) {
            die("Database query failed.");
        }
        //3. Use return data (if any)
        while($row = mysqli_fetch_assoc($result)) {
            //output data from each row
            echo "<tr><td style='font-size: 12px;'>". $row['booking_id'] ."</td>
            <td style='font-size: 12px;'>". $row['firstname'] ."<br>". $row['middle_Initial']."<br>".$row['lastname']."</td>
            <td style='font-size: 12px;'>". $row['address']."</td>
            <td style='font-size: 12px;'>". $row['contact_no'] ."</td>
            <td style='font-size: 12px;'>". $row['booking_date'] ."</td>
            <td style='font-size: 12px;'>". $row['check_in'] ."</td>
            <td style='font-size: 12px;'>". $row['check_out'] ."</td>
            <td style='font-size: 12px;'>". $row['room_no'] ."</td>
            <td style='font-size: 12px;'>". $row['type_name'] ."</td>
            <td style='font-size: 12px;'>N/A</td>
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
            room_no={$row['room_no']}'>
            <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'>
            </a>
            </td>";
        }
        mysqli_free_result($result);
    }

?>