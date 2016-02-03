<?php 
/*if(isset($_SESSION["name"])){
	header("location: index_logged.php");
	exit();
}*/
?>
<?php
	/*if(isset($_POST["name"])&&isset($_POST["password"])){
		$name =preg_replace("#[^A-Za-z0-9]#",'', $_POST["name"]);
	$password =preg_replace("#[^A-Za-z0-9]#",'', $_POST["password"]);
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
$sql=mysql_query("SELECT USER_ID FROM users WHERE NAME='$name' AND PASSWORD='$password' LIMIT 1");//query the person
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
	echo 'The information is incorrect.Try again<a href="index_logged.php">click here</a>';
	exit();
}
	}*/
?>

<div id="header-wrap">

<header>
	
    <nav>
		<ul>
			<li id="current"><a href="index.php">Home</a><span></span></li>
			<li><a href="complaints.php">Complaints</a><span></span></li>
			<li><a href="po.php">Public Opinion</a><span></span></li>
			<li><a href="support.php">Support</a><span></span></li>
			<li><a href="about.php">About</a><span></span></li>
            <?php
			if(isset($_SESSION["admin"])){
			echo '<li><a href="admin.php">Admin</a></li>';
			}
			?>
            <?php if(!isset($_SESSION["admin"])){?>
            <li >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
            <?php }else {?>
            <li >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
            
			<?php }?>
			<?php			
			if(isset($_SESSION["admin"]) || isset($_SESSION["name"]) || isset($_SESSION["authority_name"])){
			echo '<li><a href="http://localhost/peopleconnect/log_out.php">Log Out</a></li>';
			}
			
			if(!isset($_SESSION["admin"]) && !isset($_SESSION["name"]) && !isset($_SESSION["authority_name"])){
            echo '<li><a href="#" data-reveal-id="modal-01">Log In</a></li>';
			}
			?> 
            
		
		</ul>
	</nav>
	<!-- login -->
	<?php include_once("login_part.php");?>   
    <!-- login ends -->
      
 	<hgroup>
        <h1><a href="index.php">PeopleConnect</a></h1>
        <h3>A medium to hear public voice</h3>
    </hgroup>

    
   <form id="quick-search" method="get" action="index.php">
      <fieldset class="search">
         <label for="qsearch">Search:</label>
         <input class="tbox" id="qsearch" type="text" name="qsearch" value="Search..." title="Start typing and hit ENTER" />
         <button class="btn" title="Submit Search">Search</button>
      </fieldset>
   </form>
    </header></div>