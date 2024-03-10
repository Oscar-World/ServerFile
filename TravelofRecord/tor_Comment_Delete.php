<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $whoComment = $_GET["whoComment"];
    $dateComment = $_GET["dateComment"];
    $commentNum = $_GET["commentNum"];
    $postNum = $_GET["postNum"];

    $sql = "delete from comment where dateComment = '$dateComment' and whoComment = '$whoComment'";
    $query = mysqli_query($con,$sql);

    $sqlUpdate = "update record set commentNum = '$commentNum' where num = '$postNum'";
    $queryUpdate = mysqli_query($con,$sqlUpdate);

    if ($query) {
        if ($queryUpdate) {
            echo "ok";
        } else {
            echo "updateFail";
        }
    } else {
        echo "deleteFail";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>