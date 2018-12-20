<?php
    include './lib/connection.php';
    
    session_start();

    $id_job = $_GET["id"];

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
        if ($_SESSION['level'] == '1') {
            header("Location: ./administrator.php");
        } else if ($_SESSION['level'] == '3') {
            header("Location: ./freelancer.php");
        } 
    } else {
        header("Location: ./index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client - Pasang Pekerjaan</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <div class="row">
        <div class="col-8 pt-5 pl-5 pb-5 pr-4">
            <div class="container-fluid shadow bg-white p-4">
            <?php
                $selectpelamar = mysqli_query($con, "SELECT a.*, u.* FROM applications AS a INNER JOIN user AS u ON a.id_freelancer = u.id_user WHERE a.id_job = '$id_job'");

                if (mysqli_num_rows($selectpelamar) > 0) {
            ?>
                <h4>Daftar Pelamar</h4>
                <hr>
                <div class="container">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama Pelamar</th>
                            <th scope="col">Dokumen Pendukung</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $numbering = 0;
                            while ($result = mysqli_fetch_assoc($selectpelamar)) {
                                $id_pelamar = $result['id_freelancer'];
                                $namapelamar = $result['name'];
                                $selectlamaran = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM applications WHERE id_freelancer = '$id_pelamar'"));
                                $idlamaran = $selectlamaran["id_applications"];
                                $deskripsi = $selectlamaran['description'];
                                $dokumen = $selectlamaran['document'];
                                $accepted = $selectlamaran['accepted'];
                                $numbering++;
                        ?>
                                <form action="./process/terima-tolak-lamaran-process.php" method="post">
                                    <tr>
                                        <input type="hidden" name="idlamaran" value="<?=$idlamaran?>">
                                        <input type="hidden" name="idjob" value="<?=$id_job?>">
                                        <th scope="row"><?=$numbering?></th>
                                        <td><?=$namapelamar?></td>
                                        <td>
                                            <a href="<?=$dokumen?>" class="link-decoration" target="_blank">Lihat dokumen</a>
                                        </td>
                                        <td>
                                        <a href="#" data-toggle="modal" data-target="#detailLamaran<?=$id_pelamar?>" class="link-decoration btn btn-primary btn-sm pr-4 pl-4">Detail Lamaran</a>
                                        <?php
                                            if ($accepted == '0') {
                                        ?>
                                                <input type="submit" class="btn btn-success btn-sm pr-4 pl-4" name="accept" value="Terima">
                                        <?php
                                            } else if ($accepted == '1') {
                                        ?>
                                                <input type="submit" class="btn btn-danger btn-sm pr-4 pl-4" name="batal" value="Batal Terima">
                                        <?php
                                            }
                                        ?>
                                        </td>
                                    </tr>
                                </form>

                                <!-- Modal Detail -->
                                <div class="modal fade" id="detailLamaran<?=$id_pelamar?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Lamaran oleh <?=$namapelamar?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="form-group row">
                                                        <strong for="deskripsi" class="col-2 text-right ">Lamaran :</strong>
                                                        <p class="col-10"><?=$deskripsi?></p>
                                                    </div>
                                                    <div class="form-group row">
                                                        <strong for="file" class="col-2 text-right">Dokumen Pendukung :</strong>
                                                        <div class="col-10">
                                                            <div class="p-3 mb-3" style="background-color: #f0f0f0">
                                                                <a href="<?=$dokumen?>" class="link-decoration" target="_blank">Lihat dokumen terupload</a>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- Footer -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php       
                                }
                        ?>
                    </tbody>
                </table>
                </div>
            <?php
                } else {
            ?>
                    <div class="container p-5 text-center">
                        <h5>Belum ada freelancer yang mendaftar di pekerjaan ini</h5>
                    </div>
            <?php
                }
            ?>
            </div>
        </div>
        <div class="col-4 pt-5 pl-4 pb-5 pr-5">
            <div class="container-fluid shadow bg-white p-4">
                <h4>
                    Keterangan
                </h4>
                <hr>
                <p>
                    Halaman ini menampilkan daftar freelancer yang mendaftar pada pekerjaan yang dipilih.
                </p>
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