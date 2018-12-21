<?php
  include '../lib/connection.php';
  session_start();
  if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
    if ($_SESSION['level'] == '2') {
      header("Location: ../client.php");
    } else if ($_SESSION['level'] == '3') {
      header("Location: ../freelancer.php");
    } 
  } else {
    header("Location: ../index.php");
  }
  $countfreelanceraktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countfreelancer FROM user WHERE `level` = '3' AND flag = '1'"))["countfreelancer"];
  $countfreelancernonaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countfreelancer FROM user WHERE `level` = '3' AND flag = '0'"))["countfreelancer"];
  $countclientaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countclient FROM user WHERE `level` = '2' AND flag = '1'"))["countclient"];
  $countclientnonaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countclient FROM user WHERE `level` = '2' AND flag = '0'"))["countclient"];
  $countjobaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countjob FROM job WHERE flag = '1'"))["countjob"];
  $countjobnonaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countjob FROM job WHERE flag = '0'"))["countjob"];
  $countlamaranaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countlamaran FROM `applications` WHERE flag = '1'"))["countlamaran"];
  $countlamarannonaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countlamaran FROM `applications` WHERE flag = '0'"))["countlamaran"];
  $countportfolioaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countportfolio FROM portfolio WHERE flag = '1'"))["countportfolio"];
  $countportfoliononaktif = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS countportfolio FROM portfolio WHERE flag = '0'"))["countportfolio"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kerjalancer - Administrator</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
</head>

<body>
  <div class="container-scroller">
    <?php include './partials/navbar.php'; ?>
    <?php include './partials/sidebar.php'; ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title">
              <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
              </span>
              Dashboard
            </h3>
            <nav aria-label="breadcrumb">
              <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                  <span></span>Overview
                  <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
              </ul>
            </nav>
          </div>
          <div class="row">
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Freelancer
                  </h4>
                  <h2 class="mb-5"><?=$countfreelanceraktif?></h2>
                  <h6 class="card-text"><?=$countfreelancernonaktif?> Freelancer Telah Dihapus</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-primary card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Client Aktif
                  </h4>
                  <h2 class="mb-5"><?=$countclientaktif?></h2>
                  <h6 class="card-text"><?=$countclientnonaktif?> Client Telah Dihapus</h6>
                </div>
              </div>
            </div>
            <div class="col-md-4 stretch-card grid-margin">
              <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Job Aktif
                  </h4>
                  <h2 class="mb-5"><?=$countjobaktif?></h2>
                  <h6 class="card-text"><?=$countjobnonaktif?> Job Telah Dihapus</h6>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Lamaran Freelancer
                  </h4>
                  <h2 class="mb-5"><?=$countlamaranaktif?></h2>
                  <h6 class="card-text"><?=$countlamarannonaktif?> Lamaran Telah Dibatalkan</h6>
                </div>
              </div>
            </div>
            <div class="col-md-6 stretch-card grid-margin">
              <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                  <img src="images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                  <h4 class="font-weight-normal mb-3">Total Portfolio Freelancer
                  </h4>
                  <h2 class="mb-5"><?=$countportfolioaktif?></h2>
                  <h6 class="card-text"><?=$countportfoliononaktif?> Portfolio Telah Dihapus</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2017 <a href="https://www.bootstrapdash.com/"
                target="_blank">Bootstrap Dash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>