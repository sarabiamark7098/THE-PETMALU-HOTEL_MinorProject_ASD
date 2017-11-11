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
        }

        if(isset($_GET['firstname'])){
            $firstname = test_input($_GET['firstname']);
        }

        if(isset($_GET['lastname'])){
            $lastname = test_input($_GET['lastname']);
        }

        if(isset($_GET['middle_Initial'])){
            $middle_Initial = test_input($_GET['middle_Initial']);
        }

        if(isset($_GET['address'])){
            $address = test_input($_GET['address']);
        }

        if(isset($_GET['contact_no'])){
            $contact_no = test_input($_GET['contact_no']);
        }

        $query  ="UPDATE guest SET "; 
        $query .="firstname='{$firstname}', ";
        $query .="lastname='{$lastname}', ";
        $query .="middle_Initial='{$middle_Initial}', ";
        $query .="address='{$address}', ";
        $query .="contact_no='{$contact_no}' ";
        $query .="WHERE guest_id = {$id}";
        $result = mysqli_query($connection, $query);
    
        if($result) {
            header("Location: booking.php");
        }else {
            echo $query;
            echo "failed";
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