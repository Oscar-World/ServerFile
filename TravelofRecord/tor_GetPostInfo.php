<?php
// header('Content-Type: application/json; charset=utf8');
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $nickname = $_GET["nickname"];
    $num = $_GET["num"];
    $pageNum = $_GET["pageNum"];

    if ($num == null) {

        $sql = "select * from record left join userLiked on record.num = userLiked.postNum and whoLike = '$nickname' order by num DESC";

        $query = mysqli_query($con,$sql);
    
        $data = array();

        
        
        $i = $pageNum*5;
        $j = $pageNum*5-5;
        $index = 0;
        $rowNum = mysqli_num_rows($query);
    
        while ($row = mysqli_fetch_array($query)) {

            if ($rowNum-1 == $index) {
                $pagingStatus = "false";
            } else {
                $pagingStatus = "true";
            }
    
            if ($index == $j & $j < $i) {

                array_push($data,
                array('num'=>$row[0],
                'postNickname'=>$row[1],
            'profileImage'=>$row[2],
            'heart'=>$row[3],
            'commentNum'=>$row[4],
            'location'=>$row[5],
            'postImage'=>$row[6],
            'writing'=>$row[7],
            'dateCreated'=>$row[8],
            'postNum' =>$row[9],
            'whoLike' =>$row[10],
            'pagingStatus' =>$pagingStatus));

            $j++;

            }

            $index++;
    
        }
    
        echo json_encode($data);

    } else {

        $sql = "select * from record left join userLiked on record.num = userLiked.postNum and whoLike = '$nickname' where num = '$num' order by num";

        $query = mysqli_query($con,$sql);
    
        $data = array();
    
        while ($row = mysqli_fetch_array($query)) {
    
            array_push($data,
            array('num'=>$row[0],
            'postNickname'=>$row[1],
        'profileImage'=>$row[2],
        'heart'=>$row[3],
        'commentNum'=>$row[4],
        'location'=>$row[5],
        'postImage'=>$row[6],
        'writing'=>$row[7],
        'dateCreated'=>$row[8],
        'postNum' =>$row[9],
        'whoLike' =>$row[10]));
    
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