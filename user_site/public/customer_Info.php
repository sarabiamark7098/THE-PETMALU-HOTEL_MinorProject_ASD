<?php
    include 'connection.php';

    session_start();

    if(isset($_GET['check_in'])) {
        $check_in = $_GET['check_in'];
    }

    if(isset($_GET['check_out'])) {
        $check_out = $_GET['check_out'];
    }

    if(isset($_GET['room_no'])) {
        $room_no = $_GET['room_no'];
        $_SESSION['room_no']= $room_no; 
    }

    $failed = false; $succes = false;
    $errorFirstname = $errorLastname = $errorMiddleI = $errorAddress = $errorContactNo = $errorEmailAdd = $errorMail = "";
    if(isset($_GET['guest-submit'])) {

        if($_GET['firstname'] === '') {
            $errorFirstname = "walay firstname uhy!";
            $failed = true; 
        }elseif(isset($_GET['firstname'])) {
            $firstname = $_GET['firstname'];
            $_SESSION['firstname'] = $firstname;
            $succes = true;
        }

        if($_GET['lastname'] === '') {
            $errorLastname = "walay lastname uhy!";
            $failed = true;
        }elseif(isset($_GET['lastname'])) {
            $lastname = $_GET['lastname'];
            $_SESSION['lastname'] = $lastname;
            $succes = true;
        }

        if($_GET['middleI'] === '') {
            $errorMiddleI = "walay middle initial uhy!";
            $failed = true;
        }elseif($_GET['middleI']) {
            $middleI = $_GET['middleI'];
            $_SESSION['middleI'] = $middleI;
            $succes = true;
        }

        if($_GET['address'] === '') {
            $errorAddress = "walay address uhy!";
            $failed = true;
        }elseif($_GET['address']) {
            $address = $_GET['address'];
            $_SESSION['address'] = $address;
            $succes = true;
        }

        if($_GET['contact_no'] ==='') {
            $errorContactNo = "walay contact number uhy!";
            $failed = true;
        }elseif($_GET['contact_no']) {
            $contact_no = $_GET['contact_no'];
            $_SESSION['contact_no'] = $contact_no;
            $succes = true;
        }

        if($_GET['email_add'] === '') {
            $errorEmailAdd = "walay email address uhy!";
            $failed = true;
        }elseif($_GET['email_add']) {
            $email_add = $_GET['email_add'];
            $_SESSION['email_add'] = $email_add;
            $succes = true;
        }

        if($_GET['mail'] === '') {
            $errorMail = "walay mail uhy!";
            $failed = true;
        }elseif($_GET['mail']) {
            $mail = $_GET['mail'];
            $_SESSION['mail'] = $mail;
            $succes = true;
        }
        
        if($_GET['firstname'] === '' || $_GET['lastname'] === '' || $_GET['middleI'] === '' || $_GET['address'] === '' || $_GET['contact_no'] === ''|| $_GET['email_add'] === '' || $_GET['mail'] === ''){
            echo "<script type='text/javascript'>
            window.alert('Kulang ang input, please try again :)')
            </script>";
        }
        elseif(isset($firstname) && isset($lastname) && isset($middleI) && isset($address) && isset($contact_no) && isset($email_add) && isset($mail)) {
            header("Location: payment.php?firstname=$firstname&lastname=$lastname&middleI=$middleI");
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
                <a class="navbar-brand style-nav" href="index.html">The PETMALU Hotel</a>
            </div>
            <ul class="nav navbar-nav" style="float: right;">
                <li><a href="index.html" class="style-nav">Home</a></li>
                <li><a href="booking_Form.php" class="style-nav">Booking</a></li>
            </ul>
        </div>
    </nav>
    <div>
        <div class="col-sm-6"  style="background: #34495e; height: 100%; padding-top: 20px;">
            <div class="container-fluid">
                <img src="images/H2.jpg" alt="show" width=500 heigh=500 style="margin-top: 40px; margin-left: 40px;">
            </div>
        </div>
    </div>
    <div>
        <div class="col-sm-6" style="background: #bdc3c7; height: 100%; padding-top: 10px;">
            <h2 class="container-fluid">Guest info</h2>
            <br>
            <p id="required" class="container-fluid">* required fields</p>
            <br>
            <form action="customer_Info.php" class="container-fluid" method="GET">
                <div class="form-group">
                    <label for="firstname"><span id="required">*</span> First name: </label>
                    <input type="text" name="firstname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="lastname"><span id="required">*</span> Last name: </label>
                    <input type="text" name="lastname" class="form-control">
                </div>
                <div class="form-group">
                    <label for="middleinitial"><span id="required">*</span> Middle Initial: </label>
                    <input type="text" name="middleI" class="form-control" style="width: 7%;" >
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
                    <label for="email-add" class=""><span id="required">*</span> Email Address: </label><br>
                    <input type="text" name="email_add" class="col-sm-2 form-control" placeholder="email name" style="width: 25%;">
                    <input type="text" name="mail" class="col-sm-2 form-control" placeholder="@example.com"style="width: 25%;">
                </div>
                <br><br>
                <a href="avail_room.php" class="btn btn-default">Back</a>
                <input type="submit" name="guest-submit" style="float: right;"value="Submit" onclick="return confirm('Are you sure?');" class="btn btn-success">
            </form>
        </div>
    </div>
</body>
</html>