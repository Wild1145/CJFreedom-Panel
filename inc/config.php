<?php
//ini_set('display_errors',1);
//ini_set('display_startup_errors',1);
//error_reporting(-1);
//Uncomment these to enable errors. When asking for help ensure you include the error you recieve.

$WEB_SERVER_INSTALL_LOCATION = '/home/thecjgcjg/public_html/panel/';

$GLOBALS['Server_Name'] = 'CJFreedom';
$GLOBALS['SQL_USER'] = "cjfreedom_panel";
$GLOBALS['SQL_PASS'] = "rmQk5KCnuTAhWPbPcRweJs8u4";
$GLOBALS['SQL_HOST'] = "localhost";
$GLOBALS['SQL_DB'] = "cjfreedom";

$GLOBALS['API_ENABLED'] = true;
$GLOBALS['API_KEY'] = "FXbBT9N5kYxAy3HxSFf8dyGf";

$GLOBALS['SSH_USER'] = 'CJFreedom';
//SSH Keyfile is located /panel/inc/sshkey.openssh - Ensure you use an OpenSSH key format.

$config['log_location'] = '/home/CJFreedom/server/logs/latest.log';
$config['tfm_userlist'] = '/home/CJFreedom/server/plugins/CJFreedomMod/userlist.yml';

$config['SCRIPTS_FOLDER'] = '/home/CJFreedom/bin/panel_scripts/';

$config['CHAT_INTERFACE_OPTIONS'] = "[§cPanel§r]\<§a{username}§r\> §f{chatmessage}";
$config['ADMIN_CHAT_INTERFACE_OPTIONS'] = "[§bADMIN§r] §4{username}§r§9 \(Console\)§f: §b{chatmessage}";
?>