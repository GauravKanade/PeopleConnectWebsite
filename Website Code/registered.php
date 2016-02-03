<?php 
session_start();
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
?>
<?php
$sql=mysql_query("SELECT * FROM authorities");
$Count=mysql_num_rows($sql);//count the output amount
if($Count>0){
	while($row=mysql_fetch_array($sql)){
		$username=$row["USER_NAME"];
	}
}
?>

<?php
if(isset($_POST['category'])){
	print_r($_POST['category']);
	
	/*$sql4=mysql_query("SELECT * FROM authorities WHERE USER_NAME='$username'");
	$count1=mysql_num_rows($sql4);
	if($count1>0){
		while($row=mysql_fetch_array($sql4)){
			$authorityID=$row["AUTHORITY_ID"];
		}
	}
	$sql1 =mysql_query("INSERT INTO authority_category_mapping(AUTHORITY_ID,CATEGORY_ID) VALUES('$authorityID','$categoryID')") or die(mysql_error());
	header("location: registered1.php");
	exit();*/
	
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

    <title>Welcome <?php echo $username; ?></title>

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
	<?php include_once("templatehead/template_header6.php");?>
    <!--End of Header -->
    </header></div>
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
   			<!-- main -->
        <div id="main">
    			
    		<h4 align="left" style="text-transform:capitalize;">Welcome <?php echo $username; ?></h4>
			<h5 align="left">Please Select the Category</h5>
            <form action="registered.php" enctype="multipart/form-data" name="MyForm" id="MyForm" method="post">
            <div>
                    <label>Category <span>*</span></label>
                   	<table width="100%" border="0">
  					<?php echo $options; ?>
					</table>
            </div>
             <div class="no-border">
					<input type="submit"  value="Confirm" class="button">
         			<input type="reset" value="Reset" class="button">
					</div>
            </form>
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