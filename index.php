<?php
$PAGE['title'] = "Dashboard";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
?>
<!DOCTYPE html>
<html>

<head>

<?php include 'pageparts/head.php'; ?>
<script src="js/stats.js"></script>
</head>

<body>

    <div id="wrapper">

<?php include 'pageparts/nav.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Dashboard</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">CPU Usage</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="cpuUsage"></h2><h4 class="pull-right">%</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">RAM Usage</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="ramUsage"></h2><h4 class="pull-right">%</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Free Memory</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="freeMemory"></h2><h4 class="pull-right">GB</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Used Memory</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="usedMemory"></h2><h4 class="pull-right">GB</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Total Memory</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="totalMemory"></h2><h4 class="pull-right">GB</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Total Reports</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="totalReports"></h2><h4 class="pull-right">Reports</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Open Reports</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="openReports"></h2><h4 class="pull-right">Reports</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <div class="col-lg-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">Total Bans</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h2 id="totalBans"></h2><h4 class="pull-right">Bans</h4>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>
<script>
restorePreviousStats()
updateStats();
saveStats();
</script>

</body>

</html>
