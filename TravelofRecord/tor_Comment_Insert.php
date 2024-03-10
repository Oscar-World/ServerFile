<?php
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $postNum = $_GET["postNum"];
    $profileImage = $_GET["profileImage"];
    $whoComment = $_GET["whoComment"];
    $dateComment = $_GET["dateComment"];
    $comment = $_GET["comment"];
    $commentNum = $_GET["commentNum"];

    $sqlCheck = "select * from record where num = '$postNum'";
    $queryCheck = mysqli_query($con,$sqlCheck);
    $row = mysqli_num_rows($queryCheck);

    if ($row > 0) {

        $sql = "insert into comment(postNum, profileImage, whoComment, dateComment, content) values('$postNum', '$profileImage', '$whoComment', '$dateComment', '$comment')"; 
        $query = mysqli_query($con,$sql);
    
        $sqlUpdate = "update record set commentNum = '$commentNum' where num = '$postNum'";
        $queryUpdate = mysqli_query($con,$sqlUpdate);
    
        if ($query) {
            if ($queryUpdate) {
                echo "ok";
            } else {
                echo "updateFail";
            }
            
        } else {
            echo "insertFail";
        }

    } else {
        echo "noData";
    }

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>