<?php 
session_start();

if(!isset($_SESSION["authority_name"])){
	header("location: index.php");
	exit();
}
?>
<?php
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
$list="";
$authorityID = preg_replace("#[^0-9]#",'', $_SESSION["AUTHORITY_ID"]);
$sql4=mysql_query("SELECT * FROM authority_category_mapping WHERE AUTHORITY_ID='$authorityID'");
$count=mysql_num_rows($sql4);
if($count>0){
	while($rows=mysql_fetch_array($sql4)){
		$categoryID=$rows["CATEGORY_ID"];
		$sql5=mysql_query("SELECT * FROM categories WHERE CATEGORY_ID='$categoryID'");
		$count1=mysql_num_rows($sql5);
		if($count1>0){
			while($row1=mysql_fetch_array($sql5)){
				$categoryname=$row1["CATEGORY_NAME"];
			}
		}
		$list .='<a class="more" href="category.php?id='.$categoryID.'"><span style="color:#FFF; text-transform:uppercase;">'.$categoryname.'</span></a>';
	}
	$list .='&nbsp;&nbsp;&nbsp;';
}
else{
	$list= 'Has No Category Listed';
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

    <title>Welcome</title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/layout.css"> 
     
    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>
	<script src="js/jquery.reveal.js"></script>
</head>

<body id="top">

<!--header -->
<div id="header-wrap"><header>

	<!--Header -->
	<?php include_once("templatehead/template_header.php");?>
    <!--End of Header -->
    </header></div>
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    		<!-- main -->
        <div id="main">
        	<h1>Welcome Authority</h1>
            <?php echo $list; ?>
        <!-- END OF MAIN -->
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