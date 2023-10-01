<?php
ob_start();
session_start();

include 'functions.php';

global $conn;

$email = $_POST["email"];
$password = md5($_POST["password"]);
$op = $_GET['op'];

if ($op=="in") {
    $query = mysqli_query($conn, "SELECT * FROM account WHERE email = '$email' AND password = '$password' AND level_id = 'lvl001'");
    if (mysqli_num_rows($query)==1) {
        $result = mysqli_fetch_array($query);
        $_SESSION["email"] = $result["email"];
        $_SESSION["username"] = $result["username"];
        echo "
        <script> alert('Selamat Datang di Homeline');</script>";
        header("location:homepage_buyer.php");
    }
    else {
        echo "<script> alert('email/Password Salah!!!!');
        location.href = 'login.php'; </script>";
    }
}

if ($op=="in") {
    $query = mysqli_query($conn, "SELECT * FROM account WHERE email = '$email' AND password = '$password' AND level_id = 'lvl002'");
    if (mysqli_num_rows($query)==1) {
        $result = mysqli_fetch_array($query);
        $_SESSION["email"] = $result["email"];
        $_SESSION["username"] = $result["username"];

        header("location:homepage_seller.php");
    }
}

else if($op=="out"){
    unset($_SESSION['email']);
    header("location:./");
}