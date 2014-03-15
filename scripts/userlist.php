<?php
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/sessions.php';
require '../inc/spyc.php';
header("Content-type: text\html");
if (getTimeDifference('userlist', '300') == true) {
    $sftp = initSFTP();
    $userlist = $sftp->get($config['tfm_userlist']);
    addToSQLCache('userlist', $userlist);
} else {
    $userlist = retrieveSQLCache('userlist');
}

$userlist_array = spyc_load($userlist);
echo "<table><tr>";
echo "<th>Username</th>";
echo "<th>IP's</th>";
echo "</tr>";
foreach($userlist_array as $key => $value)
{
	echo $key . " " . $value . "<br />";

}
echo "</table>";
?>