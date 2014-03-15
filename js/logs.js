function getLogs() {
    if (document.getElementById('cjfConsole')) {
        var xmlhttp;
        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("cjfConsole").innerHTML=xmlhttp.responseText;
            var textarea = document.getElementById('cjfConsole');
            textarea.scrollTop = textarea.scrollHeight;
            }
        }
        xmlhttp.open("GET","scripts/logs",true);
        xmlhttp.send();       
    }
}
getLogs();