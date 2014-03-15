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
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Maps</small></h1> <span class="pull-right">Instant Reset&nbsp;<input type="checkbox" id="instant" /></span>
                </div>
                <!-- /.col-lg-12 -->
				
            </div>
			
            <!-- /.row -->
<?php
// Create the wipe flatlands tab
echo createMapTab("Wipe Flatlands", "images/maps/flatlands.png", "wipeflatlands", "Wipe Flatlands", "danger");
//Query time
$result = sqlQuery("SELECT * FROM cjf_panel_maps");
while($row = mysqli_fetch_array($result)) {
    echo createMapTab($row['mapname'], $row['map_image_href'], $row['map_folder_location'], "Restore " . $row['mapname'], "danger");
}

?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
