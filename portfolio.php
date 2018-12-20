<?php
    include './lib/connection.php';

    session_start();

    $id = $_POST["id"];
    echo $id;

    if (!isset($_SESSION['username']) && !isset($_SESSION['level'])) {
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Portfolio</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>

    <div class="container pt-5 pb-5">
        <div class="border shadow w-100 p-5 mt-4 mb-4 bg-white text-center">
            <h3>Portfolio</h3>
            <hr>
            <div class="row mt-5">
            <?php
                if (isset($_POST["submit"])) {
                    $queryportfolio = mysqli_query($con, "SELECT * FROM portfolio WHERE id_user = '$id'");
                } else {
                    $queryportfolio = mysqli_query($con, "SELECT * FROM portfolio");
                }

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
                        <img src="<?=$imageportfolio?>" alt="Portfolio" class="w-100 border shadow" style="max-height: 320px;">
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
                                <div class="modal-footer">
                                    <!-- Footer -->
                                </div>
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