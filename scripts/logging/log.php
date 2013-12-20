<?php
function logToDb($logusername, $logaction, $logip) {
	include '../inc/config.php';
	$logdate = date('l jS \of F Y h:i:s A');
	$con=mysqli_connect($config['DATABASE_IP'],$config['DATABASE_USERNAME'],$config['DATABASE_PASSWORD'],$config['DATABASE_NAME']);
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }

	$sql="INSERT INTO PanelLog (Username, Action, Date, IP)
	VALUES
	('$logusername','$logaction','$logdate','$logip')";

	if (!mysqli_query($con,$sql))
	  {
	  die('Error: ' . mysqli_error($con));
	  }

	mysqli_close($con);
}
?> 
