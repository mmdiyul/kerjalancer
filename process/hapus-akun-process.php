<?php
include '../lib/connection.php';

session_start();

$iduser = $_POST["id"];

if (isset($_POST["submit"])) {
    $query = "UPDATE user SET flag = '0' WHERE id_user = '$iduser'";
    mysqli_query($con, $query);
    session_destroy();
    header("Location: ../index.php");
}

mysqli_close($con);
?>