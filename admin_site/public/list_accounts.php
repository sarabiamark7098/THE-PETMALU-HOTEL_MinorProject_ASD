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

    if(isset($_GET['update_success'])) {
        echo "<script type='text/javascript'>
        window.alert('Successfully Updated')
        </script>";
    }

    if(isset($_GET['delete_success'])) {
        echo "<script type='text/javascript'>
        window.alert('Successfully Deleted')
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
<title>List of Accounts | The PETMALU Hotel Admin</title>
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
            <h2>Accounts</h2>
            <div class="container-fluid" id="table">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="font-size: 13px;">ID</th>
                                    <th style="font-size: 13px;">Name</th>
                                    <th style="font-size: 13px;">Profile Picture</th>
                                    <th style="font-size: 13px;">Username</th>
                                    <th style="font-size: 13px;">Action</th>
                                </tr>
                            </thead>
                            <tbody style="width: 99%;">

                                <?php 
                                
                                    //Table 
                                    // 2. Perform database query

                                    $query = "SELECT * FROM admin WHERE password != 'superadmin1234'";

                                    $result = mysqli_query($connection, $query);

                                    if(!$result) {
                                        die("Database query failed.");
                                    }

                                    //3. Use return data (if any)
                                    while($row = mysqli_fetch_assoc($result)) {
                                        //output data from each row

                                        echo "<tr><td style='font-size: 12px;'>". $row['user_id'] ."</td>
                                        <td style='font-size: 12px;'>". $row['admin_name'] ."</td>
                                        <td style='font-size: 12px;'><img width='100' height='100' src='data:image;base64,". $row['image_data'] ."'></td>
                                        <td style='font-size: 12px;'>". $row['username'] ."</td>
                                        <td>
                                        <a href='edit_account.php?
                                        user_id={$row['user_id']}&
                                        admin_name={$row['admin_name']}&
                                        username={$row['username']}&
                                        answer={$row['answer']}&
                                        update=up'>
                                        <img src='images/Edit_48px.png' style='width: 20px; height: 20px;'></a>
                                        <a href='delete_account.php?user_id={$row['user_id']}&delete=dl'>
                                        <img src='images/Delete_48px.png' style='width: 20px; height: 20px;'></a>
                                        </td>";
                                    }
                                    mysqli_free_result($result);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</body>
</html>