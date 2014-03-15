<?php
$PAGE['title'] = "Console";
include 'inc/config.php';
include 'inc/sessions.php';
include 'inc/functions.php';

if ($_SESSION['user']['rank'] < 2) {
	die('You must be a Senior Admin.');
}
?>
<!DOCTYPE html>
<html>

<head>

<?php include 'pageparts/head.php'; ?>
<script async src="js/console.js"></script>
</head>

<body>

    <div id="wrapper">

<?php include 'pageparts/nav.php'; ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">CJFreedom Panel &nbsp; <small>Console</small></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->    
                <span class="pull-right">Auto Scroll <input type="checkbox" id="autoscroll" class="" checked/></span>
                <textarea class="form-control" rows="10" id="cjfConsole"></textarea>
                        <div class="input-group">
                          <input type="text" id="commandInput" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-default" onclick="sendToServer('action=cmd&cmd=' + document.getElementById('commandInput').value + ''); document.getElementById('commandInput').value='';" id="submitCommand" type="button">Send Command</button>
                          </span>
                        </div><br />
                        <div class="input-group">
                          <input type="text" id="chatInput" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-default" onclick="sendToServer('action=chat&message=' + document.getElementById('chatInput').value + ''); document.getElementById('chatInput').value='';" id="submitCommand" type="button">Chat</button>
                          </span>
                        </div><br />
                        <div class="input-group">
                          <input type="text" id="adminchatInput" class="form-control">
                          <span class="input-group-btn">
                            <button class="btn btn-default" onclick="sendToServer('action=adminchat&message=' + document.getElementById('adminchatInput').value + ''); document.getElementById('adminchatInput').value='';" id="submitCommand" type="button">Admin Chat</button>
                          </span>
                        </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
	<script>
	var commandBox = document.getElementById('commandInput');
	var chatBox = document.getElementById('chatInput');
	var adminChatBox = document.getElementById('adminchatInput');
	$(commandBox).keyup(function(e) {
	  if (e.keyCode == 13) {
		sendToServer('action=cmd&cmd=' + document.getElementById('commandInput').value + ''); document.getElementById('commandInput').value='';
	  }
	});
	$(chatBox).keyup(function(e) {
	  if (e.keyCode == 13) {
		sendToServer('action=chat&message=' + document.getElementById('chatInput').value + ''); document.getElementById('chatInput').value='';
	  }
	});
	$(adminChatBox).keyup(function(e) {
	  if (e.keyCode == 13) {
		sendToServer('action=adminchat&message=' + document.getElementById('adminchatInput').value + ''); document.getElementById('adminchatInput').value='';
	  }
	});
	</script>
    <?php include 'pageparts/footerjs.php'; ?>


</body>

</html>
