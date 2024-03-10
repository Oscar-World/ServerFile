<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $postNickname = $_GET["postNickname"];

    $sql = "select userinfo.nickname, userinfo.imagePath, userinfo.memo, record.* from userinfo left join record on record.postNickname = '$postNickname' where userinfo.nickname = '$postNickname'";

    $query = mysqli_query($con,$sql);

    $data = array();

    while ($row = mysqli_fetch_array($query)) {

        array_push($data,
        array('nickname'=>$row[0],
        'imagePath'=>$row[1],
    'memo'=>$row[2],
    'num'=>$row[3],
    'postNickname'=>$row[4],
    'profileImage'=>$row[5],
    'heart'=>$row[6],
    'commentNum'=>$row[7],
    'location'=>$row[8],
    'postImage'=>$row[9],
    'writing'=>$row[10],
    'dateCreated'=>$row[11]));

    }

    echo json_encode($data);

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>