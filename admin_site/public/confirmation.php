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
    // 2. Perform database query
    $query = "SELECT * FROM admin WHERE user_id = '1'";
    $result = mysqli_query($connection, $query);

    if(!$result) {
        die("Database query failed.");
    }

?>

<?php
    //codes from w3schools
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
<title>Confirmation | The PETMALU Hotel Admin</title>
<link rel="stylesheet" href="stylesheets/style.css">
<link rel="stylesheet" href="stylesheets/bootstrap.css">
<link rel="stylesheet" href="stylesheets/bootstrap.min.css">
<link rel="stylesheet" href="stylesheets/bootstrap-theme.css">
<link rel="stylesheet" href="stylesheets/bootstrap-theme.min.css">
</head>
<body>
<?php
    //3. Use return data (if any)

    $user = "";
    $pass = "";

    while($row = mysqli_fetch_assoc($result)) {
        //output data from each row
        $user = $row["username"];
        $pass = $row["password"];
    }

    if($username === $user && $password === $pass) {
        header("Location: confirmation.php");
    }else {
    }

    ?>
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
                        <li><a href="home.php">Home</a></li>
                        <li><a href="booking.php">Bookings</a></li>
                        <li><a href="confirmation.php">Confirmation</a></li>
                        <li><a href="room.php">Room</a></li>
                        <li><a href="">Logout</a></li>
                    </ul>
                </center>
            </div>
        </div>
    </div>
    <div id="content" class="col-sm-10">
        <h2>Confirmation</h2>
        <div class="container-fluid" id="table">
            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Guest name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Email Address</th>
                                <th>Reservation</th>
                                <th>Check in</th>
                                <th>Check out</th>
                                <th>Room no.</th>
                                <th>Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Phillip Arman Rios</td>
                                <td>Dona Salud Sasa DAvao City</td>
                                <td>09236386510</td>
                                <td>pipoyarman<br>@gmail.com</td>
                                <td>05/17/2018</td>
                                <td>05/17/2018</td>
                                <td>05/18/2018</td>
                                <td>100</td>
                                <td>King</td>
                            </tr>   
                        </tbody>
                    </table>
                </div>
            </div>

        <form action="">
            <div class="form-group">
                <label for="select">Select ID to Confirm: </label>
                <input type="text" name="select" class="form-control" style="width: 10%;">
            </div>
            <button type="submit" class="btn btn-default">confirm</button>
        </form>

        </div>
    </div>

    <?php
        //4. Release returned data
        mysqli_free_result($result);
    ?>

</body>
</html>

<?php
// 5. Close database connection
mysqli_close($connection);
?>