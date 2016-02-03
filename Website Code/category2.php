<?php 
session_start();
?>
<?php
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
if(isset($_GET['id'])){	
	$id=preg_replace('#[^0-9]#i',"",$_GET['id']);
	//Use the var to check to see if this ID exists,if yes then get the category
	$sql=mysql_query("SELECT * FROM categories WHERE CATEGORY_ID='$id' LIMIT 1");
	$categoryCount=mysql_num_rows($sql);//count the output amount
	if($categoryCount>0){
		while($row=mysql_fetch_array($sql)){
			$categoryID=$row["CATEGORY_ID"];
		$category_name=$row["CATEGORY_NAME"];
		}
	}
}
?>

<?php
$dynamicView2="";
$i=1;
$sql4=mysql_query("SELECT * FROM complaints WHERE CATEGORY='$categoryID' AND STATUS='solved'");
$categoryCount1=mysql_num_rows($sql4);
if($categoryCount1>0){
	while($row1=mysql_fetch_array($sql4)){
		$id2=$row1["COMPLAINT_ID"];
		$status=$row1["STATUS"];
		$dynamicView2 .='
			<tr>
    			<td><a href="single_complaint.php?id='.$id2.'#complaint">'.$i.'</a></td>
    			<td><a href="single_complaint.php?id='.$id2.'#complaint">COMPLAINT ID '.$id2.'</a></td>
    			<td><a href="single_complaint.php?id='.$id2.'#complaint">KARNATAKA,<br/>BANGALORE</a></td>
    			<td><a href="single_complaint.php?id='.$id2.'#complaint">'.$category_name.'</a></td>
    			<td><a href="single_complaint.php?id='.$id2.'#complaint">'.$status.'</a></td>
                
  			</tr>			
		';
		$i++;
	}
}
else{
		$dynamicView2 ='<tr>
    						<td style=" font-weight:bold; font-size:16px;" colspan="5" align="center">No Complaints Solved Yet</td>
  						</tr>
			';
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

    <title><?php echo $category_name; ?></title>

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
	<?php include_once("templatehead/template_header1.php");?>
    <!--End of Header -->
    </header></div>
    
    <!-- content-wrap -->
	<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    		<!-- main -->
        <div id="main" style="margin:0px 0px 0px 0px;">
        <p style="font-size:12px; text-transform:capitalize;" >&diams; <u><a href="index.php">Home</a></u> >> &diams; <u><a href="complaints.php">Complaints</a></u> >> <?php echo $category_name;?></p>
        <img src="images/tag1.png" width="724" usemap="#Map">
        <map name="Map">
          <area shape="rect" coords="57,7,192,57" alt="pending" href="category.php?id=<?php echo $categoryID;?>">
          <area shape="rect" coords="527,7,667,43" alt="rejected" href="category3.php?id=<?php echo $categoryID;?>">
        </map>
        <table width="100%">
       		
  			<tr>
    			<th>SL.NO</th>
    			<th>COMPLAINT TITLE</th>
    			<th>LOCATION</th>
    			<th>CATEGORY</th>
    			<th>STATUS</th>
  			</tr>
            <?php
				echo $dynamicView2;
			?>
		  </table>


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