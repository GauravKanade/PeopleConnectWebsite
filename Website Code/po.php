<?php 
session_start();
//Connect to MySQL database
include "scripts/connect_to_mysql.php"; 	
$query= mysql_query("SELECT opt,value,title FROM poll WHERE title='strongest man on earth'");
$myurl[]="['Option','Value']";
while($r=mysql_fetch_assoc($query))
{
	$title=$r["title"];
	$opt=$r["opt"];
	$val=$r["value"];
	$myurl[]="['".$opt."',".$val."]";
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

    <title>Public Opinion</title>

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
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          <?php echo(implode(",",$myurl));?>
        ]);

        var options = {
          title: '<?php echo($title);?>',is3D:true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          <?php echo(implode(",",$myurl));?>
        ]);

        var options = {
          title: '<?php echo($title);?>',is3D:true
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchart'));

        chart.draw(data, options);
      }
    </script>
    </head>

<body id="top">

<!--header -->
<div id="header-wrap"><header>

 		<!--Header -->
	<?php include_once("templatehead/template_header2.php");?>
    <!--End of Header -->

<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">
    	<!-- main -->
        <div id="main" style="margin:0px 0px 0px 0px;">
        <p style="font-size:12px" >&diams;<u><a href="index.php">Home</a></u> >> Public Opinion</p>
        <table width="100%" border="0">
  		<form>
        <tr>
    		<td width="71%"><select style="width:500px;">
        <option value=""></option>
        <option value="question1">question 1</option>
        <option value="question1">question 2</option>
        <option value="question1">question 3</option>
        <option value="question1">question 4</option>
        </select></td>
    		<td width="29%"><input type="submit" value="Generate" style="height:59px; margin-bottom:1px"/></td>
  		</tr>
        </form>
		</table>
			<div id="piechart" style="width: 700px; height: 500px;"></div>
            <div id="barchart" style="width: 700px; height: 500px;"></div>
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
