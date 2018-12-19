<?php
include '../lib/connection.php';

if (isset($_POST['submit'])) {
    $iduser = $_POST["idprofil"];
    $nama = $_POST["nama"];
    $desc = mysqli_real_escape_string($con, $_POST["biodata"]);
    $foto = $_POST["pathfoto"];
    $waktusekarang = date('Y-m-d H:i:s');
    $code = $_FILES["foto"]["error"];

    // print_r($_FILES);die();

    if ($code === 0) {
        $namafolder = "uploads/images";
        // $filename = explode(".", $_FILES["foto"]["name"]);            
        $tmp = $_FILES["foto"]["tmp_name"];
        $newfilename = date('dmYHis').str_replace(" ", "_", basename($_FILES["foto"]["name"]));
        $tipefile = array("image/jpeg", "image/gif", "image/png");
        $path = "$namafolder/$newfilename";
        $moveto = "../$namafolder/$newfilename";

        if (!in_array($_FILES["foto"]["type"], $tipefile)) {
            echo "<script>alert('Harus upload file gambar!'); window.history.back();</script>";
            die();
        }

        move_uploaded_file($tmp, $moveto);

        $query = "UPDATE user SET `name` = '$nama', `description` = '$desc', `profile_picture` = '$path', `user_update_date` = '$waktusekarang' WHERE `id_user` = '$iduser'";
        mysqli_query($con, $query);
    } else if ($code === 4) {
        $query = "UPDATE `user` SET `name` = '$nama', `description` = '$desc', `profile_picture` = '$foto', `user_update_date` = '$waktusekarang' WHERE `id_user` = '$iduser'";
        mysqli_query($con, $query);
    } elseif ($code === 1) {
        echo "<script>alert('Ukuran gambar teralu besar! Maksimal 2Mb'); window.history.back();</script>";
        die();
    }

    header("Location: ../profil.php?id=$iduser");
}

mysqli_close($con);
?>