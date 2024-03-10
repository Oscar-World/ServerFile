<?php
require_once 'mysql_Connect.php';

if ($con) {
    $loginType = $_POST["loginType"];
    $id = $_POST["id"];
    $password = $_POST["pw"];
    $phone = $_POST["phone"];
    $nickname = $_POST["nickname"];
    $imagePath = $_POST["imagePath"];
    $fcmToken = $_POST["fcmToken"];

    $sqlId = "select id from userinfo where id = '$id'";
    $sqlNick = "select nickname from userinfo where nickname = '$nickname'";
    $sqlInsert = "insert into userinfo(loginType, id, password, phone, nickname, imagePath, fcmToken) 
    values('$loginType', '$id', '$password', '$phone', '$nickname', '$imagePath', '$fcmToken')";

    $queryId = mysqli_query($con,$sqlId);
    $dataId = mysqli_num_rows($queryId);

    $queryNick = mysqli_query($con,$sqlNick);
    $dataNick = mysqli_num_rows($queryNick);


    if ($dataId > 0) {
        echo "usingId";
    } else {
        if ($dataNick > 0) {
            echo "usingNickname";
        } else {

            $upload_dir = "../html/profileImage";
            $file_path = "/";
            $basename = basename($_FILES['uploaded_file']['name']);
            $file_path = $file_path.$basename;
            
            $nameArray = explode(".", $basename);
            $extension = $nameArray[1];
            $extensionAble = array('jpg', 'jpeg', 'png');
        
            if (in_array($extension, $extensionAble)) {
        
                if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $upload_dir.$file_path)) {
                    $queryInsert = mysqli_query($con,$sqlInsert);
                    echo "uploadOk";
                } else {
                    echo "uploadFail";
                }
        
            } else {
        
                echo "extensionFail";
        
            }

        }
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>