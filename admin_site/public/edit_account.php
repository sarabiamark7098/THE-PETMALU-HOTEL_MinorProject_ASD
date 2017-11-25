<?php
    include 'connection.php';
    session_start();

    function success($resultUpdateAccount) {
        if($resultUpdateAccount) {
            header("Location: list_accounts.php?update_success=ups");
        }else {
            echo "<script type='text/javascript'>
            window.alert('Failed')
            </script>";
        }
    }

    if(isset($_GET['update'])) {
        if(isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
            $_SESSION['update_user_id'] = $user_id;
        }

        if(isset($_GET['admin_name'])) {
            $admin_name = $_GET['admin_name'];
        }

        if(isset($_GET['username'])) {
            $username = $_GET['username'];
        }

        if(isset($_GET['answer'])) {
            $answer = $_GET['answer'];
        }
    }

    if(isset($_POST['update'])) {
        $user_id = $_SESSION['update_user_id'];
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
        if(empty($_FILES['image']['tmp_name'])) {
            
        }else {
            $image = addslashes($_FILES['image']['tmp_name']);
            $name = addslashes($_FILES['image']['name']);
            $image = file_get_contents($image);
            $image = base64_encode($image);
        }

        $queryGetHotelId = "SELECT hotel_id FROM hotel";
        $resultGetHotelId = mysqli_query($connection, $queryGetHotelId);
        while($row = mysqli_fetch_assoc($resultGetHotelId)) {
            $hotel_id = $row['hotel_id'];
        }

        if($_POST['admin_name'] == '' || $_POST['username'] == '' || $_POST['password'] == '' || $_POST['answer'] == '') {
            echo "<script type='text/javascript'>
            window.alert('Invalid input')
            </script>";
        }elseif($_FILES['image']['tmp_name'] == '') {
            $queryUpdateAccount  = "UPDATE admin SET admin_name = '{$admin_name}', username='{$username}', password='{$password}', answer='{$answer}' WHERE user_id = $user_id AND hotel_id = $hotel_id";
            $resultUpdateAccount = mysqli_query($connection, $queryUpdateAccount);
            success($resultUpdateAccount);
        }elseif(isset($name) && isset($username) && isset($password) && isset($answer) && isset($image)) {
            $queryUpdateAccount  = "UPDATE admin SET admin_name = '{$admin_name}', image_data = '{$image}', username='{$username}', password='{$password}', answer='{$answer}', image_name='{$name}' WHERE user_id = $user_id AND hotel_id = $hotel_id";
            $resultUpdateAccount = mysqli_query($connection, $queryUpdateAccount);
            success($resultUpdateAccount);
        }
    }
?>

<?php 
    include 'connection.php';

    $super_user = $_SESSION['super_user'];
    $super_pass = $_SESSION['super_pass'];

    if($super_user === 'temp' && $super_pass === 'temp'){
        $user_manage = "";
    }elseif($super_user === 'admin' && $super_pass === 'superadmin1234') {
        $user_manage = "<a href='user_manage.php'><img src='images/Manager_48px.png' alt='Home' style='float: left; width: 24px; height: 24px;'>Management</a>";
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
<title>Edit Account | The PETMALU Hotel Admin</title>
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
        <h2>Edit Account</h2>
            <br>
            <form action="edit_account.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name: </label>
                        <input type="text" class="form-control" style="width: 30%;"name="admin_name" value="<?php echo $admin_name?>">
                    </div>
                    <div>
                        <label for="photo">Select image to upload:</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input type="text" class="form-control" style="width: 30%;"name="username" value="<?php echo $username?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input type="password" class="form-control" style="width: 30%;"name="password">
                    </div>
                    <div class="form-group">
                        <label for="question">Question: </label>
                        <p>What is your programming language?</p>
                        <label for="answer">Answer: </label>
                        <input type="text" class="form-control" style="width: 30%;"name="answer" value="<?php echo $answer?>">
                    </div>
                    <a href="list_accounts.php" class="btn btn-default">Back</a>
                    <button type="submit" name="update" value="update" class="btn btn-success" style="margin-left: 200px;">Create</button>
            </form>
        </div>
    </div>
</body>
</html>