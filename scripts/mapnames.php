<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
ini_set('max_execution_time', 250000);
include '../classes/Net/SSH2.php';
    require("../login/common.php"); 
    if(empty($_SESSION['user'])) 
    { 
        include 'pages/login.php';
        die(""); 
    }
//Connect to SSH
$ssh = new Net_SSH2($config['SSH_IP']);
if (!$ssh->login($config['SSH_USERNAME'], $config['SSH_PASSWORD'])) {
    die('Cannot login to SSH');
}
?>