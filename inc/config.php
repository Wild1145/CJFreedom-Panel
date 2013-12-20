<?php
$config['SERVER_IP'] = '';
$config['SERVER_PORT'] = ''; // No SRV Records please
$config['SERVER_NAME'] = '';
$config['SERVER_LOCATION'] = '/mcserver/bukkit/'; //E.G /mcserver/bukkit/

//Define your SSH settings
$config['SSH_IP'] = '';
$config['SSH_USERNAME'] = '';
$config['SSH_PASSWORD'] = '';

//Server Settings
$config['MAP_NAMES'] = array("Flatlands", "Stadium", "Christmas", "TheUnitedKingdom", "KingdomOfVerona", "Battleship", "MobArena", "100kTimeLapse", "Mayan", "TowerOfLife", "ProjectX", "Arboretum", "Lucky38", "Template", "BoxOfEden", "Hatventure", "Dojo", "KingdomofAdeam");
$config['MAP_LOCATION'] = "/mcserver/worlds/";

$config['CHAT_INTERFACE_OPTIONS'] = "[§cPanel§r]\<§a{username}§r\> §f{chatmessage}";
$config['ADMIN_CHAT_INTERFACE_OPTIONS'] = "[§bADMIN§r] §4{username}§r§9 \(Console\)§f: §b{chatmessage}";
//Here you can set what is sent when using the chat feature. Use {username} and {chatmessage} as placeholders. Example: "[§cPanel§r]\<§a{username}§r\> §f{chatmessage}"

//Define your MySQL Database settings
$config['DATABASE_IP'] = '';
$config['DATABASE_NAME'] = '';
$config['DATABASE_USERNAME'] = '';
$config['DATABASE_PASSWORD'] = '';

//Define your general site preferences
$config['HTTPS_FORCE'] = true;
$config['SITE_HOME'] = ''; // WITHOUT HTTP:// OR HTTPS:// DO NOT INCLUDE THE TRAILING SLASH E.G. www.thecjgcjg.com
$config['PANEL_LOCATION'] = ''; // Include the Trailing slash and a previous slash E.G. /panel/

//Super Users
$config['SUPER_USERS'] = array("thecjgcjg", "varuct", "wild1145", "darthsalamon");
$config['FORBIDDEN_COMMANDS'] = array("panel", "server"); //Set commands that can only be run in the console by a super user.

//For Developers
$info['VERSION'] = 1.1;

//API Information
$config['API_ENABLED'] = true;
$config['API_KEY'] = ''; //I recommend randomly generated numbers and letters ~ 20 characters
$_config['OFFLINE_CHECK'] = true;
?>
