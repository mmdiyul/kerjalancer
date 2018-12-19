<!-- Modal Login -->
<!-- <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masuk Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="./process/login-process.php" method="post">
                    <div class="form-group">
                        <label for="username">Email/username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block mb-1" value="Masuk">
                </form>
                <span>
                    Belum punya akun? silakan 
                    <a href="#" data-toggle="modal" data-target="#daftar">Daftar</a>
                </span>
            </div>
            <div class="modal-footer">
                Footer
            </div>
        </div>
    </div>
</div> -->

<!-- Modal Daftar -->
<div class="modal fade" id="daftar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daftar Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body p-3">
                <a href="register-client.php" class="nav-link">
                    <div class="card w-100 text-center p-2 mb-4">
                        <i class="fas fa-user-md fa-5x mb-3"></i>
                        <h5>Daftar Sebagai Client</h5>
                        <p>
                            Pilih Client jika Anda ingin membuka lapangan pekerjaan.
                        </p>
                    </div>
                </a>
                <a href="register-freelancer.php" class="nav-link">
                    <div class="card w-100 text-center p-2">
                        <i class="fas fa-user fa-5x mb-3"></i>
                        <h5>Daftar Sebagai Freelancer</h5>
                        <p>
                            Pilih Freelancer jika Anda ingin menjadi seorang freelancer.
                        </p>
                    </div>
                </a>
            </div>
            <div class="modal-footer">
                <!-- Footer -->
            </div>
        </div>
    </div>
</div>