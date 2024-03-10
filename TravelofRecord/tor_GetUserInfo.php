<?php
require_once 'mysql_Connect.php';

if ($con) {

    $id = $_GET["id"];

    $sql = "select * from userinfo where id = '$id'";

    $query = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($query);

            $error = "ok";
            echo json_encode(array("response" => $error, "loginType" => $row['loginType'], "id" => $row['id'], "password" => $row['password'], 
            "phone" => $row['phone'], "nickname" => $row['nickname'], "imagePath" => $row['imagePath'], "memo" => $row['memo']));


} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>