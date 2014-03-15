<?php
$PAGE['title'] = "User Management";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
if ($_SESSION['user']['rank'] != 4) {
	header('HTTP/1.0 403 Forbidden');
	die('You are not a system admin.');
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
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>System Admin</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
