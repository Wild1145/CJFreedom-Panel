<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/sessions.php';
header('Content-type: application/json');
header("Access-Control-Allow-Origin: *");

function percent($num_amount, $num_total)
{
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count  = number_format($count2, 0);
    return $count;
}
function cpuUsage($ssh) {
    $cpuusage = $ssh->exec("top -b -n 5 -d.2 | grep \"Cpu\" | tail -n1 | awk '{print($2)}' | cut -d'%' -f 1");
    $cpuusage = trim(preg_replace('/\s\s+/', ' ', $cpuusage));
    return $cpuusage;
}

function countReports() {
    $query = sqlQuery('SELECT COUNT(reporter) FROM reports');
    while($row = mysqli_fetch_array($query)) {
        $count = $row['COUNT(reporter)'];
    }
    return $count;
}
function countOpenReports() {
    $query = sqlQuery('SELECT COUNT(reporter) FROM reports WHERE status="open"');
    while($row = mysqli_fetch_array($query)) {
        $count = $row['COUNT(reporter)'];
    }
    return $count;
}

function countBans() {
    $query = sqlQuery('SELECT COUNT(time) FROM cjf_bans');
    while($row = mysqli_fetch_array($query)) {
        $count = $row['COUNT(time)'];
    }
    return $count;
}


function totalMemory($ssh) {
    $total        = $ssh->exec('cat /proc/meminfo | grep \'MemTotal\'');
    $output       = str_replace('MemTotal: ', '', $total);
    $output       = str_replace(' kB', '', $output);
    $output       = ($output / 1024 / 1024);
    $totalmemory  = round($output, 2);
    return $totalmemory;
}


function freeMemory($ssh) {
    $free = $ssh->exec('cat /proc/meminfo | grep \'MemFree\'');
    $free = str_replace('MemFree: ', '', $free);
    $free = str_replace(' kB', '', $free);
    $free = ($free / 1024 / 1024);
    
    $cached = $ssh->exec('cat /proc/meminfo | grep \'Cached\'');
    $cached = str_replace('Cached: ', '', $cached);
    $cached = str_replace(' kB', '', $cached);
    $cached = ($cached / 1024 / 1024);
    
    $actualFree = $free + $cached;
    return round($actualFree, 2);
}

function usedMemory($ssh) {
    return totalMemory($ssh) - freeMemory($ssh);
}

?>
<?php
if (getTimeDifference('stats', '3') == true) {
    $ssh = initSSH();
    $output ='{"cpuUsage":' . cpuUsage($ssh) . ',
"totalMemory":' . totalMemory($ssh) . ', 
"usedMemory":"' . usedMemory($ssh) . '",
"freeMemory":"' . freeMemory($ssh) . '",
"memoryPercent":"' . percent(usedMemory($ssh), totalMemory($ssh)) . '",
"totalReports":' . countReports() . ',
"totalBans":' . countBans() . ',
"openReports":' . countOpenReports() . '}';
    addToSQLCache('stats', $output);
    echo $output;
} else {
    echo retrieveSQLCache('stats');
}

?>


