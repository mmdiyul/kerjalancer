<?php
include '../../lib/connection.php';
session_start();
if (isset($_POST['submit'])) {
    $iduser = $_POST['iduser'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $telepon = $_POST['telepon'];
    
    $queryCheckUsername = "SELECT username FROM user WHERE username = '$username' ";
    $checkResultUsername = mysqli_query($con, $queryCheckUsername);
    $resultUsername = mysqli_fetch_assoc($checkResultUsername);
    $queryCheckEmail = "SELECT email FROM user WHERE email = '$email'";
    $checkResultEmail = mysqli_query($con, $queryCheckEmail);
    $resultEmail = mysqli_fetch_assoc($checkResultEmail);

    $uname = $resultUsername["username"];
    $mail = $resultEmail["email"];

    if ($uname == $username && $mail == $email) {
        if (strlen($password) >= 6) {
            $query = "UPDATE user SET `name` = '$nama', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
            mysqli_query($con, $query);
            header("Location: ../data-user.php");
        } else {
            echo "<script>alert('Password minimal 6 karakter!'); window.history.back();</script>";
        }
    } else {
        if (strlen($username) >= 6) {
            if (strlen($password) >= 6) {
                if (mysqli_num_rows($checkResultUsername) == 0) {
                    if (mysqli_num_rows($checkResultEmail) == 0) {
                        $query = "UPDATE user SET `name` = '$nama', `username` = '$username', `email` = '$email', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
                        mysqli_query($con, $query);
                        header("Location: ../data-user.php");
                    } else {
                        $query = "UPDATE user SET `name` = '$nama', `username` = '$username', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
                        mysqli_query($con, $query);
                        header("Location: ../data-user.php");
                        // echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
                    }
                } else {
                    $query = "UPDATE user SET `name` = '$nama', `email` = '$email', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
                    mysqli_query($con, $query);
                    header("Location: ../data-user.php");
                }
            } else {
                echo "<script>alert('Password minimal 6 karakter!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Username minimal 6 karakter!'); window.history.back();</script>";
        }
    }

    // // if (mysqli_num_rows($checkResultUsername) == 0) {
    // if ($uname == $username) {
    //     if ($mail == $email) {
    //     // if (mysqli_num_rows($checkResultEmail) == 0) {
    //         if (strlen($username) >= 6) {
    //             if (strlen($password) >= 6) {
    //                     $query = "UPDATE user SET `name` = '$nama', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
    //                     mysqli_query($con, $query);
    //                     header("Location: ../data-user.php");
    //             }
    //             else {
                    // echo "<script>alert('Password minimal 6 karakter!'); window.history.back();</script>";
    //             }
    //         }
    //         else {
    //             echo "<script>alert('Username minimal 6 karakter!'); window.history.back();</script>";
    //         }
    //     } else if(mysqli_num_rows($checkResultEmail) == 0) {
    //         $query = "UPDATE user SET `name` = '$nama', `email` = '$email', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
    //         mysqli_query($con, $query);
    //         header("Location: ../data-user.php");
    //     } else {
    //         echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
    //     }
    // } else if(mysqli_num_rows($checkResultUsername) == 0) {
    //     if ($username == $_SESSION["username"] && $_SESSION["username"] == $uname) {
    //         $query = "UPDATE user SET `name` = '$nama', `username` = '$username', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
    //         mysqli_query($con, $query);
    //         header("Location: ../data-user.php");
    //     } else {
    //         $query = "UPDATE user SET `name` = '$nama', `username` = '$username', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
    //         mysqli_query($con, $query);
    //         header("Location: ../data-user.php");
    //     }
    // } else {
    //     $query = "UPDATE user SET `name` = '$nama', `username` = '$username', `email` = '$email', `password` = '$password', `phone` = '$telepon' WHERE `id_user` = '$iduser'";
    //     mysqli_query($con, $query);
    //     header("Location: ../data-user.php");
    // }
}

mysqli_close($con);
?>