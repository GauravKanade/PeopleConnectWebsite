<div id="header-wrap">

<header>

    <nav>
		<ul>
			<li><a href="http://localhost/PeopleConnect/index.php">Home</a><span></span></li>
			<li><a href="http://localhost/PeopleConnect/complaints.php">Complaints</a><span></span></li>
			<li><a href="http://localhost/PeopleConnect/po.php">Public Opinion</a><span></span></li>
			<li><a href="http://localhost/PeopleConnect/support.php">Support</a><span></span></li>
            <li><a href="http://localhost/PeopleConnect/about.php">About</a><span></span></li>
			<li id="current"><a href="http://localhost/PeopleConnect/admin.php">Admin</a><span></span></li>
        <?php 
		if(isset($_SESSION["admin"]) || isset($_SESSION["name"]) || isset($_SESSION["authority_name"])){
			echo '<span id="right"><a href="http://localhost/peopleconnect/log_out.php">Log Out</a></span>';
		}
		?>
        </ul>
        
	</nav>
    
    
 	<hgroup>
        <h1><a href="index.php">PeopleConnect.</a></h1>
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