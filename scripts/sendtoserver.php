<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
include 'logging/log.php';
ini_set('max_execution_time', 250000);
set_time_limit(0);
include '../classes/Net/SSH2.php';
    require("../login/common.php"); 
    if(empty($_SESSION['user'])) 
    { 
        include 'pages/login.php';
        die(""); 
    }
if (isset($_REQUEST['cmd'])) {
$actiontolog = "cmd: " . $_REQUEST['cmd'];
logToDb($_SESSION['user']['username'], $actiontolog, $_SERVER['REMOTE_ADDR']);
} else {
	if (isset($_REQUEST['mapname'])) {
	$actiontolog = "map: " . $_REQUEST['mapname'];
	logToDb($_SESSION['user']['username'], $actiontolog, $_SERVER['REMOTE_ADDR']);
	} else {
		if(isset($_REQUEST['chatmessage'])) {
		$actiontolog = "Chat: " . $_REQUEST['chatmessage'];
		logToDb($_SESSION['user']['username'], $actiontolog, $_SERVER['REMOTE_ADDR']);
		}
		logToDb($_SESSION['user']['username'], $_REQUEST['action'], $_SERVER['REMOTE_ADDR']);
	}
}

//Connect to SSH
$ssh = new Net_SSH2($config['SSH_IP']);
if (!$ssh->login($config['SSH_USERNAME'], $config['SSH_PASSWORD'])) {
    die('Cannot login to SSH');
}

//Start Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "start") {
		if (strpos($ssh->exec('server start'), "already") !== false) {
			echo "Server is already running, if you cannot connect try using the kill button.";
		} else {
			echo "Server Started.";        
		}
	}
}
//Stop Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "restart") {
		$ssh->exec('server stopped');
		echo "Server stopped.";
	}
}
//Restart Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "restart") {
		$ssh->exec('server cmd say Server is Restarting');
		$ssh->exec('server restart');
		echo "Server restarted. If you are unable to connect try again.";
	}
}
//Kill Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "kill") {
		$ssh->exec("su -c 'pkill -sigkill java' - senior");
        $ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
		$ssh->exec("server start");
		echo "Server forcefully shut down and restarted.";
	}
}

//Commands
if (isset($_REQUEST['action']) AND isset($_REQUEST['cmd'])) {
	if ($_REQUEST['action'] == "cmd") {
		$cmd = $_REQUEST['cmd'];
		if (!in_array($cmd, $config['FORBIDDEN_COMMANDS'])) {
			$ssh->exec("server cmd $cmd");
			echo "Command: $cmd sent successfully";
		} else {
			if (in_array(strtolower($_SESSION['user']['username']),$config['SUPER_USERS'])) {
				$ssh->exec("server cmd $cmd");
				echo "Command: $cmd sent successfully";
			} else {
			echo "This is a forbidden command";
			}		
		}

	}
}

// Map reset
if (isset($_REQUEST['action']) AND isset($_REQUEST['mapname'])) {
	if ($_REQUEST['action'] == "reset") {
		$mapresetname = strtolower($_REQUEST['mapname']);
		$ssh->exec('server cmd say **§dRESETTING MAP TO' . strtoupper($mapresetname) . '**');
        $ssh->exec("server cmd say **MAP IS EXTRACTING - EXPECT LAG**");
        $ssh->exec('tar -zxf ' . $config['MAP_LOCATION'] . '' . $mapresetname . '.tar.gz -C /tmp');
        $ssh->exec("server cmd say **MAP IS RESETTING**");
		$ssh->exec('server stop');
		$ssh->exec("su -c 'pkill -sigkill java' - senior");
		$ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
        $ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/spawn.yml");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/warps/*");
		$ssh->exec("rm -R " . $config['SERVER_LOCATION'] . "worlds/world");
        $ssh->exec('mv /tmp/mcserver/worlds/' . $mapresetname . '/ ' . $config['SERVER_LOCATION'] . 'worlds');
        $ssh->exec('mv ' . $config['SERVER_LOCATION'] . 'worlds/' . $mapresetname . ' ' . $config['SERVER_LOCATION'] . 'worlds/world');
		$ssh->exec("chown -R senior /mcserver");
        $ssh->exec("rm -rf /tmp/mcserver/");
		$ssh->exec("server start");
		echo "Reset map to: \"$mapresetname\"";
	}
}

// Wipe flatlands
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "wipeflatlands") {
		$ssh->exec('server stop');
        $ssh->exec("su -c 'pkill -sigkill java' - senior");
        $ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
		$ssh->exec("chown -R senior /mcserver");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/spawn.yml");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/warps/*");
		$ssh->exec("rm -R " . $config['SERVER_LOCATION'] . "worlds/flatlands");
		$ssh->exec("chown -R senior /mcserver");
		$ssh->exec("server start");
		echo "Successfully reset flatlands";
	}
}

if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "deletelogs") {
		$ssh->exec('server stop');
        $ssh->exec("su -c 'pkill -sigkill java' - senior");
        $ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
		$ssh->exec("chown -R senior /mcserver");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/spawn.yml");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/warps/*");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "server.log");
		$ssh->exec("server start");
		echo "Logs deleted.";
	}
}

if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "chat") {
            $chatmessage = $_REQUEST['chatmessage'];
            $chatmessage = str_replace("&", "", $chatmessage);
			$chatwithusername = str_replace("{username}", $_SESSION['user']['username'], $config['CHAT_INTERFACE_OPTIONS']);
			$chatcomplete = str_replace("{chatmessage}", $chatmessage, $chatwithusername);
			$ssh->exec("server cmd rawsay $chatcomplete");
            echo "yes";
	}
}
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "adminchat") {
            $chatmessage = $_REQUEST['chatmessage'];
            $chatmessage = str_replace("&", "", $chatmessage);
			$chatwithusername = str_replace("{username}", $_SESSION['user']['username'], $config['ADMIN_CHAT_INTERFACE_OPTIONS']);
			$chatcomplete = str_replace("{chatmessage}", $chatmessage, $chatwithusername);
			$ssh->exec("server cmd consoleo $chatcomplete");
            echo "done";
	}
}
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "clearuserdata") {
		$ssh->exec('server say **CLEARING ESSENTIALS USERDATA**');
		$ssh->exec("rm -rf " . $config['SERVER_LOCATION'] . "plugins/Essentials/userdata/*");
		$ssh->exec('server cmd reload');
		echo "Done";
	}
}
?>