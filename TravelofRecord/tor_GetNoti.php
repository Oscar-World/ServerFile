<?php
require_once 'mysql_Connect.php';

if ($con) {

    $nickname = $_GET["nickname"];

    $sql = "select * from chatRoom where user1 = '$nickname' or user2 = '$nickname' order by lastDate desc";
    $query = mysqli_query($con,$sql);

    while($row = mysqli_fetch_array($query)) {

        $sqlNum = "select * from chatting where roomNum='$row[0]' and messageStatus='false' and receiver = '$nickname'";

        $queryNum = mysqli_query($con,$sqlNum);

        $num = mysqli_num_rows($queryNum);

        $number += $num;

    }

    if ($number > 0) {
        echo "is";
    } else {
        echo "isNot";
    }

    

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>