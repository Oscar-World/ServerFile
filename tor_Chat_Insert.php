<?php
require_once 'mysql_Connect.php';

if ($con) {

    $roomNum = $_GET["roomNum"];
    $sender = $_GET["sender"];
    $receiver = $_GET["receiver"];
    $senderImage = $_GET["senderImage"];
    $message = $_GET["message"];
    $dateMessage = $_GET["dateMessage"];
    $messageStatus = $_GET["messageStatus"];
    $fcmToken = $_GET["fcmToken"];

    $sql = "insert into chatting(roomNum, sender, receiver, senderImage, message, dateMessage, messageStatus) values('$roomNum', '$sender', '$receiver', '$senderImage', '$message', '$dateMessage', '$messageStatus')";
    $query = mysqli_query($con,$sql);

    $sqlUpdate = "update chatRoom set lastMessage = '$message', lastDate = '$dateMessage' where roomName = '$roomNum'";
    $queryUpdate = mysqli_query($con,$sqlUpdate);

    if ($messageStatus == "false") {

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");
        $header = array("Content-Type:application/json", "Authorization: key=AAAAqFL8wLY:APA91bHNPRTNpf9xu3cKbGkv54_3R7MrltCDr_7ZQ86LYrtPNMnU0EOafYh2wFKfFb8BwaKToiMoTUj7B8Y4HEmO5zKba6CHePin5HvmhHllpvy3onZIZGre8Jtf4-C4HBkOx33VPoAR");
        $data = json_encode(array(
            "to" => $fcmToken,
            "data" => array(
                "title"   => $sender,
                "body" => $message)
                ));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);

    }




    if ($query) {
        echo "ok / ".$fcmToken." / ".$fcmResult;
    } else {
        echo "fail / ".$fcmToken." / ".$fcmResult;
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>