<?php
// header('Content-Type: application/json; charset=utf8');
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $num = $_GET["num"];
    $sql = "select postNickname from record where num = '$num'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
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