<?php
require_once 'mysql_Connect.php';

if ($con) {

    $nickname = $_GET["nickname"];

    $upload_dir = "../html/profileImage";
    $sqlImage = "select imagePath from userinfo where nickname = '$nickname'";
    $queryImage = mysqli_query($con,$sqlImage);
    $beforeImage = mysqli_fetch_assoc($queryImage);
    $image = $beforeImage['imagePath'];

    if (unlink($upload_dir."/".$image)) {

    // $sql = "
    // delete from userinfo where nickname = '$nickname';
    // SET @CNT=0;
    // UPDATE userinfo SET num = @CNT:=@CNT+1;
    // ALTER TABLE userinfo AUTO_INCREMENT=1;
    // ";

    // $query = mysqli_multi_query($con,$sql);

    $sql11 = "delete from userinfo where nickname = '$nickname'";
    $sql22 = "SET @CNT=0";
    $sql33 = "UPDATE userinfo SET num = @CNT:=@CNT+1";
    $sql44 = "ALTER TABLE userinfo AUTO_INCREMENT=1";

    $query = mysqli_query($con,$sql11);
    $query22 = mysqli_query($con,$sql22);
    $query33 = mysqli_query($con,$sql33);
    $query44 = mysqli_query($con,$sql44);

    $sql2 = "delete from record where postNickname = '$nickname'";
    $query2 = mysqli_query($con,$sql2);

    $sqlNum = "select * from userLiked where whoLike = '$nickname'";
    $queryNum = mysqli_query($con,$sqlNum);
    $heartNum = mysqli_num_rows($queryNum);

    if ($heartNum > 0) {

        while ($row = mysqli_fetch_array($queryNum)) {

            $sqlHeart = "select heart from record where num = '$row[0]'";
            $queryHeart = mysqli_query($con,$sqlHeart);
            $beforeHeart = mysqli_fetch_assoc($queryHeart);
            $heart = $beforeHeart['heart'] - 1;
    
            $sqlUpdate = "update record set heart = '$heart' where num = '$row[0]'";
            $queryUpdate = mysqli_query($con,$sqlUpdate);
    
        }

        $sql4 = "delete from userLiked where whoLike = '$nickname'";
        $query4 = mysqli_query($con,$sql4);

    }


    $sqlNum2 = "select postNum from comment where whoComment = '$nickname'";
    $queryNum2 = mysqli_query($con,$sqlNum2);
    $commentNum = mysqli_num_rows($queryNum2);

    if ($commentNum > 0) {

        while($row2 = mysqli_fetch_array($queryNum2)) {

            $sqlComment = "select commentNum from record where num = '$row2[0]'";
            $queryComment = mysqli_query($con,$sqlComment);
            $beforeComment = mysqli_fetch_assoc($queryComment);
            $comment = $beforeComment['commentNum'] - 1;
    
            $sqlUpdate2 = "update record set commentNum = '$comment' where num = '$row2[0]'";
            $queryUpdate2 = mysqli_query($con,$sqlUpdate2);
    
        }

        $sql3 = "delete from comment where whoComment = '$nickname'";
        $query3 = mysqli_query($con,$sql3);

    }


    if ($query) {
        echo "Ok";
    } else {
        echo "query Fail";
    }

    } else {
        echo "imageDelete Fail";
    }
    
    
} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>