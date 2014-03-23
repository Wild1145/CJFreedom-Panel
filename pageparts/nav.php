        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index"><?php echo $GLOBALS['Server_Name']; ?> Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <li class="dropdown alerts-dropdown open">
                                  <a id="alertsButton" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span id="alertsNumber" class="badge">0</span> <b class="caret"></b></a>
                                  <ul id="alertsBox" class="dropdown-menu"><li id="noAlerts"><a>No Alerts</a></li></ul>
                                </li>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="user"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <?php if ($_SESSION['user']['rank'] == 4) { echo '<li><a href="sys_admin"><i class="fa fa-user fa-fw"></i> System Admin</a>
                        </li>'; } ?>                
                        <li><a href="settings"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login?logout=1"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li>
                        <a href="index"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a id="reportsButton" href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reports<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="reports?page=open">Open Reports</a>
                            </li>
                            <li>
                                <a href="reports?page=closed">Closed Reports</a>
                            </li>
                            <li>
                                <a href="reports?page=all">All Reports</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="banning"><i class="fa fa-exclamation-circle fa-fw"></i> Banning</a>
                    </li>
                    <?php if ($_SESSION['user']['rank'] >= 3) { ?><li>
                        <a href="maps"><i class="fa fa-flag fa-fw"></i> Maps</a>
                    <?php } ?></li>
                    <li>
                        <a href="logs"><i class="fa fa-comments fa-fw"></i> Logs</a>
                    </li>
                    <?php if ($_SESSION['user']['rank'] >= 3) { ?><li>
                        <a href="manage"><i class="fa fa-shield fa-fw"></i> Management</a>
                    <?php } ?></li>
                    <?php if ($_SESSION['user']['rank'] >= 2) { ?><li>
                        <a href="console"><i class="fa fa-desktop fa-fw"></i> Console</a>
                   </li><?php } ?>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side --><div class="alert alert-success alert-dismissable" id="notifypanel" onclick='$("#notifypanel").slideUp(200);' style="width:300px; position: fixed; margin-left: 56%; display: none;"> <span id="notifypanelbody"></span></div>