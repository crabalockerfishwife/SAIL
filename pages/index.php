<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Cornell in Vietnam | Home</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
<body>
	<?php
		include("../includes/header.php");
   		include("../includes/nav.php");
    
	?>
	<div class="page-content-1">
        <div class="page-heading-2"><a href="http://courses.cornell.edu/preview_course_nopop.php?catoid=28&coid=467865">ASIAN 3360</a>
            Community Engagement &amp; Climate Change in the
            Mekong Delta: Insights into Vietnam</div>
            <div class="page-heading-10">
                <p>We live in an interconnected and interdependent world and with our changing climate this connectivity is becoming even more apparent. We are all in this together and will only solve this grand challenge by developing new global partnerships. This course was created as a way to help us all become more informed global citizens through firsthand experience of impacts due to climate change while gaining meaningful international engagements with the people in the Mekong Delta, Vietnam.</p>

                <p>The course is intended to provide you an introduction to Vietnam through the lens of climate change and its implications, not only globally but also how it has impacted the Mekong Delta region of Vietnam, one of the most at risk areas in the world in particular. The combination of classroom lectures, historical and cultural tours, and service learning experience while in the country will challenge you to grasp the enormous challenges posed by climate change while examining and considering possible solutions. From what you learn and experience during this course, we hope you will be a better-informed global citizen and able to share the climate change story beyond your education at Cornell.</p>

                <p>Permission of instructor required. Students must take both ASIAN 3360 and ASIAN 3361 to receive course credit. This yearlong course includes seven weeks during the second half of the fall semester and first half of the spring semester, and a January in-country two-week service-learning experience.</p>
            </div>
        <br>
        <div id='contactform'> 
            <form action='index.php' method='post'>
                <div id="most-info">
                    <h4>Contact Cornell in Vietnam</h4>
                    <label> Name: </label> <input type="text" name="fullname" value=""><br>
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
                $name = filter_input(INPUT_POST, 'fullname', FILTER_SANITIZE_STRING);
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