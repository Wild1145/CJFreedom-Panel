<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
include '../classes/Net/SSH2.php';
include '../classes/yaml_parse/sfYaml.php';
header('Content-type: application/json');
$sshup = @fsockopen($config['SSH_IP'], 22, $errno, $errstr, "1");
if ($sshup) {
$ssh = new Net_SSH2($config['SSH_IP']);
if (!$ssh->login($config['SSH_USERNAME'], $config['SSH_PASSWORD'])) {
    exit('Login Failed Contact TheCJGCJG ASAP');
}
function percent($num_amount, $num_total)
{
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count  = number_format($count2, 0);
    return $count;
}
$cache_file = "logging/userlist_cache.yml";
if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 5))) {
    // Cache file is less than five minutes old. 
    // Don't bother refreshing, just use the file as-is.
    $file = file_get_contents($cache_file);
} else {
    // Our cache is out-of-date, so load the data from our remote server,
    // and also save it over our cache for next time.
    $file = $ssh->exec("cat " . $config['SERVER_LOCATION'] . "/plugins/CJFreedomMod/userlist.yml");
    file_put_contents($cache_file, $file, LOCK_EX);
}
$userlist = yaml_parse($file);
$unique = count($userlist);


date_default_timezone_set('Europe/London');
if ($config['SERVER_IP'] and $config['SERVER_PORT']) {
    $serverup = @fsockopen($config['SERVER_IP'], $config['SERVER_PORT'], $errno, $errstr, "1");
}
if ($serverup) {
    $status = "Online";
} else {
    $status = "Offline";
}

	$cpuusage      = $ssh->exec("ps aux|awk 'NR > 0 { s +=$3 }; END {print s}'");
	$cpuusage      = $cpuusage / 2;
	$bytesize      = $ssh->exec("wc -c < " . $config['SERVER_LOCATION'] . "/server.log");
	$mbsize        = ($bytesize / 1024 / 1024);
	$total         = $ssh->exec('cat /proc/meminfo | grep \'MemTotal\'');
	$output        = str_replace('MemTotal: ', '', $total);
	$output        = str_replace(' kB', '', $output);
	$output        = ($output / 1024 / 1024);
	$totalmemory   = round($output, 2);
	$free          = $ssh->exec('cat /proc/meminfo | grep \'MemFree\'');
	$output        = str_replace('MemFree: ', '', $free);
	$output        = str_replace(' kB', '', $output);
	$output        = ($output / 1024 / 1024);
	$freememory    = round($output, 2);
	$total         = $ssh->exec('cat /proc/meminfo | grep \'MemTotal\'');
	$free          = $ssh->exec('cat /proc/meminfo | grep \'MemFree\'');
	$total         = str_replace('MemTotal: ', '', $total);
	$total         = str_replace(' kB', '', $total);
	$total         = ($total / 1024 / 1024);
	$total         = round($total, 2);
	$free          = str_replace('MemFree: ', '', $free);
	$free          = str_replace(' kB', '', $free);
	$free          = ($free / 1024 / 1024);
	$free          = round($free, 2);
	$freeused      = round($free, 2);
	$total         = $total * 100;
	$freeused      = $freeused * 100;
	$memorypercent = percent($total, $freeused);
	$memorypercent = 100 / $memorypercent * 100;
	$memorypercent = 100 - $memorypercent;
	$memorypercent = round($memorypercent, 0);
	$free          = $ssh->exec('free');
	$free          = (string) trim($free);
	$free_arr      = explode("\n", $free);
	$mem           = explode(" ", $free_arr[1]);
	$mem           = array_filter($mem);
	$mem           = array_merge($mem);
	$memory_usage  = $mem[2] / $mem[1] * 100;
	$memory_usage  = round($memory_usage);
} else {
	$memory_usage = "0";
	$freememory = "0";
	$memorypercent = "0";
	$mbsize = "0";
	$totalmemory = "0";
	$unique = 0;
	$status = "Offline";
}
?>
  {"memoryusage":"<?php echo $memory_usage;?>",
  "freememory":"<?php echo $freememory;?>", 
  "usedmemory":"<?php echo $memorypercent; ?>",
  "totalmemory":"<?php echo $totalmemory;?>",
  "logsize":"<?php echo round($mbsize, 2); ?>",
  "cpuusage":"<?php echo round(($cpuusage / 1.25), 0); ?>",
  "uniquePlayers":"<?php echo $unique; ?>",
  "time":"<?php echo date("H:i:s"); ?>",
  "status":"<?php echo $status; ?>"}

