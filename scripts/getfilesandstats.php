<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
include '../classes/Net/SSH2.php';
    require("../login/common.php"); 
    if(empty($_SESSION['user'])) 
    { 
        include 'pages/login.php';
        die(""); 
    }
$ssh = new Net_SSH2($config['SSH_IP']);
if (!$ssh->login($config['SSH_USERNAME'], $config['SSH_PASSWORD'])) {
    exit('Login Failed Contact TheCJGCJG ASAP');
}
//Get the logs
if (!isset($_GET['action'])) {
	die("You didnt define a statistic to get.");
}
if ($_GET['action'] == "logs") {
    header('Content-type: text/yaml');
	if (!isset($_GET['viewer'])) { 
		echo $ssh->exec("tail -50 " . $config['SERVER_LOCATION'] . "logs/latest.log");
	} else {
		echo $ssh->exec("tail -1000 " . $config['SERVER_LOCATION'] . "logs/latest.log");
	}
}
if ($_GET['action'] == "uniqueplayers") {
    echo $ssh->exec("ls " . $config['SERVER_LOCATION'] . "plugins/Essentials/userdata | wc -l");
}
if ($_GET['action'] == "cpuusage") {
    $cpuusage = $ssh->exec("ps aux|awk 'NR > 0 { s +=$3 }; END {print s}'");
	echo round(($cpuusage / 1.25), 0);
}
if ($_GET['action'] == "logsize") {
	$bytesize = $ssh->exec("wc -c < " . $config['SERVER_LOCATION'] . "/server.log");
	$mbsize = ($bytesize / 1024 / 1024);
	echo round($mbsize, 2);
}
if ($_GET['action'] == "totalmemory") {
	$total = $ssh->exec('cat /proc/meminfo | grep \'MemTotal\'');
	$output = str_replace('MemTotal: ', '', $total);
	$output = str_replace(' kB', '', $output);
	$output = ($output / 1024 / 1024);
	$output = round($output, 2);
	echo $output;
}
if ($_GET['action'] == "freememory") {
	$free = $ssh->exec('cat /proc/meminfo | grep \'MemFree\'');
	$output = str_replace('MemFree: ', '', $free);
	$output = str_replace(' kB', '', $output);
	$output = ($output / 1024 / 1024);
	$output = round($output, 2);
	echo $output;
}
if ($_GET['action'] == "usedmemory") {
	$total = $ssh->exec('cat /proc/meminfo | grep \'MemTotal\'');
	$free = $ssh->exec('cat /proc/meminfo | grep \'MemFree\'');
	$total = str_replace('MemTotal: ', '', $total);
	$total = str_replace(' kB', '', $total);
	$total = ($total / 1024 / 1024);
	$total = round($total, 2);
	$free = str_replace('MemFree: ', '', $free);
	$free = str_replace(' kB', '', $free);
	$free = ($free / 1024 / 1024);
	$free = round($free, 2);
	echo abs($total-$free);
}
if ($_GET['action'] == "memoryusage") {
	$free = $ssh->exec('free');
	$free = (string)trim($free);
	$free_arr = explode("\n", $free);
	$mem = explode(" ", $free_arr[1]);
	$mem = array_filter($mem);
	$mem = array_merge($mem);
	$memory_usage = $mem[2]/$mem[1]*100;
    $memory_usage = round($memory_usage);
	echo $memory_usage;
	}
?>