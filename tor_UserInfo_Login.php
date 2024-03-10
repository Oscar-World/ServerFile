<?php
require_once 'mysql_Connect.php';

if ($con) {

    $id = $_GET["id"];
    $password = $_GET["password"];

    $sql = "select * from userinfo where id = '$id'";

    $query = mysqli_query($con,$sql);

    $data = mysqli_num_rows($query);

    $row = mysqli_fetch_assoc($query);

    if ($data > 0) {

        if ($password == $row['password']) {
            $error = "ok";
            echo json_encode(array("response" => $error, "loginType" => $row['loginType'], "id" => $row['id'], "password" => $row['password'],
            "phone" => $row['phone'], "nickname" => $row['nickname'], "imagePath" => $row['imagePath'], "memo" => $row['memo'], "writeCount" => $row['writeCount']));
    
        } else {
            $error = "noPw";
            echo json_encode(array("response" => $error));
        }

    } else {
        $error = "noId";
        echo json_encode(array("response" => $error));
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>