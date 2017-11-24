    <?php

    include 'connection.php';
    session_start();

    $username = $user = $usernameError = "";
    $password = $pass = $passwordError = "";

    if(isset($_GET['in'])) {
        echo "<script type='text/javascript'>
        window.alert('Invalid Username and Password')
        </script>";
    }

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

        $query = "SELECT * FROM admin WHERE username='{$username}' AND password='{$password}' AND hotel_id = 101";
        $result = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($result)) {
            $user = $row['username'];
            $pass = $row['password'];
            $user_id = $row['user_id'];
            $name = $row['admin_name'];
        }
        
        if(!$result) {
            die("Database query failed.");
        }

        $_SESSION['user_id'] = $user_id;
        $_SESSION['admin_name'] = $name;
        header("Location: home.php");
    }  
    
    if($username === "admin" && $password === "superadmin1234") {
        $super_user = $username;
        $_SESSION['super_user'] = $super_user;
        
        $super_pass = $password;
        $_SESSION['super_pass'] = $super_pass;
        header("Location: home.php");
    }elseif($username !== $user && !$password !== $pass) {
        header("Location: index.php?in=invalid");
    }elseif($username === $user && $password === $pass) {
        $super_user = "temp";
        $_SESSION['super_user'] = $super_user;
        
        $super_pass = "temp";
        $_SESSION['super_pass'] = $super_pass;
    }elseif(isset($_GET['success'])){
        echo "<script type='text/javascript'>
        window.alert('Successfully Logout')
        </script>";
    }else {
        echo "<script type='text/javascript'>
        window.alert('Invalid User')
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
    <title>Login | The PETMALU Hotel Admin</title>
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

    </div>
    <div id="content" class="col-sm-10">
        <div class="container-fluid">
            <h2>Login</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="login-group">
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <button type="submit" class="btn btn-default">Login</button>
                <span><a href="">forgot password?</a></span>
            </form>
        </div>
    </div>
    <?php        
        mysqli_free_result($result);
    ?>
</body>
</html>