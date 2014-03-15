<?php
   include '../inc/config.php';
   include '../inc/globalvariables.php';
   include '../inc/functions.php';
   include '../login/common.php';
   if(empty($_SESSION['user'])) 
	{ 
		header("Location: index.php"); 
		die(""); 
	} 
?>

    <datalist id="command_presets"></datalist>
    <section id="forms">
        <div class="row">
            <div class="span10 offset1">
                <div class="form-horizontal well">
                    <fieldset>
                        <legend><?php echo $config['SERVER_NAME']; ?> Server
                        Management<output id=
                        "notificationbox"></output><output id=
                        "notifications"></output></legend>

                        <div class="control-group">
                            <p></p><label class="control-label" for=
                            "input01">Send Command</label>

                            <div class="controls">
                                <input class="input-xlarge" id="inputCommand" spellcheck="false" list="command_presets" name="command" onkeydown="javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)){document.getElementById('cmd').click();}};" placeholder="Command" type="text" />
                                <button class="btn btn-primary" id="cmd" onclick="sendCommand();">Send Command</button>
                                <p class="help-block"></p>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="select01">Reset
                            Map</label>

                            <div class="controls">
                                <select id="mapname" name="mapresetname">
                                <?php
                                mapNames($config['MAP_NAMES']);
                                ?>
                                </select>
                                <button class="btn btn-primary" onclick="resetMap();" type="submit">Reset Map</button>&nbsp;
                                <button class="btn btn-primary" onclick="wipeFlatlands();" type="submit">Wipe flatlands</button>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                       <button class="btn btn-success" onclick="sendServerOperation('scripts/sendtoserver.php?action=start');" />Start Server</button>
                       <button class="btn btn-warning" onclick="sendServerOperation('scripts/sendtoserver.php?action=restart');" />Restart Server</button>
                       <button class="btn btn-danger" onclick="sendServerOperation('scripts/sendtoserver.php?action=stop');" />Stop server</button>
                       <button class="btn btn-danger" onclick="sendServerOperation('scripts/sendtoserver.php?action=kill');" />Kill server</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
	
    <section id="forms">
        <div class="page-header"></div>

        <div class="form-horizontal well">
            <div class="row">
                <div class="span8">
                    <legend><?php echo $config['SERVER_NAME']; ?> Live
                    Logs</legend>

                    <div class="span12">
                        <div class="span12">
                            <textarea class="field span10" spellcheck="false" id="textarea" name="num" rows="15">Loading....</textarea>

                            <div class="control-group">
                                <p></p><label class="control-label" for=
                                "input01">Public Chat</label>

                                <div class="controls">
                                    <input class="input-xlarge" id="inputChat"
                                    list="command_presets" name="chat"
                                    onkeydown=
                                    "javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('sendChat').click();}};"
                                    placeholder="Chat Message" type="text">
                                    <button class="btn btn-primary" id=
                                    "sendChat" onclick="sendChat();">Send
                                    message</button>

                                    <p class="help-block"></p>
                                </div>

                                <div class="control-group">
                                    <p></p><label class="control-label" for=
                                    "input01">Admin Chat</label>

                                    <div class="controls">
                                        <input class="input-xlarge" id=
                                        "inputAdminChat" list="command_presets"
                                        name="chat" onkeydown=
                                        "javascript:if (event.which || event.keyCode){if ((event.which == 13) || (event.keyCode == 13)) {document.getElementById('sendAdminChat').click();}};"
                                        placeholder="Admin Chat Message" type=
                                        "text"> <button class="btn btn-primary"
                                        id="sendAdminChat" onclick=
                                        "sendAdminChat();">Send
                                        message</button>

                                        <p class="help-block"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
