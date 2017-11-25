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

    if($_SERVER["REQUEST_METHOD"] == "GET") {
        if(isset($_GET['checkin'])) {
            $check_in = test_input($_GET['checkin']);
            if($check_in != false ) {
                $check_in = date('Y-m-d');
            }
        }

        if(isset($_GET['checkout'])) {
            $check_out = test_input($_GET['checkout']);
            if($check_in != false ) {
                $check_in = date('Y-m-d');
        }

            $booking_date = date("Y-m-d");

            $query  = "INSERT INTO booking_date (check_in, check_out, booking_date) ";
            $query .= "VALUES ";
            $query .= "('{$check_in}', '{$check_out}', '{$booking_date}')";
            $result = mysqli_query($connection, $query);
            
            if($result) {
                header("Location: avail_room.php");
            }else {
                echo "failed " . $query;
            }   
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>