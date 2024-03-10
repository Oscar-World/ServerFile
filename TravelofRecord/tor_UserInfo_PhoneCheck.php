<?php
require_once 'mysql_Connect.php';

if ($con) {

    $phone = $_GET["phone"];

    $sql = "select loginType from userinfo where phone = '$phone'";

    $query = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($query);
    $data = mysqli_num_rows($query);

    if ($data > 0) {
        echo $row['loginType'];
    } else {
        echo "noPhone";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>