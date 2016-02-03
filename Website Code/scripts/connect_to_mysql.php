<?php
$db = mysql_connect("localhost","root","12345") or die("could not connect to database");
mysql_select_db("peopleconnect",$db) or die("no database");
?>