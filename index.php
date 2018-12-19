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
    <title>Kerjalancer</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <section id="index-top">
        <div class="container-fluid h-100 d-flex flex-column justify-content-center align-items-center text-center text-white">
            <h1>
                <strong>Kerjalancer</strong>
            </h1>
            <h5>
                Mau cari Freelancer? atau mau cari project? Kerjalancer aja :)
            </h5>
            <br>
            <div>
                <a href="./login.php">
                    <button class="btn btn-outline-light btn-lg mr-3">Masuk</button>
                </a>
                <a href="#">
                    <button class="btn btn-danger btn-lg" data-toggle="modal" data-target="#daftar">Daftar Sekarang!</button>
                </a>
            </div>
        </div>
    </section>

    <?php include './lib/footer.php'; ?>

    <?php include './lib/modal-login-register.php' ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>