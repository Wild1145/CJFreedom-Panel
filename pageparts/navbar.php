    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div onclick="showDiv('pages/statistics.php');" class="navbar-header">
          <a style="cursor: pointer;" onclick="showDiv('pages/statistics.php');" class="navbar-brand"><?php echo $config['SERVER_NAME']; ?> Panel</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li>
              <a style="cursor: pointer;" onclick="showDiv('pages/statistics.php');"><img width="15px" src="img/glyphicons/glyphicons_331_dashboard.png" />&nbsp;Statistics</a>
            </li>
            <li>
              <a style="cursor: pointer;" onclick="showDiv('pages/management.php');"><img width="15px" src="img/glyphicons/glyphicons_280_settings.png" />&nbsp;Server Management</a>
            </li>
          </ul>

          <ul class="nav navbar-nav navbar-right">
		  <?php
		  if (in_array(strtolower($_SESSION['user']['username']), $config['SUPER_USERS'])) {
          ?>
            <li class="dropdown">
              <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" id="themes"><img width="15px" src="img/glyphicons/glyphicons_137_cogwheels.png" />&nbsp;Administrator <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a style="cursor: pointer;" tabindex="-1" onclick="showDiv('pages/usermanagement.php');" ><img width="15px" src="img/glyphicons/glyphicons_043_group.png" />&nbsp;User Management</a></li>
                <li><a style="cursor: pointer;" tabindex="-1" onclick="showDiv('pages/actionlog.php');" ><img width="15px" src="img/glyphicons/glyphicons_087_log_book.png" />&nbsp;Action Log</a></li>
                <li><a style="cursor: pointer;" tabindex="-1" onclick="showDiv('pages/ucp.php');" ><img width="15px" src="img/glyphicons/glyphicons_003_user.png" />&nbsp;UCP&nbsp;<u><i><?php echo $_SESSION['user']['username']; ?></u></i></a></li>
             </ul>
            </li>
            <script src="js/superuser.js"></script>
          <?php
		  } else {
?>
            <li><a onclick="showDiv('pages/ucp.php');">UCP <u><i><?php echo $_SESSION['user']['username']; ?></u></i></a></li>
            <?php } ?>
            <li><a href="?logout"><img width="15px" src="img/glyphicons/glyphicons_387_log_out.png" />&nbsp;Logout</a></li>
          </ul>

        </div>
      </div>
    </div>