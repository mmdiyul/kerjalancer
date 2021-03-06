<?php
    include './lib/connection.php';
    
    session_start();

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
    <title>Client - List Pekerjaan</title>
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
            $query = "SELECT j.*, c.*, u.* FROM ((job AS j INNER JOIN category AS c ON j.id_category = c.id_category) INNER JOIN user AS u ON j.id_user = u.id_user) WHERE j.id_user = '$id_user' AND u.flag = '1' AND j.flag = '1'";
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
                                <a href="./detail-pekerjaan-client.php?id=<?=$id_job?>" class="link-decoration">
                                    <h5><?=$namapekerjaan?></h5>
                                </a>
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
                    <h5 class="mt-5">Belum ada pekerjaan yang Anda pasang.</h5>
                    <a href="./pasang-pekerjaan.php">
                        <button class="btn btn-primary mb-5 mt-3">Pasang Pekerjaan Sekarang</button>
                    </a>
                </div>
        <?php
            }
        ?>
        </div>
        <div class="col-4 pt-5 pl-4 pb-5 pr-5">
            <div class="container-fluid shadow bg-white p-4">
                <h4>Halaman Daftar Pekerjaan</h4>
                <hr>
                <p>
                    Halaman ini menampilkan daftar pekerjaan yang telah Anda pasang di Kerjalancer. Pasang pekerjaan sebanyak-banyaknya untuk menciptakan lapangan pekerjaan bagi Freelancer.
                </p>
                <p>
                    <strong>Salam hangat, Kerjalancer</strong>
                </p>
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