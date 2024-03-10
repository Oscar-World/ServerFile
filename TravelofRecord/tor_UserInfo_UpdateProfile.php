<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $nickname = $_POST["nickname"];
    $memo = $_POST["memo"];
    $imagePath = $_POST["imagePath"];
    $beforeImage = $_POST["beforeImage"];

    if (!isset($_FILES['uploaded_file'])) {

        $sql = "update userinfo set memo = '$memo' where nickname = '$nickname'";
        $query = mysqli_query($con,$sql);

        echo "uploadOk1";

    } else {

        $sql = "update userinfo set memo = '$memo' where nickname = '$nickname'";
        $query = mysqli_query($con,$sql);

        $sqlImage = "update userinfo set imagePath = '$imagePath' where nickname = '$nickname'";
        $queryImage = mysqli_query($con,$sqlImage);
    
        $postImage = "update record set profileImage = '$imagePath' where postNickname = '$nickname'";
        $queryPost = mysqli_query($con,$postImage);

        $commentImage = "update comment set profileImage = '$imagePath' where whoComment = '$nickname'";
        $queryComment = mysqli_query($con,$commentImage);

        $chatImage = "update chatting set senderImage = '$imagePath' where sender = '$nickname'";
        $queryChat = mysqli_query($con,$chatImage);

        $upload_dir = "../html/profileImage";
        $file_path = "/";
        $basename = basename($_FILES['uploaded_file']['name']);
        $file_path = $file_path.$basename;
        
        $nameArray = explode(".", $basename);
        $extension = $nameArray[1];
        $extensionAble = array('jpg', 'jpeg', 'png');
    
        if (in_array($extension, $extensionAble)) {
    
            if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $upload_dir.$file_path)) {

                    if (unlink($upload_dir."/".$beforeImage)) {
                        echo "uploadOk2";
                    } else {
                        echo "deleteFail";
                    }
                
            } else {
                echo "uploadFail";
            }
    
        } else {
            echo "extensionFail";
        }
    
    }


    
} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>