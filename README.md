# task_tracker
Modern, yet basic task tracking (bug reporting) system utilizing PHP, built with the intention of avoiding BugZilla and CGI.

Compatible with PHP 7.3.

Installation is simple. Import the database and edit the configuration file under ./server/ (most notably your database credentials.)

example:  
`mysql -u root -p`  
`CREATE DATABASE tasks;`  
`exit;`  
`mysql -u root -p tasks < tasks.sql`  
`nano /var/www/tasks/server/configuration.php`  
`		$db_host = 'localhost';`  
`		$db_username = 'apache';`  
`		$db_password = 'password';`  
`		$db_name = 'tasks';`  


You will also need to set appropriate permissions on the ./upload/ directory. The upload directory is used for uploading attachments.

example:  
`chown -R www-data:www-data /var/www/tasks/upload`  


Let me know if you have any questions or need help.

Note that task tracker doesn't currently support versioning. Feel free to make contributions. If the demand is high enough, I'd be happy to implement it myself. Let me know. Thanks for stopping by!
