<?php
include 'connection.php';

session_start();

$firstname = $lastname = $middleI = "";
if(isset($_GET['firstname'])) {
    $firstname = $_GET['firstname'];
}

if(isset($_GET['lastname'])) {
    $lastname = $_GET['lastname'];
}

if(isset($_GET['middleI'])) {
    $middleI = $_GET['middleI'];
}

if(isset($_GET['payment-submit'])) {
    if(isset($_GET['card-holder-name'])) {
        $card_holder_name = $_GET['card-holder-name'];
        $_SESSION['card_holder_name'] = $card_holder_name;
    }

    if(isset($_GET['card_number'])) {
        $card_number = $_GET['card_number'];
        $_SESSION['card_number'] = $card_number;
    }

    if(isset($_GET['card_code'])) {
        $card_code = $_GET['card_code'];
        $_SESSION['card_code'] = $card_code;
    }

    if(isset($_GET['payment-method'])) {
        $payment_method = $_GET['payment-method'];
        $_SESSION['payment_method'] = $payment_method;
    }

    if($_GET['card-holder-name'] === '' || $_GET['card_number'] === '' || $_GET['card_code'] === '' || $_GET['payment-method'] === '' ){
        echo "<script type='text/javascript'>
        window.alert('Kulang ang input, please try again :)')
        </script>";
    }
    elseif(isset($card_holder_name) && isset($card_number) && isset($card_code) && isset($payment_method)) {
        header("Location: validate.php?submit=submit");
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

<div class="col-sm-6"  style="background: #34495e; height: 100%; padding-top: 20px;">
    <div class="container-fluid">
        <img src="images/trees.png" alt="trees" style="width: 400px; margin: 70px;">
    </div>
</div>
<div class="col-sm-6" style="background: #bdc3c7; height: 100%; padding-top: 10px;">
    <div class-"container-fluid">
        <h2>Payment</h2>
        <br>
        <label for="guest-name">Guest Name: &nbsp;</label><input  class="form-control" type="text" style="width: 50%;"name="guest-name" value="<?php echo $firstname ." ".$middleI.".  " .$lastname;?>">
        <br><br>
        <form action="payment.php" method="get">
            <div class="form-group">
                <label for="guest-cardholder-name">Cardholder's Name: </label>
                <input type="text" class="form-control" name="card-holder-name" style="width: 50%;">
            </div>
            <div class="form-group">
                <label for="guest-card-number">Card Number: </label>
                <input type="text" class="form-control" maxlength='19' style="width: 50%;" name="card_number">
            </div>
            <div class="form-group">
                <label for="guest-code">CVV/CVC: </label>
                <input type="text" class="form-control" maxlength='3' style="width: 50%;" name="card_code">
                <p style="padding-right: 200px;">* CVV or CVC is the card security code, unique three digits number on the back of your card separate from its number.</p>
            </div>
            <br>
            <div>
                <img src="images/Visa_logo.png" alt="visa" style="width: 100px; height: 30px;">&nbsp;
                <img src="images/MasterCard_Logo.png" alt="visa" style="width: 100px; height: 50px;">
                <img src="images/paypal.png" alt="visa" style="width: 100px; height: 50px;">
            </div>
            <br>
            <div class="form-group">
                <label for="payment-method">Payment Method: </label>
                <select name="payment-method" class="form-control" style="width: 25%;">
                    <option value=""></option>
                    <option value="Visa">Visa</option>
                    <option value="MasterCard">MasterCard</option>
                    <option value="Paypal">Paypal</option>
                </select>
            </div>
            <a href="customer_Info.php" class="btn btn-default">Back</a>
            <button type="submit" name="payment-submit" value="payment-submit" style="float: right;"  onclick="return confirm('Are you sure?');" class="btn btn-success">Submit</button>
        </form>
    </div>
    
</div>
</body>
</html>