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

    <style>
        #required {
            color: red;
        }
    </style>

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

    <div>
        <div class="col-sm-6" style="background: #ecf0f1; height: 100%; padding-top: 10px;">
            <h1 class="container-fluid">Guest info</h1>
            <br>
            <p id="required" class="container-fluid">* required fields</p>
            <br>
            <form action="" class="container-fluid">
                <div class="form-group">
                    <label for="firstname"><span id="required">*</span> First name:</label>
                    <input type="text" name="firstname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastname"><span id="required">*</span> Last name:</label>
                    <input type="text" name="lastname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="middleinitial"><span id="required">*</span> Middle Initial:</label>
                    <input type="text" name="middleI" class="form-control" style="width: 10%;">
                </div>
                <div class="form-group">
                    <label for="address"><span id="required">*</span> Address: </label>
                    <input type="text" name="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="contact-no"><span id="required">*</span> Contact Number: </label>
                    <input type="text" name="contact_no" class="form-control" style="width: 50%;">
                </div>
                <div class="form-group">
                    <label for="email-add"><span id="required">*</span> Email Address: </label>
                    <input type="text" name="email_add" class="form-control" style="width: 50%;">
                </div>
            </form>
        </div>
    </div>
    <div>
        <div class="col-sm-6"  style="background: #ecf0f1; height: 100%; padding-top: 20px;">

        </div>
    </div>
</body>
</html>