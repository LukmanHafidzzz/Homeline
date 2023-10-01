<?php
include 'functions.php';

if (isset($_GET['house_id'])) {
    $house_id = $_GET['house_id'];
} else {
    die("Error. No ID Selected!");
}

$house_data = query("SELECT * FROM (((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id))");
// $house_data = query("SELECT * FROM house_data_status");

$update = query("SELECT * FROM (((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id)) WHERE house_id ='$house_id'")[0];

$update2 = query("SELECT * FROM ((house_photo JOIN house_data USING(house_id)) JOIN sertivicate USING(house_id)) WHERE house_id ='$house_id'")[0];

$updatePhoto = ("SELECT sub_photo FROM house_photo WHERE house_id ='$house_id'");

// if(isset($_POST["cari"])) {
//     $sell = cari($_POST["keyword"]);
// }

if (isset($_POST["submit"])) {
    update_admin($_POST, $house_id);
    add_subPhoto($_POST, $house_id);
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('Data Berhasil diubah!');
                document.location.href = 'adminpage.php';
                </script>";
    } else {
        echo "<script>
                alert('Data Gagal diubah!');
                document.location.href = 'adminpage.php';
                </script>";
    };
}


?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/adminpage_style.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #20C997;" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    HOMELINE
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Database
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="input.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Data</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <span class="material-icons">account_circle</span>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <!-- <div class="dropdown-divider"></div> -->
                                <a class="dropdown-item" href="http://localhost/CodingWeb/lastproject2/landingpage/" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold" style="color: #20C997;">Data User</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <a href="add.php" class="btn btn-success btn-circle btn-sm mb-3">
                                    <span class="material-icons">add</span>
                                </a>
                                <!-- <form method="post" action="">
                                    <input type="text" name="keyword">
                                    <button type="submit" name="cari">Cari!</button>
                                </form> -->
                                <form action="" enctype="multipart/form-data" method="post">
                                    <div class="container mt-4 mb-4">
                                        <div class="row">
                                            <div class="col-md-6 mt-4">
                                                <label for="title" class="form-label">Judul Iklan:</label>
                                                <input class="form-control titleForm" name="title" id="title" type="text" placeholder="Masukan judul iklan" aria-label="default input example" value="<?= $update['title']; ?>">
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="status_id" class="form-label">Status Rumah:</label>
                                                <select name="status_id" id="status_id" class="form-select roleForm" aria-label="Default select example" style="color: black;">
                                                    <option value="<?= $update['status_id']; ?>" selected disabled><?= $update['status']; ?></option>   
                                                    <option value="S001">Waiting</option>
                                                    <option value="S002">Available</option>
                                                    <option value="S003">Sold</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="no_wa" class="form-label">Nomer Whatsapp:</label>
                                                <div style="display: flex;">
                                                    <input class="form-control waForm1" disabled readonly type="text" value="+62" aria-label="Disabled input example">
                                                    <input class="form-control waForm2" name="no_wa" id="no_wa" type="text" placeholder="Contoh: 813xxxxxxxx" aria-label="default input example" value="<?= $update['no_wa']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="price" class="form-label">Harga:</label>
                                                <div style="display: flex;">
                                                    <input class="form-control priceForm1" disabled readonly type="text" value="Rp." aria-label="Disabled input example">
                                                    <input class="form-control priceForm2" name="price" id="price" type="text" placeholder="Contoh: 800000000" aria-label="default input example" autocomplete="off" value="<?= $update['price']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="home_address" class="form-label">Alamat:</label>
                                                <textarea class="form-control addressForm" name="home_address" id="home_address" placeholder="Contoh: Jl. Kenangan, Rt 04/004, Kelurahan, Kecamatan, Kota, Prov." cols="20" rows="5"><?= $update['home_address']; ?></textarea>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="thumbnail_photo" class="form-label">Upload Foto Thumbnail</label>
                                                <input class="form-control form-control-lg thumbForm" type="file" id="thumbnail_photo" name="thumbnail_photo" value="<?= $update['thumbnail_photo']; ?>">
                                                <div>
                                                    <img src="img_database/<?= $update['thumbnail_photo']; ?>" alt="" width="200px">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="description" class="form-label">Deskripsi: (seperti jumlah kamar, fasilitas rumah, dan lainnya)</label>
                                                <!-- <input class="form-control addressForm" name="home_address" id="home_address" type="text" placeholder="Contoh: Jl. Kenangan, Rt 04/004, Kelurahan, Kecamatan, Kota, Prov." aria-label="default input example"> -->
                                                <textarea class="form-control descForm" placeholder="Masukan deskripsi rumah" name="description" id="description" cols="30" rows="10"><?= $update['description']; ?></textarea>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="sertiv_photo" class="form-label">Upload Foto Sertifikat</label>
                                                <input class="form-control form-control-lg thumbForm" type="file" id="sertiv_photo" name="sertiv_photo">
                                                <div>
                                                    <img src="img_sertivicate/<?= $update2['sertiv_photo']; ?>" alt="" width="200px">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mt-4">
                                                <label for="sub_photo" class="form-label">Upload Foto Pelengkap (note: Isi jika ingin merubah foto)</label>
                                                <input class="form-control form-control-lg thumbForm" type="file" id="sub_photo" name="sub_photo[]" multiple>
                                                <?php
                                                if ($res = $conn->query($updatePhoto)) {
                                                    $x = 0;
                                                    while ($row = $res->fetch_assoc()) {
                                                ?>
                                                        <div class="mt-1">
                                                            <img src="img_database/<?php echo $row['sub_photo'] ?>" width="200px">
                                                        </div>
                                                <?php
                                                        $x++;
                                                    } // tutup while
                                                }    // tutup if
                                                ?>
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
                                                <button class="btn chatForm" type="submit" name="submit" id="submit">Update <i class="bi bi-upload"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright 2022 • All rights reserved • HOMELINE.</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="http://localhost/CodingWeb/lastproject2/landingpage/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- back modal -->
    <div class="modal fade" id="backModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Jika anda keluar, data tidak akan berubah dan kembali seperti sebelumnya.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a class="btn btn-primary" href="adminpage.php" style="background-color: #20C997;">Back</a>
                </div>
            </div>
        </div>
    </div>
    <!-- back modal -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
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
</body>

</html>