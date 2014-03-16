<?php
include 'inc/config.php';
include 'inc/functions.php';
if (isset($_GET['logout'])) {
    session_start();
    $_SESSION = array();
    session_destroy();
    unset($_COOKIE['panel_auto']);
    setcookie("panel_auto","",time()-6400,"/");
    header('Location: https://www.thecjgcjg.com/cjfreedom/panel/login');
    die();
}



if (isset($_COOKIE['panel_auto'])) {
    $array = json_decode(base64_decode($_COOKIE['panel_auto']), true);
    $username = $array['user'];
    $result = sqlQuery('SELECT salt,password FROM cjf_panel_users WHERE username="' . $username . '"');
    while ($row = mysqli_fetch_array($result)) {
        $salt = $row['salt'];
        $passwordStored = $row['password'];
    }
    $password = base64_decode(decrypt(base64_decode($array['pass']), $salt . $passwordStored));
    if (login($username, $password)) {
        header("Location: https://www.thecjgcjg.com/cjfreedom/panel/index");
        die();
    } else {
        setcookie("panel_auto","",time()-6400,"/");
        echo "<script> console.log('Attmpted auto login. Failed'); </script>";
    }
}
updateMetric();
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login &bull; CJFreedom Panel</title>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/login.js"></script>
    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="bodytag">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">CJFreedom Panel - Login</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" id="username" type="username">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" id="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="button" onclick="login();" id="loginButton" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts - Include with every page -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

</body>
</script>
</html>
