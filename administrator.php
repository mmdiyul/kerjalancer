<?php
    include './lib/connection.php';
    
    session_start();

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
        if ($_SESSION['level'] == '1') {
            header("Location: ./administrator/");
        } else if ($_SESSION['level'] == '2') {
            header("Location: ./client.php");
        } else if ($_SESSION['level'] == '3') {
            header("Location: ./freelancer.php");
        }
    } else {
        header("Location: ./index.php");
    }
?>