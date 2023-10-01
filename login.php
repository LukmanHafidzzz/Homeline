<?php

ob_start();
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login_style.css">
    <title>Log in</title>
</head>
<body>
    <div>

        <!-- Logo -->
        <div class="textLogo">
            <span style="color: #20C997;">H</span>OMLINE.
        </div>
        <!-- Logo -->

        <h2 class="loginText">Log In</h2>
        <!-- form --> 
        <form action="log_function.php?op=in" method="post">
            <div>
                <input autocomplete="off" type="email" name="email" class="form-control emailForm" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; $email?>">
            </div>
            <div>
                <input type="password" name="password" class="form-control passForm" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="logButton">
                <button class="loginForm" type="submit" name="submit"> Log In </button>
            </div>
            <div class="signUp">
                Don't have an account?
                <a href="signup.php" class="makeAcc"> Sign up </a>
            </div>
        </form>
        <!-- form -->
    </div>
</body>
</html>