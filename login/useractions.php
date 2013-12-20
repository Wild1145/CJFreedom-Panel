<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
require '../login/common.php';
if(empty($_SESSION['user'])) 
{ 
    header("Location: index.php"); 
    die("403 Forbidden"); 
} 


if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "delete" AND isset($_REQUEST['usernametodelete'])) {
    $query = "DELETE FROM users WHERE username='" . $_REQUEST['usernametodelete'] . "'";         
    try 
    { 
        // These two statements run the query against your database table. 
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    { 
        // Note: On a production website, you should not output $ex->getMessage(). 
        // It may provide an attacker with helpful information about your code.  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
             
    // Finally, we can retrieve all of the found rows into an array using fetchAll 
    $rows = $stmt->fetchAll(); 
    
    }
} else {
    echo "Do it right";
    }
?>
