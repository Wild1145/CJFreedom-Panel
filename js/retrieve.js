/*
Loading image
*/
var loadingImage;
if ( localStorage.getItem('loadingImage')) {
  loadingImage = localStorage.getItem('loadingImage');
}
else {
  loadingImage='';
  localStorage.setItem('loadingImage',loadingImage);
}
//document.getElementById("loadingimage").src='data:image/svg+xml;base64,' + loadingImage;

var loadingImage;

if ( localStorage.getItem('loadingImage')) {
  loadingImage = localStorage.getItem('loadingImage');
}
else {
function loadloadingImage()
{
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
    localStorage.setItem('loadingImage',xmlhttp.responseText);
	loadingImage = xmlhttp.responseText;
    }
}
xmlhttp.open("GET","js/imageuri/loading_gif.js",false);
xmlhttp.send();
}
  loadloadingImage();
  //loadingImage='';
  
}
//document.getElementById("loadingImage").src=loadingImage;

