<?php
require_once 'mysql_Connect.php';

// function getMillisecond()
// {
//   list($microtime,$timestamp) = explode(' ',microtime());
//   $millisecondTime = $timestamp.substr($microtime, 2, 3);
 
//   return $millisecondTime;
// }

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");
    // date_default_timezone_set('Asia/Seoul');

    // $nickname = $_GET["postNickname"];

    $sql = "select record.profileImage, record.postNickname, userLiked.dateLiked from record join userLiked on record.num = userLiked.postNum";

    $query = mysqli_query($con,$sql);

    // $currentDay = date("Y-m-d", time());
    // $currentMonth = date("Y-m", time());
    // $currentYear = date("Y", time());

    // while ($dateData = mysqli_fetch_assoc($query)) {

    //     $likedDay = date("Y-m-d", $dateData['dateLiked'] /1000);

    //     if ($likedDay == $currentDay) {

    //     }

    //     echo $likedDay;

    // }

    $data = array();

    while ($row = mysqli_fetch_array($query)) {

        array_push($data,
        array('profileImage'=>$row[0],
               'postNickname'=>$row[1],
               'dateLiked'=>$row[2]));

    }

    echo json_encode($data);

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>