<div class="header-bar">
	<img class="cornell-logo" src="../images/logo.png" alt="Cornell-Logo" />

	<?php

		$current_page = basename($_SERVER["SCRIPT_FILENAME"], '.php');

		if ($current_page == "winter2017" || $current_page == "bloghome") {
			if (empty($_SESSION['logged_user'])){
				print ("<div id='loginformwelcome'> 
            			<form action='bloghome.php' method='post'>
                        <br>
            	  	 	 	Username: <input type='text' name='authorname'>
             	  	 		Password: <input type='password' name='password'>
           	  	  	 		<input type='submit' name='loginsubmit' value='Log In'>
           				</form>
	  	 			</div>");
			} elseif (isset($_SESSION['logged_user'])) {
				print ("<form action='bloghome.php' method='post'>
    						<input type='submit' name='logoutsubmit' value='Log Out'>
    					</form>");
			}
		}

	?>
</div>

	<?php

		if ($current_page == "index") {
			print '<img class="header-image" src="../images/watermelons.jpg" alt="" />';
		} else if ($current_page == "application" || $current_page == "expenses"
			|| $current_page == "travelprep" || $current_page == "funding") {
			print '<img class="header-image" src="../images/tuition-hero.jpg" alt="" />';
		} else if ($current_page == "facilities") {
			print '<img class="header-image" src="../images/facilities-hero.jpg" alt="" />';
		} else if ($current_page == "asian3360" || $current_page == "faculty"
			|| $current_page == "fieldtrips" || $current_page == "calendar") {
			print '<img class="header-image" src="../images/faculty-hero.jpg" alt="" />';
		} else if ($current_page == "opportunities") {
			print '<img class="header-image" src="../images/ruins-hero.jpg" alt="" />';
		} else if ($current_page == "winter2017" || $current_page == "bloghome") {
			print '<img class="header-image" src="../images/colorful_lamps-hero.jpg" />';
		}

	?>


<div class="header">Cornell in Vietnam</div>
