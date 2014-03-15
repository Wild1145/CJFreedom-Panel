function changeReport(changeTo, id, reportStats) {
    $.get("scripts/changereportstatus?action=" + changeTo + "&id=" + id + '');
    $.get( "pages/reports_" + reportStats + '', function( data ) {
      document.getElementById('reportPage').innerHTML=data;
    });
}
function closeAllReports() {
    $.get("scripts/changereportstatus?action=closeall&id=0");
    $.get( "pages/reports_all" , function( data ) {
      document.getElementById('reportPage').innerHTML=data;
    });
}

function sendToServer(query) {
    $.get( "scripts/sendtoserver?" + query, function( data ) {
        newAlert('Operation Sent', data);
    });
}

function updateStats() {
    if(document.getElementById('cpuUsage')) {
        $.getJSON( "scripts/stats", function( stats ) {
          document.getElementById('cpuUsage').innerHTML=stats.cpuUsage;
          document.getElementById('ramUsage').innerHTML=stats.memoryPercent;
          document.getElementById('freeMemory').innerHTML=stats.freeMemory;
          document.getElementById('usedMemory').innerHTML=stats.usedMemory;
          document.getElementById('totalMemory').innerHTML=stats.totalMemory;
          document.getElementById('totalReports').innerHTML=stats.totalReports;
          document.getElementById('openReports').innerHTML=stats.openReports;
          document.getElementById('totalBans').innerHTML=stats.totalBans;
        });
    }
}
function saveStats() {
        $.getJSON( "scripts/stats", function( stats ) {
          localStorage.setItem('stats', JSON.stringify(stats));
        });
}

function restorePreviousStats() {
    if (localStorage.getItem("stats") === null) {
      saveStats();
    } else {
        var stats = JSON.parse(localStorage.getItem('stats'));
        document.getElementById('cpuUsage').innerHTML=stats.cpuUsage;
        document.getElementById('ramUsage').innerHTML=stats.memoryPercent;
        document.getElementById('freeMemory').innerHTML=stats.freeMemory;
        document.getElementById('usedMemory').innerHTML=stats.usedMemory;
        document.getElementById('totalMemory').innerHTML=stats.totalMemory;
        document.getElementById('totalReports').innerHTML=stats.totalReports;
        document.getElementById('openReports').innerHTML=stats.openReports;
        document.getElementById('totalBans').innerHTML=stats.totalBans;
    }
}

function clearAlerts() {
    document.getElementById('alertsBox').innerHTML = '<li id="noAlerts"><a>No Alerts</a></li>';
    document.getElementById('alertsNumber').innerHTML = '0';
    saveAlertStatus();
}

function saveAlertStatus() {
    localStorage.setItem('alertsBox', document.getElementById('alertsBox').innerHTML);
    localStorage.setItem('alertsNumber', document.getElementById('alertsNumber').innerHTML);
}

function loadNavbarPrev() {
    if (document.getElementById('alertsBox')) {
        if (localStorage.getItem("alertsBox") === null) {
            console.log('Someones new!');
        } else {
            document.getElementById('alertsBox').innerHTML = localStorage.getItem("alertsBox");
        }
        if (localStorage.getItem('alertsNumber') === null) {
            console.log('Again new.');
        } else {
            document.getElementById('alertsNumber').innerHTML = localStorage.getItem("alertsNumber");
        }
    }
}
$( document ).ready(function() {
  loadNavbarPrev();
});
function newAlert(alertValue, subtext) {
    var clearText = '<li><a onclick="clearAlerts();">Clear Alerts</a></li><li class="divider"></li>';
    var alertsNumberSpan = document.getElementById('alertsNumber');
    var alertNumber = parseInt(alertsNumberSpan.innerHTML) + 1;
    alertsNumberSpan.innerHTML = alertNumber;
    document.getElementById('noAlerts').innerHTML = '';
    if (!alertType) {
        var alertType = 'default';
    }
    var oldAlertsBox = document.getElementById('alertsBox').innerHTML;
    var oldAlertsBox = oldAlertsBox.replace(clearText, '');
    document.getElementById('alertsBox').innerHTML = clearText + '<li><a>' + alertValue + '<br /><small>' + subtext + '</small></a></li><li class="divider"></li>' + oldAlertsBox;
    saveAlertStatus();
    if (getSetting('chromeNotify')) {
        chromeNotify(alertValue, subtext);
    }
    if (getSetting('alertNoises')) {
        var clickSound = new Audio('ding.mp3');
        clickSound.play();
    }
        $("#notifypanel").slideUp(200, function () {
            document.getElementById('notifypanelbody').innerHTML = subtext;
            $("#notifypanel").slideDown(200)
        });
        
        $("#notifypanel").delay(5000).slideUp(200);
        
    saveAlertStatus();
}

function chromeNotify(alertText, subText) {
    if (window.webkitNotifications.checkPermission() == 0) {
        var notification = window.webkitNotifications.createNotification('https://www.thecjgcjg.com/cjfreedom/panel/images/chromenotification.png', alertText, subText);
        notification.show();
    } else {
        window.webkitNotifications.requestPermission();
    }
}

function saveSettings() {
    localStorage.setItem('settings_chromeNotify', document.getElementById('chromeNotify').checked);
    localStorage.setItem('settings_alertNoises', document.getElementById('alertNoises').checked);
    console.log('Settings Saved');
}

function getSetting(setting) {
    if (localStorage.getItem('settings_' + setting) === null) {
        return false;
    } else {
        if (localStorage.getItem('settings_' + setting) == "true") {
            return true;
        } else {
            return false;
        }
    }
}

function loadSettings() {
    document.getElementById('chromeNotify').checked = getSetting('chromeNotify');
    document.getElementById('alertNoises').checked = getSetting('alertNoises');
}

function addUser() {
    var username = document.getElementById('usernameCreate').value;
    var password = document.getElementById('createPassword').value;
    var rank = document.getElementById('newRank').value;
    $.post( "sys_admin", { action: "createUser", username: username, password: password, rank: rank }, function( data ) {
        newAlert('User Add', data);
        location.reload();
    });
}

function deleteUser() {
    var username = document.getElementById('usernameDelete').value;
    $.post( "sys_admin", { action: "deleteUser", username: username }, function( data ) {
        newAlert('User Delete', data);
        location.reload();
    });
}

function AdminChangePassword() {
    var username = document.getElementById('usernameChange').value;
    var newPassword = document.getElementById('changePassword').value;
    $.post( "sys_admin", { action: "deleteUser", username: username, password: newPassword }, function( data ) {
        newAlert('User Password', data)
        location.reload();
    });
}
function changeUserPassword() {
    var newPassword = document.getElementById('changePassword').value;
    $.post( "user", { action: "changePassword", password: newPassword }, function( data ) {
        newAlert('Password Changed', 'Completed');
    });
    newPassword='';
}
function deleteMap() {
    var mapName = document.getElementById('deleteMapName').value;
    $.post( "sys_admin", { action: "deleteMap", mapName: mapName }, function( data ) {
        newAlert('Map Delete', data);
        location.reload();
    });
}

function resetMap(mapName) {
    if (mapName == 'wipeflatlands') {
        sendToServer('action=wipeflatlands');
    } else {
        if (document.getElementById('instant').checked) {
            sendToServer("instant=true&action=resetmap&mapname=" + mapName);
        } else {
            sendToServer("action=resetmap&mapname=" + mapName);
        }
    }
}