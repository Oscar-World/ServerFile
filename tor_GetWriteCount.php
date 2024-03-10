<?php
require_once 'mysql_Connect.php';

if ($con) {

    $nickname = $_GET["nickname"];

    $sql = "select writeCount from userinfo where nickname = '$nickname'";

    $query = mysqli_query($con,$sql);

    $row = mysqli_fetch_assoc($query);

            $error = "ok";
            echo json_encode(array("writeCount" => $row['writeCount']));

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>