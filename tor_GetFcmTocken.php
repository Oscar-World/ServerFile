<?php
require_once 'mysql_Connect.php';

if ($con) {

    $nickname = $_GET["nickname"];

    $sql = "select fcmToken from userinfo where nickname = '$nickname'";
    $query = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($query);

    if ($query) {
        echo $row['fcmToken'];
    } else {
        echo "토큰 없음";
    }
    

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>