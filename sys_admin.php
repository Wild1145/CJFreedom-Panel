<?php
$PAGE['title'] = "User Management";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
if ($_SESSION['user']['rank'] != 4) {
	header('HTTP/1.0 403 Forbidden');
	die('You are not a system admin.');
}

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case "createUser":
			addUser($_POST['username'], $_POST['password'], $_POST['rank']);
			die(1);
			break;
		case "deleteUser":
			deleteUser($_POST['username'], $_SESSION);
			die(1);
			break;
		case "changePassword":
			adminChangePassword($_POST['username'], $_POST['password']);
			die(1);
			break;
        case "deleteMap":
            $result = sqlQuery("SELECT * FROM cjf_panel_maps WHERE mapname='" . $_POST['mapName'] . "' ORDER BY mapname ASC");
            while($row = mysqli_fetch_array($result)) {
                unlink($row['map_image_href']);
                sqlQuery("DELETE FROM cjf_panel_maps WHERE ID=" . $row['ID'] . "");
            }
            die();
    }
}

if (isset($_POST['mapSubmit'])) {
    $image = file_get_contents($_FILES['mapImage']['tmp_name']);
    file_put_contents("images/maps/" . $_POST['mapName'] . ".png", $image);
    $imageLocation = "images/maps/" . $_POST['mapName'] . ".png";
    $folder = $_POST['mapLoc'];
    $mapName = $_POST['mapName'];
    sqlQuery("INSERT INTO cjf_panel_maps (mapname, map_image_href, map_folder_location) VALUES ('" . $mapName . "', '" . $imageLocation . "', '" . $folder . "')");
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
            <div class="well well-lg">
                <h3>Action Logs</h3>
                <?php
                if (isset($_GET['pg']) AND $_GET['pg'] == "actionLogs") {
                            ?>
                            <div class="actionlogs">
                            <table class="table table-striped ">
                            <tr>
                            <th>Username</th>
                            <th>IP Address</th>
                            <th>Time</th>
                            <th>Action</th>
                            </tr>
                            <?php
                            $result = sqlQuery("SELECT * FROM cjf_panel_action_log ORDER BY time DESC");
                            while($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['username'] . "</td>";
                                echo "<td>" . $row['ip'] . "</td>";
                                echo "<td>" . date('Y-m-d H:i:s', $row['time']) . "</td>";
                                echo "<td>" . $row['action'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                            
                            </table>
                            </div>
                            <?php
                } else {
                ?>
                <ul>
                <li><a href="?pg=actionLogs">View Action Logs</a></li>
                </ul>
                <?php } ?>
            </div>
            <div class="well well-lg">
                <h3>Add new Map</h3>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data" role="form">
                      <div class="form-group">
                        <label for="mapName" class="col-sm-2 control-label">Map Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="mapName" id="mapName" placeholder="Map Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="mapLoc" class="col-sm-2 control-label">Map Folder Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="mapLoc" id="mapLoc" placeholder="Map Folder Name">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="inputImage" class="col-sm-2 control-label">Map Image (PNG)</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="mapImage" id="inputImage" placeholder="Select Image">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" name="mapSubmit" value="addMap" class="btn btn-default pull-right">Add Map</button>
                        </div>
                      </div>
                    </form>
            </div>
            <div class="well well-lg">
            <h3>Remove map</h3>
                <div class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="deleteMapName" class="col-sm-2 control-label">Map Name</label>
                    <div class="col-sm-10">
                      <select id="deleteMapName" class="form-control">
                        <?php
                        $result = sqlQuery("SELECT * FROM cjf_panel_maps");
                        while($row = mysqli_fetch_array($result)) {
                            echo "<option>" . $row['mapname'] . "</option>";
                        }
                        ?>
                       </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-default pull-right" onclick="deleteMap();">Delete Map</button>
                <br />
            </div>
            <div class="well well-lg">
            <h3>Create User</h3>
                <div class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="usernameCreate" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="usernameCreate" placeholder="Username">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="createPassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="createPassword" placeholder="Password">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="newRank" class="col-sm-2 control-label">Rank</label>
                    <div class="col-sm-10">
                      <select id="newRank" class="form-control">
						<option value="1">Super Admin</option>
						<option value="2">Super Telnet Admin</option>
						<option value="3">Senior Admin</option>
						<option value="4">System-Admin</option>
                       </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-default pull-right" onclick="addUser();">Create User</button>
                <br />
            </div>
            <div class="well well-lg">
            <h3>Delete User</h3>
                <div class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="usernameDelete" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <select id="usernameDelete" class="form-control">
                        <?php
                        echo listUsers();
                        ?>
                       </select>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-default pull-right" onclick="deleteUser()" >Delete User</button>
                <br />
            </div>
            <div class="well well-lg">
            <h3>Change User Password</h3>
                <div class="form-horizontal" role="form">
                  <div class="form-group">
                    <label for="usernameChange" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <select id="usernameChange" class="form-control">
                        <?php
                        echo listUsers();
                        ?>
                       </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="changePassword" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="changePassword" placeholder="Password">
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-default pull-right" onclick="AdminChangePassword();">Change Password</button>
                <br />
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
