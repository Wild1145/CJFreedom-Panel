<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
require '../login/common.php';
if(empty($_SESSION['user'])) 
{ 
    header("Location: index.php"); 
    die(""); 
} 
?>
<h2>Statistics</h2>
<table class="table table-striped" style="">
        <tbody>
          <tr>
            <td class="statustableitemnames">Server Status</td>
            <td class="statustableitemvalues"><span name="tableServerStatus" class="tableServerStatus" id="tableServerStatus">Loading.....</span></td>
          </tr>
          <tr>
            <td class="statustableitemnames">Unique Players</td>
            <td class="statustableitemvalues"><span name="tableTotalUsers" class="tableTotalUsers" id="tableTotalUsers">Loading.....</span></td>
          </tr>
            <td class="statustableitemnames">CPU Usage (2 Cores)</td>
            <td class="statustableitemvalues"><span name="tableCpuUsage" class="TableCpuUsage" id="tableCpuUsage"><div style="position: absolute; width: 307px;" class="progress progress-striped active"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" id="cpuusageprogress" style=""><span id="cpuusageprogresstext"></span></div></div></span></td>
          </tr>
          <tr>
            <td class="statustableitemnames">Memory Usage</td>
            <td class="statustableitemvalues"><span name="tableMemoryUsage" class="tableMemoryUsage" id="tableMemoryUsage"><div style="position: absolute; width: 307px;" class="progress progress-striped active"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" id="memoryusageprogress" style=""><span id="memoryusageprogresstext"></span></div></div></span></td>
          </tr>
          <tr>
            <td class="statustableitemnames">Total Memory</td>
            <td class="statustableitemvalues"><span name="tableTotalMemory" class="tableTotalMemory" id="tableTotalMemory">Loading.....</span></td>
          </tr>
          <tr>
            <td class="statustableitemnames">Free Memory</td>
            <td class="statustableitemvalues"><span name="tableFreeMemory" class="tableFreeMemory" id="tableFreeMemory">Loading.....</span></td>
          </tr>
          <tr>
            <td class="statustableitemnames">Last Updated (UTC)</td>
            <td class="statustableitemvalues"><span name="tablelastUpdated" class="tableLastUpdated" id="tableLastUpdated">Loading.....</span></td>
          </tr>
        </tbody>
      </table>
	  <script src="js/onmanagement.js"></script>
