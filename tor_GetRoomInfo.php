<?php
require_once 'mysql_Connect.php';

if ($con) {

    $nickname = $_GET["nickname"];

    $sql = "select * from chatRoom where user1 = '$nickname' or user2 = '$nickname' order by lastDate desc";
    $query = mysqli_query($con,$sql);


    $data = array();

    while($row = mysqli_fetch_array($query)) {

        $sqlNum = "select * from chatting where roomNum='$row[0]' and messageStatus='false' and receiver = '$nickname'";

        $queryNum = mysqli_query($con,$sqlNum);

        $num = mysqli_num_rows($queryNum);

        if ($nickname == $row[1]) {

            $sql1 = "select imagePath from userinfo where nickname = '$row[2]'";
            $query1 = mysqli_query($con,$sql1);
            $value = mysqli_fetch_assoc($query1);

        } else {

            $sql2 = "select imagePath from userinfo where nickname = '$row[1]'";
            $query2 = mysqli_query($con,$sql2);
            $value = mysqli_fetch_assoc($query2);

        }

        array_push($data,
        array('roomName'=>$row[0],
              'lastMessage'=>$row[3],
              'lastDate'=>$row[4],
              'notReadMessage'=>$num,
              'senderImage'=>$value['imagePath']));

    }

    echo json_encode($data);
    

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>