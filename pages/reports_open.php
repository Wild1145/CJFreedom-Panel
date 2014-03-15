<?php
if (basename(__FILE__) != basename($_SERVER['SCRIPT_FILENAME'])) {
   //this is included
} else {
    include '../inc/config.php';
    include '../inc/functions.php';
    include '../inc/sessions.php';
}
?>
<h2>Open <a onclick="closeAllReports();" style="cursor: pointer;" class="pull-right">Close All</a></h2>
<table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Username</th>
          <th>Reporter</th>
          <th>Reason</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $result = sqlQuery("SELECT * FROM reports WHERE status='open' ORDER BY time DESC LIMIT 300");
        while($row = mysqli_fetch_array($result))
          {
            $time = date('H:i:s d/m/Y', $row['time']) . ' UTC';
            if ($row['status'] == "open") {
                $statusAlternate = 'close';
            } else {
                $statusAlternate = 'open';
            }
            echo "<tr>";
            echo '<td>' . $row['ID'] . '</td>';
            echo '<td>' . $row['reported'] . '</td>';
            echo '<td>' . $row['reporter'] . '</td>';
            echo '<td>' . $row['ban_reason'] . '</td>';
            echo '<td>' . $time . '</td>';
            echo '<td><a class="reportChange" onclick="changeReport(\'' . $statusAlternate . '\', \'' . $row['ID'] . '\', \'open\');">' . $statusAlternate . '</a>';
            echo "</tr>";
          }
      ?>

      </tbody>
    </table>