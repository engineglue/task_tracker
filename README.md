# task_tracker
Modern, yet basic task tracking (bug reporting) system utilizing PHP. Built with the intention of avoiding BugZilla and CGI.

Installation is simple. Import the database and edit the configuration file under ./server/ (most notably your database credentials.)

example:<br>
`
mysql -u root -p<br>
CREATE DATABASE tasks;<br>
exit;<br>
mysql -u root -p tasks < tasks.sql<br>
nano /var/www/tasks/server/configuration.php<br>
		$db_host = 'localhost';<br>
		$db_username = 'apache';<br>
		$db_password = 'password';<br>
		$db_name = 'tasks';<br>
`

You will also need to set appropriate permissions on the ./upload/ directory. The upload directory is used for uploading attachments.

example:
chown -R www-data:www-data /var/www/tasks/upload


Let me know if you have any questions or need help.

Note that task tracker doesn't currently support versioning. Feel free to make contributions. If the demand is high enough, I'd be happy to implement it myself. Let me know. Thanks for stopping by!


.code{
	background-color:#eee;
	width:auto;
	border:1px solid #ddd;
	padding:6px 10px 6px 10px;
	line-height:25px;
}
