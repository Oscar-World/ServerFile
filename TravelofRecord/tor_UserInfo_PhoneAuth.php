<?php
require_once 'mysql_Connect.php';

if ($con) {

    $phone = $_GET["phone"];

    $sql = "select * from userinfo where phone = '$phone'";

    $query = mysqli_query($con,$sql);

    $data = mysqli_num_rows($query);

    $row = mysqli_fetch_assoc($query);

    if ($data > 0) {
        echo $row['id'];
    } else {
        echo "NOID";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>