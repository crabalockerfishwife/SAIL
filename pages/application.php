<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cornell in Vietnam | Application</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>
<body>
	<?php
		include("../includes/header.php");
   		include("../includes/nav_pages.php");

	?>
	<div class="page-content">
		<div class="page-heading">Application Requirements</div>  
        <div class="page-heading-11">
        
			<div class="page-heading-4">
                <h3>Requirements</h3>
  				<ul class>
  					<li>• Upper-level students only.</li>
 					<li>• Minimum GPA of 3.0 and good standing with the University (no pending Judicial Administrative violations). This GPA must be maintained over the program.</li>
 					<li>• Permission code for ASIAN 3360 will be issued after your acceptance into the program.</li>
 					<li>• All accepted students must enroll in VIET 1100 (1 credit, fall only)</li>
 				</ul>
                <h3>Qualifications</h3>
                    <p>The ideal candidate will demonstrate cross-cultural skills, flexibility, adaptability and maturity. Candidates should have demonstrated interests in Vietnam/Southeast Asia and issues on climate change, international development, and environmental studies. Candidates should exhibit excellent written and oral communication skills and have experience working as part of a team. Selected students must be willing to engage in service learning activities in local communities in Vietnam.</p>
                    <p>We welcome and encourage students from all colleges and majors to apply. </p>
                    </div>
        
        <div class="page-heading-2">Click <a href="../includes/ASIAN3360ApplicationApril 2017.docx" target="_blank">here</a> to start the application process.</div>
        <div class="page-heading-8">
            <div id="pagecontent_p">
                <p>Please note that this course is NOT an opportunity for a holiday. It should be treated as an opportunity for intense international experience with serious academic work and intercultural exchange. The field component will require a high level of cooperation and collegiality with traveling companions.</p></div></div>
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