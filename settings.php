<?php
$PAGE['title'] = "Maps";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
if ($_SESSION['user']['rank'] < 3) {
	die('You must be a Senior Admin.');
}
?>
<!DOCTYPE html>
<html>

<head>

<?php include 'pageparts/head.php'; ?>
</head>

<body>

    <div id="wrapper">

<?php include 'pageparts/nav.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>User Settings</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <div class="row">
				 <b>Chrome Notifications</b>
				 <div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" onclick="window.webkitNotifications.requestPermission();" class="onoffswitch-checkbox" id="chromeNotify">
					<label class="onoffswitch-label" for="chromeNotify">
					   <div class="onoffswitch-inner">
						  <div class="onoffswitch-active">
							 <div class="onoffswitch-switch">ON</div>
						  </div>
						  <div class="onoffswitch-inactive">
							 <div class="onoffswitch-switch">OFF</div>
						  </div>
					   </div>
					</label>
				 </div>
			  </div>
			  <br />
			  <div class="row">
				 <b>Alert Noises</b>
				 <div class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="alertNoises">
					<label class="onoffswitch-label" for="alertNoises">
					   <div class="onoffswitch-inner">
						  <div class="onoffswitch-active">
							 <div class="onoffswitch-switch">ON</div>
						  </div>
						  <div class="onoffswitch-inactive">
							 <div class="onoffswitch-switch">OFF</div>
						  </div>
					   </div>
					</label>
				 </div>
			  </div><br /><br />
			  <button type="submit" onclick="saveSettings();" class="btn btn-default">Save</button>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>
<script>
if (document.getElementById('chromeNotify')) {
    loadSettings();
}
</script>

</body>

</html>
