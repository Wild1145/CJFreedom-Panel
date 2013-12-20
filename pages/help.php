<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
require '../login/common.php';
if(empty($_SESSION['user'])) 
{ 
    header("Location: index.php"); 
    die(""); 
} 
?>
<h1>Welcome<b> <?php echo $_SESSION['user']['username']; ?> </b>to the <?php echo $config['SERVER_NAME']; ?> Panel!</h1>
<h2>Help:</h2>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Basic Panel Usage</h3>
  </div>
  <div class="panel-body">
    <p>
    The panel is very easy to use. However if you have problems you can follow this.
    <ul>
    <li>Statistics - A basic overview of what is happening on the server. Auto updates</li>
    <li>Management - You can send commands to the server, reset the map, chat and view the live logs from this section</li>
    </ul>
    Thats it, very easy to use.
    </p>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Changing your password</h3>
  </div>
  <div class="panel-body">
    <p>
    To change your password you need to click on the tab that says "ucp" in the bar at the top of your screen. From here you can enter a new password.
    </p>
  </div>
</div>
<br /><br />
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Using the panel API</h3>
  </div>
  <div class="panel-body">
    <p id="logos">Written by TheCJGCJG</p>
  </div>
</div>
<br /><br />
<hr />
<h3>For Developers</h3>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Using the panel API</h3>
  </div>
  <div class="panel-body">
    <p>
    The panel api is located at <a href="/scripts/api.php">/scripts/api.php</a> and can be used by providing the following queries in the GET request.
    <ul>
    <li>apikey=A8Sjns7jm2523jkdsdsf</li>
    <li>action=start | stop | restart | cmd | reset | kill | wipeflatlands</li>
    <li>mapname=MAPNAME - If Applicable</li>
    <li>cmd=COMMAND - If applicable</li>
    </ul>
    <br>
    When using the API you will be returned with the following Header Statuses:
    <ul>
    <li>275: SSH login failed, please contact the Panel maintainer.</li>
    <li>276: Server could not be started. Reason: Already running</li>
    <li>277: Server started</li>
    <li>278: Server restarted</li>
    <li>279: Server Killed</li>
    <li>280: Server stopped</li>
    <li>281: Command Send Successfully</li>
    <li>282: Map has been reset</li>
    <li>283: Flatlands Has Been Wiped</li>
    <li>284: API Disabled</li>
    <li>285: No API key entered</li>
    <li>286: Invalid API key entered</li>
    </ul>
    </p>
  </div>
</div>
<br /><br />
<hr />
<h3>Legal</h3>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Credits</h3>
  </div>
  <div class="panel-body">
    <p>
    Credit is hereby given to the following developers for allowing the use of their code in this situation.
    <ul>
    <li><a href="http://getbootstrap.com/">Bootstrap By Twitter</a></li>
    <li><a href="http://jquery.com/">The jQuery Foundation.</a></li>
    <li><a href="http://bootswatch.com/">Bootswatch</a></li>
    <li><a href="http://thomaspark.me/">Thomas Park</a></li>
    </ul>
    </p>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">License, Terms & Conditions</h3>
  </div>
  <div id="license" class="panel-body">
<?php include '../LICENSE.md'; ?>
  </div>
</div>
