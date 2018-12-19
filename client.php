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
    <title>Client - Dashboard</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <section id="index-top">
        <div class="container-fluid h-100 d-flex flex-column justify-content-center align-items-center text-center text-white">
            <h1>
                Selamat Datang, 
                <strong>
                    <?php
                        echo $nama;
                    ?>
                </strong>
            </h1>
            <h5>
                Tunggu apa lagi?
            </h5>
            <br>
            <div>
                <a href="./pasang-pekerjaan.php">
                    <button class="btn btn-outline-light btn-lg">Pasang Job Sekarang</button>
                </a>
                &nbsp;&nbsp;&nbsp;Atau&nbsp;&nbsp;&nbsp;
                <a href="./list-pekerjaan-client.php">
                    <button class="btn btn-outline-light btn-lg">Lihat Daftar Job yang Telah Dibuat</button>
                </a>
            </div>
        </div>
    </section>

    <section id="cara-kerja" class="pt-5 pb-5 bg-white">
        <div class="container-fluid h-100 d-flex flex-column justify-content-center align-items-center">
            <h2>Cara Kerja Kerjalancer</h2>
            <div class="row w-100 mt-3">
                <div class="col-4 text-center">
                    <i class="fab fa-teamspeak fa-5x mb-3"></i>
                    <h5>Jelaskan Kebutuhanmu</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptatem sit suscipit, soluta nostrum quos non, earum, deserunt praesentium totam facilis temporibus esse. Sit quaerat quam aperiam nulla, ea dignissimos!
                    </p>
                </div>
                <div class="col-4 text-center">
                    <i class="fas fa-users fa-5x mb-3"></i>
                    <h5>Bandingkan Proposal Freelancer</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse recusandae quisquam ut eveniet, distinctio rem pariatur quas, blanditiis quod vel iste, sed excepturi! Fuga, enim! Laborum dignissimos maiores quia repudiandae!
                    </p>
                </div>
                <div class="col-4 text-center">
                    <i class="fas fa-user-ninja fa-5x mb-3"></i>
                    <h5>Rekrut Freelancer</h5>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit iste provident inventore, fuga sint amet quod, laborum reprehenderit a deserunt ipsam dignissimos voluptas autem quis. Perspiciatis odio corporis quis harum?
                    </p>
                </div>
            </div>
        </div>
    </section>

    <?php include './lib/footer.php'; ?>

    <?php include './lib/scripts.php'; ?>
</body>
</html>
<?php
    mysqli_close($con);
?>