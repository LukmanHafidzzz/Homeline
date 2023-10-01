<?php
require 'functions.php';
ob_start();
session_start();

if (isset($_GET['house_id'])) {
    $house_id = $_GET['house_id'];

    delete($house_id);
    echo "<script>
    alert('Data Berhasil dihapus!');
    document.location.href = 'homepage_seller.php';
    </script>";
} else {
    die("Error. No ID Selected!");
}

header("location:homepage_seller.php");