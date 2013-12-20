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
    
     <span id="notifypanelbody"></span>
            <div class="well" style="width: 750px; margin-left: auto; margin-right: auto;">
              <div class="form-horizontal">
                <fieldset>
                  <legend><?php echo $_SESSION['user']['username'] ?>'s User Control&nbsp;<span id="notifications"></span></legend><br><br>
                  <div style="padding: 5px;" class="form-group">
                    <label for="select" class="col-lg-2 control-label"><img src="img/glyphicons/glyphicons_003_user.png"></i></label>
                    <div class="col-lg-5">
                    <input type="password" placeholder="New Password" class="input-xlarge" name="newpassword" onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('ChangePasswordButton').click();}};" id="inputNewPassword">
                    </div><button type="submit" id="ChangePasswordButton" onclick="changePassword();" class="btn btn-primary">Change Password</button> 
                  </div><br>
                </fieldset>
			</div>
		</div>