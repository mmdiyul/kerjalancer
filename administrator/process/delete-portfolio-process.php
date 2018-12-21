<?php
include '../../lib/connection.php';

$idport = $_GET["id"];

$query = "UPDATE portfolio SET flag = '0' WHERE id_portfolio = '$idport'";
mysqli_query($con, $query);
header("Location: ../data-portfolio.php");

mysqli_close($con);
?>