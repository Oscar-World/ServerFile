<?php
require_once 'mysql_Connect.php';

if ($con) {

    $roomNum = $_GET["chatRoomNum"];
    $user1 = $_GET["chatRoomUser1"];
    $user2 = $_GET["chatRoomUser2"];
    $lastMessage = $_GET["chatRoomMessage"];
    $lastDate = $_GET["chatRoomDateMessage"];


    $sql = "insert into chatRoom(roomName, user1, user2, lastMessage, lastDate) values('$roomNum', '$user1', '$user2', '$lastMessage', '$lastDate')";
    $query = mysqli_query($con,$sql);

    if ($query) {
        echo "ok";
    } else {
        echo "fail";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>