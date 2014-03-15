<?php
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/sessions.php';

if(!isset($_GET['action'])) {
    die('Incorrect parameters');
}
$action = $_GET['action'];
$ssh = initSSH();

switch ($action) {
    case "resetmap":
        if ($_SESSION['user']['rank'] < 3) {
            die('You must be a Senior Admin.');
        }
        if (!isset($_GET['mapname'])) {
            die('Map name not defined');
        }
		if (isset($_GET['instant'])) {
			$ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_resetmap.sh instant ' . escapeshellarg($_GET['mapname']) . ' &');
		} else {
			$ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . '/home/CJFreedom/bin/panel_scripts/server_resetmap.sh ' . escapeshellarg($_GET['mapname']) . ' &');
		}
        echo "Map is resetting - This may take a few moments";
        logAction("Map Reset to " . $_GET['mapname']);
        break;
    case "wipeflatlands":
        if ($_SESSION['user']['rank'] < 3) {
            die('You must be a Senior Admin.');
        }
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_wipeflatlands.sh &');
        echo "The flatlands are being wiped - Please wait a few moments";
        logAction('Flatlands Wiped');
        break;
    case "start":
        if ($_SESSION['user']['rank'] < 3) {
            die('You must be a Senior Admin.');
        }
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_start.sh &');
        echo "Server start has been attempted";
        logAction("Server Started");
        break;
    case "restart":
        if ($_SESSION['user']['rank'] < 3) {
            die('You must be a Senior Admin.');
        }
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_restart.sh &');
        logAction("Server Restarted");
        echo "Server Restarted";
        break;
    case "stop":
        if ($_SESSION['user']['rank'] < 3) {
            die('You must be a Senior Admin.');
        }
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_stop.sh &');
        logAction("Server Stopped");
        echo "Server stopped";
        break;
    case "cmd":
        if ($_SESSION['user']['rank'] < 2) {
            die('You must be a Telnet Admin.');
        }
        if (!isset($_GET['cmd'])) {
            die('Command has not been entered.');
        }
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_cmd.sh ' . escapeshellarg($_GET['cmd']) . ' &');
        echo "Command: " . $_GET['cmd'] . " Sent.";
        logAction("Command: " . $_GET['cmd']);
        break;
    case "chat":
        if ($_SESSION['user']['rank'] < 2) {
            die('You must be a Telnet Admin.');
        }
        if (!isset($_GET['message'])) {
            die('Command has not been entered.');
        }
        $chatmessage = $_GET['message'];
        $username = $_SESSION['user']['username'];
        $chatWithUsername = str_replace("{username}", $username, $config['CHAT_INTERFACE_OPTIONS']);
        $chatComplete = str_replace("{chatmessage}", $chatmessage, $chatWithUsername);
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_cmd.sh rawsay ' . $chatComplete . ' &');
        echo "Sent message: " . $chatmessage;
        logAction("Chat: " . $_GET['message']);
        break;
    case "adminchat":
        if ($_SESSION['user']['rank'] < 2) {
            die('You must be a Telnet Admin.');
        }
        if (!isset($_GET['message'])) {
            die('Command has not been entered.');
        }
        $chatmessage = $_GET['message'];
        $chatwithusername = str_replace("{username}", $_SESSION['user']['username'], $config['ADMIN_CHAT_INTERFACE_OPTIONS']);
		$chatcomplete = str_replace("{chatmessage}", $chatmessage, $chatwithusername);
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_cmd.sh consoleo ' . $chatcomplete . ' &');
        echo "Sent message" . $chatmessage;
        logAction("Adminchat: " . $_GET['message']);
        break;
    default:
       die('Incorrect Parameters - If this is not expected please contact thecjgcjg.');
       break;
}

?>