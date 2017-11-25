<?php
    session_start();

    include 'connection.php';     
    $now = time();
    if(isset($_GET['check-date'])) {
        if($_GET['check-in'] === '' && $_GET['check-out'] === '') {
            echo "<script type='text/javascript'>
            window.alert('Walay unod master')
            </script>";
        }elseif ($now > strtotime($_GET['check-in'])) {
            echo "<script type='text/javascript'>
            window.alert('Humana na ni sya Lodi')
            </script>";
        }elseif (strtotime($_GET['check-out']) < strtotime($_GET['check-in'])) {
            echo "<script type='text/javascript'>
            window.alert('Layo na kaayo siya kol')
            </script>";
        }elseif (isset($_GET['check-in']) && isset($_GET['check-out'])) {
            $check_in = $_GET['check-in'];
            $_SESSION['check_in'] = $check_in;

            $check_out = $_GET['check-out'];
            $_SESSION['check_out'] = $check_out;
        }
        
        if(isset($check_in) && isset($check_out)) {
            header("Location: avail_room.php?check_in=$check_in&check_out=$check_out");
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking | The PETMALU Hotel</title>
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/style.css?ver=1.0.1"> 

</head>
<body>
    <nav class="booking-nav">
        <div class="container">
            <div class="navbar-header page-scroll">
                <a class="navbar-brand style-nav" href="index.html">The PETMALU Hotel</a>
            </div>
            <ul class="nav navbar-nav" style="float: right;">
                <li><a href="index.html" class="style-nav">Home</a></li>
                <li><a href="booking_Form.php" class="style-nav">Booking</a></li>
            </ul>
        </div>
    </nav>

    <div class="col-sm-6" id="bookingForm">
        <div class="bookform" id="bookFormSpacing">
            <h1 style="color: white; font-size: 70px; font-family: sans-serif;">Choose<br>date<br>to<br>Book</h1>
            <br>
            <form action="booking_Form.php" method="get" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="checkin" class="control-label">
                            <h2><span class="label">Check in: </span></h2>
                        </label>
                        <input type="date" name="check-in" class="form-control input-lg">
                    </div>
                    <div class="col-sm-5">
                        <label for="checkout" class="control-label">
                            <h2><span class="label">Check out: </span>
                        </h2></label>
                        <input type="date" name="check-out" class="form-control input-lg">
                    </div>
                    <div class="col-sm-6">
                        <br><br>
                        <input type="submit" value="Check Available Rooms" name="check-date" onclick="return confirm('Are you sure?');" class="btn btn-success btn-lg">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6" id="formshowcase">
        <div>
            <div>
                <center>
                    <img src="images/hello.gif" alt="mix" width=600 height=450 style="margin-left: 10px;margin-top:60px;">
                </center>
            </div>
        </div>
    </div>
</body>
</html>