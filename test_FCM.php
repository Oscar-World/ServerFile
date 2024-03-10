<?php
 $ch = curl_init("https://fcm.googleapis.com/fcm/send");
 $header = array("Content-Type:application/json", "Authorization: key=AAAAqFL8wLY:APA91bHNPRTNpf9xu3cKbGkv54_3R7MrltCDr_7ZQ86LYrtPNMnU0EOafYh2wFKfFb8BwaKToiMoTUj7B8Y4HEmO5zKba6CHePin5HvmhHllpvy3onZIZGre8Jtf4-C4HBkOx33VPoAR");
 $data = json_encode(array(
     "to" => "fCAdE4Q-TQe2TxnOmxkMar:APA91bGBAuNbLFCfbFZC84x1WDMzBkXdugh9oi5IUOhUSx2zZSvFdjWiJhpRakPmf4ZNBJ_1eX28kHtXpk6BRuI1d-ppt7rsGuMrlAVfMmZVRl3oTH1CwKsBwMZXh2iZgBIs9EAaZ3XW",
     "notification" => array(
         "title"   => "Test",
         "body" => "message")
         ));
 curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
 curl_exec($ch);
?>