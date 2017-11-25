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
$query = "SELECT * FROM guest";
$result = mysqli_query($connection, $query);

if(!$result) {
    die("Database query failed.");
}
?>

<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Edit | The PETMALU Hotel Admin</title>
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
    <?php
        //codes from w3schools
        //functional part
        $id = 0;

        if($_SERVER["REQUEST_METHOD"] == "GET") {
            if(isset($_GET['id'])){
                $id = test_input($_GET['id']);
            }

            if(isset($_GET['firstname'])){
                $firstname = test_input($_GET['firstname']);
            }

            if(isset($_GET['lastname'])){
                $lastname = test_input($_GET['lastname']);
            }

            if(isset($_GET['middle'])){
                $middle_Initial = test_input($_GET['middle']);
            }

            if(isset($_GET['address'])){
                $address = test_input($_GET['address']);
            }

            if(isset($_GET['contact'])){
                $contact_no = test_input($_GET['contact']);
            }
        }

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    ?>

<div>
<div class="col-sm-6" style="background: #bdc3c7; height: 100%; padding-top: 10px;">
    <h1 class="container-fluid">Update</h1>
    <p id="required" class="container-fluid"></p>
    <form action="update.php" class="container-fluid" method="get">
        <div class="form-group">
            <label for="firstname"><span id="required"></span> First name:</label>
            <input type="text" name="firstname" value="<?php echo $firstname;?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="lastname"><span id="required"></span> Last name:</label>
            <input type="text" name="lastname" value="<?php echo $lastname;?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="middleinitial"><span id="required"></span> Middle Initial:</label>
            <input type="text" name="middle_Initial" value="<?php echo $middle_Initial;?>" class="form-control" style="width: 10%;">
        </div>
        <div class="form-group">
            <label for="address"><span id="required"></span> Address: </label>
            <input type="text" name="address" value="<?php echo $address;?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact-no"><span id="required"></span> Contact Number: </label>
            <input type="text" name="contact_no" value="<?php echo $contact_no;?>" class="form-control" style="width: 50%;">
    </div>
        <br>
        <button type="submit" name="id" value="<?php echo $id;?>"class="btn btn-success">Update</button>
    </form>
</div>
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