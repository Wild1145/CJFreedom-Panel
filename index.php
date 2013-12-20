<?php
include 'inc/config.php';
include 'inc/globalvariables.php';
include 'inc/functions.php';
include 'inc/ssl.php';
?>

<?php
    require("login/common.php"); 
    if(empty($_SESSION['user'])) 
    { 
        include 'pages/login.php';
        die(""); 
    }
	if (isset($_GET['logout'])) {
		include 'login/logout.php';
	}
	// Load the page
	include 'pageparts/basicpagedesign.php';
?>

