<?php
 
  $server  = "vps1.thecjgcjg.com";
  $port   = "25665";
  $timeout = "10";
 
  if ($server and $port and $timeout) {
    $verbinding =  @fsockopen("$server", $port, $errno, $errstr, $timeout);
  }
  if($verbinding) {
    echo "<b>Minecraft server is online</b><br>";
  }
  else {
    echo "Minecraft server is offline";
  }
?>