<h1>CJFreedom Panel</h1>
<h2>Basic information</h2>
<p>This software will require modification to work with your server setup, however the fundamentals are there for you to work with</p>
<p>Built for the CJFreedom All Op Server @ mc.thecjgcjg.com</p>

<h2>Requirements</h2>
<p>
<ul>
<li>Not suitable for Shared hosting due to resource usage and lack of extensions.</li>
<li>Each client takes on average 30kbps of bandwidth when the panel is left open.</li>
<li>A linux based server with SSH2 Access (SSH access is provided courtesy of http://phpseclib.sourceforge.net/)</li>
<li>PHP 5.4 or higher.</li>
<li>Access to a MySQL Database with ability to create new tables. Table creation is not automatic.</li>
<li>The ability to install web server mods - These will be evident in your error_log</li>
<li>You can decrease the request rate based on your user's ping to your server. Default is 300ms.</li>
<li>HTML5 Client support is required due to the use of HTML5 Local Storage</li>
</ul>
</p>

<h2>Notes for usage</h2>
<ul>
<li>Although not required try using <a href="https://github.com/TheCJGCJG/MCManager">https://github.com/TheCJGCJG/MCManager</a> for simplicities sake.</li>
<li>When passwords are saved to a client's machine it is saved in BASE64 encoding, this makes it undecodable to a glancing eye, however this is easy to interpret by machine. Passwords are transmitted with plain text so SSL is reccomended. SSL Force is a config option.</li>
<li>You must run the following SQL commands</li>
    <ul>
        <li>CREATE TABLE &#96;reports&#96; (
  &#96;ID&#96; int(11) NOT NULL AUTO_INCREMENT,
  &#96;reporter&#96; varchar(45) DEFAULT NULL,
  &#96;reported&#96; varchar(45) DEFAULT NULL,
  &#96;time&#96; varchar(45) DEFAULT NULL,
  &#96;ban_reason&#96; varchar(45) DEFAULT NULL,
  &#96;status&#96; varchar(45) DEFAULT NULL,
  &#96;ip&#96; varchar(45) DEFAULT NULL,
  PRIMARY KEY (&#96;ID&#96;)
);</li><br />

<li>CREATE TABLE &#96;cjf_panel_action_log&#96; (
  &#96;ID&#96; int(11) NOT NULL AUTO_INCREMENT,
  &#96;username&#96; varchar(45) DEFAULT NULL,
  &#96;ip&#96; varchar(45) DEFAULT NULL,
  &#96;action&#96; varchar(45) DEFAULT NULL,
  &#96;time&#96; int(45) DEFAULT NULL,
  PRIMARY KEY (&#96;ID&#96;)
);</li><br />

<li>CREATE TABLE &#96;cjf_panel_users&#96; (
  &#96;ID&#96; int(11) NOT NULL AUTO_INCREMENT,
  &#96;username&#96; varchar(45) DEFAULT NULL,
  &#96;password&#96; longtext,
  &#96;salt&#96; varchar(128) DEFAULT NULL,
  &#96;rank&#96; varchar(45) DEFAULT NULL,
  PRIMARY KEY (&#96;ID&#96;)
);</li><br />

<li>CREATE TABLE &#96;cjf_panel_cache&#96; (
  &#96;ID&#96; int(11) NOT NULL AUTO_INCREMENT,
  &#96;cachename&#96; varchar(45) DEFAULT NULL,
  &#96;cachevalue&#96; blob,
  &#96;lastupdated&#96; int(11) DEFAULT NULL,
  PRIMARY KEY (&#96;ID&#96;)
);</li><br />

<li>CREATE TABLE &#96;cjf_panel_maps&#96; (
  &#96;ID&#96; int(11) NOT NULL AUTO_INCREMENT,
  &#96;mapname&#96; varchar(45) DEFAULT NULL,
  &#96;map_image_href&#96; varchar(45) DEFAULT NULL,
  &#96;map_folder_location&#96; varchar(45) DEFAULT NULL,
  PRIMARY KEY (&#96;ID&#96;)
);</li><br />

<li>CREATE TABLE &#96;cjf_bans&#96; (
  &#96;ID&#96; int(11) NOT NULL AUTO_INCREMENT,
  &#96;bannedplayer&#96; varchar(45) DEFAULT NULL,
  &#96;adminname&#96; varchar(45) DEFAULT NULL,
  &#96;reason&#96; varchar(65) DEFAULT NULL,
  &#96;time&#96; int(40) DEFAULT NULL,
  &#96;ip&#96; varchar(45) DEFAULT NULL,
  PRIMARY KEY (&#96;ID&#96;)
);</li><br />

    </ul>
</ul>

<h2>Known bugs</h2>
<ul>
<li>None currently - Please use the reporting feature and ensure you include any error logs if they exist. You can enable on page error logging in `inc/config.php` </li>
</ul>

<h2>License</h2>
<p>You can view the license in LICENSE.md - By using this software you agree to abide by this license.</p>

<h2>Contact me</h2>
You can contact me at <a href="mailto:charlesg.github@gmail.com ">charlesg.github@gmail.com </a>.