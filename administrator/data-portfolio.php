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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
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
              Data Portfolio
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
                  <h4 class="card-title">Data Portfolio</h4>
                  <div class="table-responsive">
                    <table class="table" id="myTable">
                      <thead>
                        <tr>
                          <th>
                            Judul Portfolio
                          </th>
                          <th>
                            Nama Freelancer
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = mysqli_query($con, "SELECT p.*, u.*, p.flag AS fl, p.description AS `desc` FROM portfolio AS p INNER JOIN user AS u ON p.id_user = u.id_user");

                        while ($row = mysqli_fetch_assoc($query)) {
                            $idport = $row["id_portfolio"];
                            $title = $row["title"];
                            $name = $row["name"];
                            $flag = $row["fl"];
                            $desc = $row["desc"];
                            $gambar = $row["attachment"];
                      ?>
                        <tr>
                          <td>
                            <?=$title?>
                          </td>
                          <td>
                            <?=$name?>
                          </td>
                          <td>
                            <?php
                              if ($flag == '1') {
                                echo "Aktif";
                              } else {
                                echo "Tidak Aktif";
                              }
                            ?>
                          </td>
                          <td>
                            <a href="#" class="link-decoration btn btn-outline-primary btn-sm p-3" data-toggle="modal" data-target="#portfolio-<?=$idport?>">Lihat Detail</a>
                            <?php
                              if ($flag == '1') {
                            ?>
                                <a href="./process/delete-portfolio-process.php?id=<?=$idport?>" class="link-decoration btn btn-danger btn-sm p-3">Delete</a>
                            <?php
                              } else {
                            ?>
                                <a href="./process/aktif-portfolio-process.php?id=<?=$idport?>" class="link-decoration btn btn-success btn-sm p-3">Aktifkan</a>
                            <?php
                              }
                            ?>
                          </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="portfolio-<?=$idport?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?=$title?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container d-flex flex-column align-items-start">
                                            <img src="../<?=$gambar?>" alt="Portfolio" class="w-100 mb-5 border shadow">
                                            <p>
                                                <strong>Deskripsi:</strong>
                                            </p>
                                            <p class="text-left"><?=$desc?></p>
                                            <p>
                                                <strong>Diupload oleh: </strong><?=$name?>
                                            </p>
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
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
    $('#myTable').DataTable({
      "lengthMenu": [5, 10, 15, 20],
        "pageLength": 5
    })
  } );
  </script>
</body>

</html>
                        