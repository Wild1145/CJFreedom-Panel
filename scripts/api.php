<?php
include '../inc/config.php';
include '../inc/functions.php';
//include '../inc/sessions.php';

if ($GLOBALS['API_ENABLED'] != true) {
    die('API Is Disabled');
}

if (!isset($_GET['key'])) {
    die ('You have not entered the API key - Use ?key=xxx');
}

if ($_GET['key'] != $GLOBALS['API_KEY']) {
    die ('Incorrect API Key');
}

if(!isset($_GET['action'])) {
    die('Incorrect parameters');
}

$action = $_GET['action'];
$ssh = initSSH();

switch ($action) {
    case "resetmap":
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_resetmap.sh ' . escapeshellarg($_GET['mapname']) . ' &');
        echo "Map is resetting - This may take a few moments";
        logAction("Map Reset to " . $_GET['mapname']);
        break;
    case "wipeflatlands":
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_wipeflatlands.sh &');
        echo "The flatlands are being wiped - Please wait a few moments";
        logAction('Flatlands Wiped');
        break;
    case "start":
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_start.sh &');
        echo "Server start has been attempted";
        logAction("Server Started");
        break;
    case "restart":
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_restart.sh &');
        logAction("Server Restarted");
        break;
    case "stop":
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_stop.sh &');
        echo "Server Restarted";
        logAction("Server Stopped");
        echo "Server stopped";
        break;
    case "cmd":
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_cmd.sh ' . escapeshellarg($_GET['cmd']) . ' &');
        echo "Command: " . $_GET['cmd'] . " Sent.";
        logAction("Command: " . $_GET['cmd']);
        break;
    case "chat":
        $chatmessage = $_GET['message'];
        $username = $_SESSION['user']['username'];
        $chatWithUsername = str_replace("{username}", $username, $config['CHAT_INTERFACE_OPTIONS']);
        $chatComplete = str_replace("{chatmessage}", $chatmessage, $chatWithUsername);
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_cmd.sh rawsay ' . $chatComplete . ' &');
        echo "Sent message: " . $chatmessage;
        logAction("Chat: " . $_GET['message']);
        break;
    case "adminchat":
        $chatmessage = $_GET['message'];
        $chatwithusername = str_replace("{username}", $_SESSION['user']['username'], $config['ADMIN_CHAT_INTERFACE_OPTIONS']);
		$chatcomplete = str_replace("{chatmessage}", $chatmessage, $chatwithusername);
        $ssh->exec('nohup ' . $config['SCRIPTS_FOLDER'] . 'server_cmd.sh consoleo ' . $chatcomplete . ' &');
        echo "Sent message" . $chatmessage;
        logAction("Adminchat: " . $_GET['message']);
        break;
	case "createuser":
		$username = $_POST['username'];
		$password = $_POST['password'];
		$rank = $_POST['rank'];
		addUser($username, $password, $rank);
		logAction('User Added: ' . $username);
		die('User has been added.');
	    break;
    default:
       die('Incorrect Parameters - If this is not expected please contact thecjgcjg.');
       break;
}

?>