<?php
include '../lib/connection.php';

$idlamaran = $_POST["idlamaran"];
$idjob = $_POST["idjob"];

if(isset($_POST["accept"])) {
    $query = "UPDATE applications SET accepted = '1' WHERE id_applications = '$idlamaran'";
    mysqli_query($con, $query);
    header("Location: ../client-lihat-pelamar.php?id=$idjob");
} else if (isset($_POST["batal"])) {
    $query = "UPDATE applications SET accepted = '0' WHERE id_applications = '$idlamaran'";
    mysqli_query($con, $query);
    header("Location: ../client-lihat-pelamar.php?id=$idjob");
}


mysqli_close($con);
?>