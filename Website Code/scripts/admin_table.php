<?php
$db = mysql_connect("localhost","root","12345") or die("could not connect to database");
mysql_select_db("peopleconnect",$db) or die("no database");
?>
<?php
$sqlCommand = 'CREATE TABLE admin (
		id int(11) NOT NULL AUTO_INCREMENT,
		username varchar(24) NOT NULL,
		password varchar(24) NOT NULL,
		last_log_date date NOT NULL,
		PRIMARY KEY (id),
		UNIQUE KEY username(username)
		)';
if(mysql_query($sqlCommand,$db)){
	echo "Your admin table has been created successfully!";
}else{
	echo "CRITICAL error: admin table has not been created";
}
?>