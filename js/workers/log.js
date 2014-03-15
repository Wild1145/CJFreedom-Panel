var w;

function startWorker()
{
if(typeof(Worker)!=="undefined")
  {
  if(typeof(w)=="undefined")
  {
  w=new Worker("js/workers/logWorker.js");
  }
  w.onmessage = function (event) {
    document.getElementsByName('num')[0].value=event.data;
	$('#textarea').scrollTop($('#textarea')[0].scrollHeight);
    };
  }
else
  {
  document.getElementsByName('num')[0].value="Get A Better Browser, Try Google Chrome, Or Firefox, Or Safari, Or Opera, Anything BUT Internet Explorer, Unless its Internet Explorer 10, then its okay.";
  }
}

function stopWorker()
{ 
w.terminate();
}
