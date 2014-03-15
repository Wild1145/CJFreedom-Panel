<?php
require '../login/common.php';
if(empty($_SESSION['user'])) 
{ 
    header("Location: index.php"); 
    die(""); 
}
if (!in_array(strtolower($_SESSION['user']['username']), $config['SUPER_USERS'])) {
    exit('Nupe');
}
include '../inc/config.php';
mysql_connect($config['DATABASE_IP'], $config['DATABASE_USERNAME'], $config['DATABASE_PASSWORD']);
@mysql_select_db($config['DATABASE_NAME']) or die("Unable to select database");
$query  = "SELECT * FROM PanelLog";
$result = mysql_query($query);
$num    = mysql_numrows($result);
mysql_close();
?>
<a name="oldest" href="#recentevents">View Recent Events</a>
<table class="table table-striped" >
	<tr>
		<td><u><b>Username</b></u></td>
		<td><u><b>Action</b></u></td>
		<td><u><b>Date</b></u></td>
		<td><u><b>IP Address</b></u></td>
	</tr>
	<?php
	$i = 0;
	while ($i < $num) {
		$f1 = mysql_result($result, $i, "username");
		$f2 = mysql_result($result, $i, "action");
		$f3 = mysql_result($result, $i, "date");
		$f4 = mysql_result($result, $i, "IP");
	?>
	<tr>
		<td><?php echo $f1;	?></td>
		<td><?php echo $f2;	?></td>
		<td><?php echo $f3;	?></td>
		<td><?php echo $f4;	?></td>
	</tr>
	<?php
		$i++;
	}
	?>
</table>
<a href="#oldest" name="recentevents">View oldest events</a>
