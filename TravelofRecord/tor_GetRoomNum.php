<?php
require_once 'mysql_Connect.php';

if ($con) {

    $roomNum1 = $_GET["roomNum1"];
    $roomNum2 = $_GET["roomNum2"];

    $sqlRoom1 = "select * from chatting where roomNum = '$roomNum1'";
    $query1 = mysqli_query($con,$sqlRoom1);
    $num1 = mysqli_num_rows($query1);

    $sqlRoom2 = "select * from chatting where roomNum = '$roomNum2'";
    $query2 = mysqli_query($con,$sqlRoom2);
    $num2 = mysqli_num_rows($query2);
    
    if ($num1 > 0) {
        $check = true;
        echo json_encode(array("roomCheck" => $check, "roomNum" => $roomNum1));
    } else if ($num2 > 0) {
        $check = true;
        echo json_encode(array("roomCheck" => $check, "roomNum" => $roomNum2));
    }else {
        $check = false;
        echo json_encode(array("roomCheck" => $check, "roomNum" => $roomNum1));
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>