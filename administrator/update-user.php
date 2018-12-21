<?php
include '../lib/connection.php';
session_start();
$id_user = $_GET["id"];
if (isset($_SESSION['username']) && isset($_SESSION['level'])) {
  if ($_SESSION['level'] == '2') {
    header("Location: ../client.php");
  } else if ($_SESSION['level'] == '3') {
    header("Location: ../freelancer.php");
  } 
} else {
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kerjalancer - Administrator</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
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
              Update User
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
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update User</h4>
                  <?php
                    $query = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id_user = '$id_user'"));
                    $iduser = $query["id_user"];
                    $name = $query["name"];
                    $email = $query["email"];
                    $username = $query["username"];
                    $password = $query["password"];
                    $telepon = $query["phone"];

                    // echo $password;die();
                  ?>
                    <form action="./process/update-user-process.php" method="post">
                        <div class="row">
                            <div class="col-12 p-2 mt-4 mb-4 bg-white">
                                <input type="hidden" name="iduser" value="<?=$iduser?>">
                                <div class="form-group">
                                    <label for="nama">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?=$name?>" placeholder="John Doe" required autofocus>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="john@doe.id" value="<?=$email?>" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="username" id="username" placeholder="johndoe" value="<?=$username?>" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" name="password" id="password" placeholder="**********" value="<?=$password?>" required>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="telepon">Telepon</label>
                                        <input type="number" class="form-control" name="telepon" id="telepon" placeholder="082234659383" value="<?=$telepon?>" required>
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary btn-block mt-3 mb-3" value="Update">
                            </div>
                        </div>
                    </form>
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
  <!-- <script src="../js/jquery-3.3.1.min.js"></script> -->
</body>

</html>