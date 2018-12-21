<?php
include '../lib/connection.php';

session_start();

$idlamaran = $_POST["idlamaran"];

if (isset($_POST["submit"])) {
    $query = "UPDATE applications SET flag = '0' WHERE id_applications = '$idlamaran'";
    mysqli_query($con, $query);
    header("Location: ../list-pekerjaan-freelancer.php");
}

mysqli_close($con);
?>