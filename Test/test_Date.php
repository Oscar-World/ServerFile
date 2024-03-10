<?php
date_default_timezone_set('Asia/Seoul');
echo date("Y-m-d a h:i", time());
echo microtime();

function getMillisecond()
{
  list($microtime,$timestamp) = explode(' ',microtime());
  $millisecondTime = $timestamp.substr($microtime, 2, 3);
 
  return $millisecondTime;
}

echo getMillisecond();

?>