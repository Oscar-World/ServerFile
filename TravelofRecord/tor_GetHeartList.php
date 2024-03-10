<?php
require_once 'mysql_Connect.php';

if ($con) {

    $postNum = $_GET["postNum"];

    $sql = "select whoLike from userLiked where postNum = '$postNum'";
    $query = mysqli_query($con,$sql);

    $data = array();

    while($row = mysqli_fetch_array($query)) {

        $sqlInfo = "select imagePath,nickname from userinfo where nickname = '$row[0]'";
        $queryInfo = mysqli_query($con,$sqlInfo);

        $row2 = mysqli_fetch_array($queryInfo);

        array_push($data,
        array('imagePath'=>$row2[0],
              'nickname'=>$row2[1]));

    }

    echo json_encode($data);
    

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>