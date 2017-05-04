<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cornell in Vietnam | Home</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
<body>
	<?php
		include("../includes/header.php");
   		include("../includes/nav.php");

	//    require_once ("../includes/config.php");
	//    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	//    
	//    if($mysqli->connect_error) {
	//        die("Connection failed: " . $mysqli->connect_error);
	//    } else {
	//        echo NULL;
	//    }
    
	?>
	<div class="page-content">
		<div class="page-heading">Spend three weeks in Vietnam!</div><br>
		<div class="page-heading-2">ASIAN 3360
            Community Engagement &amp; Climate Change in the
            Mekong Delta: Insights into Vietnam</div>
			<button class="accordion">Application Information</button>
			<div class="panel">
  				<p>Early application decision: May 15, 2017</p>
                <p>Rolling Admission: May 1, 2017 - August 25, 2017</p>
                <p>Limited to 12 Students</p>
                <p>Fall 2017 Requirement:  VIET 1100</p>
			</div>
			<button class="accordion">Contact Information</button>
			<div class="panel">
  				<p>CornellinVietnam@cornell.edu</p>
			</div>
        
        <br>
        <div id='contactform'> 
            <form action='index.php' method='post'>
            <div class="page-heading">Contact Form</div><br>
                <div id="most-info">
                    Name: <input type="text" name="name" value=""> <br>
                    E-mail: <input type="email" name="email" value=""> <br>
                    Phone Number: <input type="tel" name="phone" value=""> <br>
                    Select Your Graduation Year: 
                    <select name="gradyear">
                    <option value="">Select a Year</option>
                    <option value="2020"> 2020 </option>
                    <option value="2019"> 2019 </option>
                    <option value="2018"> 2018 </option>
                </select>
                </div>
                <div id="add-info">Additional Information:<br>
                    <textarea id="additionalinformation" name="additionalinformation" rows="3" cols="50"></textarea><br>
                    <input type="submit" name="submit" value="Contact Us"><br>
                </div>
           	</form>
        </div>

        <?php

        if (isset($_POST['submit'])) { #to check if the user submitted
                
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $gradyear = $_POST['gradyear'];
                $additionalinformation = $_POST['additionalinformation'];

                $to = 'samplel@email.com' . ',';
                $from = $email;
                $subject = 'Subject to be Emailed to Cornell in Vietnam Email';
                $message = "The Provided Information:\r\nName: $name\r\nEmail: $email\r\nPhone Number:
                $phone\r\nAdditional Information: $additionalinformation";

        }

        ?>
        
	</div>

	<div class="footer-bar"><br>© SAIL 2017</div>
	<script type="text/javascript" src="../scripts/script.js"></script>
</body>