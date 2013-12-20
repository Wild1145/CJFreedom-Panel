function showDiv(divurl) {
    $("#footer").fadeOut('fast');
    $("#pagecontent").fadeOut('fast', function () {
        window.scrollTo(1, 1);
        loadingImage = localStorage.getItem('loadingImage');
        changeFavicon(loadingImage);
        document.getElementById("pagecontent").innerHTML = '<center><img width="66" id="loadingImage" height="66" title="" src="' + loadingImage + '" alt=""></center>';
        $("#pagecontent").fadeIn('fast');
    });
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            $("#pagecontent").fadeOut('fast', function () {
                document.getElementById("pagecontent").innerHTML = xmlhttp.responseText;
                changeFavicon('https://www.thecjgcjg.com/favicon.ico');
                $("#pagecontent").fadeIn('fast');
                $("#footer").fadeIn('slow');
            });

        }
    }
    xmlhttp.open("GET", divurl, true);
    xmlhttp.send();
}

function getNotifyPermissions() {
    window.webkitNotifications.requestPermission();
}

function notify(notificationText) {
    var isWebkit = 'webkitRequestAnimationFrame' in window;
    if (navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPhone/i)) {
            //Do nothing
        } else {
            if (isWebkit) {
                var havePermission = window.webkitNotifications.checkPermission();
                if (havePermission == 0) {
                    // 0 is PERMISSION_ALLOWED - MUST REMEMBER THIS
                    var notification = window.webkitNotifications.createNotification('https://www.thecjgcjg.com/favicon.ico', 'CJFreedom Panel', notificationText);
                } else {
                    document.getElementById('notifications').innerHTML = "<a onclick=\"getNotifyPermissions();\">Click here to enable Chrome Notifications</a>";
                }
            }
        }
        $("#notifypanel").slideUp(200, function () {
            document.getElementById('notifypanelbody').innerHTML = notificationText;
            $("#notifypanel").slideDown(200)
            if (isWebkit) {
                notification.show();
            }
        });
    }


    function sendServerOperation(url) {
        var xmlhttp;
        if (document.getElementById("notifications")) {
            document.getElementById("notifications").innerHTML = '<img width="25" id="loadingImage" height="25" title="" src="' + loadingImage + '" alt="">';
        }
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (document.getElementById("notifications")) {
                    document.getElementById("notifications").innerHTML = '';
                }
                notify(xmlhttp.responseText);
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    function sendServerOperationNoNotify(url) {
        var xmlhttp;
        if (document.getElementById("notifications")) {
            document.getElementById("notifications").innerHTML = '<img width="25" id="loadingImage" height="25" title="" src="' + loadingImage + '" alt="">';
        }
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (document.getElementById("notifications")) {
                    document.getElementById("notifications").innerHTML = '';
                }
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
    }

    function deleteLog() {
        notify('Resetting logs');
        sendServerOperation('scripts/sendtoserver.php?action=deletelogs');
    }

    function resetMap() {
        var mapname = document.getElementById("mapname").value;
        notify('Resetting map to: ' + mapname + '.');
        sendServerOperation('scripts/sendtoserver.php?action=reset&mapname=' + mapname + '');
    }

    function wipeFlatlands() {
        notify('Wiping flatlands. This may take some time.');
        sendServerOperation('scripts/sendtoserver.php?action=wipeflatlands');
    }

    function sendCommand() {
        var cmd = document.getElementById("inputCommand").value;
        document.getElementById("inputCommand").value = '';
        sendServerOperation('scripts/sendtoserver.php?action=cmd&cmd=' + cmd + '');
    }

    function sendChat() {
        var chatmessage = document.getElementById("inputChat").value;
        document.getElementById("inputChat").value = '';
        sendServerOperationNoNotify('scripts/sendtoserver.php?action=chat&chatmessage=' + chatmessage + '');
    }

    function sendAdminChat() {
        var chatmessage = document.getElementById("inputAdminChat").value;
        document.getElementById("inputAdminChat").value = '';
        sendServerOperationNoNotify('scripts/sendtoserver.php?action=adminchat&chatmessage=' + chatmessage + '');
    }

    function changePassword() {
        var chatmessage = document.getElementById("inputNewPassword").value;
        document.getElementById("inputNewPassword").value = '';
        sendServerOperation('login/edit_account.php?password=' + chatmessage + '&email=' + Math.random(1, 25000) + '@thecjgcjg.com');
        showDiv('pages/ucp.php');
    }

    function getLogs() {
        var xmlhttp;
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var log = xmlhttp.responseText;
                if (document.getElementById("textarea")) {
                    document.getElementsByName('num')[0].value = log;
                    $('#textarea').scrollTop($('#textarea')[0].scrollHeight);
                }
                setTimeout("getLogs()", 800);
            }
        }
        xmlhttp.open("GET", "scripts/getfilesandstats.php?action=logs", true);
        xmlhttp.send();
    }

    document.head = document.head || document.getElementsByTagName('head')[0];

    function changeFavicon(src) {
        var link = document.createElement('link'),
            oldLink = document.getElementById('dynamic-favicon');
        link.id = 'dynamic-favicon';
        link.rel = 'shortcut icon';
        link.href = src;
        if (oldLink) {
            document.head.removeChild(oldLink);
        }
        document.head.appendChild(link);
    }
