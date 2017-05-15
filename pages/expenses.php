<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cornell in Vietnam | Costs and Expenses</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head><body>
	<?php
		include("../includes/header.php");
   		include("../includes/nav_pages.php");

	?>
	
	<div class="page-content">
		<div class="page-heading">Costs and Expenses</div>
			<div class="page-heading-4">
                <div class="page-heading-11">
                <h3>Program Costs</h3>
  					• Program costs: estimated to be around $2,100-2,500 all-in. This includes 3 weeks of housing, transportation, academic components, service learning, cultural activities, and most food. Note: the food costs in Vietnam are very reasonable<br>
 					• International airfare is generally around $900-1,400. However, last year some participants paid $870 round trip from NYC
                
                <h3>Additional Costs</h3>
  					• Passport must have at least 6 months of validity. Expiration date July 2018 or later.<br>
 					• Vietnam visa: $25 (e-visa, single entry, 30 days). Other options: $55 (allows for 1 year multiple entries)<br>
                    • Other personal related spending: $250 - 400 (food, souvenirs, gifts, etc.; estimated depending on personal spending habits)<br>
                    • Vaccinations: cost depends on student vaccination history<br>
                    • UHC (emergency evacuation insurance): free for Cornell students

        <div class="page-heading-5">
            <p>Note: we will work with all students to find financial aid and make this course more affordable. Visit the <a href="funding.php">Financial Aid Information</a> page for more details. Do not let the cost prevent you from applying!</p></div>
        </div>
        </div>
        <div id='contactform'> 
            <form action='index.php' method='post'>
                <div id="most-info">
                    <h4>Contact Cornell in Vietnam</h4>
                    <label> Name: </label> <input type="text" name="fullname" value=""> <br>
                     <label> Email: </label> <input type="email" name="email" value=""> <br>
                     <label> Graduation Year: </label>
                    <select name="gradyear">
                        <option value="">Select a Year</option>
                        <option value="2018"> 2018 </option>
                        <option value="2020"> 2019</option>
                        <option value="2019"> 2020 </option>
                </select><br>
                
                <label> Message: </label><br>
                    <textarea id="additionalinformation" name="additionalinformation" rows="3" cols="50"></textarea><br>
                    <input type="submit" name="submit" value="Contact Us"><br>
           	
                </div>
                </form>
        </div>
        

        <?php
         
            if (isset($_POST['submit'])) {
                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $gradyear = filter_input(INPUT_POST, 'gradyear', FILTER_VALIDATE_INT);
                $additionalinformation = filter_input(INPUT_POST, 'additionalinformation', FILTER_SANITIZE_STRING);

            ini_set("SMTP", "aspmx.l.google.com");
            ini_set("sendmail_from", $email);

            $message = "Name: $name\r\nEmail: $email\r\nYear: $gradyear\r\nMessage: $additionalinformation";
            $headers = "From: $email";

            mail("CornellinVietnam@cornell.edu", "Inquiry from $name, $email", $message, $headers);
            }
        
        ?>
        
        </div>

	<div class="footer-bar"><br>© SAIL 2017</div>
	<script type="text/javascript" src="../scripts/script.js"></script>
</body>