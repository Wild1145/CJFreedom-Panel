<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $config['SERVER_NAME']; ?> &bull; Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.oldpanel.min.css">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
    <link rel="stylesheet" href="css/bootstrapresponsive.css">
    <link rel="stylesheet" href="css/bootswatch.min.css">
	<link rel="stylesheet" href="css/custom.css">
    <link rel="stylesheet" href="css/glyphicons.css">
    <script src="js/retrieve.js"></script>
	<script src="js/functions.js"></script>
    <script src="js/management.js"></script>
</head>
  <body>
<?php
include 'pageparts/navbar.php';
?><br><br><br>
    <div class="container">
		<div class="alert alert-success alert-dismissable" id="notifypanel" onclick='$("#notifypanel").slideUp(200);' style="width:300px; position: fixed; margin-left: 56%; display: none;"><button class="close" onclick='$("#notifypanel").slideUp(200);'  type="button">&times;</button> <span id="notifypanelbody"></span></div>
        <div id="pagecontent" class="bs-example">			
		<img width="66" id="loadingImg" height="66" title="" alt="" src="" /> 
    </div>
<?php include 'pageparts/footer.php'; ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootswatch.js"></script>
  	
</body></html>
<script src="js/workers/log.js"></script>
<script>
showDiv('pages/statistics.php');
</script>
<script src="js/statistics.js" async="true"></script>

