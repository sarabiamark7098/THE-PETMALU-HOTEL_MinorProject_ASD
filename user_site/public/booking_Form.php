<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Booking | Hotel Reservation</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/bootstrap.css">
    <link rel="stylesheet" href="stylesheets/bootstrap.min.css">
    <link rel="stylesheet" href="stylesheets/bootstrap-theme.css">
    <link rel="stylesheet" href="stylesheets/bootstrap-theme.min.css">

</head>
<body>
    <nav class="booking-nav">
        <div class="container">
            <div class="navbar-header page-scroll">
                <a class="navbar-brand style-nav" href="#">Hotel Booking System</a>
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
            <form action="avail_room.php" class="form-horizontal">
                <div class="form-group">
                    <div class="col-sm-5">
                        <label for="checkin" class="control-label"><h2><span class="label">Check in: </span></h2></label><input type="date" name="checkin" class="form-control input-lg">
                    </div>
                    <div class="col-sm-5">
                        <label for="checkout" class="control-label"><h2><span class="label">Check out: </span></h2></label><input type="date" name="checkout" class="form-control input-lg">
                    </div>
                    <div class="col-sm-6">
                        <br><br>
                        <input type="submit" value="Check Avail Room" name="submit" class="btn btn-success btn-lg">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6" id="formshowcase">
        <div>
            <div>
                <center>
                    <img src="images/earth-icon.png" alt="earth">
                </center>
            </div>
        </div>
    </div>
</body>
</html>