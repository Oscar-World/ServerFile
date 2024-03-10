<?php
require_once 'mysql_Connect.php';

if ($con) {

    $roomNum = $_GET["roomNum"];
    $sender = $_GET["sender"];

    $sqlUpdate = "update chatting set messageStatus='true' where roomNum = '$roomNum' and sender = '$sender'";
    $queryUpdate = mysqli_query($con,$sqlUpdate);

    $sql = "select * from chatting where roomNum = '$roomNum'";
    $query = mysqli_query($con,$sql);

    $data = array();

    if ($queryUpdate) {

        while($row = mysqli_fetch_array($query)) {

            array_push($data,
            array('roomNum'=>$row[0],
            'sender'=>$row[1],
            'senderImage'=>$row[3],
            'message'=>$row[4],
            'dateMessage'=>$row[5],
            'messageStatus'=>$row[6]));
    
        }
    
        echo json_encode($data);

    }


} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>