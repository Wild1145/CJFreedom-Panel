<!DOCTYPE html>
<html>
   <head>
      <link href="css/bootstrap.oldpanel.min.css" rel="stylesheet">
      <link href="css/bootstrapresponsive.css" rel="stylesheet">
      <link href="css/bootswatch.min.css" rel="stylesheet">
      <link href="css/bootstrap_panel.css" rel="stylesheet">
      <link href="css/custom.css" rel="stylesheet">
      <link href="css/glyphicons.css" rel="stylesheet">
      <link href="css/login.css" rel="stylesheet">
      <title>CjFreedom Panel • Login</title>
   </head>
   <body>
      <!--<link rel="stylesheet" href="css/bootstrap.css" media="screen">-->
      <!--<link rel="stylesheet" href="css/font-awesome.min.css">-->
      <script src="js/jquery.min.js"></script><script>
         function login() {
             $("#loginstatus").slideUp(400, function() {
                 var username = document.getElementById('username').value;
                 var password = document.getElementById('password').value;
                 document.getElementById("loginstatus").innerHTML = '<center><img width="66" id="loadingImage" height="66" title="" src="' + loadingImage + '" alt=""></center>';
                 $("#loginform").slideUp(400, function() {});
                 $("#loginstatus").slideDown(400, function() {
                     var xmlhttp;
                     if (window.XMLHttpRequest) {
                         xmlhttp = new XMLHttpRequest();
                     } else {
                         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                     }
                     xmlhttp.onreadystatechange = function() {
                         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                             if (xmlhttp.responseText == "1") {
                                 $("#loginstatus").slideUp(400, function() {
                                     document.getElementById('loginstatus').innerHTML = '<center><img width="66" id="loadingImage" height="66" title="" src="' + loadingImage + '" alt=""></center><br />';
                                     document.getElementById('statusBarMessage').innerHTML = "Login successful.";
                                     $("#loginstatus").slideDown(400, function() {
                                         window.location.href = "http://<?php echo $config['SITE_HOME']; echo $config['PANEL_LOCATION']; ?>";
                                     });
                                 });
                             } else {
                                 $("#loginstatus").slideUp(400, function() {
                                     document.getElementById("loginstatus").innerHTML = '<div class="alert alert-danger"><p>Incorrect Username or Password. Please try again.</p></div>';
                                     if (localStorage.getItem("PanelUser") === null) {
                                         //ignore
                                     } else {
                                         localStorage.removeItem('PanelUser');
                                         localStorage.removeItem('PanelPassword');
                                     }
                                     document.getElementById('password').value = '';
                                     $("#loginstatus").slideDown(400, function() {
                                         document.getElementById('password').value = '';
                                         $("#loginform").slideDown(300, function() {});
                                     });
                                 });
                             }
                         }
                     }
                     xmlhttp.open("POST", "login/login.php", true);
                     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                     xmlhttp.send("username=" + username + "&password=" + password + "");
                 });
             });
         }

         function loginButton() {
             if (document.getElementById("rememberme").checked) {
                 savePassword();
				 login();
             } else {
                 login();
             }
         }

         function savePassword() {
             var username = document.getElementById('username').value;
             var password = window.btoa(document.getElementById('password').value);
             localStorage.setItem('PanelUser', username);
             localStorage.setItem('PanelPassword', password);
             var password = window.atob(localStorage.getItem('PanelPassword'));
             document.getElementById('username').value = username;
             document.getElementById('password').value = password;
         }

         function autoLogin() {
             if (localStorage.getItem("PanelUser") === null) {
                 //...
             } else {
                 var username = localStorage.getItem('PanelUser');
                 var password = window.atob(localStorage.getItem('PanelPassword'));
                 document.getElementById('username').value = username;
                 document.getElementById('password').value = password;
                 login();
             }
         }

         function deletePassword() {
             ocalStorage.removeItem('PanelUser');
             localStorage.removeItem('PanelPassword');
         }
		function rememberMeAlert() {
		  $("#remembermetext").toggle();
		  $("#infobox").toggle();
		}
      </script>
      <script src="js/retrieve.js"></script>
      <div class="login">
         <h1 id="statusBarMessage">Login to the <?php echo $config['SERVER_NAME']; ?> Panel</h1>
         <span id="loginstatus"></span>
         <span id="loginform">
            <p><input type="text" name="login" id="username" value="" placeholder="Username"></p>
            <p><input type="password" id="password" name="password" value="" placeholder="Password" onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)){document.getElementById('loginButton').click();}};"></p>
            <p class="remember_me">
               <label>
               <input type="checkbox" name="rememberme" onchange="rememberMeAlert();" id="rememberme">
               <span id="remembermetext">Remember me on this computer</span><span style="display: none;" id="infobox">Only use on a trusted computer.</span>
               </label>
            </p>
            <p class="submit"><input type="submit" onclick="loginButton();" id="loginButton" name="commit" value="Login"></p>
			<noscript><div>It appears you do not have Javascript enabled. This site requires Javascript to work.</div></noscript>
         </span>
      </div>

   </body>
</html>
<script>
   autoLogin();
</script>