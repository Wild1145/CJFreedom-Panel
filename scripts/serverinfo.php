<?php
/**
 * @author Kristaps Karlsons <kristaps.karlsons@gmail.com>
 * Licensed under MPL 1.1
 */
 
function mc_status($host,$port='25565') {
    $timeInit = microtime();
    // TODO: implement a way to store data (memcached or MySQL?) - please don't overload target server
    $fp = fsockopen($host,$port,$errno,$errstr,$timeout=10);
    if(!$fp) die($errstr.$errno);
    else {
        fputs($fp, "\xFE"); // xFE - get information about server
        $response = '';
 
        while(!feof($fp)) $response .= fgets($fp);
        fclose($fp);
        $timeEnd = microtime();
 
        $response = str_replace("\x00", "", $response); // remove NULL
 
        //$response = explode("\xFF", $response); // xFF - data start (old version, prior to 1.0?)
        $response = explode("\xFF\x16", $response); // data start
 
        $response = $response[1]; // chop off all before xFF (could be done with regex actually)
 
        //echo(dechex(ord($response[0])));
        $response = explode("\xA7", $response); // xA7 - delimiter
 
        $timeDiff = $timeEnd-$timeInit;
        $response[] = $timeDiff < 0 ? 0 : $timeDiff;
    }
    return $response;
}
 
$data = mc_status('78.129.230.96','25665'); // even better - don't use hostname but provide IP instead (DNS lookup is a waste)
 
print_r($data); // [0] - motd, [1] - online, [2] - slots, [3] - time of request (in microseconds - use this to present latency information)
?>