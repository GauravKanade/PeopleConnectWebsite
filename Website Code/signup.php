<?php 
session_start();
//Connect to MySQL database
include "scripts/connect_to_mysql.php";

?>
<?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["usernamecheck"])){
	$username = preg_replace('#[^a-z0-9]#i', '', $_POST['usernamecheck']);
	$sql = mysql_query("SELECT AUTHORITY_ID FROM authorities WHERE USER_NAME='$username' LIMIT 1"); 
    $uname_check = mysql_num_rows($sql);
    if (strlen($username) < 3 || strlen($username) > 16) {
	    echo '<strong style="color:#F00;">3 - 16 characters please</strong>';
	    exit();
    }
	if (is_numeric($username[0])) {
	    echo '<strong style="color:#F00;">Username must begin with a letter</strong>';
	    exit();
    }
    if ($uname_check < 1) {
	    echo '<strong style="color:#009900;"><span style="text-transform:uppercase;">' . $username . '</span> is OK</strong>';
	    exit();
    } else {
	    echo '<strong style="color:#F00;"><span style="text-transform:uppercase;">' . $username . '</span> is taken</strong>';
	    exit();
    }
}
?>

<?php
// Ajax calls this NAME CHECK code to execute
if(isset($_POST["namecheck"])){
	$name = preg_replace('#[^a-zA-Z0-9]#i', '', $_POST['namecheck']);
    if (strlen($name) < 3) {
	    echo '<strong style="color:#F00;">Not a valid name</strong>';
	    exit();
    }
	if (ctype_alpha($name)) {
		echo '<strong style="color:#009900;">Name is OK</strong>';
	    exit();
    }
	else{
		echo '<strong style="color:#F00;">Not a valid name</strong>';
	    exit();
	}
}
?>
<?php
// Ajax calls this PASSWORD CHECK code to execute
if(isset($_POST["passwordcheck"])){
	$password = preg_replace('#[^a-z0-9]#i', '', $_POST['passwordcheck']);
    if (strlen($password) < 6) {
	    echo '<strong style="color:#F00;">Password should contain minimum of 6 characters</strong>';
	    exit();
    }
	if (ctype_alpha($password)) {
	    echo '<strong style="color:#F00;">Password must be a combination of digits and characters</strong>';
	    exit();
    }
	if (ctype_digit($password)) {
	    echo '<strong style="color:#F00;">Password must be a combination of digits and characters</strong>';
	    exit();
    }
    if ((strlen($password) >= 6) && ctype_alnum($password))
	{
		 echo '<strong style="color:#009900;">Password is OK</strong>';
	    exit();
	}
}
?>
<?php
// Ajax calls this Email CHECK code to execute
if(isset($_POST["emailcheck"])){
	
    $email = preg_replace('#[^a-z0-9.@]#i', '', $_POST["emailcheck"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo '<strong style="color:#F00;">Invalid Email</strong>';
	  exit(); 
    }
	else{
		echo '<strong style="color:#009900;">Valid Email</strong>';
		exit();
	}
  }
?>
<?php
// Ajax calls this Number CHECK code to execute
if(isset($_POST["numbercheck"])){
	
    $number = preg_replace('#[^0-9]#i', '', $_POST["numbercheck"]);
	$arr = preg_split('//', $number, -1, PREG_SPLIT_NO_EMPTY);
    // check if e-mail address is well-formed
    if (strlen($number)==10 && ($arr[0]==9 || $arr[0]==8 || $arr[0]==7)) {
      echo '<strong style="color:#009900;">Valid Phone Number</strong>';
	  exit(); 
    }
	else if (ctype_alpha($number)){
		echo '<strong style="color:#F00;">Invalid Phone Number</strong>';
		exit();
	}
	else if (ctype_alnum($number)){
		echo '<strong style="color:#F00;">Invalid Phone Number</strong>';
		exit();
	}
	else{
		echo '<strong style="color:#F00;">Invalid Phone Number</strong>';
		exit();
	}
  }
?>
<?php
$options="";
$sql= mysql_query("SELECT * FROM categories");
$count=mysql_num_rows($sql);
if($count>0){
	while($rows=mysql_fetch_array($sql)){
		$options.='<tr>';
		$category=$rows["CATEGORY_NAME"];
		$categoryID=$rows["CATEGORY_ID"];
		$options .='<td bgcolor="#E9EAEB"><input type="checkbox" name="category" value="'.$categoryID.'">'.$category.'</td>';
		if($rows=mysql_fetch_array($sql)){
		$category=$rows["CATEGORY_NAME"];
		$categoryID=$rows["CATEGORY_ID"];
		$options .='<td bgcolor="#E9EAEB"><input type="checkbox" name="category" value="'.$categoryID.'">'.$category.'</td>';
		}
		if($rows=mysql_fetch_array($sql)){
		$category=$rows["CATEGORY_NAME"];
		$categoryID=$rows["CATEGORY_ID"];
		$options .='<td bgcolor="#E9EAEB"><input type="checkbox" name="category" value="'.$categoryID.'">'.$category.'</td>';
		}
		$options.='</tr>';
	}
}
?>
<?php
//parse the form and add new authority to the system
if(isset($_POST['username'])){
	$username1 =mysql_real_escape_string($_POST['username']);
	$password1 =mysql_real_escape_string($_POST['password']);
	$name1 =mysql_real_escape_string($_POST['name']);
	$email1 =mysql_real_escape_string($_POST['email']);
	$number1 =mysql_real_escape_string($_POST['number']);
	$categoryIDs =mysql_real_escape_string($_POST['checkBoxes']);
	
	$categories = preg_split("/[,]+/",$categoryIDs);
	//Add the AUTHORITY into the database
	$sqlc = mysql_query("INSERT INTO authorities(USER_NAME,PASSWORD,EMAIL_ID,PHONE_NUMBER,NAME) VALUES('$username1','$password1','$email1','$number1','$name1')") or die(mysql_error());
	
	
	$sql4=mysql_query("SELECT AUTHORITY_ID FROM authorities WHERE USER_NAME='$username1'");
	$count1=mysql_num_rows($sql4);
	if($count1==1){
		while($row=mysql_fetch_array($sql4)){
			$authorityID=$row["AUTHORITY_ID"];
		}
		foreach($categories as $value){
	$sql1 =mysql_query("INSERT INTO authority_category_mapping(AUTHORITY_ID,CATEGORY_ID) VALUES('$authorityID','$value')") or die(mysql_error());
	
	}
	}
	
	header("location: registered1.php");
	exit();
	}
	
?>

<?php
/*if(isset($_POST['username'])){
	$username1 =mysql_real_escape_string($_POST['username']);
	$sql4=mysql_query("SELECT AUTHORITY_ID FROM authorities WHERE AUTHORITY_NAME='$username1'");
	$count1=mysql_num_rows($sql4);
	if($count1==1){
		while($row=mysql_fetch_array($sql4)){
			$authorityID=$row["AUTHORITY_ID"];
		}
	}
	
	
}*/
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

    <title>SignUp</title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
	<!--<link rel="stylesheet" href="css/base.css"> -->
	<link rel="stylesheet" href="css/layout.css"> 
     
    <!--[if lt IE 9]>
	    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.6.1.min.js"><\/script>')</script>

    <script src="js/scrollToTop.js"></script>
	<script src="js/jquery.reveal.js"></script>
    <script src="js/main.js"></script>
    <script language="javascript">
	function checkBoxesFunction(){
		alert('reached here');
		var count=0;
		var checkedString="";
		var firstElement = false;
		for(var i=0;i<document.MyForm.category.length;i++){
			if(document.MyForm.category[i].checked==true){
				if(firstElement==false){
					firstElement=true;
					checkedString = document.MyForm.category[i].value;
				} else {
					checkedString += "," + document.MyForm.category[i].value;
				}
			}

		}
		document.MyForm.checkBoxes.value=checkedString;
		document.MyForm.submit();
		alert('reached here 2');
	}
    </script>
<script src="js/ajax.js"></script>
<script>
function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
function checkusername(){
	var u = _("username").value;
	if(u != ""){
		_("usernamestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("usernamestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("usernamecheck="+u);
	}
}
function checkname(){
	var c = _("name").value;
	if(c != ""){
		_("namestatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("namestatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("namecheck="+c);
	}
}
function checkpassword(){
	var p = _("password").value;
	if(p != ""){
		_("upassstatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("upassstatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("passwordcheck="+p);
	}
}
function checkemail(){
	var e = _("email").value;
	if(e != ""){
		_("emailstatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("emailstatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("emailcheck="+e);
	}
}
function checknumber(){
	var n = _("number").value;
	if(n != ""){
		_("numberstatus").innerHTML = 'checking ...';
		var ajax = ajaxObj("POST", "signup.php");
        ajax.onreadystatechange = function() {
	        if(ajaxReturn(ajax) == true) {
	            _("numberstatus").innerHTML = ajax.responseText;
	        }
        }
        ajax.send("numbercheck="+n);
	}
}
</script>
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
        
        <h3>SignUp Form</h3>

				<form action="signup.php" enctype="multipart/form-data" name="MyForm" id="MyForm" method="post">

                    <div>
                    <label>Username <span class="required">*</span></label>
                    <input name="username" type="text" id="username" onblur="checkusername()" onkeyup="restrict('username')" required /><br/>
                    <span id="usernamestatus"></span>
                    </div>
                    
                    <div>
                    <label>Password <span class="required">*</span></label>
                    <input name="password" type="password" id="password" onblur="checkpassword()" onkeyup="restrict('password')" required />
                    <br/>
                    <span id="upassstatus"></span>
                    </div>

					<div>
                    <label>Full Name <span class="required">*</span></label>
                    <input name="name" type="text" id="name" onblur="checkname()" onkeyup="restrict('name')" required/><br/>
                    <span id="namestatus"></span>
                    </div>
                    
					<div>
                    <label>Email <span class="required">*</span></label>
                    <input name="email" type="email" id="email" onblur="checkemail()" onkeyup="restrict('email')" required />
                    <br/>
                    <span id="emailstatus"></span>
                    </div>
                    
                    <div>
                    <label>Phone Number <span class="required">*</span></label>
                    <input value="+91" maxlength="3" size="3" disabled />
                    <input name="number" type="text" id="number" maxlength="10" onblur="checknumber()" onkeyup="restrict('number')" required />
                    <br/>
                    <span id="numberstatus"></span>
                    </div>
                    
                    <div>
                    <label>Category <span>*</span></label>
                   	<table width="100%" border="0">
  					<?php echo $options; ?>
					</table>
            </div>

                    <div class="no-border">
					<input type="button"  value="Register" class="button" onclick="checkBoxesFunction()">
         			<input type="reset" value="Reset" class="button">
					</div>
<input type="hidden" name="checkBoxes" value=""/>
				</form>


        
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