<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $nickname = $_POST["nickname"];
    $profileImage = $_POST["profileImage"];
    $heart = $_POST["heart"];
    $commentNum = $_POST["commentNum"];
    $location = $_POST["location"];
    $postImage = $_POST["postImage"];
    $writing = $_POST["writing"];
    $dateCreated = $_POST["dateCreated"];
    $writeCount = $_POST["writeCount"];

    $sql = "insert into record(postNickname, profileImage, heart, commentNum, location, postImage, writing, dateCreated) 
    values('$nickname', '$profileImage', '$heart', '$commentNum', '$location', '$postImage', '$writing', '$dateCreated')";

    $sql2 = "update userinfo set writeCount = '$writeCount' where nickname = '$nickname'";

    // var_dump($_FILES['uploaded_file']);

    $upload_dir = "../html/postImage";
    $file_path = "/";
    $basename = basename($_FILES['uploaded_file']['name']);
    $file_path = $file_path.$basename;
    
    $nameArray = explode(".", $basename);
    $extension = $nameArray[1];
    $extensionAble = array('jpg', 'jpeg', 'png');

    if (in_array($extension, $extensionAble)) {

        if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $upload_dir.$file_path)) {
            $query = mysqli_query($con,$sql);
            $query2 = mysqli_query($con,$sql2);
            echo "uploadOk";
        } else {
            echo "uploadFail";
        }

    } else {
        echo "extensionFail";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>