<?php
include '../../lib/connection.php';

$idjob = $_GET["id"];

$query = "UPDATE job SET flag = '1' WHERE id_job = '$idjob'";
mysqli_query($con, $query);
header("Location: ../data-job.php");

mysqli_close($con);
?>