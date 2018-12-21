<nav class="navbar navbar-expand-md navbar-light bg-light pl-5 pr-5 fixed-top shadow">
    <a class="navbar-brand" href="index.php"><strong>Kerjalancer</strong></a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <?php
            $username = $_SESSION['username'];
            $level = $_SESSION['level'];
            $query = "SELECT * FROM user WHERE username = '$username'";
            $result = mysqli_fetch_array(mysqli_query($con, $query));
            $id_user = $result['id_user'];
            $nama = $result['name'];
            $profile_picture = $result['profile_picture'];
            $email = $result['email'];
            $phone = $result['phone'];
            $desc = $result['description'];
            $password = $result['password'];
            $daftar = date_create($result['user_create_date']);
            $update = date_create($result['user_update_date']);


            if ($level == 1) {
                header("Location: ./administrator/");
        ?>
                <!-- <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./administrator.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-dark" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Data
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="#">
                                Data Client
                            </a>
                            <a class="dropdown-item" href="#">
                                Data Freelancer
                            </a>
                            <a class="dropdown-item" href="#">
                                Data Pekerjaan
                            </a>
                            <a class="dropdown-item" href="#">
                                Data Portofolio
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-2 mt-2 mt-lg-0 pl-3 border-left">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $nama; ?> &nbsp;
                            <img src="<?php echo $profile_picture; ?>" class="rounded rounded-circle" alt="foto profil" height="23px">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./logout.php">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div class="col-9">
                                    Keluar
                                </div>
                            </div>        
                            </a>
                        </div>
                    </li>
                </ul> -->
        <?php
            } else if ($level == 2) {
        ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./client.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./portfolio.php">Portfolio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-dark" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pekerjaan
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./pasang-pekerjaan.php">
                                Pasang Pekerjaan
                            </a>
                            <a class="dropdown-item" href="./list-pekerjaan-client.php">
                                List Pekerjaan
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-2 mt-2 mt-lg-0 pl-3 border-left">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $nama; ?> &nbsp;
                            <img src="<?php echo $profile_picture; ?>" class="rounded rounded-circle" alt="foto profil" height="23px">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./profil.php?id=<?=$id_user?>">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col-9">
                                        Profil
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="./pengaturan-akun.php?id=<?=$id_user?>">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <div class="col-9">
                                        Pengaturan
                                    </div>
                                </div>                                    
                            </a>
                            <hr>
                            <a class="dropdown-item" href="./logout.php">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div class="col-9">
                                    Keluar
                                </div>
                            </div>        
                            </a>
                        </div>
                    </li>
                </ul>
        <?php
            } else if ($level == 3) {
        ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./freelancer.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./portfolio.php">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="./portfolio-saya.php">Portfolio Saya</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle text-dark" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pekerjaan
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./cari-kerja.php">
                                Cari Pekerjaan
                            </a>
                            <a class="dropdown-item" href="./list-pekerjaan-freelancer.php">
                                List Pekerjaan
                            </a>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-2 mt-2 mt-lg-0 pl-3 border-left">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo $nama; ?> &nbsp;
                            <img src="<?php echo $profile_picture; ?>" class="rounded rounded-circle" alt="foto profil" height="23px">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                            <a class="dropdown-item" href="./profil.php?id=<?=$id_user?>">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="col-9">
                                        Profil
                                    </div>
                                </div>
                            </a>
                            <a class="dropdown-item" href="./pengaturan-akun.php?id=<?=$id_user?>">
                                <div class="row">
                                    <div class="col-3">
                                        <i class="fas fa-cogs"></i>
                                    </div>
                                    <div class="col-9">
                                        Pengaturan
                                    </div>
                                </div>                                    
                            </a>
                            <hr>
                            <a class="dropdown-item" href="./logout.php">
                            <div class="row">
                                <div class="col-3">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div class="col-9">
                                    Keluar
                                </div>
                            </div>        
                            </a>
                        </div>
                    </li>
                </ul>
        <?php
            } else {
        ?>
                <ul class="navbar-nav ml-auto mt-2 mt-lg-0 mr-2">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="portfolio.php">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="cari-kerja.php">Cari Job</a>
                    </li>
                </ul>
                <a class="nav-link text-dark pl-3 border-left" href="./login.php">Masuk</a>
                <a href="#">
                    <button class="btn btn-outline-dark" data-toggle="modal" data-target="#daftar">Daftar Sekarang!</button>
                </a>
        <?php
            }
        ?>
    </div>
</nav>