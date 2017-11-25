<?php

include 'connection.php';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}   

//$target_dir = "uploads/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$filename = $_FILES["fileToUpload"]["name"];
//$uploadOk = 1;
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}   
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['type_name'])){
        $type_name = test_input($_POST['type_name']);
    }

    if(isset($_POST['cost'])){
        $cost = test_input($_POST['cost']);
    }

    $query = "INSERT INTO type (type_name, price,image) VALUES ('{$type_name}', {$cost}, '{$filename}');";
    $result = mysqli_query($connection, $query);
    
    if($result) {
        echo "success";
        
        $query = "SELECT image FROM `type` WHERE type_no = 38";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result)) {
            $img = $row['image'];
        }
        echo "<img src='$img' alt='picture' style='width: 25%; height: 25%';>";
        
    }else {
        echo "<br>failed" . $query; 
    }
}
// Check if file already exists
/*
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}*/
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
/*
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error
/*
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". $_FILES["fileToUpload"]["name"] . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
*/

?>