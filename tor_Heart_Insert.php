<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $postNum = $_GET["postNum"];
    $whoLike = $_GET["whoLike"];
    $heart = $_GET["heart"];
    $dateLiked = $_GET["dateLiked"];

    $sql = "insert into userLiked(postNum, whoLike, dateLiked) values('$postNum', '$whoLike', '$dateLiked')"; 
    $query = mysqli_query($con,$sql);

    $sqlUpdate = "update record set heart = '$heart' where num = '$postNum'";
    $queryUpdate = mysqli_query($con,$sqlUpdate);

    $sqlCheck = "select * from userLiked where postNum = '$postNum' and whoLike = '$whoLike'";
    $queryCheck = mysqli_query($con,$sqlCheck);
    $row = mysqli_fetch_assoc($queryCheck);

    echo json_encode(array("postNum" => $row['postNum'], "whoLike" => $row['whoLike']));

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>