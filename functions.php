<?php
$conn = mysqli_connect("localhost", "root", "", "homeline");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function registrasi($data)
{
    global $conn;

    $username = $data["username"];
    $email = $data["email"];
    $level_id = $data["level_id"];
    $password = md5($data["password"]);
    // $password = password_hash($data["password"], PASSWORD_DEFAULT);
    $password2 = md5($data["password2"]);

    $query = "SELECT MAX(user_id) as user_id FROM account";
    $hasil = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($hasil);
    $user_id = $data["user_id"];

    $noUrut = (int) substr($user_id, 3, 3);
    $noUrut++;

    $char = "U";
    $user_id = $char . sprintf("%04s", $noUrut);
    // echo $kode_user;

    if ($password !== $password2) {
        echo "<script> alert('Konfirmasi Password Salah');
        location.href = 'signup.php'; </script>";
        exit;
    } else {
        echo "<script> alert('Akun Berhasil Dibuat');
        location.href = 'login.php'; </script>";
        mysqli_query($conn, "INSERT INTO account VALUES ('$user_id', '$username', '$level_id', '$email', '$password')");
        exit;
    }
}

function login($data)
{
    global $conn;

    $email = $data["email"];
    $password = md5($data["password"]);

    $query = mysqli_query($conn, "SELECT * FROM account WHERE email = '$email'");

    // cek email
    if (mysqli_num_rows($query) === 1) {

        // cek password
        $result = mysqli_fetch_assoc($query);
        if ($password === $result["password"]) {
            $_SESSION["login"] = true;
            $username = $result["username"];
            echo "<script> alert('Selamat Datang $username');
            location.href = 'signup.php'; </script>";
        } else {
            echo "<script> alert('email/Password Salah!!!!');
            location.href = 'login.php'; </script>";
        };
    } else if ($data["email"] === "superadmin@gmail.com" && $data["password"] === "admin123") {
        $email = $data["email"];
        $password = $data["password"];
        $_SESSION["login"] = true;
        echo "<script> alert('Selamat Datang Admin');
        location.href = 'adminpage.php'; </script>";
    } else {
        echo "<script> alert('email/Password Salah!!!!');
        location.href = 'adminpage.php'; </script>";
    };
}

function cari($keyword)
{
    $query = "SELECT * FROM (((house_data JOIN house_data_status USING(status_id)) JOIN account USING(user_id)) JOIN account_level USING(level_id)) WHERE title LIKE '%$keyword%' OR home_address LIKE '%$keyword%' OR price LIKE '%$keyword%'";
    return query($query);
}

function upload_thumbnail()
{
    $namaFile = $_FILES["thumbnail_photo"]["name"];
    $ukuranFile = $_FILES["thumbnail_photo"]["size"];
    $error = $_FILES["thumbnail_photo"]["error"];
    $tmpName = $_FILES["thumbnail_photo"]["tmp_name"];


    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script> alert('Pilih gambar terlebih dahulu!'); </script>";
        return false;
    }

    //cek jenis gambar
    $ekstensiGambarvalid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) {
        echo "<script> alert('yang anda upload tidak sesuai!'); </script>";
        return false;
    }

    //cek ukuran gambar
    if ($ukuranFile > 10000000) {
        echo "<script> alert('Ukuran file terlalu besar!'); </script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, "img_database/" . $namaFileBaru);

    return $namaFileBaru;
}

function update_thumbnail()
{
    $namaFile = $_FILES["thumbnail_photo"]["name"];
    $ukuranFile = $_FILES["thumbnail_photo"]["size"];
    $tmpName = $_FILES["thumbnail_photo"]["tmp_name"];

    //cek jenis gambar
    $ekstensiGambarvalid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) {
        // echo "<script> alert('yang anda upload tidak sesuai!'); </script>";
        return false;
    }

    //cek ukuran gambar
    if ($ukuranFile > 10000000) {
        echo "<script> alert('Ukuran file terlalu besar!'); </script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, "img_database/" . $namaFileBaru);

    return $namaFileBaru;
}

function upload_sertiv_photo()
{
    $namaFile = $_FILES["sertiv_photo"]["name"];
    $ukuranFile = $_FILES["sertiv_photo"]["size"];
    $error = $_FILES["sertiv_photo"]["error"];
    $tmpName = $_FILES["sertiv_photo"]["tmp_name"];


    //cek apakah tidak ada gambar yang di upload
    if ($error === 4) {
        echo "<script> alert('Pilih gambar terlebih dahulu!'); </script>";
        return false;
    }

    //cek jenis gambar
    $ekstensiGambarvalid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) {
        echo "<script> alert('yang anda upload tidak sesuai!'); </script>";
        return false;
    }

    //cek ukuran gambar
    if ($ukuranFile > 10000000) {
        echo "<script> alert('Ukuran file terlalu besar!'); </script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;


    // move_uploaded_file($tmpName, "../img_sertiv/" . $namaFileBaru);
    move_uploaded_file($tmpName, "img_sertivicate/" . $namaFileBaru);

    return $namaFileBaru;
}

function update_sertiv_photo()
{
    $namaFile = $_FILES["sertiv_photo"]["name"];
    $ukuranFile = $_FILES["sertiv_photo"]["size"];
    $tmpName = $_FILES["sertiv_photo"]["tmp_name"];

    //cek jenis gambar
    $ekstensiGambarvalid = ["jpg", "jpeg", "png"];
    $ekstensiGambar = explode(".", $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) {
        // echo "<script> alert('yang anda upload tidak sesuai!'); </script>";
        return false;
    }

    //cek ukuran gambar
    if ($ukuranFile > 10000000) {
        echo "<script> alert('Ukuran file terlalu besar!'); </script>";
        return false;
    }

    //lolos pengecekan, gambar siap di upload
    //generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;


    // move_uploaded_file($tmpName, "../img_sertiv/" . $namaFileBaru);
    move_uploaded_file($tmpName, "img_sertivicate/" . $namaFileBaru);

    return $namaFileBaru;
}

function add($data)
{
    global $conn;

    $title = $data['title'];
    $price = $data['price'];
    $home_address = $data['home_address'];
    $no_wa = $data['no_wa'];
    $description = $data['description'];
    $thumbnail_photo = upload_thumbnail();
    if (!$thumbnail_photo) {
        return false;
    }

    $tampilPeg = mysqli_query($conn, "SELECT * FROM account WHERE email='$_SESSION[email]'");
    $peg = mysqli_fetch_array($tampilPeg);
    $user_id = $peg['user_id'];

    // house_id
    $query_house_id = "SELECT MAX(house_id) as house_id FROM house_data";
    $hasil = mysqli_query($conn, $query_house_id);
    $data = mysqli_fetch_array($hasil);
    $house_id = $data["house_id"];

    $noUrut = (int) substr($house_id, 3, 3);
    $noUrut++;

    $char = "H";
    $house_id = $char . sprintf("%05s", $noUrut);
    // house_id

    // sertiv_id
    $query_sertiv_id = "SELECT MAX(sertiv_id) as sertiv_id FROM sertivicate";
    $hasil = mysqli_query($conn, $query_sertiv_id);
    $data = mysqli_fetch_array($hasil);

    $sertiv_id = $data["sertiv_id"];

    $noUrut = (int) substr($sertiv_id, 3, 3);
    $noUrut++;

    $char = "S";
    $sertiv_id = $char . sprintf("%05s", $noUrut);
    // sertiv_id

    // sertiv_photo
    $sertiv_photo = upload_sertiv_photo();
    if (!$sertiv_photo) {
        return false;
    }
    // sertiv_photo


    $query_house_data = "INSERT INTO house_data VALUES ('$house_id', '$user_id', '$thumbnail_photo', '$title', '$price', '$home_address', '$no_wa', '$description', 'S001')";
    $query_sertivicate = "INSERT INTO sertivicate VALUES ('$house_id', '$sertiv_id', '$sertiv_photo')";
    // $query_house_photo = "INSERT INTO house_photo VALUES ('$house_id', '$photo_id', '$sub_photo')";

    mysqli_query($conn, $query_house_data);
    mysqli_query($conn, $query_sertivicate);

    $image = $_FILES['sub_photo']['name'];
    $imageCount = count($image);
    for ($i = 0; $i < $imageCount; $i++) {
        $imageName = $_FILES['sub_photo']['name'][$i];
        $imageTempName = $_FILES['sub_photo']['tmp_name'][$i];
        $ukuranFile = $_FILES["sub_photo"]["size"]["$i"];
        $error = $_FILES["sub_photo"]["error"]["$i"];

        //cek apakah tidak ada gambar yang di upload
        if ($error === 4) {
            echo "<script> alert('Pilih gambar terlebih dahulu!'); </script>";
            return false;
        }

        //cek jenis gambar
        $ekstensiGambarvalid = ["jpg", "jpeg", "png"];
        $ekstensiGambar = explode(".", $imageName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) {
            echo "<script> alert('yang anda upload tidak sesuai!'); </script>";
            return false;
        }

        //cek ukuran gambar
        if ($ukuranFile > 10000000) {
            echo "<script> alert('Ukuran file terlalu besar!'); </script>";
            return false;
        }

        //lolos pengecekan, gambar siap di upload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $ekstensiGambar;

        // photo_id
        $query_photo_id = "SELECT MAX(photo_id) as photo_id FROM house_photo";
        $hasil = mysqli_query($conn, $query_photo_id);
        $data = mysqli_fetch_array($hasil);

        $photo_id = $data['photo_id'];

        $noUrut = (int) substr($photo_id, 3, 4);
        $noUrut++;

        $char = "P";
        $photo_id = $char . sprintf("%06s", $noUrut);
        // photo_id


        move_uploaded_file($imageTempName, "img_database/" . $namaFileBaru);
        $sql = "INSERT INTO house_photo VALUES ('$house_id', '$photo_id', '$namaFileBaru')";
        mysqli_query($conn, $sql);
    }
    // HOUSE_PHOTO
}


function update($data, $house_id)
{
    global $conn;

    $title = $data['title'];
    $price = $data['price'];
    $home_address = $data['home_address'];
    $no_wa = $data['no_wa'];
    $description = $data['description'];
    $thumbnail_photo = update_thumbnail();

    if ($thumbnail_photo) {
        $query_house_data = "UPDATE house_data SET title = '$title', price = '$price', home_address = '$home_address', thumbnail_photo = '$thumbnail_photo', no_wa = '$no_wa', `description` = '$description', status_id = 'S002' WHERE house_id = '$house_id'";
    } else {
        $query_house_data = "UPDATE house_data SET title = '$title', price = '$price', home_address = '$home_address', no_wa = '$no_wa', `description` = '$description', status_id = 'S001' WHERE house_id = '$house_id'";
    }
    mysqli_query($conn, $query_house_data);

    $sertiv_photo = update_sertiv_photo();
    if ($sertiv_photo) {
        $query_sertivicate = "UPDATE sertivicate SET sertiv_photo = '$sertiv_photo' WHERE house_id = '$house_id'";
    } else {
        return $sertiv_photo;
    }
    mysqli_query($conn, $query_sertivicate);
}

function update_admin($data, $house_id)
{
    global $conn;

    $title = $data['title'];
    $status_id = $data['status_id'];
    $price = $data['price'];
    $home_address = $data['home_address'];
    $no_wa = $data['no_wa'];
    $description = $data['description'];
    $thumbnail_photo = update_thumbnail();

    if ($thumbnail_photo) {
        $query_house_data = "UPDATE house_data SET title = '$title', price = '$price', home_address = '$home_address', thumbnail_photo = '$thumbnail_photo', no_wa = '$no_wa', `description` = '$description', status_id = '$status_id' WHERE house_id = '$house_id'";
    } else {
        $query_house_data = "UPDATE house_data SET title = '$title', price = '$price', home_address = '$home_address', no_wa = '$no_wa', `description` = '$description', status_id = '$status_id' WHERE house_id = '$house_id'";
    }
    mysqli_query($conn, $query_house_data);

    $sertiv_photo = update_sertiv_photo();
    if ($sertiv_photo) {
        $query_sertivicate = "UPDATE sertivicate SET sertiv_photo = '$sertiv_photo' WHERE house_id = '$house_id'";
    } else {
        return $sertiv_photo;
    }
    mysqli_query($conn, $query_sertivicate);
}

function add_subPhoto($data, $house_id)
{
    global $conn;

    // $query_house_data = "INSERT INTO house_data VALUES ('$house_id')";
    // $query_sertivicate = "INSERT INTO sertivicate VALUES ('$house_id', '$sertiv_id', '$sertiv_photo')";
    // $query_house_photo = "INSERT INTO house_photo VALUES ('$house_id', '$photo_id', '$sub_photo')";

    // mysqli_query($conn, $query_house_data);
    // mysqli_query($conn, $query_sertivicate);

    $house_id = $_GET['house_id'];

    $image = $_FILES['sub_photo']['name'];
    $imageCount = count($image);
    for ($i = 0; $i < $imageCount; $i++) {
        $imageName = $_FILES['sub_photo']['name'][$i];
        $imageTempName = $_FILES['sub_photo']['tmp_name'][$i];
        $ukuranFile = $_FILES["sub_photo"]["size"]["$i"];
        $error = $_FILES["sub_photo"]["error"]["$i"];

        //cek apakah tidak ada gambar yang di upload
        if ($error === 4) {
            // echo "<script> alert('Pilih gambar terlebih dahulu!'); </script>";
            return false;
        }

        //cek jenis gambar
        $ekstensiGambarvalid = ["jpg", "jpeg", "png"];
        $ekstensiGambar = explode(".", $imageName);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarvalid)) {
            // echo "<script> alert('yang anda upload tidak sesuai!'); </script>";
            return false;
        }

        //cek ukuran gambar
        if ($ukuranFile > 10000000) {
            echo "<script> alert('Ukuran file terlalu besar!'); </script>";
            return false;
        }

        //lolos pengecekan, gambar siap di upload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= ".";
        $namaFileBaru .= $ekstensiGambar;

        // photo_id
        $query_photo_id = "SELECT MAX(photo_id) as photo_id FROM house_photo";
        $hasil = mysqli_query($conn, $query_photo_id);
        $data = mysqli_fetch_array($hasil);

        $photo_id = $data['photo_id'];

        $noUrut = (int) substr($photo_id, 3, 4);
        $noUrut++;

        $char = "P";
        $photo_id = $char . sprintf("%06s", $noUrut);
        // photo_id


        move_uploaded_file($imageTempName, "img_database/" . $namaFileBaru);
        $sql = "INSERT INTO house_photo VALUES ('$house_id', '$photo_id', '$namaFileBaru')";
        mysqli_query($conn, $sql);
    }
    // HOUSE_PHOTO
}

function delete($house_id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM house_data WHERE house_id = '$house_id'");
}