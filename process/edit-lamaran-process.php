<?php
include '../lib/connection.php';

if (isset($_POST['submit'])) {
    $id_application = $_POST["idapplications"];
    $id_job = $_POST["idjob"];
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

        $query = "UPDATE applications SET `description` = '$desc', `document` = '$path' WHERE `id_applications` = '$id_application'";
        mysqli_query($con, $query);
    } else if ($code === 4) {
        $query = "UPDATE applications SET `description` = '$desc' WHERE `id_applications` = '$id_application'";
        mysqli_query($con, $query);
    } elseif ($code === 1) {
        echo "<script>alert('Ukuran dokumen teralu besar! Maksimal 2Mb'); window.history.back();</script>";
        die();
    }

    header("Location: ../detail-pekerjaan-freelancer.php?id=$id_job");
}

mysqli_close($con);
?>