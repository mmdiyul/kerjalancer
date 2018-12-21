<?php
include '../lib/connection.php';

session_start();

$idjob = $_POST["idjob"];

if (isset($_POST["submit"])) {
    $query = "UPDATE job SET flag = '0' WHERE id_job = '$idjob'";
    mysqli_query($con, $query);
    header("Location: ../list-pekerjaan-client.php");
}

mysqli_close($con);
?>