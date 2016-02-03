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
include "../scripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM admin WHERE id='$adminID' AND username='$admin' AND password='$password' LIMIT 1");//query the person
//....MAKE SURE THE PERSON EXISTS IN THE DATABASE
$existCount=mysql_num_rows($sql);//count the row nums
if($existCount == 0){
	echo "your log in session is not on record in the database";
	exit();
	}
?>
<?php
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>

<?php
$state_list="";
$sql=mysql_query("SELECT * FROM states ORDER BY STATE_NAME");
$stateCount=mysql_num_rows($sql);//count the output amount
if($stateCount>0){
	while($row=mysql_fetch_array($sql)){
		$id=$row["STATE_ID"];
		$state_name=$row["STATE_NAME"];
		$state_list .="<option value='$id'>$state_name</option>";
	}
}
?>
<?php
if(isset($_POST['city_name'])){
	
	$city_name = mysql_real_escape_string($_POST['city_name']);
	$state_name = mysql_real_escape_string($_POST['state_name']);
	$sql=mysql_query("SELECT CITY_ID FROM city WHERE CITY_NAME='$city_name' LIMIT 1");
	$cityMatch = mysql_num_rows($sql);//count the output amount
	if($cityMatch > 0){
		echo 'Sorry you tried to place a duplicate "City Name" into the system, <a href="add_city.php">click here</a>';
		exit();
	}
	$sql = mysql_query("INSERT INTO city (CITY_NAME,STATE_ID) VALUES('$city_name','$state_name')") or die(mysql_error());
	header("location: add_city.php");
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

    <title>Add City</title>

    <link rel="stylesheet" type="text/css" media="screen" href="../css/style.css" />
	<link rel="stylesheet" href="../css/base.css">
	<link rel="stylesheet" href="../css/layout.css"> 
     
    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>window.jQuery || document.write('<script src="../js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="../js/scrollToTop.js"></script>
	<script src="../js/jquery.reveal.js"></script>
</head>

<body id="top">

<!--header -->
<div id="header-wrap"><header>

	<!--Header -->
	<?php include_once("../templatehead/template_header6.php");?>
    <!--End of Header -->
    </header></div>
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    
         <!-- main -->
        <div id="main">
        
        <h2>Add City</h2>
        
        <form action="add_city.php" enctype="multipart/form-data" method="post" id="contactform">
					
                    <div>
                    <label><select name="state_name" id="state_name">
      				<option value="">-- Select State --</option>
      				<?php echo $state_list; ?>
      				</select></label>
                    </div>
                    
                    <div>
                    <label>City Name<span class="required">*</span></label>
                    <input name="city_name" type="text" id="city_name" value="" />
                    </div>
                    
                    <div class="no-border">
					<input type="submit"  value="Add" class="button">
         			<input type="reset" value="Reset" class="button">
					</div>
		</form>
        
        <!-- /main -->
        </div>
        <!--Sidebar -->
	<?php include_once("../sidebar.php");?>
    <!--End of Sidebar -->
    
    <!-- content -->
	</div>

	<!-- /content-out -->
	</div>
    

    <!--Footer -->
	<?php include_once("../template_footer.php");?>
    <!--End of Footer -->
    
    </body>
    </html>