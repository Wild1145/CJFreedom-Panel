<?php
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/sessions.php';
header("Content-type: text\yaml");
if (getTimeDifference('console', '0.1') == true) {
    $ssh = initSSH();
    $console = $ssh->exec("tail -25 " . $config['log_location']);
    addToSQLCache('console', $console);
    echo $console;
} else {
    echo retrieveSQLCache('console');
}


?>