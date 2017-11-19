<?php include 'connection.php'?>

<?php
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
<title>Booking | The PETMALU Hotel Admin</title>
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
        <div class="container-fluid">
        <h2>Bookings</h2>
            <select name="optionBooking" onchange="showBookings(this.value)" class="form-control" style="width: 15%; float: right; margin-top: -7px;">
                <option value="null"></option>
                <option value="all">All Bookings</option>
                <option value="in">Check in Today</option>
                <option value="out">Check out Today</option>
            </select>
            <label for="choose" style="float: right; font-size: 15px;">Select Views: &nbsp;</label>
        </div>
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
                                <th style="font-size: 13px;">Action</th>
                            </tr>
                        </thead>
                        <tbody id="show-tables" style="width: 99%;">
                            <!--Ajax code auto refresh a certain section in html-->
                            <script>
                                function showBookings(str) {
                                var xhttp;    
                                if (str == "") {
                                    document.getElementById("show-tables").innerHTML = "";
                                    return;
                                }
                                xhttp = new XMLHttpRequest();
                                xhttp.onreadystatechange = function() {
                                    if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("show-tables").innerHTML = this.responseText;
                                    }
                                };
                                xhttp.open("GET", "option.php?option="+str, true);
                                    xhttp.send();
                                }
                            </script>
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