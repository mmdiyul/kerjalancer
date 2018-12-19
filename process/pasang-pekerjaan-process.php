<?php

include '../lib/connection.php';

if (isset($_POST['submit'])) {
    $namapekerjaan = $_POST["nama"];
    $kategoripekerjaan = $_POST["kategori"];
    $bataswaktu = $_POST["bataswaktu"];
    $salary = $_POST["salary"];
    $deskripsi = mysqli_real_escape_string($con, $_POST["deskripsi"]);
    $iduser = $_POST["iduser"];
    $waktusekarang = date('Y-m-d');

    if ($bataswaktu >= $waktusekarang) {
        $query = "INSERT INTO job(job_name, id_category, apply_expire_date, job_salary, job_description, id_user) VALUES('$namapekerjaan', '$kategoripekerjaan', '$bataswaktu', '$salary', '$deskripsi', '$iduser')";
        mysqli_query($con, $query);
        header("Location: ../list-pekerjaan-client.php");
    } else {
        echo "<script>alert('Batas waktu tidak boleh kurang dari waktu sekarang!'); window.history.back();</script>";
    }
}

mysqli_close($con);
?>