<?php
require_once 'mysql_Connect.php';

if ($con) {

    $id = $_GET["id"];

    $sql = "select id from userinfo where id = '$id'";

    $query = mysqli_query($con,$sql);

    $data = mysqli_num_rows($query);

    if ($data > 0) {
        echo "usingId";
    } else {
        echo "ok";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>