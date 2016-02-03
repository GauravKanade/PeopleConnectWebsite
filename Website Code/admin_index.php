<?php 
session_start();
if(!isset($_SESSION["admin"])){
	header("location: admin.php");
	exit();
}
//Be sure to check that this manager SESSION is in fact in the database
	$adminID = preg_replace("#[^0-9]#",'', $_SESSION["id"]);
	$admin = preg_replace("#[^A-Za-z0-9]#",'', $_SESSION["admin"]);
	$password = preg_replace("#[^A-Za-z0-9]#",'', $_SESSION["password"]);
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM admin WHERE id='$adminID' AND username='$admin' AND password='$password' LIMIT 1");//query the person
//....MAKE SURE THE PERSON EXISTS IN THE DATABASE
$existCount=mysql_num_rows($sql);//count the row nums
if($existCount == 0){
	echo "your log in session is not on record in the database";
	exit();
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

    <title>Admin home page</title>

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
<div id="header-wrap"><header>

	<!--Header -->
	<?php include_once("templatehead/template_header6.php");?>
    <!--End of Header -->
    </header></div>
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    	
        <!-- main -->
        <div id="main">

	<h2>Welcome Admin</h2>
    <ul>
    	<li><a href="signup.php">SignUp</a></li>
        <li><a href="add/add_state.php">Add State</a></li>
        <li><a href="add/add_city.php">Add City</a></li>
        <li><a href="add/add_layout.php">Add Layout</a></li>
    </ul> 
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