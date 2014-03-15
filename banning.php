<?php
$PAGE['title'] = "Banning";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';
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
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Banning</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="panel panel-default">
                        <div class="panel-heading">
                            CJFreedom Recent Bans
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Username</th>
                                      <th>Admin</th>
                                      <th>Reason</th>
                                      <th>Time</th>
                                      <?php if ($_SESSION['user']['rank'] >= 3) { echo "<th>Actions</th>"; } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  $result = sqlQuery("SELECT * FROM cjf_bans ORDER BY time DESC LIMIT 350");
                                    while($row = mysqli_fetch_array($result))
                                      {
                                        $dateTime = date('H:i:s d/m/Y', $row['time']) . ' UTC';
                                        echo "<tr>";
                                        echo '<td>' . $row['ID'] . '</td>';
                                        echo '<td>' . $row['bannedplayer'] . '</td>';
                                        echo '<td>' . $row['adminname'] . '</td>';
                                        echo '<td>' . $row['reason'] . '</td>';
                                        echo '<td>' . $dateTime . '</td>';
                                        if ($_SESSION['user']['rank'] >= 3) { echo "<td><a style='cursor:pointer;' onclick='sendToServer(\"action=cmd&cmd=glist unban " . $row['bannedplayer'] . "\");'>Unban</a> / <a style='cursor:pointer;' onclick='sendToServer(\"action=cmd&cmd=glist ban " . $row['bannedplayer'] . "\");'>Reban</a></td>"; }
                                        echo "</tr>";
                                      }
                                  ?>

                                  </tbody>
                                </table>
                            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
