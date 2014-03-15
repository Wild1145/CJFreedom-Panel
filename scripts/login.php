<?php
if (isset($_POST['username']) AND isset($_POST['password'])) {
	$status = 1;
	
} else {
	if (!isset($_POST['username'])) {
		$status = 3;
	}
	if (!isset($_POST['password'])) {
		$status = 4;
	}
}

//Output final result
echo $status;


/*
Status messages:
1: User and Pass provided
2: User and Pass both missing from request
3: Username not submitted
4: Password Not Submitted
5: Error
6: Username or Password is wrong
7: Authentication successful
*/
?>