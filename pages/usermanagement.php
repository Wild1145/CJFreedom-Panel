<?php
include '../inc/config.php';
include '../inc/globalvariables.php';
include '../inc/functions.php';
require '../login/common.php';
if (!in_array(strtolower($_SESSION['user']['username']), $config['SUPER_USERS'])) {
    exit('Nupe');
}
if(empty($_SESSION['user'])) 
{ 
    header("Location: index.php"); 
    die(""); 
} 

if (isset($_REQUEST['action'])) {
    if ($_REQUEST['action'] == "delete" AND isset($_REQUEST['usernametodelete'])) {
    	$username = sanitize($_REQUEST['usernametodelete']);
        if (!in_array(strtolower($_REQUEST['usernametodelete']), $config['SUPER_USERS'])) {
            $query= "DELETE FROM users WHERE username='" . $username . "'";
            echo "User Deleted";
        } else {
            die("Please dont try to delete other Sys. Admins.");
        }
    }
} else {
    $query = " 
    SELECT 
        id, 
        username, 
        email 
    FROM users 
";
}
    
try 
{ 
    // These two statements run the query against your database table. 
    $stmt = $db->prepare($query); 
    $stmt->execute(); 
} 
catch(PDOException $ex) 
{ 
    // Note: On a production website, you should not output $ex->getMessage(). 
    // It may provide an attacker with helpful information about your code.  
    die("Failed to run query: " . $ex->getMessage()); 
} 
         
// Finally, we can retrieve all of the found rows into an array using fetchAll 
$rows = $stmt->fetchAll(); 
//<td>< ?php echo htmlentities($row['email'], ENT_QUOTES, 'UTF-8'); ? ></td> 
//<td>< ?php echo $row['id']; ? ></td> <!-- htmlentities is not needed here because $row['id'] is always an integer -->
if (isset($_REQUEST['action'])) {
die("Done.");
}
?> 

            <div class="well" style="width: 750px; margin-left: auto; margin-right: auto;">
              <div class="form-horizontal">
                <fieldset>
                  <legend><?php echo $config['SERVER_NAME']; ?> User Management&nbsp;<span id="notifications"></span></legend><br><br>
                  <div style="padding: 5px;" class="form-group">
                    <label for="select" class="col-lg-2 control-label"><img src="img/glyphicons/glyphicons_003_user.png"></i></label>
                    <div class="col-lg-5">
                      <select id="usernameselected" class="form-control">
					<?php foreach($rows as $row): ?> 
						<option><?php echo htmlentities($row['username'], ENT_QUOTES, 'UTF-8'); ?></option> 
					<?php endforeach; ?> 
                      </select>
                    </div><button type="submit" onclick="deleteUser();" class="btn btn-primary">Delete user</button><!-- <button type="submit" onclick="wipeFlatlands();" class="btn btn-primary">Change Password</button> -->
                  </div><br>
                </fieldset>
			</div>
		</div>
      
        
        <div class="well" style="width: 750px; margin-left: auto; margin-right: auto;">
            <div class="form-horizontal">
                <fieldset>
                  <legend>Add user&nbsp;<span id="notifications2"></span></legend><br><br>
                  <div style="padding: 5px;" class="form-group">
                    <label for="select" class="col-lg-2 control-label"><img src="img/glyphicons/glyphicons_006_user_add.png"></i></label>
                    <div class="col-lg-5">

                    </div><input type="text" placeholder="Username" class="input-xlarge" name="username" onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('CreateUserButton').click();}};" id="inputUsername">
                    <input type="password" placeholder="Password" class="input-xlarge" name="password" onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('CreateUserButton').click();}};" id="inputPassword">
                    
                    <button type="submit" id="CreateUserButton" onclick="createUser();" class="btn btn-primary">Add user</button> 
                  </div><br>
                </fieldset>
			</div>
		</div>
        
