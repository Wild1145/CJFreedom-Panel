<?php
$currentversion = '1.1';
$checker = file_get_contents('https://www.thecjgcjg.com/panel/version.php');

if ($checker != $currentversion) {
    echo "Panel is NOT up to date";
} else {
    echo "Panel is up to date";
}

?>