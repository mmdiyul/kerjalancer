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
    $skill = $_POST["skill"];

    if ($bataswaktu >= $waktusekarang) {
        $query = "INSERT INTO job(job_name, id_category, apply_expire_date, job_salary, job_description, id_user) VALUES('$namapekerjaan', '$kategoripekerjaan', '$bataswaktu', '$salary', '$deskripsi', '$iduser')";
        mysqli_query($con, $query);
        $lastid = mysqli_insert_id($con);
        foreach ($skill as $s) {
            $queryinsertskill = "INSERT INTO job_has_skills VALUES ('$lastid', '$s')";
            mysqli_query($con, $queryinsertskill);
        }
        header("Location: ../detail-pekerjaan-client.php?id=$lastid");
    } else {
        echo "<script>alert('Batas waktu tidak boleh kurang dari waktu sekarang!'); window.history.back();</script>";
    }
}

mysqli_close($con);
?>