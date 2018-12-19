<?php
include '../lib/connection.php';

if (isset($_POST['submit'])) {
    $iduser = $_POST["iduser"];
    $idjob = $_POST["idjob"];
    $desc = mysqli_real_escape_string($con, $_POST["deskripsi"]);
    $code = $_FILES["file"]["error"];

    // print_r($_FILES);die();

    if ($code === 0) {
        $namafolder = "uploads/documents";
        // $filename = explode(".", $_FILES["foto"]["name"]);            
        $tmp = $_FILES["file"]["tmp_name"];
        $newfilename = date('dmYHis').str_replace(" ", "_", basename($_FILES["file"]["name"]));
        $tipefile = array("application/pdf");
        $path = "$namafolder/$newfilename";
        $moveto = "../$namafolder/$newfilename";

        if (!in_array($_FILES["file"]["type"], $tipefile)) {
            echo "<script>alert('Harus upload file pdf!'); window.history.back();</script>";
            die();
        }

        move_uploaded_file($tmp, $moveto);

        $query = "INSERT INTO applications(`description`, document, id_freelancer, id_job) VALUES ('$desc', '$path', '$iduser', '$idjob')";
        mysqli_query($con, $query);
    } elseif ($code === 1) {
        echo "<script>alert('Ukuran dokumen teralu besar! Maksimal 2Mb'); window.history.back();</script>";
        die();
    }

    header("Location: ../detail-pekerjaan-freelancer.php?id=$idjob");
}

mysqli_close($con);
?>