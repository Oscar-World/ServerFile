<?php
// header('Content-Type: application/json; charset=utf8');
require_once 'mysql_Connect.php';

if ($con) {

    mysqli_set_charset($con,"utf8mb4");
    mysqli_query("SET collation_connection = 'utf8mb4_unicode_ci'");

    $modeNum = $_GET["modeNum"];

        $sql = "select * from rank where modeNum = '$modeNum' order by score desc";

        $query = mysqli_query($con,$sql);
    
        $data = array();
        $num = 1;
    
        while ($row = mysqli_fetch_array($query)) {

                array_push($data,
                array('modeNum'=>$row[0],
                'ranking'=>$num,
                'nickname'=>$row[1],
                'score'=>$row[2]));
        
                $num += 1;

            }
    
        echo json_encode($data);

} else {
    echo "접속 실패";
    $error = mysqli_connect_error();
    $errno = mysqli_connect_errno();
    print "$errno: $error\n"; exit();
}

?>