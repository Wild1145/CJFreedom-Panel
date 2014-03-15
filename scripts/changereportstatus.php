<?php
include '../inc/config.php';
include '../inc/functions.php';
include '../inc/sessions.php';

if (!isset($_GET['id']) OR !isset($_GET['action'])) {
    die('Incorrect Parameters');
}

$id = $_GET['id'] + 0;

switch ($_GET['action']) {
    case "open":
        sqlQuery('UPDATE reports SET status="open" WHERE ID="' . $id . '"');
        break;
    case "close":
        sqlQuery('UPDATE reports SET status="closed" WHERE ID="' . $id . '"');
        break;
    case "delete":
        sqlQuery('DELETE FROM reports WHERE ID="' . $id . '"');
        break;
    case "closeall":
        sqlQuery('UPDATE reports SET status="closed" WHERE status="open"');
        break;
    default:
       die("Incorrect Action Parameter");
}

?>