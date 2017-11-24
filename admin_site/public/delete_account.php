<?php
    include 'connection.php';
    if(isset($_GET['delete'])) {
        if(isset($_GET['user_id'])) {
            $user_id = $_GET['user_id'];
        }

        $queryDeleteAccount = "DELETE FROM admin WHERE user_id = $user_id";
        $resultDeleteAccount = mysqli_query($connection, $queryDeleteAccount);
        if($resultDeleteAccount) {
            header("Location: list_accounts.php?delete_success=dls");
        }
    }
?>