<?php
require_once 'mysql_Connect.php';

if ($con) {

    $id = $_GET["id"];
    $password = $_GET["password"];

    $sql = "update userinfo set password = '$password' where id = '$id'";

    $query = mysqli_query($con,$sql);


    $sqlPw = "select * from userinfo where id = '$id'";
    $queryPw = mysqli_query($con,$sqlPw);

    $row = mysqli_fetch_assoc($queryPw);

        echo $row['password'];
    
} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>