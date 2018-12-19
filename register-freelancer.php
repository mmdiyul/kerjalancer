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
    <title>Freelancer - Daftar</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <form action="./process/register-freelancer-process.php" method="post">
        <div class="row mt-5">
            <div class="col-2"></div>
            <div class="col-8 border shadow w-100 p-4 mt-4 mb-4 bg-white">
                <h4>Daftar Sebagai Freelancer</h4>
                <hr>
                <div class="form-group">
                    <label for="nama">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="John Doe" required autofocus>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="john@doe.id" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="johndoe" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="**********" required>
                    </div>
                    <div class="form-group col-6">
                        <label for="telepon">Telepon</label>
                        <input type="number" class="form-control" name="telepon" id="telepon" placeholder="082234659383" required>
                    </div>
                </div>
                <input type="submit" name="submit" class="btn btn-primary btn-block mt-3 mb-3" value="Daftar">
                <span>
                    Sudah punya Akun?
                    <a href="./login.php">Masuk</a>
                </span>
            </div>
            <div class="col-2"></div>
        </div>
    </form>

    <?php include './lib/modal-login-register.php' ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>