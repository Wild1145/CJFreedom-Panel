function setSliders(sliderid, slidervalue, slidertextid, slidertextcontent) {
    if (document.getElementById(sliderid)) {
        document.getElementById(slidertextid).innerHTML = slidertextcontent + '%';
        document.getElementById(sliderid).style.width = slidervalue + '%';
    }
}

    function getStats(url) {
        var AJAX_req = new XMLHttpRequest();
        AJAX_req.open("GET", url, true);
        AJAX_req.setRequestHeader("Content-type", "application/json");

        AJAX_req.onreadystatechange = function () {
            if (AJAX_req.readyState == 4 && AJAX_req.status == 200) {
                var response = JSON.parse(AJAX_req.responseText);
                outPutStats(response);
            }
        }
        AJAX_req.send();
    }

    function outPutStats(stats) {
        if (document.getElementById("cpuusageprogress")) {
            document.getElementById('tableTotalMemory').innerHTML = stats.totalmemory + ' GB';
            document.getElementById('tableFreeMemory').innerHTML = stats.freememory + ' GB';
            document.getElementById('tableTotalMemory').innerHTML = stats.totalmemory + ' GB';
            document.getElementById('tableTotalUsers').innerHTML = stats.uniquePlayers + '';
            document.getElementById('tableLastUpdated').innerHTML = stats.time + '';
            document.getElementById('tableServerStatus').innerHTML = stats.status + '';
            setSliders('cpuusageprogress', stats.cpuusage, 'cpuusageprogresstext', stats.cpuusage);
            setSliders('memoryusageprogress', stats.memoryusage, 'memoryusageprogresstext', stats.memoryusage);
        }
            if (stats.status == "Offline") {
                if (localStorage.getItem("panelOfflineAlert") === null) {
                    var seconds = new Date().getTime() / 1000;
                    localStorage.setItem("panelOfflineAlert", seconds);
                    notify('Server is offline');
                }
                var lastRun = localStorage.getItem('panelOfflineAlert');
                var seconds = new Date().getTime() / 1000;
                if ((seconds - lastRun) > 300) {
                    notify('Server is offline');
                    localStorage.setItem("panelOfflineAlert", seconds)
                }
                
            }
    }

    function updateStats() {
            if (document.getElementById('tableTotalMemory') == "Loading.....") {
                if(localStorage.getItem("serverStatus") != null) {
                    outPutStats(localStorage.getItem("serverStatus"));
                }
            }
            getStats('scripts/stats.php');
        if (document.getElementById("textarea")) {
            getLogs();
        }
        setTimeout("updateStats()", 1000);
    }
    updateStats();
