<?php
$PAGE['title'] = "Logs";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
?>
<!DOCTYPE html>
<html>

<head>

<?php include 'pageparts/head.php'; ?>
<script async src="js/logs.js"></script>
</head>

<body>

    <div id="wrapper">

<?php include 'pageparts/nav.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Logs</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <textarea class="form-control" rows="10" id="cjfConsole"></textarea>
                <button type="button" onclick="getLogs();" class="btn btn-primary">Refresh</button>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
