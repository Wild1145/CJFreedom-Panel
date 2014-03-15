<?php
if($_SERVER["HTTPS"] != "on" AND $config['HTTPS_FORCE'] == true)
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
?>