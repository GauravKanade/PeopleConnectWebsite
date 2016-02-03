<?php
$db = mysql_connect("localhost","root","12345") or die("could not connect to database");
mysql_select_db("peopleconnect",$db) or die("no database");
?>
<?php
$sqlCommand = 'CREATE TABLE ARCHIVE_VOTES (
		QUESTION_ID INT NOT NULL ,
  OPTION_1 FLOAT NULL ,
  OPTION_2 FLOAT NULL ,
  OPTION_3 FLOAT NULL ,
  OPTION_4 FLOAT NULL ,
  OPTION_5 FLOAT NULL ,
  NUMBER_OF_VOTERS INT NOT NULL ,
  PRIMARY KEY (QUESTION_ID) 
	)';
if(mysql_query($sqlCommand,$db)){
	echo "Your ARCHIVE VOTES table has been created successfully!";
}else{
	echo "CRITICAL error: ARCHIVE VOTES table has not been created";
}
?>