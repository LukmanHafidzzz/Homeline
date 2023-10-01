<?php
include 'functions.php';
ob_start();
session_start();

if (isset($_POST["submit"])) {
    add($_POST);
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('Data Berhasil ditambahkan!');
                document.location.href = 'homepage_seller.php';
                </script>";
    } else {
        echo "<script>
                alert('Data Gagal ditambahkan!');
                document.location.href = 'homepage_seller.php';
                </script>";
    };
}


// $house_id = $_GET["house_id"];
$house_data = mysqli_query($conn, "SELECT * FROM (((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id))");
$result = mysqli_fetch_array($house_data);


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
    <link rel="stylesheet" href="css/add_style.css">
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

        <form action="" enctype="multipart/form-data" method="post">
            <div class="container mt-4 mb-4">
                <div class="row">
                    <div class="col-md-6 mt-4">
                        <label for="title" class="form-label">Judul Iklan:</label>
                        <input class="form-control titleForm" name="title" id="title" type="text" placeholder="Masukan judul iklan" aria-label="default input example">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="no_wa" class="form-label">Nomer Whatsapp:</label>
                        <div style="display: flex;">
                            <input class="form-control waForm1" disabled readonly type="text" value="+62" aria-label="Disabled input example">
                            <input class="form-control waForm2" name="no_wa" id="no_wa" type="text" placeholder="Contoh: 813xxxxxxxx" aria-label="default input example">
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="price" class="form-label">Harga:</label>
                        <div style="display: flex;">
                            <input class="form-control priceForm1" disabled readonly type="text" value="Rp." aria-label="Disabled input example">
                            <input class="form-control priceForm2" name="price" id="price" type="text" placeholder="Contoh: 800000000" aria-label="default input example" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="home_address" class="form-label">Alamat:</label>
                        <textarea class="form-control addressForm" name="home_address" id="home_address" placeholder="Contoh: Jl. Kenangan, Rt 04/004, Kelurahan, Kecamatan, Kota, Prov." cols="20" rows="5"></textarea>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="thumbnail_photo" class="form-label">Upload Foto Thumbnail</label>
                        <input class="form-control form-control-lg thumbForm" type="file" id="thumbnail_photo" name="thumbnail_photo">
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="sub_photo" class="form-label">Upload Foto Pelengkap (seperti kamar tidur, dapur, dan lainnya)</label>
                        <input class="form-control form-control-lg thumbForm" type="file" id="sub_photo" name="sub_photo[]" multiple>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="sertiv_photo" class="form-label">Upload Foto Sertifikat</label>
                        <input class="form-control form-control-lg thumbForm" type="file" id="sertiv_photo" name="sertiv_photo" multiple>
                    </div>
                    <div class="col-md-6 mt-4">
                        <label for="description" class="form-label">Deskripsi: (seperti jumlah kamar, fasilitas rumah, dan lainnya)</label>
                        <!-- <input class="form-control addressForm" name="home_address" id="home_address" type="text" placeholder="Contoh: Jl. Kenangan, Rt 04/004, Kelurahan, Kecamatan, Kota, Prov." aria-label="default input example"> -->
                        <textarea class="form-control descForm" placeholder="Masukan deskripsi rumah" name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div style="display: flex;" class="row justify-content-end">
                    <div class="col-4">
                    <a data-bs-toggle="modal" data-bs-target="#backModal"><button class="btn chatForm" type="submit"><i class="bi bi-chevron-compact-left"></i> Back</button></a>
                    </div>
                    <div class="col-4">
                        <!-- <input class="form-control" type="text" placeholder="asdasdas"> -->
                    </div>
                    <div class="col-4" style="text-align: end;">
                        <button class="btn chatForm" type="submit" name="submit">Upload <i class="bi bi-upload"></i></button>
                    </div>
                </div>
            </div>
        </form>



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

                <!-- back modal -->
                <div class="modal fade" id="backModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Jika anda keluar, data tidak akan diinput.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <a style="background-color: #20C997;" href="homepage_seller.php?user_id=<?= $peg['user_id']; ?>" class="btn btn-primary">Back</a>
                        </div>
                    </div>
                </div>
                <!-- back modal -->

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