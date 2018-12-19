<?php

    include 'constant.php';
    $con = mysqli_connect(HOST, UNAME, PASS, DB);

    if (mysqli_connect_errno()) {
        echo "Failed to connect : " . mysqli_connect_error();
    } else {
        // echo "Success";
    }

?>