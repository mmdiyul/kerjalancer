<?php
include '../lib/connection.php';

session_start();

$idportfolio = $_POST["idportfolio"];

if (isset($_POST["submit"])) {
    $query = "UPDATE portfolio SET flag = '0' WHERE id_portfolio = '$idportfolio'";
    mysqli_query($con, $query);
    header("Location: ../portfolio-saya.php");
}

mysqli_close($con);
?>