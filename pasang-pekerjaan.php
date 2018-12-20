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
    <title>Client - Pasang Pekerjaan</title>
    <?php include './lib/header.php'; ?>
</head>
<body class="mt-5">
    <?php include './lib/navbar.php'; ?>
    <form action="./process/pasang-pekerjaan-process.php" method="post">
        <div class="row">
            <div class="col-8 pt-5 pl-5 pb-5 pr-4">
                <div class="container-fluid shadow bg-white p-4">
                    <h4>Pasang Pekerjaan</h4>
                    <hr>
                    <div class="container">
                        <input type="hidden" name="iduser" value="<?=$id_user?>">
                        <div class="form-group row">
                            <label for="nama" class="col-2 text-right">Nama Pekerjaan</label>
                            <input type="text" class="form-control col-10" name="nama" id="nama" placeholder="Nama Pekerjaan" required autofocus>
                        </div>
                        <div class="form-group row">
                            <label for="kategori" class="col-2 text-right">Kategori Pekerjaan</label>
                            <select class="form-control col-10" name="kategori" id="kategori" required>
                                <?php
                                    $query = "SELECT * FROM category";
                                    $result = mysqli_query($con, $query);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                            <option value="<?=$row['id_category'];?>"><?=$row['category_name'];?></option>
                                <?php 
                                        }
                                    } 
                                ?>
                            </select>
                        </div>
                        <div class="form-group row">
                            <?php
                                $date = date_create(date('Y-m-d'));
                                date_modify($date, '+1 day');
                                // $date->modify('+1 day');
                            ?>
                            <label for="bataswaktu" class="col-2 text-right">Batas Waktu Apply</label>
                            <input type="text" class="form-control col-10" name="bataswaktu" id="bataswaktu" value="<?=date_format($date, 'Y-m-d')?>" data-toggle="datepicker" required>
                        </div>
                        <div class="form-group row">
                            <label for="salary" class="col-2 text-right">Salary</label>
                            <input type="number" class="form-control col-10" name="salary" id="salary" placeholder="Salary" required>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-2 text-right">Deskripsi Pekerjaan</label>
                            <textarea class="form-control col-10" name="deskripsi" id="deskripsi" rows="10" placeholder="Jelaskan tentang kebutuhan anda. Misalnya, 'Saya membutuhkan aplikasi berbasis mobile dengan ketentuan sebagai berikut ...'" required></textarea>
                        </div>
                        <div class="form-group row">
                            <label for="deskripsi" class="col-2 text-right">Deskripsi Pekerjaan</label>
                            <div class="col-10 form-control" style="height:200px; overflow-y: scroll;">
                            <?php
                                $queryselectskill = mysqli_query($con, "SELECT * FROM skill");
                                while ($rowskill = mysqli_fetch_assoc($queryselectskill)) {
                                    $idskill = $rowskill["id_skill"];
                                    $namaskill = $rowskill["nama_skill"];
                            ?>
                                <input type="checkbox" name="skill[]" id="skill" value="<?=$idskill?>"> <?=$namaskill?> <br>
                            <?php
                                }
                            ?>
                            </div>
                        </div>
                        <div class="form-group w-100 d-flex justify-content-end mt-4">
                            <input type="submit" name="submit" value="Tambah Pekerjaan" class="btn btn-success ">                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 pt-5 pl-4 pb-5 pr-5">
                <div class="container-fluid shadow bg-white p-4">
                    <h4>
                        Keterangan
                    </h4>
                    <hr>
                    <p>
                        <strong>Nama Pekerjaan:</strong>
                        Diisi dengan judul pekerjaan yang akan di post.
                    </p>
                    <p>
                        <strong>Kategori Pekerjaan:</strong>
                        Diisi dengan kategori pekerjaan yang akan di post.
                    </p>
                    <p>
                        <strong>Batas Waktu Apply:</strong>
                        Diisi dengan batas waktu freelancer dapat melamar di pekerjaan ini.
                    </p>
                    <p>
                        <strong>Salary:</strong>
                        Diisi dengan gaji yang akan dibayarkan ketika pekerjaan selesai.
                    </p>
                    <p>
                        <strong>Deskripsi Pekerjaan:</strong>
                        Diisi dengan deskripsi yang menjelaskan tentang pekerjaan dan kebutuhan-kebutuhan apa saja yang diperlukan dalam pekerjaan ini.
                    </p>
                    <p>
                        <strong>Skill:</strong>
                        Diisi dengan skill yang diprioritaskan harus dimiliki oleh freelancer.
                    </p>
                </div>
            </div>
        </div>
    </form>

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