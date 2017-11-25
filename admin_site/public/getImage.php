<?php
    include 'connection.php';
    $id = $_GET['id'];
    // do some validation here to ensure id is safe
  
    $sql = "SELECT image FROM `type` WHERE type_no=$id";
    $result = mysqli_query($sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($connection);
  
    header("Content-type: image/jpeg");
    echo $row['dvdimage'];
?>