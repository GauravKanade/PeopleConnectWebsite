<?php
session_start();
?>
<?php
if(isset($_SESSION["authority_name"])){
$nameID = preg_replace("#[^0-9]#",'', $_SESSION["AUTHORITY_ID"]);
}
else if(isset($_SESSION["name"])){
$nameID = preg_replace("#[^0-9]#",'', $_SESSION["USER_ID"]);
}
//Script error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
//change the status
if(isset($_POST['statuschange'])){
	$statuschange = mysql_real_escape_string($_POST['statuschange']);
	$thisID = mysql_real_escape_string($_POST['thisID']);
	$sql11=mysql_query("UPDATE complaints SET STATUS='$statuschange' WHERE COMPLAINT_ID='$thisID'");
	header("location: single_complaint.php?id='.$thisID.'");
	exit();
}
?>
<?php 
//Check to see the URL variable is set and that it exists in the database

if(isset($_GET['id'])){
	
	$id=preg_replace('#[^0-9]#i',"",$_GET['id']);
	//Use the var to check to see if this ID exists,if yes then get the complaint
	$sql=mysql_query("SELECT * FROM complaints WHERE COMPLAINT_ID='$id' LIMIT 1");
	$complaintCount=mysql_num_rows($sql);//count the output amount
	if($complaintCount>0){
		//get all the product detalis
		while($row=mysql_fetch_array($sql)){
		$id=$row["COMPLAINT_ID"];
		$body=$row["COMPLAINT_BODY"];
		$location=$row["COMPLAINT_LOCATION"];
		$complained_by=$row["COMPLAINED_BY"];
		$status=$row["STATUS"];
		$date_added = strftime("%b %d, %Y",strtotime($row["COMPLAINED_ON"]));
		$date_added1 = strftime("%I:%M%p",strtotime($row["COMPLAINED_ON"]));
		$category=$row["CATEGORY"];
		$sql5=mysql_query("SELECT CATEGORY_NAME FROM categories WHERE CATEGORY_ID='$category'");
		while($row1=mysql_fetch_array($sql5)){
		$category_name=$row1["CATEGORY_NAME"];
		}
		$time = preg_split("/[\s,]+/", $date_added);
		}
	}else{
		echo 'That complaint does not exist.';
		exit();
	}
	$sql2=mysql_query("SELECT * FROM users WHERE USER_ID='$complained_by' LIMIT 1");
$complaintCount1=mysql_num_rows($sql2);
if($complaintCount1>0){
	while($row=mysql_fetch_array($sql2)){
		$by=$row["NAME"];
	}
}
}else{
	echo 'Data to render this page is missing.';
	exit();
}
?>

<?php
//parse the form and add new comment
if(isset($_POST['comment'])){
	$comment =mysql_real_escape_string($_POST['comment']);
	$complaint_id =$id;
	$posted_by=$nameID;
	echo "$comment $complaint_id $posted_by";
	//Store comment into the database
	$sql3 = mysql_query("INSERT INTO comments (COMPLAINT_ID,COMMENT_BODY,POSTED_ON,POSTED_BY) VALUES('$complaint_id','$comment',now(),'$posted_by')") or die(mysql_error());
	header("location: single_complaint.php?id='.$id.'#com");
	exit();
}
?>
<?php
$commentList="";
$sql4=mysql_query("SELECT * FROM comments WHERE COMPLAINT_ID='$id' ORDER BY POSTED_ON DESC");
$complaintCount2=mysql_num_rows($sql4);
if($complaintCount2>0){
	while($row=mysql_fetch_array($sql4)){
		$comp_id=$row["COMPLAINT_ID"];
		$comp_body=$row["COMMENT_BODY"];
		$comp_on= strftime("%b %d, %Y at %I:%M %p",strtotime($row["POSTED_ON"]));
		$comp_by=$row["POSTED_BY"];
		$sql5=mysql_query("SELECT * FROM users WHERE USER_ID='$comp_by'");
		$complaintCount3=mysql_num_rows($sql5);
		if($complaintCount3>0){
			while($row1=mysql_fetch_array($sql5)){
				$comp_name=$row1["NAME"];
			}
		}
		$commentList .='<li class="depth-1">
							<div class="comment-info">
							<cite>
								<a href="#">'.$comp_name.'</a><br />
								<span class="comment-data"><a href="#comment-63" title="">'.$comp_on.'</a></span>
							</cite>
							</div>
							<div class="comment-text">
								<p>'.$comp_body.'</p>
							</div>
							</li>
							';
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
	<?php include_once("templatehead/template_header1.php");?>
    <!--End of Header -->
    
<!--/header-->
</header></div>
	
<!-- content-wrap -->
<div id="content-wrap">

    <!-- content -->
    <div id="content" class="clearfix">

   	    <!-- main -->
        <div id="main" style="margin:0px 0px 0px 0px;">
        	<p style="font-size:12px; text-transform:capitalize;" >&diams; <u><a href="index.php">Home</a></u> >> &diams; <u><a href="complaints.php">Complaints</a></u> >>&diams; <u><a href="user.php?id=<?php echo $complained_by;?>"><?php echo $by;?></a></u> >> &diams; <u><a href="category.php?id=<?php echo $category;?>"><?php echo $category_name;?></a></u> >> Complaint <?php echo $id;?></p>
      	    <article class="post">

      		    <div class="primary">

                    <h2 id="complaint">Complaint <?php echo $id;?></h2>

                    <p class="post-info"><span>location</span> <a href="#">bangalore</a>, <a href="#">india</a></p>

               	    <div class="image-section">
              		    <img src="complaint/<?php echo $id;?>.jpg" alt="image post" height="250" width="250"/>
         	        </div>

                    <p><?php echo $body;?></p>
                    
                </div>
				
                <aside>

            	    <p class="dateinfo"><?php echo $time[0]; ?><span><?php echo $time[1]; ?></span></p>

               	    <div class="post-meta">
                  	    <h4>Post Info</h4>
                     	<ul>
                           <li class="user"><a href="user.php?id=<?php echo $complained_by;?>"><?php echo $by; ?></a></li>
                           <li class="time"><a href="#"><?php echo $date_added1; ?></a></li>
                           <li class="comment"><a href="#com"><?php if($complaintCount2==0){echo "0 Comments";}
						   											else if($complaintCount2==1){echo "1 Comment";}
																	else{echo $complaintCount2." Comments";} ?></a></li>
                                                                    
                           <?php if(isset($_SESSION['authority_name']))
						   {?>
                           <li class="permalink">
                           <form action="single_complaint.php" enctype="multipart/form-data" name="MyForm" id="MyForm" method="post" style="margin:0px 0px 0px 0px;">
                           <label>
                           <select name="statuschange" id="statuschange" style="font-size:11px; padding-bottom:0px; padding-left:0px;
                           padding-right:0px; padding-top:0px; width:132px; margin-left:28px; margin-bottom:0px; margin-top:5px; color:#000; text-transform:capitalize;">
                           
                           <option value="<?php echo $status;?>"><?php  echo $status; ?></option>
                           <option value="complaint viewed">Complaint Viewed</option>
                           <option value="under process">Under Process</option>
                           <option value="solved">Solved</option>
                           <option value="rejected">Rejected</option>
                           </select>
                           </label>
                           <label>
                           <input name="thisID" type="hidden" value="<?php echo $id; ?>" />
                           <input type="submit" value="change status" style="margin:0px 360px 0px 0px ; padding:0px 0px 0px 0px; font-size:11px; color: #006; background-color:#FFF; "/>
                           </label>
                           </form>
                           
                           </li>
                           <?php } else {?>
                           <li class="permalink" style="text-transform:capitalize;"><a href="#"><?php  echo $status; ?></a></li>
                           <?php } ?>
                           <li class="tag" style="text-transform:capitalize;"><a href="category.php?id=<?php echo $category;?>"><?php echo $category_name;?></a></li>
                           
                           
                        </ul>
					</div>
                </aside>
		    </article>     
        <!-- post-bottom-section -->
        <div class="post-bottom-section">

		    <?php if($complaintCount2==0){?>
            	<h4 align="center"><span id="com">No Comment</span></h4>
            <?php }else {?>
            	<h4><span id="com">Comments</span></h4>
             <?php }?>
            

            <div class="primary">

            	<ol class="commentlist">
						<?php if(isset($_SESSION["name"])){?>
                        
						<li class="depth-1">
							<div class="comment-text">
                            	<form enctype="multipart/form-data"  name="commentform" id="commentform" method="post">
								<textarea cols="45" rows="3" name="comment" id="comment"></textarea>

								<div class="reply">
								<input type="submit" value="Post"/>
                                  </div>
							</div>
							</form>
							</li>
						<?php } ?>
                        <?php echo $commentList; ?>
                        <!--<li class="depth-1">

							<div class="comment-info">
								<cite>
									<a href="index.html">Erwin</a><br />
									<span class="comment-data"><a href="#comment-63" title="">January 31st, 2010 at 10:00 pm</a></span>
								</cite>
							</div>

							<div class="comment-text">
								<p>Comments are great!</p>

							</div>

							</li> -->
						
                <!-- /comment-list -->
				</ol>

            <!-- /primary -->
            </div>

         </div>
            
            
        

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
