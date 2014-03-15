<?php
function encrypt($file, $key) {
	$key = hash('sha512', $key);
    $iv = substr($key, 0, 8);
    $key = substr($key, 0, 56);
    $encrypted = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $file, MCRYPT_MODE_CBC, $iv);
    return $encrypted;
}
function decrypt($file, $key) {
	$key = hash('sha512', $key);
    $iv = substr($key, 0, 8);
    $key = substr($key, 0, 56);
	$decrypted = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $file, MCRYPT_MODE_CBC, $iv);
	return $decrypted;
}
function sqlQuery($query)
{
    $sqlDetails = mysqli_connect($GLOBALS['SQL_HOST'], $GLOBALS['SQL_USER'], $GLOBALS['SQL_PASS'], $GLOBALS['SQL_DB']);
    if (mysqli_connect_errno()) {
        die("SQL connection failed with error: " . mysqli_connect_error());
    }
    $queryMake = mysqli_query($sqlDetails, $query);
    mysqli_close($sqlDetails);
    return $queryMake;
}

function logAction($action) {
    $action = sanitize($action);
    sqlQuery("INSERT INTO cjf_panel_action_log (username, ip, time, action) VALUES ('" . $_SESSION['user']['username'] ."', '" . $_SERVER['REMOTE_ADDR'] . "', '" . time() . "', '" . $action . "')");
}
function sanitize($input)
{
    $output = htmlspecialchars($input, ENT_QUOTES);
    return $output;
}

function loginHash($input, $salt)
{
    $output = $input . $salt;
    $hash   = $output;
    $i      = 0;
    while ($i != '50') {
        $i++;
        $hash = hash('sha512', $hash);
        $hash = hash('md5', $hash);
        $hash = hash('whirlpool', $hash);
        $hash = hash('ripemd160', $hash);
        $hash = hash('whirlpool', $hash);
        $hash = hash('sha256', $hash);
        $hash = hash('sha512', $hash);
        $hash = hash('ripemd320', $hash);
        $hash = hash('snefru', $hash);
        $hash = hash('sha512', $hash);
    }
    return ($hash);
}
function login($username, $password)
{
    $username = sanitize($username);
    if (!isset($username) OR !isset($password)) {
        die("Enter a username and password");
    }
    $get = sqlQuery("SELECT * FROM cjf_panel_users WHERE username='" . $username . "'");
    while ($row = mysqli_fetch_array($get)) {
        $correctPassHashed = $row['password'];
        $passwordHashed = loginHash($password, $row['salt']);
        //echo $password;
        if ($passwordHashed == $correctPassHashed) {
            session_start();
            $_SESSION['user']['username'] = $row['username'];
            $_SESSION['user']['rank'] = $row['rank'];
            $_SESSION['user']['password'] = $row['password'];
            $_SESSION['user']['ID'] = $row['ID'];
            $_SESSION['user']['salt'] = $row['salt'];
            logAction("Logged In");
            return 1;
        } else {
            return 0;
        }
    }
}
function addUser($username, $password, $rank)
{
    include 'config.php';
    $username = sanitize($username);
        $salt     = rand(5, 9999999999) . rand(5, 99999999999999999999999);
        $username = sanitize($username);
        $rank     = sanitize($rank);
        $password = loginHash($password, $salt);
        if (sqlQuery('INSERT INTO cjf_panel_users (username, password, salt, rank) VALUES ("' . $username . '", "' . $password . '", "' . $salt . '", "' . $rank . ' ")')) {
            return 1;
        }    
}
function listUsers()
{
    $query = sqlQuery('SELECT * FROM cjf_panel_users');
    while ($row = mysqli_fetch_array($query)) {
        echo "<option>" . $row['username'] . "</option>";
    }
}
function getRank()
{
    return str_replace(" ", "", $_SESSION['user']['permissions']);
}
function deleteUser($username, $SESSION)
{
    include 'config.php';
    $username = sanitize($username);
    $check    = sqlQuery('SELECT * FROM cjf_panel_users WHERE username="' . $username . '"');
    while ($row = mysqli_fetch_array($check)) {
        if ($row['rank'] == 4) {
            die("You cannot delete Super Users");
        }
    }
    
        if (sqlQuery("DELETE FROM cjf_panel_users WHERE username='" . $username . "'")) {
            return 1;
        }
}
function changePassword($SESSION ,$password)
{
    $oldDetails  = $_SESSION['user'];
    $salt        = $oldDetails["salt"];
    $newPassword = loginHash($password, $salt);
    if (sqlQuery("UPDATE cjf_panel_users SET password='" . $newPassword . "' WHERE ID='" . $oldDetails["ID"] . "'")) {
        return 1;
    } else {
        return 0;
    }
}
function adminChangePassword($username, $password)
{
    $username = $username;
    $salt        = rand(15994, 999999999);
    $newPassword = loginHash($password, $salt);
    if (sqlQuery("UPDATE cjf_panel_users SET password='" . $newPassword . "' WHERE username='" . $username . "'")) {
        return 1;
    } else {
        return 0;
    }
}

function addToSQLCache($name, $cache) {
    $time = time();
    $cache = base64_encode($cache);
    sqlQuery('UPDATE cjf_panel_cache SET lastupdated="' . $time . '",cachevalue="' . $cache . '" WHERE cachename="' . $name .'"');
    return 1;
}

function retrieveSQLCache($name) {
    $result = sqlQuery('SELECT cachevalue FROM cjf_panel_cache WHERE cachename="' . $name . '"');
    while($row = mysqli_fetch_array($result))
      {
      $value = $row["cachevalue"];
      }
      $value = base64_decode($value);
    return $value;
}

function getSQLCacheAge($name) {
    $value = sqlQuery('SELECT lastupdated FROM cjf_panel_cache WHERE cachename="' . $name . '"');
    while($row = mysqli_fetch_array($value)) {
        $value = $row['lastupdated'];
    }
    return $value;
}

function getTimeDifference($name, $maxdifference) {
    $query = sqlQuery('SELECT * FROM cjf_panel_cache WHERE cachename="' . $name . '"');
    while($row = mysqli_fetch_array($query)) {
        $value = $row['lastupdated'];
    }
    $difference = (time() - $value);
    if ($difference > $maxdifference) {
        return true;
    } else {
        return false;
    }
}

function initSSH()
{
    include '' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/config.php';
    include '' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/phpseclib/Net/SSH2.php';
    include '' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/phpseclib/Crypt/RSA.php';
    $ssh = new Net_SSH2('ipv6.server.thecjgcjg.com');
    $key = new Crypt_RSA();
    $key->loadKey(file_get_contents('' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/sshkey.openssh'));
    if (!$ssh->login($GLOBALS['SSH_USER'], $key)) {
        exit('SSH Connection Attempt Failed');
    }
    return $ssh;
}

function initSFTP()
{
    include '' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/config.php';
    include '' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/phpseclib/Net/SFTP.php';
    include '' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/phpseclib/Crypt/RSA.php';
    $sftp = new Net_SFTP('ipv6.server.thecjgcjg.com');
    $key = new Crypt_RSA();
    $key->loadKey(file_get_contents('' . $GLOBALS['WEB_SERVER_INSTALL_LOCATION'] . 'inc/sshkey.openssh'));
    if (!$sftp->login('CJFreedom', $key)) {
        exit('SFTP Connection Attempt Failed');
    }
    return $sftp;
}

function createMapTab($mapname, $mapImage, $mapLoc, $buttonText, $buttonClassName) {
return '        <div class="col-lg-5">
                    <div class="panel panel-default">
                        <div class="panel-heading"><b>' . $mapname .'</b></div>
                        <div class="panel-body" style="height: 250px; background-size: cover; background-image:url(\'' . $mapImage .'\');">
                            <p>
                                <button type="button" class="btn btn-' . $buttonClassName . ' pull-right" onclick="resetMap(\'' . $mapLoc .'\');"><b>' . $buttonText .'</b></button>
                            </p>
                        </div>
                    </div>
                </div>';
}
?>