<?php
    include './lib/connection.php';

    session_start();

    if (!isset($_SESSION['username']) && !isset($_SESSION['level'])) {
        header("Location: ./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Portfolio Saya</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>

    <div class="container pt-5 pb-5">
        <div class="border shadow w-100 p-5 mt-4 mb-4 bg-white text-center">
            <h3>Portfolio Saya</h3>
            <hr>
            <div class="row mt-5">
                <div class="col-4 mb-5">
                    <a href="#" class="link-decoration" data-toggle="modal" data-target="#tambahportfolio">
                        <div class="container border shadow p-5" style="cursor: pointer;">
                            <i class="far fa-plus-square fa-5x mb-3" style="color: #dfdfdf"></i>
                            <h5>Tambah Portfolio</h5>
                        </div>
                    </a>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="tambahportfolio" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="./process/tambah-portfolio.php" method="post" enctype="multipart/form-data" >
                                    <div class="modal-header">
                                        <h5 class="modal-title">Tambah Portfolio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="container">
                                            <input type="hidden" name="idprofil" value="<?=$id_user?>">
                                            <div class="form-group row">
                                                <label for="judul" class="col-2 text-right">Judul Portfolio</label>
                                                <input type="text" class="form-control col-10" name="judul" id="judul" placeholder="Judul Portfolio" required>
                                            </div>
                                            <div class="form-group row">
                                                <label for="deskripsi" class="col-2 text-right">Deskripsi</label>
                                                <textarea class="form-control col-10" name="deskripsi" id="deskripsi" rows="10" placeholder="Deskripsi" required></textarea>
                                            </div>
                                            <div class="form-group row">
                                                <label for="foto" class="col-2 text-right">Gambar</label>
                                                <div class="col-10">
                                                    <input type="file" class="form-control" name="foto" id="foto" required>
                                                    <small class="text-danger">*) Ukuran maksimum 2Mb</small><br>
                                                    <small class="text-danger">*) Hanya upload file gambar saja.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Tambahkan Portfolio">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $queryportfolio = mysqli_query($con, "SELECT * FROM portfolio WHERE id_user = '$id_user' AND flag = '1'");

                if (mysqli_num_rows($queryportfolio) > 0) {
                    while ($queryportfolioassoc = mysqli_fetch_assoc($queryportfolio)) {
                        $idportfolio = $queryportfolioassoc["id_portfolio"];
                        $namaportfolio = $queryportfolioassoc["title"];
                        $imageportfolio = $queryportfolioassoc["attachment"];
                        $descportfolio = $queryportfolioassoc["description"];
                        $iduseruploader = $queryportfolioassoc["id_user"];
                        $userport = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id_user = '$iduseruploader'"));
                        $nama = $userport["name"];
            ?>
                <div class="col-4 mb-5">
                    <div class="container border shadow p-3" data-toggle="modal" data-target="#portfolio-<?=$idportfolio?>" style="cursor: pointer;">
                        <img src="<?=$imageportfolio?>" alt="Portfolio" class="w-100 border shadow">
                        <h5 class="mt-3"><?=$namaportfolio?></h5>
                        <small>Oleh : <?=$nama?></small>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="portfolio-<?=$idportfolio?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><?=$namaportfolio?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="link-decoration btn btn-danger" data-toggle="modal" data-target="#hapusportfolio-<?=$idportfolio?>">Hapus Portfolio</a>
                                    <a href="#" class="link-decoration btn btn-warning" data-toggle="modal" data-target="#editportfolio-<?=$idportfolio?>">Edit Portfolio</a>
                                </div>
                                <div class="modal-body">
                                    <div class="container d-flex flex-column align-items-start">
                                        <img src="<?=$imageportfolio?>" alt="Portfolio" class="w-100 mb-5 border shadow">
                                        <p>
                                            <strong>Deskripsi:</strong>
                                        </p>
                                        <p class="text-left"><?=$descportfolio?></p>
                                        <p>
                                            <strong>Diupload oleh: </strong><?=$nama?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="editportfolio-<?=$idportfolio?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <form action="./process/edit-portfolio-process.php" method="post" enctype="multipart/form-data" >
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Portfolio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="container">
                                            <input type="hidden" name="idportfolio" value="<?=$idportfolio?>">
                                            <div class="form-group row">
                                                <label for="judul" class="col-2 text-right">Judul Portfolio</label>
                                                <input type="text" class="form-control col-10" name="judul" id="judul" placeholder="Judul Portfolio" value="<?=$namaportfolio?>" required>
                                            </div>
                                            <div class="form-group row">
                                                <label for="deskripsi" class="col-2 text-right">Deskripsi</label>
                                                <textarea class="form-control col-10" name="deskripsi" id="deskripsi" rows="10" placeholder="Deskripsi" required><?=$descportfolio?></textarea>
                                            </div>
                                            <div class="form-group row">
                                                <label for="foto" class="col-2 text-right">Gambar</label>
                                                <div class="col-10">
                                                    <img src="<?=$imageportfolio?>" alt="Gambar Portfolio" style="width:200px;">
                                                    <input type="file" class="form-control" name="foto" id="foto">
                                                    <small class="text-danger">*) Ukuran maksimum 2Mb</small><br>
                                                    <small class="text-danger">*) Hanya upload file gambar saja.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <input type="submit" name="submit" class="btn btn-primary" value="Edit Portfolio">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="hapusportfolio-<?=$idportfolio?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <form action="./process/hapus-portfolio-process.php" method="post" enctype="multipart/form-data" >
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Portfolio</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                    </div>
                                    <div class="modal-body text-left">
                                        <div class="container">
                                            Apakah Anda yakin untuk menghapus portfolio ini?
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="idportfolio" value="<?=$idportfolio?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <input type="submit" name="submit" class="btn btn-danger" value="Hapus Portfolio">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                    }
                }
            ?>
            </div>
        </div>
    </div>

    

    <?php include './lib/footer.php'; ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>
<?php
    mysqli_close($con);
?>