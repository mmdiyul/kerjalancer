<?php
include '../lib/connection.php';

if (isset($_POST['submit'])) {
    $idportfolio = $_POST["idportfolio"];
    $judul = $_POST["judul"];
    $desc = mysqli_real_escape_string($con, $_POST["deskripsi"]);
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

        // $query = "INSERT INTO portfolio(`title`, `description`, `attachment`, `id_user`) VALUES ('$judul', '$desc', '$path', '$iduser')";
        $query = "UPDATE portfolio SET title = '$judul', `description` = '$desc', attachment = '$path' WHERE id_portfolio = '$idportfolio'";
        mysqli_query($con, $query);
    } else if ($code === 4) {
        $query = "UPDATE portfolio SET title = '$judul', `description` = '$desc' WHERE id_portfolio = '$idportfolio'";
        mysqli_query($con, $query);
    } elseif ($code === 1) {
        echo "<script>alert('Ukuran gambar teralu besar! Maksimal 2Mb'); window.history.back();</script>";
        die();
    }

    header("Location: ../portfolio-saya.php?id=$iduser");
}

mysqli_close($con);
?>