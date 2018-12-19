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
    <title>Profil</title>
    <?php include './lib/header.php'; ?>
</head>
<body>
<?php include './lib/navbar.php'; ?>
    <div class="row mt-5 mb-5">
        <div class="col-2"></div>
        <div class="col-8 border shadow w-100 p-4 mt-4 mb-4 bg-white">
            <h4>Profil</h4>
            <hr>
            <div class="row">
                <div class="col-3 d-flex flex-column justify-content-start align-items-center mt-3 text-center">
                    <img src="<?=$profile_picture?>" alt="Foto Profil" style="width: 80%;" class="mb-3">
                    <h5><?=$nama?></h5>
                </div>
                <div class="col-9 border-left">
                    <div class="w-100 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editProfil">
                            <i class="far fa-edit mr-2"></i>
                            Edit Profil
                        </button>
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

    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editProfil">
      Launch
    </button> -->
    
    <!-- Modal -->
    <div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="./process/edit-profil-process.php" method="post" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="idprofil" value="<?=$id_user?>">
                            <input type="hidden" name="pathfoto" value="<?=$profile_picture?>">
                            <div class="form-group row">
                                <label for="nama" class="col-2 text-right">Nama Lengkap</label>
                                <input type="text" class="form-control col-10" name="nama" id="nama" value="<?=$nama?>" required>
                            </div>
                            <div class="form-group row">
                                <label for="biodata" class="col-2 text-right">Biodata</label>
                                <textarea class="form-control col-10" name="biodata" id="biodata" rows="10" required><?=$desc?></textarea>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-2 text-right">Foto Profil</label>
                                <div class="col-10">
                                    <img src="<?=$profile_picture?>" alt="Foto Profil" class="mb-3" style="width: 130px;">
                                    <input type="file" class="form-control" name="foto" id="foto" value="<?=$profile_picture?>">
                                    <small class="text-danger">*) Ukuran maksimum 2Mb</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include './lib/footer.php' ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>
<?php
    mysqli_close($con);
?>