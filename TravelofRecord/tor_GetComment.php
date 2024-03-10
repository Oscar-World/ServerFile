<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $num = $_GET["postNum"];

    $sql = "select comment.profileImage, whoComment, dateComment, content, comment.commentNumber from comment join record on num = postNum where num = '$num'";

    $query = mysqli_query($con,$sql);

    $data = array();

    while ($row = mysqli_fetch_array($query)) {

        array_push($data,
        array('commentProfileImage'=>$row[0],
        'whoComment'=>$row[1],
    'dateComment'=>$row[2],
    'comment'=>$row[3],
    'commentNumber'=>$row[4]));

    }

    echo json_encode($data);

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>