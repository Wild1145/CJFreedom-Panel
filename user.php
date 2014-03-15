<?php
$PAGE['title'] = "User Control";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
if (isset($_POST["action"])) {
	switch ($_POST["action"]) {
		case "changePassword":
			changePassword($_SESSION, $_POST["password"]);
			die("Done");
			break;
        default:
            die();
	}
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
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>User Management</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="well well-lg">
            <h3>Change Password</h3>
                <div class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="usernameChange" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input id="usernameChange" class="form-control" value="<?php echo $_SESSION['user']['username'];?>" disabled/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="changePassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="changePassword" placeholder="Password">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-default pull-right" onclick="changeUserPassword();">Change Password</button>
                <br />
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
