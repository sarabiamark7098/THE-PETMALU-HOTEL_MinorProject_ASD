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
?>

<?php

    $user_id = $_SESSION['user_id'];

    $username = $usernameError = "";
    $password = $passwordError = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["username"])) {
            $usernameError = "Invalid username. ";
        }else {
            $username = test_input($_POST["username"]);
        }

        if(empty($_POST["password"])) {
            $passwordError = "Invalid password. ";
        }else {
            $password = test_input($_POST["password"]);
        }
    }

    $queryGetImage = "SELECT * FROM admin WHERE user_id = $user_id";
    $resultGetImage = mysqli_query($connection, $queryGetImage);
    while($row = mysqli_fetch_assoc($resultGetImage)){
        $image = $row['image_data'];
        $name = $row['admin_name'];

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
    <title>Home | The PETMALU Hotel Admin</title>
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
                    <li><?php echo $user_manage;?></li>
                    <li><a href="logout.php" onclick="return confirm('Are you sure?');"><img src="images/Logout Rounded Up_48px.png" alt="Home" style='float: left; width: 24px; height: 24px;'>Logout</a></li>
                </ul>
                </center>
            </div>
        </div>
    </div>
    <div id="content" class="col-sm-10">
        <div class="container-fluid">
            <h2>Welcome!</h2>
            <h3><?php echo $name;?></h3>
            <?php echo "<img width='400' height='300' src='data:image;base64,". $image ."'>";?>
        </div>
    </div>

</body>
</html>