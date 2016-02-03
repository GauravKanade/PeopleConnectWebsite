<?php
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
?>
<?php
$sql=mysql_query("SELECT * FROM complaints");
$complaintCount=mysql_num_rows($sql);
$sql1=mysql_query("SELECT * FROM complaints WHERE STATUS='solved'");
$complaintCount1=mysql_num_rows($sql1);
$sql2=mysql_query("SELECT * FROM complaints WHERE STATUS='complaint received' || STATUS='complaint viewed' || STATUS='under process'");
$complaintCount2=mysql_num_rows($sql2);
?>
<?php
$dynamicView="";
$sql3=mysql_query("SELECT * FROM complaints WHERE STATUS='solved'");
$complaintCount3=mysql_num_rows($sql3);
if($complaintCount3>0){
	while($row=mysql_fetch_array($sql3)){
		$id=$row["COMPLAINT_ID"];
		$date_added = strftime("%B %d, %Y",strtotime($row["COMPLAINED_ON"]));
		$dynamicView .='<li><a href="single_complaint.php?id='.$id.'#complaint">Complaint '.$id.'</a><br/><b>Solved</b><br/>'.$date_added.'</li>';
		}
}
?>
<!-- sidebar -->
		<div id="sidebar">

      	    <div class="sidemenu">

         	    <h3>Complaint List</h3>
				<ul>
                	<li><a href="#">Complaint Registered:</a><br/>
                	<?php echo $complaintCount; ?></li>
                	<li><a href="#">Complaint solved:</a><br/>
                	<?php echo $complaintCount1; ?></li>
                	<li><a href="#">Complaint Pending:</a><br/>
                	<?php echo $complaintCount2; ?></li>
                </ul>
            </div>

			<div class="sidemenu">

				<h3>News Update</h3>
                <ul>
					<?php echo $dynamicView; ?>

				</ul>

			</div>

			
        <!-- /sidebar -->
		</div>
