<?php
    include './lib/connection.php';
    
    session_start();
    
    $iduser = $_GET["id"];

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
    }
?>
<!DOCTYPE html>
<html lang="en">
<body class="mt-5">
    <title>Profil</title>
    <?php include './lib/header.php'; ?>
</head>
<body>
<?php include './lib/navbar.php'; ?>
    <div class="row mt-5 mb-5">
        <div class="col-2"></div>
        <div class="col-8 border shadow w-100 p-4 mt-4 mb-4 bg-white">
            <?php
                $resultuser = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id_user = '$iduser' AND flag = '1'"));
                $profile_picture = $resultuser["profile_picture"];
                $nama = $resultuser["name"];
                $username = $resultuser["username"];
                $email = $resultuser["email"];
                $phone = $resultuser["phone"];
                $desc = $resultuser["description"];
                $daftar = date_create($resultuser['user_create_date']);
                $update = date_create($resultuser['user_update_date']);
                $level = $resultuser["level"];
                $queryskill = mysqli_query($con, "SELECT us.*, s.* FROM user_has_skills AS us INNER JOIN skill AS s ON us.id_skill = s.id_skill WHERE us.id_user = '$iduser'");
            ?>
            <h4>Profil</h4>
            <hr>
            <div class="row">
                <div class="col-3 d-flex flex-column justify-content-start align-items-center mt-3 text-center">
                    <img src="<?=$profile_picture?>" alt="Foto Profil" style="width: 80%;" class="mb-3">
                    <h5><?=$nama?></h5>
                </div>
                <div class="col-9 border-left">
                    <div class="w-100 d-flex justify-content-end">
                        <!-- <a href="./portfolio.php?id=<?=$iduser?>" class="link-decoration"></a> -->
                        <form action="./portfolio.php?id=<?=$iduser?>" method="get">
                            <input type="hidden" name="id" value="<?=$iduser?>">
                            <input type="submit" name="submit" class="btn btn-outline-primary" value="Lihat Portfolio">
                        </form>
                        <!-- <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#editProfil">
                            <i class="far fa-eye mr-2"></i>
                            Lihat Portfolio
                        </button> -->
                    </div>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-3">
                            <strong>Nama Lengkap</strong>
                        </div>
                        <div class="col-1">
                            <strong>:</strong>
                        </div>
                        <div class="col-8">
                            <?=$nama?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <strong>Username</strong>
                        </div>
                        <div class="col-1">
                            <strong>:</strong>
                        </div>
                        <div class="col-8">
                            <?=$username?>
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
                            <?=$email?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <strong>Biodata</strong>
                        </div>
                        <div class="col-1">
                            <strong>:</strong>
                        </div>
                        <div class="col-8">
                            <?=$desc?>
                        </div>
                    </div>
                    <?php
                        if ($level == 3) {
                    ?>
                        <div class="row mt-3">
                            <div class="col-3">
                                <strong>Skill</strong>
                            </div>
                            <div class="col-1">
                                <strong>:</strong>
                            </div>
                            <div class="col-8">
                                <ul class="ml-1">
                                    <?php
                                        while ($skillres = mysqli_fetch_assoc($queryskill)) {
                                    ?>
                                            <li><?=$skillres["nama_skill"]?></li>
                                    <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="row mt-3">
                        <div class="col-3">
                            <strong>Nomor Telepon</strong>
                        </div>
                        <div class="col-1">
                            <strong>:</strong>
                        </div>
                        <div class="col-8">
                            <?=$phone?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <strong>Tanggal Mendaftar</strong>
                        </div>
                        <div class="col-1">
                            <strong>:</strong>
                        </div>
                        <div class="col-8">
                            <?=$daftar->format('D, d M Y')?>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-3">
                            <strong>Terakhir Update Profil</strong>
                        </div>
                        <div class="col-1">
                            <strong>:</strong>
                        </div>
                        <div class="col-8">
                            <?=$update->format('D, d M Y')?>
                        </div>
                    </div>
                </div>
            </div>
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