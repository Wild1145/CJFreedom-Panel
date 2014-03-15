<?php
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/sessions.php';
header("Content-type: text\yaml");
if (getTimeDifference('logs', '3') == true) {
    $sftp = initSFTP();
    $logfile = $sftp->get($config['log_location']);
    addToSQLCache('logs', $logfile);
    echo $logfile;
} else {
    echo retrieveSQLCache('logs');
}


?>