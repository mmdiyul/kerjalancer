<?php
$username = $_SESSION["username"];
$query = mysqli_query($con, "SELECT * FROM user WHERE username = '$username'");
$result = mysqli_fetch_assoc($query);
$name = $result["name"];
$profile_picture = $result["profile_picture"];
?>
<!-- partial:partials/_navbar.html -->
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo" href="index.html"><strong>Kerjalancer</strong></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-stretch">
    <div class="search-field d-none d-md-block">
        <form class="d-flex align-items-center h-100" action="#">
        <div class="input-group">
            <div class="input-group-prepend bg-transparent">
            <i class="input-group-text border-0 mdi mdi-magnify"></i>
            </div>
            <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
        </div>
        </form>
    </div>
    <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item nav-profile dropdown">
        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
            <div class="nav-profile-img">
            <img src="../<?=$profile_picture?>" alt="image">
            <span class="availability-status online"></span>
            </div>
            <div class="nav-profile-text">
            <p class="mb-1 text-black"><?=$name?></p>
            </div>
        </a>
        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
            <a class="dropdown-item" href="../logout.php">
            <i class="mdi mdi-logout mr-2 text-primary"></i>
            Signout
            </a>
        </div>
        </li>
    </div>
</nav>