<?php
session_start();
if (isset($_SESSION['user']['email'])) {
    session_destroy();
    header("Location: https://www.thecjgcjg.com/cjfreedom/panel/");
}
if (empty($_SESSION['user'])) {
    header('Location: https://www.thecjgcjg.com/cjfreedom/panel/login.php');
    exit();
}
?>