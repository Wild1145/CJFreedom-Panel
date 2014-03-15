function getConsole() {
    if (document.getElementById('cjfConsole')) {
        var xmlhttp;
        xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            
            if (document.getElementById('autoscroll').checked) {
               document.getElementById("cjfConsole").innerHTML=xmlhttp.responseText;
                var textarea = document.getElementById('cjfConsole');
                textarea.scrollTop = textarea.scrollHeight;
            } else {
                //document.getElementById("cjfConsole").innerHTML=xmlhttp.responseText;
            }
            }
        }
        xmlhttp.open("GET","scripts/console",true);
        xmlhttp.send();       
    }
}
getConsole();
setInterval(function(){ 
    getConsole();   
}, 500);