<?php 
session_start();
if(isset($_SESSION["admin"])){
	header("location: admin_index.php");
	exit();
}
?>
<?php
	if(isset($_POST["username"])&&isset($_POST["password"])){
		$admin =preg_replace("#[^A-Za-z0-9]#",'', $_POST["username"]);
	$password =preg_replace("#[^A-Za-z0-9]#",'', $_POST["password"]);
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
$sql=mysql_query("SELECT id FROM admin WHERE username='$admin' AND password='$password' LIMIT 1");//query the person
//....MAKE SURE THE PERSON EXISTS IN THE DATABASE
$existCount=mysql_num_rows($sql);//count the row nums
if($existCount == 1){
	while($row=mysql_fetch_array($sql)){
		$id=$row["id"];
	}
	$_SESSION["id"]=$id;
	$_SESSION["admin"]=$admin;
	$_SESSION["password"]=$password;
	header("location: admin_index.php");
	exit();
}
else{
	echo 'The information is incorrect.Try again<a href="admin_index.php">click here</a>';
	exit();
}
	}
?>
<!DOCTYPE html>
<!--[if IE 7 ]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie8 oldie"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html> <!--<![endif]-->

<head>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin login</title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />

    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>

</head>

<body id="top">

<!--header -->
	<!--Header -->
	<?php include_once("templatehead/template_header6.php");?>
    <!--End of Header -->
    
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    	
        <!-- main -->
        <div id="main">

	<h2>Admin Please Log In</h2>
    <form id="form1" name="form1" action="admin.php" method="post" >
    <h3>User Name:</h3><br/>
    <input name="username" type="text" id="username" size="40" style="width:300px;"/>
    <br/>
    <h3>Password:</h3><br/>
    <input name="password" type="password" id="password" size="40" style="width:300px;"/>
    <br/>
	<input type="submit" name="button" id="button" value="Log In"/>
    </form>
     
      <!-- /main -->
        </div>
       
    <!--Sidebar -->
	<?php include_once("sidebar.php");?>
    <!--End of Sidebar -->
        
    <!-- content -->
	</div>
    

<!-- /content-out -->
</div>

    <!--Footer -->
	<?php include_once("template_footer.php");?>
    <!--End of Footer -->
    </body>
    </html>