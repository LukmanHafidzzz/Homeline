<?php
include 'functions.php';
ob_start();
session_start();

// if (!isset($_SESSION['email'])) {
//     die(header("Location:session.php"));
// }

// $house_id = $_GET["house_id"];
// $detail = query("SELECT hd.thumbnail_photo as thumb_nail, hd.title as title, hd.price as price, hd.home_address as home_add, hd.no_wa as no_wa, hd.description as descr, hd.status as stat FROM (((house_data hd JOIN house_data_status hds USING(status_id)) JOIN account a USING(user_id)) JOIN account_level al USING(level_id)) WHERE hd. house_id = $house_id")[0];

// if (isset($_POST["submit"])) {
//     detail($_POST, $id);
//     header("Location:input.php");
//     exit;
// }

if (isset($_GET['house_id'])) {
    $house_id = $_GET['house_id'];
} else {
    die("Error. No ID Selected!");
}

// $house_data = mysqli_query($conn, "SELECT * FROM ((((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id)) WHERE house_id ='$house_id'");

// $house_data = mysqli_query($conn, "SELECT * FROM (((((account_level join account using(level_id)) join house_data using(user_id)) join house_data_status using(status_id)) join house_photo using(house_id)) join sertivicate using(house_id)) WHERE house_id ='$house_id'");
// select * from ((((account_level join account using(level_id)) join house_data using(user_id)) join house_photo using(house_id)) join sertivicate using(house_id));
$house_data = mysqli_query($conn, "SELECT * FROM (((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id)) WHERE house_id ='$house_id'");
$result = mysqli_fetch_array($house_data);

// $detail_data = mysqli_query($conn, "SELECT house_data.house_id as house_id, house_photo.photo_id as photo_id, house_photo.sub_photo as sub_photo from (house_data join house_photo using(house_id)) WHERE house_id ='$house_id'");
// $detail_result = mysqli_fetch_array($detail_data);

$detail_result = "SELECT house_data.thumbnail_photo as thumbnail_photo, house_data.house_id as house_id, house_photo.photo_id as photo_id, house_photo.sub_photo as sub_photo from (house_data join house_photo using(house_id)) WHERE house_id ='$house_id'";

$tampilPeg = mysqli_query($conn, "SELECT * FROM account WHERE email='$_SESSION[email]'");
$peg = mysqli_fetch_array($tampilPeg);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/details_buyer_style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Homepage</title>
</head>

<body>
    <!-- Keseluruhan -->
    <div>
        <!-- navbar -->
        <div class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid" data-aos="zoom-in">
                <!-- <img src="img/20220517_075127.2.png" alt="" width="120px" class="img1"> -->
                <a class="navbar-brand navbar1 pe-4"><span class="navbar2">H</span>OMELINE.</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="container-fluid">
                    <form class="d-flex" role="search" method="post">
                        <input autocomplete="off" class="form-control me-2 searchFormText" type="search" placeholder="Search" aria-label="Search" name="keyword">
                        <div class="searchButton">
                            <button class="btn searchForm" type="submit" name="cari"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="ps-4 collapse navbar-collapse justify-content-end connav" id="navbarNavAltMarkup">
                    <div class="navbar-nav" id="navbar3">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <span class="material-icons">account_circle</span> -->
                                <i class="bi bi-person-circle"></i>
                                <span class="mr-2 text-gray-600 small">
                                    <?php echo $peg['username']; ?>
                                </span>
                                <!-- <span class="material-icons">account_circle</span> -->
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" type="button" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- navbar -->

        <div class="container mt-4 mb-4 text-center">
            <div class="card round1">
                <div class="row">
                    <div class="col-md-7">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="img_database/<?php echo $result['thumbnail_photo'] ?>" class="d-block w-100" alt="...">
                                </div>
                                <?php
                                if ($res = $conn->query($detail_result)) {
                                    $x = 0;
                                    while ($row = $res->fetch_assoc()) {
                                        if ($x == 0) $aktif = "active";
                                        else $aktif = '';
                                ?>
                                        <div class="carousel-item">
                                            <img src="img_database/<?php echo $row['sub_photo'] ?>" class="d-block w-100" alt="...">
                                        </div>
                                <?php
                                        $x++;
                                    } // tutup while
                                }    // tutup if
                                ?>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>

                    <div class="col-6 col-md-5" style="text-align: left;">
                        <div class="row me-2 mt-3">
                            <div class="col-md-6 textTitle">
                                <?= $result['title']; ?>
                            </div>
                            <div class="col-md-6 textHarga">
                                <?= "Rp. " . number_format($result['price'], 2, ',', '.'); ?>
                            </div>
                            <div class="textAlamat mt-3">
                                <div class="textDesc">Alamat:</div>
                                <?= $result['home_address']; ?>
                            </div>
                            <div class="mt-2">
                                <div class="textDesc">
                                    Description:
                                </div>
                                <div class="descText">
                                    <?= $result['description']; ?>
                                </div>
                            </div><br>
                        </div>
                        <div class="container">
                            <div class="me-2 mt-5">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="chatButton">
                                            <a href="homepage_buyer.php"><button class="btn chatForm" type="submit"><i class="bi bi-chevron-compact-left"></i> Back</button></a>
                                        </div>
                                    </div>
                                    <div class="col-md-4 offset-md-2">
                                        <div class="chatButton">
                                            <a href="http://wa.me/62<?= $result['no_wa']; ?>"><button class="btn chatForm" type="submit"><i class="bi bi-chat-right-text"></i></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- footer -->
        <div>
            <div class="container mt-5 mb-5" style="border-bottom: solid black 2px;"></div>
            <div class="container container-5">
                <div class="row">
                    <div class="col-4">
                        <span class="text9">H</span><span class="text8">OMELINE.</span>
                        <div class="text10">Jl. Lkr. Luar Barat No.101, Rw. Buaya, Kecamatan Cengkareng, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11740</div>
                    </div>
                    <div class="col">

                    </div>
                    <div class="col">
                        <div class="text11">
                            About
                        </div>
                        <div class="text10">
                            <a class="text12" href="" data-bs-toggle="modal" data-bs-target="#add">
                                <p>Want to buy?</p>
                            </a>
                            <!-- <a class="text12" type="button" data-bs-toggle="modal" data-bs-target="#update">
                                <p>Update data?</p>
                            </a>
                            <a class="text12" href="" data-bs-toggle="modal" data-bs-target="#delete">
                                <p>Delete data?</p>
                            </a> -->
                        </div>
                    </div>
                    <div class="col">
                        <div class="text11">
                            Contact Us
                        </div>
                        <div class="text10">
                            <!-- <ul><a class="text12" href="">lukmanokaru@gmail.com</a></ul>
                                <ul><a class="text12"  href="">0887-4330-65059</a></ul> -->
                            <a class="text12" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=homeline@gmail.com">
                                <p>homeline@gmail.com</p>
                            </a>
                            <a class="text12" href="http://wa.me/6282266012696">0822-6601-2696</a>
                        </div>
                    </div>
                </div>
                <!-- footer -->

                <!-- footer2 -->
                <div>
                    <div class="container container-6">
                        <div class="row">
                            <p class="text13">
                                Copyright 2022 • All rights reserved • HOMELINE.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- footer2 -->

                <!-- Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Ready to leave?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Select "Logout" below if you are ready to end your current session.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a class="btn btn-primary" href="logout.php" style="background-color: #20C997;">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Logout -->
                <!-- add modal -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Ingin mengiklankan rumah?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                1. Login <br>
                                2. Mencari dan memilih rumah <br>
                                3. Menghubungi penjual <br>
                                4. Melakukan negosiasi <br>
                                5. Melakukan transaksi <br>
                                6. Trasaksi selesai
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add modal -->
            </div>
            <!-- Keseluruhan -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script>
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
    var dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl)
    })
</script>


<script>
    var myModal = document.getElementById('myModal')
    var myInput = document.getElementById('myInput')

    myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
    })
</script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>