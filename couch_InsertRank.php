<?php
require_once 'mysql_Connect.php';

if ($con) {

    $modeNum = $_GET["modeNum"];
    $ranking = $_GET["ranking"];
    $nickname = $_GET["nickname"];
    $score = $_GET["score"];


    $sql = "insert into rank(modeNum, nickname, score) values('$modeNum', '$nickname', '$score')";
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