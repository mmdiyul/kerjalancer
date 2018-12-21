<?php
include '../../lib/connection.php';

$idport = $_GET["id"];

$query = "UPDATE portfolio SET flag = '1' WHERE id_portfolio = '$idport'";
mysqli_query($con, $query);
header("Location: ../data-portfolio.php");

mysqli_close($con);
?>