<?php
$PAGE['title'] = "Reports";
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
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Reports</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <span id="reportPage">
            <?php switch ($_GET['page']) {
                    case "open":
                        include 'pages/reports_open.php';
                        break;
                    case "closed":
                        include 'pages/reports_closed.php';
                        break;
                    case "all":
                        include 'pages/reports_all.php';
                        break;
                    default:
                        echo "Incorrect URL Parameters";
                        break;
                  } ?>
            </span>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'pageparts/footerjs.php'; ?>

</body>

</html>
    <script>
    if (document.getElementById('reportsButton')) {
        setTimeout(function (){
            document.getElementById('reportsButton').click();
        }, 500); // how long do you want the delay to be? 
    }
    </script>