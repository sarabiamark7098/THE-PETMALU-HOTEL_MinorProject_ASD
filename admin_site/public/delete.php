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
        if(isset($_GET['id'])){
            $id = test_input($_GET['id']);

            $query = "DELETE FROM guest WHERE guest_id = {$id}";
            $result = mysqli_query($connection, $query);
        
            if(result) {
                header("Location: booking.php");
            }
        
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    mysqli_close($connection);
?>