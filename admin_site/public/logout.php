<?php
    include 'connection.php';
    session_start();
    $successMessage = "sucess";
    $super_user = $_SESSION['super_user'];
    $super_pass = $_SESSION['super_pass'];

    if(isset($super_user) && isset($super_pass)) {
        unset($_SESSION['super_user']);
        unset($_SESSION['super_pass']);
        unset($_SESSION['name']);
        unset($_SESSION['user_id']);
        mysqli_close($connection);
        header("Location: index.php?success=$successMessage");
    }
?>