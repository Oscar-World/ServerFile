<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $nickname = $_GET["nickname"];

    $sql = "select userLiked.dateLiked from record join userLiked on record.num = userLiked.postNum where record.postNickname = '$nickname'";

    $query = mysqli_query($con,$sql);

    $data = array();

    while ($row = mysqli_fetch_array($query)) {

        array_push($data,
        array('dateLiked'=>$row[0]));

    }

    echo json_encode($data);

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>