<?php
include 'inc/functions.php';
include 'inc/config.php';
    $result = sqlQuery('SELECT salt FROM cjf_panel_users WHERE username="' . $username . '"');
    while ($row = mysqli_fetch_array($result)) {
        $salt = $row['salt'];
    }
    echo $salt;
?>