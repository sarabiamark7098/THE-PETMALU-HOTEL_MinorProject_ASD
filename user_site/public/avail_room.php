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

    <div class="col-sm-6" style="background: #34495e; min-height:100%;">
        <div class="container-fluid">
            <div style="padding-top:30px;">
                <form action="booking_Form.php" class="form-horizontal">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success btn-lg">Back</button>
                    </div>
                </form>
            </div>
            <form action="customer_Info.php" class="form-horizontal">
                <div class="container-fluid">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <label for="checkin" class="control-label"><h2><span class="label">Check in: <span></span></span></h2></label>
                            <br>
                            <label for="checkout" class="control-label"><h2><span class="label">Check out: <span></span></span></h2></label>
                            <hr>    
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                            <label for="room-type" class="control-label"><h2><span class="label">Room Type: </span></h2></label>
                            <select name="type[]" size="1" class="form-control input-lg">
                                <option value="<NULL>"><NULL></option>
                                <option value="King">King</option>
                                <option value="Queen">Queen</option>
                                <option value="Deluxe">Deluxe</option>
                            </select>
                            </div>
                            <div class="col-sm-4">
                            <label for="room-no" class="control-label"><h2><span class="label">Room no: </span></h2></label>
                            <select name="room[]" size="1" class="form-control input-lg col-sm-4">
                                <option value="null"><NULL></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            </div>
                        <div class="col-sm-4">
                            <label for="Price" class="control-label"><h2><span class="label">Price: </span><h2></label>
                            <label for="outputPrice" class="label form-control col-sm-4"><span style="color: black;"></span></label>
                        </div>
                        <div class="col-sm-12">
                            <br><br>
                            <button type="submit" class="btn btn-success btn-lg">Next</button>  
                        </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-6" id="formshowcase">
        <div class="container-fluid">
            <img src="images/rocket-icon.png" alt="rocket">
        </div>
    </div>

</body>
</html>