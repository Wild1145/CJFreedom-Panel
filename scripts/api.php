<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
include '../classes/Net/SSH2.php';
if (!$config['API_ENABLED']) {
	header("HTTP/1.1 284 API Disabled");
	die('The API is not enabled');
}
if (!isset($_GET['apikey'])) {
	header("HTTP/1.1 285 API Key Error");
	die('You have not entered an API key');
}
if ($_GET['apikey'] != $config['API_KEY']) {
	header("HTTP/1.1 286 API Key Error");
	die('You have entered an invalid API key');
}
?>
<?php
//Connect to SSH
$ssh = new Net_SSH2($config['SSH_IP']);
if (!$ssh->login($config['SSH_USERNAME'], $config['SSH_PASSWORD'])) {
	header("Status: 275");
    die('Cannot login to SSH');
}

//Start Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "start") {
		if (strpos($ssh->exec('server start'), "already") !== false) {
			echo "Server is already running, if you cannot connect try using the kill button.";
            header("Status: 276");
		} else {
			echo "Server Started.";  
            header("Status: 277");            
		}
	}
}
//Restart Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "restart") {
		$ssh->exec('server cmd say Server is Restarting');
		$ssh->exec('server restart');
        header("Status: 278");
		echo "Server restarted. If you are unable to connect try again.";
        
	}
}
//Kill Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "kill") {
		$ssh->exec("su -c 'pkill -sigkill java' - senior");
        $ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
		$ssh->exec("server start");
        header("Status: 279");
		echo "Server forcefully shut down and restarted.";
        
	}
}

//Stop Server
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "stop") {
		$ssh->exec("server stop");
		$ssh->exec("su -c 'pkill -sigkill java' - senior");
        $ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
        header("Status: 280");
		echo "Server forcefully shut down and restarted.";
        
	}
}

//Commands
if (isset($_REQUEST['action']) AND isset($_REQUEST['cmd'])) {
	if ($_REQUEST['action'] == "cmd") {
		$cmd = $_REQUEST['cmd'];
		$ssh->exec("server cmd $cmd");
        header("Status: 281");
		echo "Command: $cmd sent successfully";
        
	}
}

// Map reset
if (isset($_REQUEST['action']) AND isset($_REQUEST['mapname'])) {
	if ($_REQUEST['action'] == "reset") {
		$mapresetname = strtolower($_REQUEST['mapname']);
		$ssh->exec('server cmd say **§dRESETTING MAP TO' . strtoupper($mapresetname) . '**');
        $ssh->exec("server cmd say **MAP IS EXTRACTING - EXPECT LAG**");
        $ssh->exec("tar -zxf /mcserver/worlds/" . $mapresetname . ".tar.gz -C /tmp");
        $ssh->exec("server cmd say **MAP IS RESETTING**");
		$ssh->exec('server stop');
		$ssh->exec("su -c 'pkill -sigkill java' - senior");
		$ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
        $ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/spawn.yml");
		$ssh->exec("rm " . $config['SERVER_LOCATION'] . "plugins/Essentials/warps/*");
		$ssh->exec("rm -R " . $config['SERVER_LOCATION'] . "worlds/world");
        $ssh->exec('mv /tmp/mcserver/worlds/' . $mapresetname . '/ /mcserver/bukkit/worlds');
        $ssh->exec('mv /mcserver/bukkit/worlds/' . $mapresetname . ' /mcserver/bukkit/worlds/world');
		$ssh->exec("chown -R senior /mcserver");
        $ssh->exec("rm -rf /tmp/mcserver/");
		$ssh->exec("server start");
        header("Status: 282");
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
        header("Status: 283");
		echo "Successfully reset flatlands";
        
	}
}
if (isset($_REQUEST['action'])) {
	if ($_REQUEST['action'] == "purge") {
		$ssh->exec('server cmd csay **CLEANUP STARTED**');
		$ssh->exec('server cmd tfipbanlist purge');
		$ssh->exec('server cmd tfbanlist purge');
		$ssh->exec('server cmd csay **CLEANUP FINISHED**');
		echo "Done";
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
if (isset($_REQUEST['action']) && $_REQUEST['action'] == "checkonline") {
    if ($_config['OFFLINE_CHECK']) {
        $serverup = @fsockopen($config['SERVER_IP'], $config['SERVER_PORT'], $errno, $errstr, "1");
        if (!$serverup) {
            sleep(5);
            $serverupcheckagain = @fsockopen($config['SERVER_IP'], $config['SERVER_PORT'], $errno, $errstr, "1");
            if (!$serverupcheckagain) {
                $ssh->exec("server say **SERVER HAS BEEN DETECTED AS OFFLINE OR LAGGED**");
                $ssh->exec("server say **SERVER IS RESTARTING**");
                $ssh->exec('server stop');
                $ssh->exec("su -c 'pkill -sigkill java' - senior");
                $ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
                $ssh->exec('server start');
                die('Server is Offline');
            }
        } else {
            if ($ssh->exec("find /mcserver/bukkit/crash-reports/. -type d -name .svn -prune -o -mmin -5 -type f -print") != "") {
                //$ssh->exec("server say **SERVER HAS BEEN DETECTED AS OFFLINE OR LAGGED**");
                //$ssh->exec("server say **SERVER IS RESTARTING**");
                //$ssh->exec('server stop');
                //$ssh->exec("su -c 'pkill -sigkill java' - senior");
                //$ssh->exec("su -c 'screen -S minecraft -X quit' - senior");
                //$ssh->exec('server start');
                die('Server is Offline');
            } else {
                die('Server Online');
            }
        }
    }
}
?>