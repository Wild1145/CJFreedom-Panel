function login() {
var xmlhttp;
var username = document.getElementById('username').value;
var password = document.getElementById('password').value;
var loginButton = document.getElementById('loginButton');
var rememberme = document.getElementById('remember');

if (rememberme.checked) {
    var remember='&remember=true';
} else {
    var remember='';
}

loginButton.disabled=1;
loginButton.classList.remove("btn-success");
loginButton.classList.remove("btn-danger");
loginButton.classList.add('btn-success');
loginButton.disabled=1;
xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
     if (xmlhttp.responseText == "1") {
        console.log('Login Success');
        window.location = "https://www.thecjgcjg.com/cjfreedom/panel/";
     } else {
        console.log("Login Failed");
        loginButton.classList.remove("btn-success");
        loginButton.classList.add('btn-danger');
        loginButton.disabled=0;
     }
    }
  }
xmlhttp.open("POST","scripts/login",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("username=" + username + "&password=" + password + remember);
}