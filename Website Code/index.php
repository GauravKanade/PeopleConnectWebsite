<?php 
session_start();
if(isset($_SESSION["authority_name"])){
	header("location: authority_logged.php");
	exit();
}
else if(isset($_SESSION["name"])){
	header("location: index_logged.php");
	exit();
}
?>
<?php
	if(isset($_POST["name"])&&isset($_POST["password"])){
		$name =preg_replace("#[^A-Za-z0-9]#",'', $_POST["name"]);
	$password =preg_replace("#[^A-Za-z0-9]#",'', $_POST["password"]);
//Connect to MySQL database
include "scripts/connect_to_mysql.php";

$sql=mysql_query("SELECT USER_ID FROM users WHERE NAME='$name' AND PASSWORD='$password' LIMIT 1");
//query the user
//....MAKE SURE THE PERSON EXISTS IN THE DATABASE
$existCount=mysql_num_rows($sql);//count the row nums
if($existCount == 1){
	while($row=mysql_fetch_array($sql)){
		$id=$row["USER_ID"];
	}
	$_SESSION["USER_ID"]=$id;
	$_SESSION["name"]=$name;
	$_SESSION["password"]=$password;
	header("location: index_logged.php");
	exit();
}
else{
	$sqla=mysql_query("SELECT AUTHORITY_ID FROM authorities WHERE USER_NAME='$name' AND PASSWORD='$password' LIMIT 1");
	//query the authority member
	//....MAKE SURE THE AUTHORITY MEMBER EXISTS IN THE DATABASE
	$existCount1=mysql_num_rows($sqla);//count the row nums
	if($existCount1 == 1){
	while($rows=mysql_fetch_array($sqla)){
		$id1=$rows["AUTHORITY_ID"];
	}
	$_SESSION["AUTHORITY_ID"]=$id1;
	$_SESSION["authority_name"]=$name;
	$_SESSION["password"]=$password;
	header("location: authority_logged.php");
	exit();
	}
	else{
		echo "Invalid Username or password please try again <a href=\"index.php\">LogIn</a>";
	}
}
}
?>
<?php
//Script error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php 
//Run a Select query to get my latest complaints
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
$dynamicList="";
$dynamicList1="";
$sql1=mysql_query("SELECT * FROM complaints ORDER BY COMPLAINED_ON DESC LIMIT 10");
$complaintCount=mysql_num_rows($sql1);
if($complaintCount>0){
	while($row=mysql_fetch_array($sql1)){
				$complained_by=$row["COMPLAINED_BY"];
	}
}else{
	$dynamicList="We have no complaints listed in our site yet";	
}
		
$sql2=mysql_query("SELECT * FROM users WHERE USER_ID='$complained_by'");
$complaintCount1=mysql_num_rows($sql2);
if($complaintCount1>0){
	while($row=mysql_fetch_array($sql2)){
		$by=$row["NAME"];
	}
}
$sql3=mysql_query("SELECT * FROM complaints ORDER BY COMPLAINED_ON DESC LIMIT 10");
$complaintCount2=mysql_num_rows($sql3);
if($complaintCount2>0){
	while($row=mysql_fetch_array($sql3)){
		$id=$row["COMPLAINT_ID"];
		$body=$row["COMPLAINT_BODY"];
		$location=$row["COMPLAINT_LOCATION"];
		$status= $row["STATUS"];
		$complained_by=$row["COMPLAINED_BY"];
		$date_added = strftime("%b %d, %Y",strtotime($row["COMPLAINED_ON"]));
		$date_added1 = strftime("%I:%M %p",strtotime($row["COMPLAINED_ON"]));
		$category=$row["CATEGORY"];
		$location1=$row["COMPLAINT_LOCATION"];
		$time = preg_split("/[\s,]+/", $date_added);
		$sql4=mysql_query("SELECT * FROM comments WHERE COMPLAINT_ID='$id'");
		$complaintCount3=mysql_num_rows($sql4);
		if($complaintCount3==0){$comment="0 Comments";}
		else if($complaintCount3==1){$comment="1 Comment";}
		else{$comment=$complaintCount3." Comments";}
		$sql5=mysql_query("SELECT CATEGORY_NAME FROM categories WHERE CATEGORY_ID='$category'");
		while($row1=mysql_fetch_array($sql5)){
		$category_name=$row1["CATEGORY_NAME"];
		}
		$string = strip_tags($body);
		if (strlen($string) > 210) {
    	// truncate string
    	$stringCut = substr($string, 0, 210);
    	// make sure it ends in a word so assassinate doesn't become ass...
    	$string = substr($stringCut, 0, strrpos($stringCut, ' ')).' ...';
		}
		$loc = preg_split("/[,]+/", $location1);
		$j=count($loc);
		$dynamicList .='
		        	<article class="post">
         			<div class="primary">
					<h2><a href="single_complaint.php?id='.$id.'#complaint">Complaint '.$id.'</a></h2>
                    <p class="post-info"><span>location</span> <a href="#">'.$loc[$j-3].','.$loc[$j-2].','.$loc[$j-1].'</a>
					</p>
               	    <div class="image-section">
              		<img src="complaint/'.$id.'.jpg" alt="image post" height="250" width="250"/>
         	        </div>
                    <p>'.$string.'</p>
					
                    <p><a class="more" href="single_complaint.php?id='.$id.'#complaint">Continue Reading &raquo;</a></p>
					</div>
						<aside>
						<p class="dateinfo">'.$time[0].'<span>'.$time[1].'</span></p>
						<div class="post-meta">
                  	    <h4>Post Info</h4>
                     	<ul>
                           <li class="user"><a href="user.php?id='.$complained_by.'">'.$by.'</a></li>
                           <li class="time"><a href="#">'.$date_added1.'</a></li>
                           <li class="comment"><a href="single_complaint.php?id='.$id.'#com">'.$comment.'</a></li>
                           <li class="permalink" style="text-transform:capitalize;"><a href="#">'.$status.'</a></li>
						   <li class="tag" style="text-transform:capitalize;"><a href="category.php?id='.$category.'">'.$category_name.'</a></li>
                        </ul>
						</div>
						</aside>
						</article>';
	}
}
mysql_close();
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

    <title>PeopleConnect</title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/layout.css"> 
     

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
    
<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main">
			<?php echo $dynamicList; ?>
             

            <?php echo $dynamicList1; ?>
                

		    <!--
      	    <article class="post">

      		    <div class="primary">

                    <h2><a href="index.php">Complaint 1</a></h2>

                    <p class="post-info"><span>location</span> <a href="index.php">bangalore</a>, <a href="index.php">india</a></p>

               	    <div class="image-section">
              		    <img src="images/img-post.jpg" alt="image post" height="250" width="250"/>
         	        </div>

                    <p>Description	of the complaint....
                    Description	of the complaint....
                    Description	of the complaint....
                    Description	of the complaint....
                    Description	of the complaint....
                    </p>

                    <p><a class="more" href="index.php">Continue Reading &raquo;</a></p>

                </div>

                <aside>

            	    <p class="dateinfo">FEB<span>27</span></p>

               	    <div class="post-meta">
                  	    <h4>Post Info</h4>
                     	<ul>
                           <li class="user"><a href="#">rahul</a></li>
                           <li class="time"><a href="#">12:30 PM</a></li>
                           <li class="comment"><a href="#">2 Comments</a></li>
                           <li class="permalink"><a href="#">Status</a></li>
                        </ul>
					</div>

                </aside>

		    </article>
             -->
            
            
        

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
