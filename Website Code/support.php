<?php 
session_start();
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

    <title>Support</title>

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
	<?php include_once("templatehead/template_header4.php");?>
    <!--End of Header -->
    </header></div>
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    		<!-- main -->
        <div id="main" style="margin:0px 0px 0px 0px;">
        	<p style="font-size:12px" >&diams;<u><a href="index.php">Home</a></u> >> Support</p>
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