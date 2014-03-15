<?php
include '../inc/config.php';
include '../inc/functions.php';


$username = sanitize($_POST['username']);
$password = $_POST['password'];

if (isset($_POST['remember'])) {
    $logins['user'] = $username;
    $result = sqlQuery('SELECT salt,password FROM cjf_panel_users WHERE username="' . $username . '"');
    while ($row = mysqli_fetch_array($result)) {
        $salt = $row['salt'];
        $passwordStored = $row['password'];
    }
    $logins['pass'] = base64_encode(encrypt(base64_encode($password), $salt . $passwordStored));
    $cookieval = json_encode($logins);
    $cookieval = base64_encode($cookieval);
    setcookie("panel_auto", $cookieval, time()+31536000, '/');
}
echo login($username, $password);
?>