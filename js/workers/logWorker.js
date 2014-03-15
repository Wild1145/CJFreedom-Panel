function httpGet(theUrl)
 {
  var xmlHttp = null;
  xmlHttp = new XMLHttpRequest();
  xmlHttp.open( "GET", theUrl, false );
  xmlHttp.send( null );
  return xmlHttp.responseText;
 }

var i=0;
function timedCount()
{
i=i+1;
var i = httpGet("../../scripts/getfilesandstats.php?action=logs");
postMessage(i);
setTimeout("timedCount()",300);
}

timedCount();
