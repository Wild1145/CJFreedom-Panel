function deleteUser() {
    var username = document.getElementById("usernameselected").value;
    sendServerOperation('pages/usermanagement.php?action=delete&usernametodelete=' + username + '');
    showDiv('pages/usermanagement.php');
}


function createUser() {
var username = document.getElementById("inputUsername").value;
var password = document.getElementById("inputPassword").value;
var xmlhttp;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    showDiv('pages/usermanagement.php');
    notify(xmlhttp.responseText);
    }
  }
xmlhttp.open("POST","login/register.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send('username=' + username + '&password=' + password + '&email=' + Math.random() + '@thecjgcjg.com');
}