<?php
session_start();
include '../lib/connection.php';

$id_profil = $_GET["id"];

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $queryCheckUsername = "SELECT username FROM user WHERE username = '$username'";
    $checkResultUsername = mysqli_query($con, $queryCheckUsername);
    $resultUsername = mysqli_fetch_assoc($checkResultUsername);
    $queryCheckEmail = "SELECT email FROM user WHERE email = '$email'";
    $checkResultEmail = mysqli_query($con, $queryCheckEmail);
    $resultEmail = mysqli_fetch_assoc($checkResultEmail);

    if (mysqli_num_rows($checkResultUsername) == 0) {
        if (mysqli_num_rows($checkResultEmail) == 0) {
            if (strlen($username) >= 6) {
                if (strlen($password) >= 6) {
                    $query = "UPDATE `user` SET `email` = '$email',`username` = '$username',`password` = '$password' WHERE `id_user` = '$id_profil'";
                    mysqli_query($con, $query);
                    $_SESSION["username"] = $username;
                    echo "<script>alert('Perubahan telah tersimpan!'); window.location = '../pengaturan-akun.php?id=$id_profil';</script>";
                }
                else {
                    echo "<script>alert('Password minimal 6 karakter!'); window.location = '../pengaturan-akun.php?id=$id_profil';</script>";
                }
            }
            else {
                echo "<script>alert('Username minimal 6 karakter!'); window.location = '../pengaturan-akun.php?id=$id_profil';</script>";
            }
        } else if($resultUsername["username"] != $username) {
            $query = "UPDATE `user` SET `username` = '$username', `password` = '$password' WHERE `id_user` = '$id_profil'";
            mysqli_query($con, $query);
            $_SESSION["username"] = $username;
            echo "<script>alert('Perubahan telah tersimpan!'); window.location = '../pengaturan-akun.php?id=$id_profil';</script>";
        }
    } else if($resultEmail["email"] != $email) {
        $query = "UPDATE `user` SET `email` = '$email', `password` = '$password' WHERE `id_user` = '$id_profil'";
        mysqli_query($con, $query);
        echo "<script>alert('Perubahan telah tersimpan!'); window.location = '../pengaturan-akun.php?id=$id_profil';</script>";
    } else {
        echo "<script>alert('Username atau email sudah digunakan!'); window.location = '../pengaturan-akun.php?id=$id_profil';</script>";
    }
}

mysqli_close($con);
?>