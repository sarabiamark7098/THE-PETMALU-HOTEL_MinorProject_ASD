<?php 
    include 'connection.php';

    ini_set('mysqli.connect_timeout', 300);
    ini_set('default_socket_timeout', 300);

    session_start();
    $super_user = $_SESSION['super_user'];
    $super_pass = $_SESSION['super_pass'];

    if($super_user === 'temp' && $super_pass === 'temp'){
        $user_manage = "";
    }elseif($super_user === 'admin' && $super_pass === 'superadmin1234') {
        $user_manage = "<a href='user_manage.php'><img src='images/Manager_48px.png' alt='Home' style='float: left; width: 24px; height: 24px;'>Management</a>";
    }

    if(isset($_POST['create'])) {
        if(isset($_POST['admin_name'])) {
            $admin_name = $_POST['admin_name'];
        }

        if(isset($_POST['username'])) {
            $username = $_POST['username'];
        }

        if(isset($_POST['password'])) {
            $password = $_POST['password'];
        }

        if(isset($_POST['answer'])) {
            $answer = $_POST['answer'];
        }

        if(getimagesize($_FILES['image']['tmp_name']) == FALSE) {
            echo "Please select an image";

        }else {
            $image = addslashes($_FILES['image']['tmp_name']);
            $name = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);
        }

        if($_POST['admin_name'] == '' || $_POST['username'] == '' || $_POST['password'] == '' || $_POST['answer'] == '' ) {
            echo "<script type='text/javascript'>
            window.alert('Invalid input')
            </script>";
        }elseif(isset($name) && isset($username) && isset($password) && isset($answer) && isset($image)) {
            //header("Location: create.php?submit=submit&name=$name&username=$username&password=$password&answer=$answer");
            $queryGetHotelId = "SELECT hotel_id FROM hotel";
            $resultGetHotelId = mysqli_query($connection, $queryGetHotelId);
            while($row = mysqli_fetch_assoc($resultGetHotelId)) {
                $hotel_id = $row['hotel_id'];
            }

            $queryCreateAccount  = "INSERT INTO admin (admin_name, username, password, answer, hotel_id, image_data, image_name) ";
            $queryCreateAccount .= "VALUES ";
            $queryCreateAccount .= "('". $admin_name ."', '". $username ."', '". $password ."', '". $answer ."', $hotel_id, '". $image ."', '". $name ."')";
            $resultCreateAccount = mysqli_query($connection, $queryCreateAccount);

            if($resultCreateAccount) {
                echo "<script type='text/javascript'>
                window.alert('Successfully Created')
                </script>";
                header("Location: user_manage.php?create_success=crs");
            }else {
               echo $queryCreateAccount;
            }
        }
    }
?>

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
<title>Create Account | The PETMALU Hotel Admin</title>
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
            <h2>Create New Account</h2>
            <br>
            <form action="create_account.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text" class="form-control" style="width: 30%;"name="admin_name">
                    </div>
                    <div>
                        <label for="photo">Select image to upload:</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input type="text" class="form-control" style="width: 30%;"name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" class="form-control" style="width: 30%;"name="password">
                    </div>
                    <div class="form-group">
                        <label for="question">Question: </label>
                        <p>What is your programming language?</p>
                        <label for="answer">Answer: </label>
                        <input type="text" class="form-control" style="width: 30%;"name="answer">
                    </div>
                    <a href="user_manage.php" class="btn btn-default">Back</a>
                    <button type="submit" name="create" value="create" class="btn btn-success" style="margin-left: 200px;">Create</button>
            </form>
        </div>
    </div>
</body>
</html>