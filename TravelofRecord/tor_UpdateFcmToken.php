<?php
require_once 'mysql_Connect.php';

if ($con) {

    $nickname = $_GET["nickname"];
    $fcmToken = $_GET["fcmToken"];

    $sql = "update userinfo set fcmToken = '$fcmToken' where nickname = '$nickname'";
    $query = mysqli_query($con,$sql);

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