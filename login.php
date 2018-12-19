<?php
    session_start();

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
        if ($_SESSION['level'] == '1') {
            header("Location: ./administrator.php");
        } else if ($_SESSION['level'] == '2') {
            header("Location: ./client.php");
        } else if ($_SESSION['level'] == '3') {
            header("Location: ./freelancer.php");
        } 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kerjalancer - Login</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="col-4 border shadow w-100 p-4 mt-4 mb-4 bg-white">
            <h4>Masuk</h4>
            <hr>
            <form action="./process/login-process.php" method="post">
                <div class="form-group">
                    <label for="username">Email/username</label>
                    <input type="text" class="form-control" name="username" id="username" required autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <input type="submit" class="btn btn-primary btn-block mb-2" value="Masuk">
            </form>
            <span>
                Belum punya akun? silakan 
                <a href="#" data-toggle="modal" data-target="#daftar">Daftar</a>
            </span>
        </div>
        <div class="col-4"></div>
    </div>

    <?php include './lib/modal-login-register.php' ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>