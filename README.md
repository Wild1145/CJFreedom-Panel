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
<li>Although not required try using <a href="https://github.com/DarthCraft/MCManager">https://github.com/DarthCraft/MCManager</a> for simplicities sake.</li>
<li>When passwords are saved to a client's machine it is saved in BASE64 encoding, this makes it undecodable to a glancing eye, however this is easy to interpret by machine. Passwords are transmitted with plain text so SSL is reccomended. SSL Force is a config option.</li>
</ul>

<h2>Known bugs</h2>
<ul>
<li>Memory usage shows as a negative number in some cases. E.G -4900. This shall be fixed very soon.</li>
<li>iOS Bug - Can't use server management buttons on iOS - A fix has been pushed and shall be tested soon.</li>
</ul>

<h2>License</h2>
<p>You can view the license in LICENSE.md - By using this software you agree to abide by this license.</p>

<h2>Contact me</h2>
You can contact me at <a href="mailto:charlesg.github@gmail.com ">charlesg.github@gmail.com </a>.
