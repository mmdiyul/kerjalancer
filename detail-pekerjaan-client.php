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
    <title>Client - Detail Pekerjaan</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <div class="row">
        <div class="col-8 pt-5 pl-5 pb-5 pr-4">
        <?php
            $username = $_SESSION["username"];
            $resultquery = mysqli_query($con, "SELECT u.id_user FROM user AS u INNER JOIN job AS j ON j.id_user = u.id_user WHERE u.username = '$username'");
            $rowusername = mysqli_fetch_assoc($resultquery);
            $id_user = $rowusername['id_user'];
            $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE id_job = '$id_job'";
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_assoc($result);

            $category_image = $row["category_image"];
            $namapekerjaan = $row["job_name"];
            $idcategory = $row["id_category"];
            $category = $row["category_name"];
            $waktupost = $row["job_create_date"];
            $datepost = date_create($waktupost);
            $bataswaktu = $row["apply_expire_date"];
            $expire = date_create($bataswaktu);
            $usercreate = $row["user_create_date"];
            $dateuser = date_create($usercreate);
            $deskripsi = $row["job_description"];
            $salary = $row["job_salary"];
            $namaclient = $row["name"];
            $fotoclient = $row["profile_picture"];
            $queryapplicant = mysqli_query($con, "SELECT COUNT(*) AS applicants FROM applications WHERE id_job = '$id_job'");
            $rowapplicant = mysqli_fetch_assoc($queryapplicant);
            $applicants = $rowapplicant['applicants'];
        ?>
            <div class="container-fluid shadow bg-white p-4 mb-3">
                <div class="w-100 d-flex justify-content-end">
                    <a href="./client-lihat-pelamar.php?id=<?=$id_job?>" class="link-decoration mr-3">
                        <button class="btn btn-outline-success">
                            <i class="fas fa-users mr-2"></i>
                            Lihat Pelamar
                        </button>
                    </a>
                    <a href="#" class="link-decoration" data-toggle="modal" data-target="#editJob">
                        <button class="btn btn-primary">
                            <i class="far fa-edit mr-2"></i>
                            Edit Job
                        </button>
                    </a>
                </div>
                <hr>
                <div class="row d-flex flex-column justify-content-center align-items-center w-100">
                    <img src="<?=$category_image?>" alt="Gambar Category" style="width: 220px;">
                    <h3 class="text-primary"><?=$namapekerjaan?></h3>
                    <div class="row">
                        <i class="far fa-file-alt ml-3 mr-2 text-dark"></i>
                        <span><?=$applicants?> Pelamar</span>
                        <i class="far fa-calendar-alt ml-3 mr-2 text-dark"></i>
                        <span>Pendaftaran ditutup pada: <span class="text-danger"><?=$expire->format('D, d M Y')?></span></span>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <p>
                        <strong class="text-primary">Tanggal Post : </strong> 
                        <?=$datepost->format('D, d M Y')?> <br>
                    </p>
                    <p>
                        <strong class="text-primary">Kategori Pekerjaan : </strong> 
                        <?=$category?> <br>
                    </p>
                    <p>
                        <strong class="text-primary">Salary Pekerjaan : </strong> 
                        <strong>IDR</strong> <?=number_format($salary, 0, '.', ',')?> <br>
                    </p>
                    <p>
                        <strong class="text-primary">Skill yang Dibutuhkan : </strong> 
                    </p>
                    <p class="container">
                        <ul>
                        <?php
                            $queryskills = mysqli_query($con, "SELECT s.*, js.* FROM skill AS s INNER JOIN job_has_skills AS js ON s.id_skill = js.id_skill WHERE js.id_job = '$id_job'");
                            while ($rowskills = mysqli_fetch_assoc($queryskills)) {
                        ?>
                                <li><?=$rowskills["nama_skill"]?></li>
                        <?php
                            }
                        ?>
                        </ul>
                    </p>
                    <p>
                        <strong class="text-primary">Deskripsi Pekerjaan : </strong> 
                    </p>
                    <p class="container">
                        <?=$deskripsi?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-4 pt-5 pl-4 pb-5 pr-5">
            <div class="container-fluid shadow bg-white p-4">
                <h4>Dipost Oleh</h4>
                <hr>
                <div class="row d-flex flex-column justify-content-center align-items-center">
                    <img src="<?=$fotoclient?>" alt="Gambar Category" class="rounded-circle mb-3" style="width: 120px; height: 120px;">
                    <h5><?=$namaclient?></h5>
                    <small>Terdaftar di Kerjalancer pada :</small>
                    <span class="text-success"><?=$dateuser->format('D, d M Y')?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Edit -->
    <div class="modal fade" id="editJob" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form action="./process/edit-pekerjaan-process.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Job</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <input type="hidden" name="idjob" value="<?=$id_job?>">
                            <div class="form-group row">
                                <label for="nama" class="col-2 text-right">Nama Pekerjaan</label>
                                <input type="text" class="form-control col-10" name="nama" id="nama" value="<?=$namapekerjaan?>" required>
                            </div>
                            <div class="form-group row">
                                <label for="kategori" class="col-2 text-right">Kategori Pekerjaan</label>
                                <select class="form-control col-10" name="kategori" id="kategori" required>
                                    <?php
                                        $query = "SELECT * FROM category";
                                        $result = mysqli_query($con, $query);

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($rowres = mysqli_fetch_assoc($result)) {
                                    ?>
                                                <option value="<?=$rowres['id_category'];?>" <?=$rowres['id_category'] == $idcategory ? 'selected="selected"' : '';?>><?=$rowres['category_name'];?></option>
                                    <?php 
                                            }
                                        } 
                                    ?>
                                </select>
                            </div>
                            <div class="form-group row">
                                <label for="bataswaktu" class="col-2 text-right">Batas Waktu Apply</label>
                                <input type="text" class="form-control col-10" name="bataswaktu" id="bataswaktu" value="<?=$expire->format('Y-m-d')?>" data-toggle="datepicker" required>
                            </div>
                            <div class="form-group row">
                                <label for="salary" class="col-2 text-right">Salary</label>
                                <input type="number" class="form-control col-10" name="salary" id="salary" value="<?=$salary?>" required>
                            </div>
                            <div class="form-group row">
                                <label for="deskripsi" class="col-2 text-right">Deskripsi Pekerjaan</label>
                                <textarea class="form-control col-10" name="deskripsi" id="deskripsi" rows="10" required><?=$deskripsi?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input type="submit" name='submit' class="btn btn-primary" value="Simpan Perubahan">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include './lib/footer.php'; ?>

    <?php include './lib/scripts.php'; ?>
    <script>
        $(function() {
            $('[data-toggle="datepicker"]').datepicker({
                format: 'yyyy-mm-dd',
                autoHide: true,
                zIndex: 2048,
            })
        })
    </script>
</body>
</html>
<?php
    mysqli_close($con);
?>