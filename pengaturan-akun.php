<?php
    include './lib/connection.php';
    
    session_start();
    
    $id_profil = $_GET["id"];

    if (!isset($_SESSION['username']) && !isset($_SESSION['level'])) {
        header("Location: ./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<body class="mt-5">
    <title>Pengaturan Akun</title>
    <?php include './lib/header.php'; ?>
</head>
<body>
<?php include './lib/navbar.php'; ?>
    <div class="row mt-5 mb-5">
        <div class="col-2"></div>
        <div class="col-8 border shadow w-100 p-4 mt-4 mb-4 bg-white">
            <h4>Pengaturan Akun - Edit Akun</h4>
            <hr>
            <form action="./process/pengaturan-akun-process.php?id=<?=$id_profil?>" method="post">
                <div class="row">
                    <div class="col-3 d-flex flex-column justify-content-start align-items-center mt-3">
                        <img src="<?=$profile_picture?>" alt="Foto Profil" style="width: 80%;" class="mb-3">
                        <h5><?=$nama?></h5>
                    </div>
                    <div class="col-9 border-left">
                        <div class="row mt-3">
                            <div class="col-3">
                                <strong>Username</strong>
                            </div>
                            <div class="col-1">
                                <strong>:</strong>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="username" id="username" value="<?=$username?>" required autofocus>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <strong>Email</strong>
                            </div>
                            <div class="col-1">
                                <strong>:</strong>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" id="email" value="<?=$email?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-3">
                                <strong>Password</strong>
                            </div>
                            <div class="col-1">
                                <strong>:</strong>
                            </div>
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" id="password" value="<?=$password?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end">
                            <a href="./client.php" class="link-decoration">
                                <button type="button" class="btn btn-secondary mt-3 mb-3 mr-3">Batal</button>
                            </a>
                            <input type="submit" name="submit" class="btn btn-primary mt-3 mb-3 mr-3" value="Simpan Perubahan">
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-2"></div>
    </div>

    <?php include './lib/footer.php' ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>
<?php
    mysqli_close($con);
?>