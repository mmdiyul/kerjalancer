<?php
include '../../lib/connection.php';

$iduser = $_GET["id"];

$query = "UPDATE user SET flag = '0' WHERE id_user = '$iduser'";
mysqli_query($con, $query);
header("Location: ../data-user.php");

mysqli_close($con);
?>