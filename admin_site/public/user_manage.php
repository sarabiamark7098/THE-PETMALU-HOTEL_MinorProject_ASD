<?php 
    include 'connection.php';

    session_start();
    $super_user = $_SESSION['super_user'];
    $super_pass = $_SESSION['super_pass'];

    if($super_user === 'temp' && $super_pass === 'temp'){
        $user_manage = "";
    }elseif($super_user === 'admin' && $super_pass === 'superadmin1234') {
        $user_manage = "<a href='user_manage.php'><img src='images/Manager_48px.png' alt='Home' style='float: left; width: 24px; height: 24px;'>Management</a>";
    }

    $show = 'show';
    $_SESSION['show'] = $show;
?>

<?php

    if(isset($_GET['create_success'])) {
        echo "<script type='text/javascript'>
        window.alert('Successfully Created')
        </script>";
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
<title>Management | The PETMALU Hotel Admin</title>
<link rel="stylesheet" href="stylesheets/style.css">
<link rel="stylesheet" href="stylesheets/bootstrap.css">
<link rel="stylesheet" href="stylesheets/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/bootstrap-theme.css">
<link rel="stylesheet" href="stylesheets/bootstrap-theme.min.css">
<script>showBookings('show');</script>
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
                        <li><?php echo $user_manage;?></li>
                        <li><a href="logout.php" onclick="return confirm('Are you sure?');"><img src="images/Logout Rounded Up_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Logout</a></li>
                    </ul>
            </center>
            </div>
        </div>
    </div>
    <div id="content" class="col-sm-10">
        <div class="container-fluid">
            <h2>User Management</h2>
            <br>
            <div>
                <a href="create_account.php" class="btn btn-default">Create New Account</a>
                <br><br>
                <a href="list_accounts.php" class="btn btn-default">List of Accounts</a>
            </div>
        </div>
    </div>
</body>
</html>