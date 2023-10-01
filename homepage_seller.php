<?php
include 'functions.php';
ob_start();
session_start();

if (!isset($_SESSION['email'])) {
    die(header("Location:session.php"));
}

$tampilPeg = mysqli_query($conn, "SELECT * FROM account WHERE email='$_SESSION[email]'");
$peg = mysqli_fetch_array($tampilPeg);

$house_data = query("SELECT * FROM (((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id)) WHERE user_id='$peg[user_id]'");

$count = query("SELECT COUNT(house_data.house_id) as count_data FROM (account LEFT JOIN house_data USING(user_id)) where account.level_id = 'lvl002' AND user_id='$peg[user_id]' group by account.user_id");

$count2 = mysqli_query($conn, "SELECT COUNT(house_data.house_id) FROM (account LEFT JOIN house_data USING(user_id)) where account.level_id = 'lvl002' AND email='$_SESSION[email]' group by account.user_id");
$tampilCount = mysqli_fetch_array($count2);
// $house_data = query("SELECT * FROM house_data_status");

// if(isset($_POST["cari"])) {
//     $sell = cari($_POST["keyword"]);
// }


if (isset($_POST["cari"])) {
    $house_data = cari($_POST["keyword"]);
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
    <link rel="stylesheet" href="css/homepage_seller_style.css">
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



        <?php
        if ($tampilCount['COUNT(house_data.house_id)'] > 0) { ?>

            <div class="container mt-4 mb-5">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <!-- <?= $tampilCount['COUNT(house_data.house_id)']; ?> -->
                    <?php foreach ($house_data as $hd) : ?>
                        <div class="col">
                            <div class="card h-100 round1">
                                <img src="img_database/<?= $hd['thumbnail_photo']; ?>" class="card-img-top roundImage" alt="...">
                                <div class="card-body">
                                    <input class="form-control mb-3 statusForm" type="text" value="<?= $hd['status']; ?>" aria-label="Disabled input example" disabled readonly>
                                    <!-- <input class="form-control mb-3 statusForm" type="text" value="<?= $hd['user_id']; ?>" aria-label="Disabled input example" disabled readonly> -->
                                    <h5 class="card-title"><?= $hd['title']; ?></h5>
                                    <div class="textAlamat"><?= $hd['home_address']; ?></div>
                                    <p class="card-text mt-4 textHarga"><?= "Rp. " . number_format($hd['price'], 2, ',', '.'); ?></p>
                                    <a href="details_seller.php?house_id=<?= $hd['house_id']; ?>"><button class="btn detailForm" type="button" name="submit">Details<i class="bi bi-chevron-compact-down ms-2"></i></button></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        <?php } elseif ($tampilCount['COUNT(house_data.house_id)'] < 1) { ?>

            <div class="container mb-4 mt-4">
                <!-- <?= $tampilCount['COUNT(house_data.house_id)']; ?> -->
                <div class="noneText">
                    <center>
                        Belum ada iklan rumah yang diupload <br>
                        Tambah iklan rumah di <a href="add.php?user_id=<?php $peg['user_id']; ?>" class="siniText">sini</a> atau klik tombol + dibawah
                    </center>
                </div>
            </div>

        <?php } ?>

        <div class="container containerAdd">
            <a href="add.php?user_id=<?= $peg['user_id']; ?>"><button class="btn addForm" type="button" name="submit"><i class="text-center bi bi-plus-lg fs-2"></i></button></a>
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
                                <p>Add data?</p>
                            </a>
                            <a class="text12" type="button" data-bs-toggle="modal" data-bs-target="#update">
                                <p>Update data?</p>
                            </a>
                            <a class="text12" href="" data-bs-toggle="modal" data-bs-target="#delete">
                                <p>Delete data?</p>
                            </a>
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

                <!-- Started Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Do you want to start the search?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                You must "Login" to continue
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="login.php" style="background-color: #20C997;">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Started Modal -->

                <!-- add modal -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Ingin mengiklankan rumah?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                1. Tekan tombol + pada bagian atas <br>
                                2. Input data - data rumah <br>
                                4. Menunggu konfirmasi admin <br>
                                5. Jika disetujui maka data akan ditampilkan pada halaman penjualan <br>
                                6. Jika tidak maka akan diberi informasi oleh admin
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- add modal -->

                <!-- update modal -->
                <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Ingin merubah data rumah?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                1. Masuk ke details rumah <br>
                                2. Tekan tombol update <br>
                                3. Ubah data sesuai dengan yang diinginkan <br>
                                4. Menunggu konfirmasi admin <br>
                                5. Jika disetujui maka data akan dirubah <br>
                                6. Jika tidak maka akan diberi informasi oleh admin
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- update modal -->

                <!-- delete modal -->
                <div class="modal fade" id="delete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Ingin menghapus data rumah?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                1. Masuk ke detail rumah <br>
                                2. Tekan tombol delete <br>
                                3. Lakukan konfirmasi penghapusan data <br>
                                4. Data terhapus
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- delete modal -->
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