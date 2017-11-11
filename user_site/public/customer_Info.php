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
    //codes from w3schools

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['firstname'])){
            $firstname = $_POST['firstname'];
        }
        if(isset($_POST['lastname'])){
            $lastname = $_POST['lastname'];
        }

        if(isset($_POST['middleI'])){
            $middleI = $_POST['middleI'];
        }

        if(isset($_POST['address'])){
            $address = $_POST['address'];
        }

        if(isset($_POST['contact_no'])){
            $contact_no = $_POST['contact_no'];
        }

        if(isset($_POST['email_add'])){
            $email_add = $_POST['email_add'];
        }

        if(isset($_POST['mail'])){
            $mail = $_POST['mail'];
        }
        
        $query = "INSERT INTO guest (firstname, lastname, middle_Initial, address, contact_no, email_address, mail) VALUES ('".$firstname."', '".$lastname."', '".$middleI."', '".$address."', '".$contact_no."', '".$email_add."', '".$mail."')";

        if(mysqli_query($connection, $query)){
            header("Location: complete.php");
        }else {
            echo "Query failed";
        }
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
        <div class="col-sm-6" style="background: #bdc3c7; height: 100%; padding-top: 10px;">
            <h1 class="container-fluid">Guest info</h1>
            <br>
            <p id="required" class="container-fluid">* required fields</p>
            <br>
            <form action="customer_Info.php" class="container-fluid" method="POST">
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
                    <label for="email-add" class=""><span id="required">*</span> Email Address: </label><br>
                    <input type="text" name="email_add" class="col-sm-2 form-control" placeholder="email name" style="width: 25%;">
                    <input type="text" name="mail" class="col-sm-2 form-control" placeholder="@example.com"style="width: 25%;">
                </div>
                <br><br>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
    <div>
        <div class="col-sm-6"  style="background: #ecf0f1; height: 100%; padding-top: 20px;">

        </div>
    </div>
</body>
</html>

<?php
// 5. Close database connection
mysqli_close($connection);
?>