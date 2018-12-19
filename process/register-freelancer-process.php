<?php

include '../lib/connection.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];
    
    $queryCheckUsername = "SELECT username FROM user WHERE username = '$username' ";
    $checkResultUsername = mysqli_query($con, $queryCheckUsername);
    $queryCheckEmail = "SELECT email FROM user WHERE email = '$email'";
    $checkResultEmail = mysqli_query($con, $queryCheckEmail);

    if (mysqli_num_rows($checkResultUsername) == 0) {
        if (mysqli_num_rows($checkResultEmail) == 0) {
            if (strlen($username) >= 6) {
                if (strlen($password) >= 6) {
                    $query = "INSERT INTO `user`(`name`,`email`,`username`,`password`,`phone`,`level`) VALUES ('$nama', '$email', '$username', '$password', '$telepon', '3')";
                    mysqli_query($con, $query);
                    header("Location: ../login.php");
                }
                else {
                    echo "<script>alert('Password minimal 6 karakter!'); window.history.back();</script>";
                }
            }
            else {
                echo "<script>alert('Username minimal 6 karakter!'); window.history.back();</script>";
            }
        }
        else {
            echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
        }
    }
    else {
        echo "<script>alert('Username sudah digunakan!'); window.history.back();</script>";
    }
}

mysqli_close($con);
?>