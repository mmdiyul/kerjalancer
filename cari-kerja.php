<?php
    include './lib/connection.php';
    
    session_start();

    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
        if ($_SESSION['level'] == 2) {
            header("Location: ./list-pekerjaan-client.php");
        }
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Client - List Pekerjaan</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <div class="row">
        <div class="col-8 pt-5 pl-5 pb-5 pr-4">
        <?php
            $where = $_POST["where"];
            $wherekategori = $_POST["kategori"];
            $waktusekarang = date('Y-m-d');
            $username = $_SESSION["username"];
            $resultquery = mysqli_query($con, "SELECT u.id_user FROM user AS u INNER JOIN job AS j ON j.id_user = u.id_user WHERE u.username = '$username'");
            $rowusername = mysqli_fetch_assoc($resultquery);
            $id_user = $rowusername['id_user'];
            $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE j.apply_expire_date >= '$waktusekarang' AND u.flag = '1' AND j.flag = '1' ORDER BY j.apply_expire_date";
            if (isset($_POST["submitname"])) {
                $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE (j.job_name LIKE '%$where%' OR j.job_description LIKE '%$where%') AND j.apply_expire_date >= '$waktusekarang' AND u.flag = '1' AND j.flag = '1' ORDER BY j.apply_expire_date";
            } else if (isset($_POST["submitcat"])) {
                $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE j.id_category = '$wherekategori' AND j.apply_expire_date >= '$waktusekarang' AND u.flag = '1' AND j.flag = '1' ORDER BY j.apply_expire_date";
            } else if (isset($_POST["submitclose"])) {
                $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE j.apply_expire_date < '$waktusekarang' AND u.flag = '1' AND j.flag = '1' ORDER BY j.apply_expire_date";
            } else {
                $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE j.apply_expire_date >= '$waktusekarang' AND u.flag = '1' AND j.flag = '1' ORDER BY j.apply_expire_date";
            }
            $result = mysqli_query($con, $query);


            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $id_job = $row["id_job"];
                    $category_image = $row["category_image"];
                    $namapekerjaan = $row["job_name"];
                    $category = $row["category_name"];
                    $waktupost = $row["job_create_date"];
                    $date = date_create($waktupost);
                    $deskripsi = $row["job_description"];
                    $salary = $row["job_salary"];
                    $bataswaktu = $row["apply_expire_date"];
                    $expire = date_create($bataswaktu);
                    $queryapplicant = mysqli_query($con, "SELECT COUNT(*) AS applicants FROM applications INNER JOIN user ON applications.id_freelancer = user.id_user WHERE applications.id_job = '$id_job' AND user.flag = '1' AND applications.flag = '1'");
                    $rowapplicant = mysqli_fetch_assoc($queryapplicant);
                    $applicants = $rowapplicant['applicants'];

        ?>
                    <div class="container-fluid shadow bg-white p-4 mb-3">
                        <div class="row">
                            <div class="col-3">
                                <img src="<?=$category_image?>" alt="Gambar Category" class="w-100">
                            </div>
                            <div class="col-9">
                                <?php
                                    if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
                                        if ($_SESSION['level'] == 3) {
                                            # code...
                                ?>
                                            <a href="./detail-pekerjaan-freelancer.php?id=<?=$id_job?>" class="link-decoration">
                                                <h5><?=$namapekerjaan?></h5>
                                            </a>
                                <?php
                                        }
                                    } else {
                                ?>
                                        <a href="./detail-pekerjaan.php?id=<?=$id_job?>" class="link-decoration">
                                            <h5><?=$namapekerjaan?></h5>
                                        </a>
                                <?php
                                    }
                                ?>
                                <hr>
                                <span class="text-success"><?=$category?> </span>
                                -
                                <span class="text-primary"> Dipost pada: <?=$date->format('D, d M Y')?></span>
                                <p class="par"><?=$deskripsi?></p>
                                <i class="fas fa-hand-holding-usd mr-2 text-dark"></i>
                                <span>IDR <?=number_format($salary, 0, '.', ',')?></span>
                                <i class="far fa-file-alt ml-3 mr-2 text-dark"></i>
                                <span><?=$applicants?> Pelamar</span>
                                <i class="far fa-calendar-alt ml-3 mr-2 text-dark"></i>
                                <span>Pendaftaran ditutup pada: <span class="text-danger"><?=$expire->format('D, d M Y')?></span></span>
                            </div>
                        </div>
                    </div>
        <?php
                }
            } else {
        ?>
                <div class="container-fluid shadow bg-white p-4 mb-3 d-flex flex-column justify-content-center align-items-center">
                    <h5 class="mt-5 mb-5">Tidak ada pekerjaan yang cocok</h5>
                </div>
        <?php
            }
        ?>
        </div>
        <div class="col-4 pt-5 pl-4 pb-5 pr-5">
            <div class="container-fluid shadow bg-white p-4">
                <h4>Pencarian</h4>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="where">Cari:</label>
                        <input type="text" class="form-control" name="where" id="where" placeholder="Masukkan keyword" value="<?=$where?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submitname" class="btn btn-success btn-block" value="Cari Berdasarkan Nama">
                    </div>
                </form>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="where">Cari berdasarkan kategori:</label>
                        <select class="form-control" name="kategori" id="kategori" required>
                            <?php
                                $query = "SELECT * FROM category";
                                $result = mysqli_query($con, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($rowres = mysqli_fetch_assoc($result)) {
                            ?>
                                        <option value="<?=$rowres['id_category'];?>" <?=$rowres['id_category'] == $wherekategori ? 'selected="selected"' : '';?>><?=$rowres['category_name'];?></option>
                            <?php 
                                    }
                                } 
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submitcat" class="btn btn-success btn-block" value="Cari Berdasarkan Kategori">
                    </div>
                </form>
                <hr>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="submit" name="submitall" class="btn btn-primary btn-block" value="Tampilkan Semua Pekerjaan Terbuka">
                    </div>
                </form>
                <form action="" method="post">
                    <div class="form-group">
                        <input type="submit" name="submitclose" class="btn btn-danger btn-block" value="Tampilkan Pekerjaan yang Telah Tertutup">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include './lib/footer.php'; ?>

    <?php include './lib/scripts.php'; ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(".par").each(function(i){
                len=$(this).text().length;
                    if(len>150)
                {
                    $(this).text($(this).text().substr(0,150)+'...')
                }
            })
        })
    </script>
</body>
</html>
<?php
    mysqli_close($con);
?>