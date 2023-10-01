<?php
session_start();
require 'functions.php';
if (isset($_POST["submit"])) {
    registrasi($_POST); 
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/signup_style.css">
    <title>Sign Up</title>
</head>
<body>
    <div>
        <!-- Logo -->
        <div class="textLogo">
            <span style="color: #20C997;">H</span>OMLINE.
        </div>
        <!-- Logo -->
        
        <h2 class="loginText"> Sign up </h2>
        <!-- form -->
        <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
            <div>
                <input autocomplete="off" type="text" name="username" id="username" class="form-control emailForm" placeholder="Username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; $username ?>" required autofocus>
            </div>
            <div>
                <!-- <label for="level_id" class="roleForm">Sign Up as</label> -->
                <div class="mt-2">
                    <select name="level_id" id="level_id" class="form-select roleForm" aria-label="Default select example" style="color: black;">
                        <!-- <option value="" disabled selected >Sign Up as</option> -->
                        <option value="lvl001">Pembeli</option>
                        <option value="lvl002">Penjual</option>
                    </select>
                </div>
            </div>
            <div>
                <input autocomplete="off" type="email" name="email" id="email" class="form-control emailForm" placeholder="Email Address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; $email ?>" required autofocus>
            </div>
            <div>
                <input type="password" name="password" id="password" class="form-control passForm" id="exampleInputPassword1" placeholder="Password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" required autofocus>
            </div>
            <div>
                <input type="password" name="password2" id="password2" class="form-control confirmPass" id="exampleInputPassword1" placeholder="Confirm Password" value="<?php echo isset($_POST['password2']) ? $_POST['password2'] : ''; ?>" required autofocus>
            </div>
            <div class="logButton">
                <button class="loginForm" type="submit" name="submit"> Sign up </button>
            </div>
            <div class="signUp mb-5">
                Already have an account?
                <a href="login.php" class="makeAcc"> log in </a>
            </div>
        </form>
        <!-- form -->
    </div>
</body>
</html>