<?php session_start();

if (isset($_SESSION['logged_user'])){
    if (isset($_POST['logoutsubmit'])) {     
            unset($_SESSION["logged_user"]);
        } 
}

?> 

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cornell in Vietnam | Winter 2017</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head><body>
	<?php
		include("../includes/header.php");
   		include("../includes/nav_pages.php");

	    require_once ("../includes/config.php");
	    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	    
	    if($mysqli->connect_error) {
	        die("Connection failed: " . $mysqli->connect_error);
	    } else {
	        echo NULL;
	    }
	?>

<?php

 
if(isset($_POST['loginsubmit'])) {
        
        if(!isset($authorname) && !isset($password)) {
            if (preg_match('/^[A-Za-z0-9_,. ]*$/', $_POST['authorname']) && preg_match('/^[A-Za-z0-9_,. ]*$/', $_POST['password'])) {
            $username = filter_input(INPUT_POST, 'authorname', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $hashpassword = '$2y$10$4MSLoGEop/TRC3TB96Dz5uq/c.jPlx8qqN3KKG/UlGVr963L5fLlG';
                
            if (password_verify($password, $hashpassword)) {
        
            $sql = "SELECT Author_Name, Hash_Password FROM Users;";  
            $result=$mysqli->query($sql);
                if($result && $result->num_rows==1){
                    $row=$result->fetch_assoc();
                        $database_username=$row['Author_Name'];
                        $database_password=$row['Hash_Password'];
                    if ($hashpassword == $database_password && $username == $database_username) {
                        $_SESSION['logged_user'] = $username;
                        echo"<script> window.location='winter2017.php';</script>";
                     }
             
                    elseif ($username != $database_username) {
                            echo "Please check your username.";
                    } 
                }
                
            } else {
                echo "Please check your credentials.";
            }
        }  //pregmatch    
            else {
                echo "Bad input.";
            }
        }   //!isset    
    }   

?>

	<div class="page-content">
		<div class="page-heading">Winter 2017</div>
		
  <?php  
        
 if(!isset($_GET['user_id'])){
     
   ?>  
        <div class="page-heading-2">Student Blogs</div>
        <div class="page-heading-4">
        <p>Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta.</p>
        </div>
        
      <?php 
     
        $allinfo = $mysqli->query("SELECT Blogs.*, Programs.*, BlogInProgram.*, UserInBlog.*, Users.* from Blogs LEFT JOIN BlogInProgram on Blogs.Blog_Id = BlogInProgram.Blog_Id LEFT JOIN Programs on BlogInProgram.Program_Id = Programs.Program_Id LEFT JOIN UserInBlog on Blogs.Blog_Id = UserInBlog.Blog_Id INNER JOIN Users on UserInBlog.User_Id = Users.User_Id GROUP BY Users.User_Id"); 
        while($row = $allinfo->fetch_assoc()) {
         
            $blog_id = $row["Blog_Id"];
            $program_id = $row["Program_Id"];
            $title = $row["Title"];
            $content = $row["Content"];
            $program_name = $row["Program_Name"];
            $program_date = $row["Program_Date"];
            $user_id = $row["User_Id"];
            $author_name = $row["Author_Name"];
            
            echo("<div class='page-heading-9'>");
            echo( "<a href='winter2017.php?user_id=$user_id'>$author_name</a></p>");
            echo("</div>");
    }
 
 } else if (isset($_GET['user_id'])){
    $user_id=($_GET['user_id']);
 
  ?>   
    <div class="page-heading-4">
      <a href="../pages/winter2017.php">Winter 2017: Student Blogs</a>
    </div>
 <?php         
        $result = $mysqli->query("SELECT Blogs.*, Users.*, UserInBlog.* from Blogs INNER JOIN UserInBlog on Blogs.Blog_Id = UserInBlog.Blog_Id INNER JOIN Users on UserInBlog.User_Id = Users.User_Id WHERE UserInBlog.User_Id='$user_id'");
     
        while($row=$result->fetch_assoc()) {

            $content = $row["Content"];
            $title = $row["Title"];
            $user_id = $row["User_Id"];
            $blog_id = $row["Blog_Id"];
            $author_name = $row["Author_Name"];
            $date=$row['Date'];
            $image=$row['Image_File_Path'];
            
            echo("<div class='page-heading-9'>");
            echo("<h2>$title</h2>");
            echo("$date");
            echo("<br>");
            if ($image != '../images/') {
                echo("<img src=$image alt=''>");
                echo("<br>");
                echo("$content");
                echo("<br>");
                echo("</div>");
            } else {
                echo("<br>");
            echo("$content");
            echo("<br>");
            echo("</div>");
            }
            
        }
 }
   ?>     
<!--
			<button class="accordion">Expand this</button>
			<div class="panel">
  				<p>Some content</p>
			</div>
			<button class="accordion">Expand this</button>
			<div class="panel">
  				<p>Some content</p>
			</div>
-->
	</div>

    <div class="footer-bar"><br>© SAIL 2017</div>
	<script type="text/javascript" src="../scripts/script.js"></script> 
</body>