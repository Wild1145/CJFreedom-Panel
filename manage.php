<?php
$PAGE['title'] = "Management";
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
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Management</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="well col-lg-6">
                <button type="button" onclick="sendToServer('action=start');" class="btn btn-success">Start Server</button>
                <button type="button" onclick="sendToServer('action=restart');" class="btn btn-info">Restart Server</button>
                <button type="button" onclick="sendToServer('action=stop');" class="btn btn-warning">Stop Server</button>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
