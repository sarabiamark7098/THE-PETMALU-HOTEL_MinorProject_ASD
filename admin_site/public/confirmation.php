<?php
    // 1. Create a database connection
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "asdminorproject";
    $connection = mysqli_connect($dbhost, $dbuser, $dbpass,  $dbname);

    // Test if connection occurred. 
    if(mysqli_connect_errno()) {
        die("Database connection failed: " . 
            mysqli_connect_error() . 
            " (" . mysqli_connect_errno() . ")"
        );
    }
?>

<?php
    // 2. Perform database query
    $query = "SELECT * FROM guest";
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Database query failed.");
    }

?>

<?php
    //codes from w3schools

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Confirmation | The PETMALU Hotel Admin</title>
<link rel="stylesheet" href="stylesheets/style.css">
<link rel="stylesheet" href="stylesheets/bootstrap.css">
<link rel="stylesheet" href="stylesheets/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/bootstrap-theme.css">
<link rel="stylesheet" href="stylesheets/bootstrap-theme.min.css">
</head>
<body>
    <div id="header" class="col-sm-12">
        <div class="container-fluid">
            <h1>The <span id="highlight-header">PETMALU</span> Hotel Admin</h1>
        </div>
    </div>
    <div id="side-nav" class="col-sm-2">
        <div class="">
            <div class="navigation" id="navigation">
                <center>
                    <ul>
                        <li><a href="home.php"><img src="images/Home_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Home</a></li>
                        <li><a href="booking.php"><img src="images/Booking_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Bookings</a></li>
                        <li><a href="confirmation.php"><img src="images/Checked_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Confirmation</a></li>
                        <li><a href="room.php"><img src="images/Room_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Room</a></li>
                        <li><a href=""><img src="images/Logout Rounded Up_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Logout</a></li>
                    </ul>
                </center>
            </div>
        </div>
    </div>
    <div id="content" class="col-sm-10">
    <h2>Confirmation</h2>
    <div class="container-fluid" id="table">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="font-size: 13px;">#</th>
                            <th style="font-size: 13px;">Guest name</th>
                            <th style="font-size: 13px;">Address</th>
                            <th style="font-size: 13px;">Contact Number</th>
                            <th style="font-size: 13px;">Reservation</th>
                            <th style="font-size: 13px;">Check in</th>
                            <th style="font-size: 13px;">Check out</th>
                            <th style="font-size: 13px;">Room no.</th>
                            <th style="font-size: 13px;">Type</th>
                            <th style="font-size: 13px;">Payment</th>
                            <th style="font-size: 13px;">Confirm</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php //Table 
                            // 2. Perform database query
                            $query = "SELECT * FROM guest";
                            $result = mysqli_query($connection, $query);

                            if(!$result) {
                                die("Database query failed.");
                            }

                            //3. Use return data (if any)
                            while($row = mysqli_fetch_assoc($result)) {
                                //output data from each row
                                $id = test_input($row['guest_id']);
                                $firstname = test_input($row['firstname']);
                                $lastname = test_input($row['lastname']);
                                $middle_Initial = test_input($row['middle_Initial']);
                                $guest_name = $firstname . "<br>" . $middle_Initial . ".<br>" . $lastname;
                                $address = test_input($row['address']);
                                $contact_no = test_input($row['contact_no']);
                                $email_add =  test_input($row['email_address']);
                                $mail = test_input($row['mail']);

                                echo "<tr><td style='font-size: 12px;'>". $id ."</td>
                                <td style='font-size: 12px;'>". $guest_name ."</td>
                                <td style='font-size: 12px;'>". $address ."</td>
                                <td style='font-size: 12px;'>". $contact_no ."</td>
                                <td style='font-size: 12px;'>N/A</td>
                                <td style='font-size: 12px;'>N/A</td>
                                <td style='font-size: 12px;'>N/A</td>
                                <td style='font-size: 12px;'>N/A</td>
                                <td style='font-size: 12px;'>N/A</td>
                                <td style='font-size: 12px;'>N/A</td>
                                <td>
                                <a href='confirmed.php?id={$id}' class='btn btn-default'><img src='images/Checked_48px.png' style='width: 24px;'height: 24px;></a>
                                </td>";
                            }
                            mysqli_free_result($result);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
// 5. Close database connection
mysqli_close($connection);
?>