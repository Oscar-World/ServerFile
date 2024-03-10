<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $num = $_GET["num"];

    $sql = "delete from record where num = '$num'"; 
    $query = mysqli_query($con,$sql);

    $sql2 = "delete from userLiked where postNum = '$num'";
    $query2 = mysqli_query($con,$sql2);

    $sql3 = "delete from comment where postNum = '$num'";
    $query3 = mysqli_query($con,$sql3);

    if ($query) {
        echo "ok";
    } else {
        echo "fail";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>