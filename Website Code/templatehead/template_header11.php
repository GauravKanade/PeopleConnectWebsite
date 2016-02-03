<?php 
/*if(!isset($_SESSION["name"])){
	header("location: index.php");
	exit();
}
//Be sure to check that this manager SESSION is in fact in the database
	$nameID = preg_replace("#[^0-9]#",'', $_SESSION["USER_ID"]);
	$name = preg_replace("#[^A-Za-z0-9]#",'', $_SESSION["name"]);
	$password = preg_replace("#[^A-Za-z0-9]#",'', $_SESSION["password"]);
//Connect to MySQL database
include "scripts/connect_to_mysql.php";
$sql=mysql_query("SELECT * FROM users WHERE USER_ID='$nameID' AND NAME='$name' AND PASSWORD='$password' LIMIT 1");//query the person
//....MAKE SURE THE PERSON EXISTS IN THE DATABASE
$existCount=mysql_num_rows($sql);//count the row nums
if($existCount == 0){
	echo "your log in session is not on record in the database";
	exit();
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
			if(isset($_SESSION["name"])){
			echo '<span id="right"><a href="http://localhost/peopleconnect/log_out.php">Log Out</a></span>';
			}
			?> 
            <?php
			if(!isset($_SESSION["name"])){
            echo '<span id="right"><a href="#" data-reveal-id="modal-01">Log In</a></span>';
			}
			?> 
            
		
		</ul>
	</nav>
	<!-- login -->
	   <div id="modal-01" class="reveal-modal">

			
		  <div class="link-box">
          	<h2>Please Login</h2>
          </div>
		<div class="description-box">
        <!-- form -->
            <form name="LogInForm" id="LogInForm" method="post" action="../index.php">
					<fieldset>
						   <label>Username :</label>
						   <input name="name" type="text" id="name" size="35" value="" />

                  
						   <label>Password :</label>
						   <input name="password" type="password" id="password" size="35" value="" />
                  

                  <div>
                     <button class="submit">Log In</button>
                     
                     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                     <a href="#">Forgot Password?</a>
                  </div>

					</fieldset>
				</form> <!-- Form End -->
        </div>
         <div class="link-box">
		      <a class="close-reveal-modal">Close</a>
         </div>

	   </div><!-- login ends -->
      
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