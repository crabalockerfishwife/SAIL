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
        <title>Cornell in Vietnam | Blog</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
    </head>


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
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['authorname']) && preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['password'])) {
            $username = filter_input(INPUT_POST, 'authorname', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $match = false;

            $hashpasswords_query = "SELECT Hash_Password FROM Users;";
            $hashpasswords = array();

            $result = $mysqli->query($hashpasswords_query);
            if($result == FALSE) {
                echo("Error in retrieving hashpasswords.");
            }   
            while ($row = $result->fetch_assoc()) {
                 array_push($hashpasswords, $row['Hash_Password']);
            }

            foreach ($hashpasswords as $hashpassword){
                if (password_verify($password, $hashpassword)) {
                    $match = true;
                    break;
                }
            }

            if ($match) {
                $_SESSION['logged_user'] = $username;
                echo"<script> window.location='bloghome.php';</script>";
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
<body>
    <div class="page-content">
        <div class="page-heading">Blog</div>
        <div class="page-heading-4">
            <p>Through the course of a year, students engage in 5 credits of academic learning. Starting from VIET 1110 in the Fall and concluding with ASIAN 3360 in the Spring, students receive amble opportunity to learn and experience Vietnam both in the classroom and in the country itself. <br> These blogs represent the students work before, during, and after their stay in Vietnam.</p>
            <a href="../pages/winter2017.php">Winter 2017: Climate Change and Service Learning in the Mekong Delta, Vietnam</a>
              </div>

  <?php       
    if (isset($_SESSION['logged_user'])){      
   ?>      

    <!-- Add a Blog -->       
       <div>
            <button class="accordion">Add a Blog</button>
            <div class="panel">
                
        <div id="addblog">
            <form method="post" action="bloghome.php" enctype="multipart/form-data">
            <label>Title</label><input type="text" name="title" required/>
            <label>Content</label><input type="text" name="content" required/>
            <input type="file" name="new_upload_image">
            <label>Program</label><select name="programname">

                <?php
                    $array="SELECT Program_Id, Program_Name from Programs";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $program_id=$row['Program_Id'];
                            $program_name = $row['Program_Name'];
                            echo "<option value=\"$program_id\" label=\" $program_name\">$program_name</option>";
                        }
                ?>
            </select>
            
            <label>Author</label><select name="authorname">

                <?php
                    $array="SELECT User_Id, Author_Name from Users";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $user_id=$row['User_Id'];
                            $author_name = $row['Author_Name'];
                            echo "<option value=\"$user_id\" label=\" $author_name\">$author_name</option>";
                        }
                ?>
            </select>
            
            <input type="submit" name="addblog" value="Add Blog">
        </form>
            </div> <!-- addblog div -->
                
         </div> <!-- panel -->
    </div> <!-- accordion--> 

<?php
    
    
        if (isset($_POST['addblog'])){
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['title']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['programname']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['authorname'])))) {
                $file = $_FILES['new_upload_image'];
                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
                $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
                $program_id= filter_input(INPUT_POST, 'programname');
                $user_id= filter_input(INPUT_POST, 'authorname');
                
       
        if (!empty($_POST['content'])) {      
            if(!empty($_FILES['new_upload_image'])) {
                $originalname=$file['name'];

                if($file['error']==0) { //0 = no error
                    $temporaryname=$file['tmp_name'];
                    move_uploaded_file($temporaryname,"../images/$originalname");
                    $_SESSION['new_upload_image'][] = $originalname;
                    print("$originalname was uploaded successfully");
                }
                   
            } if (empty($_FILES['new_upload_image'])) {
                    echo ("No image selected");
            }
            
            $addblog_query="INSERT INTO Blogs (Blog_Id, Title, Image_File_Path, Content, Date) VALUES (NULL, '$title', '../images/$originalname', '$content', NULL)";
            if(!isset($_GET['Blog_Id'])){
            $result = $mysqli->query($addblog_query);
                if($result == FALSE) {
                    echo("Error in adding blog to database.");
                }   
            }

            $blog_grab="SELECT Blog_Id FROM Blogs ORDER BY Blog_Id desc LIMIT 1";
            $query = $mysqli->query($blog_grab);
                while($result = $query->fetch_assoc()) {
                    $blog_id=$result['Blog_Id'];
                

            $myquery="INSERT INTO BlogInProgram (Blog_Id, Program_Id) VALUES ('$blog_id', '$program_id');";
                if(!isset($_GET['programname'])){
                    $result = $mysqli->query($myquery);
                        if($result == FALSE) {
                        echo("Error in inserting into Blog in Program.");
                        }   
                }
            
//            $programname_grab="SELECT Program_Name, Program_Date FROM Programs WHERE Program_Id='$program_id'";
//            $query = $mysqli->query($programname_grab);
//                while($result = $query->fetch_assoc()) {
//                    $program_name=$result['Program_Name'];
//                    $program_date=$result['Program_Date'];
             
            
//            $program_query="INSERT INTO Programs (Program_Id, Program_Name, Program_Date) VALUES ('$program_id', '$program_name', '$program_date');";
//                if(!isset($_GET['programname'])){
//                    $result = $mysqli->query($program_query);
//                        if($result == FALSE) {
//                        echo("Error in inserting into Program.");
//                        }   
//                }
//            }
            
            $user_blog="INSERT INTO UserInBlog (User_Id, Blog_Id) VALUES ('$user_id', '$blog_id');";
                if(!isset($_GET['authorname'])){
                    $result = $mysqli->query($user_blog);
                        if($result == FALSE) {
                        echo("Error in inserting into User in Blog.");
                        }   
                }
            
//            $user_program="INSERT INTO UserInProgram (User_Id, Program_Id) VALUES ('$user_id', '$program_id');";
//                if(!isset($_GET['authorname'])){
//                    $result = $mysqli->query($user_program);
//                        if($result == FALSE) {
//                        echo("Error in inserting into User in Program.");
//                        }   
            
            }
            
        } else { //if there is content 
            echo "No content was added.";
        }
                
        } else {//pregmatch
                echo "Bad input.";
        }
        
        } //add blog is pushed

        
?>

    <!-- Delete a Blog -->
    <div>
    <button class="accordion">Delete a Blog</button>
        <div class="panel">
  		    <div id="deleteblog">
        <form method="post" action="bloghome.php" enctype="multipart/form-data">
            <label>Blog Title</label><select name="blogtitle">

                <?php
                    $array="SELECT Blog_Id, Title from Blogs";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $blog_id=$row['Blog_Id'];
                            $title = $row['Title'];
                            echo "<option value=\"$blog_id\" label=\" $title\">$title</option>";
                        }
                ?>
            </select>
            

            <input type="submit" name="deleteblog" value="Delete Blog">
        </form>
            </div> <!-- deleteblog div -->
                
         </div> <!-- panel -->
    </div> <!-- accordion--> 
 
<?php
        if (isset($_POST['deleteblog'])){
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['blogtitle'])) {
                $blog_id= filter_input(INPUT_POST, 'blogtitle');
    
            $deleteblog="DELETE FROM Blogs WHERE Blog_Id='$blog_id'"; 
            $result=$mysqli->query($deleteblog);
                if($result == FALSE) {
                    echo("Error in deleting from database.");
                } 
            }
            
            $deleteblog_inprogram="DELETE FROM BlogInProgram WHERE Blog_Id='$blog_id'"; 
            $result=$mysqli->query($deleteblog_inprogram);
                if($result == FALSE) {
                    echo("Error in deleting from database.");
                } 
            
            $deleteuser_inblog="DELETE FROM UserInBlog WHERE Blog_Id='$blog_id'"; 
            $result=$mysqli->query($deleteuser_inblog);
                if($result == FALSE) {
                    echo("Error in deleting from database.");
                } 
            
            
        } //delete blog end
?> 
    
 <!-- Edit a Blog -->
 <div>
            <button class="accordion">Edit a Blog</button>
            <div class="panel">
                
    <div id="addblog">
        <form method="post" action="bloghome.php" enctype="multipart/form-data">
            
            <label>Blog Title</label><select name="oldtitle">

                <?php
                    $array="SELECT Blog_Id, Title from Blogs ORDER BY Blog_Id ASC";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $blog_id=$row['Blog_Id'];
                            $title = $row['Title'];
                            echo "<option value=\"$blog_id\" label=\" $title\">$title</option>";
                        }
                ?>
            </select>
            <label>New Title</label><input type="newtext" name="newtitle"/>
            <label>Content</label><input type="text" name="content"/>
            <label>Program</label><select name="programname">

                <?php
                    $array="SELECT Program_Id, Program_Name from Programs ORDER BY Program_Id asc";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $program_id=$row['Program_Id'];
                            $program_name = $row['Program_Name'];
                            echo "<option value=\"$program_id\" label=\" $program_name\">$program_name</option>";
                        }
                ?>
            </select>
            
            <label>Author</label><select name="authorname">

                <?php
                    $array="SELECT User_Id, Author_Name from Users ORDER BY User_Id ASC";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $user_id=$row['User_Id'];
                            $author_name = $row['Author_Name'];
                            echo "<option value=\"$user_id\" label=\" $author_name\">$author_name</option>";
                        }
                ?>
            </select>
            
            <input type="submit" name="editblog" value="Edit Blog">
        </form>
            </div> <!-- addblog div -->
                
         </div> <!-- panel -->
    </div> <!-- accordion--> 

<?php

        if (isset($_POST['editblog'])){
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['oldtitle']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['newtitle']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['content']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['programname']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['authorname'])))))) {
                $blog_id= filter_input(INPUT_POST, 'oldtitle');
                $newtitle = filter_input(INPUT_POST, 'newtitle', FILTER_SANITIZE_STRING);
                $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
                $program_id= filter_input(INPUT_POST, 'programname');
                $user_id= filter_input(INPUT_POST, 'authorname');
        
        if (($blog_id != 1) && (!empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id == 1) && ($user_id == 1)) {
            
            $edittitle="UPDATE Blogs SET Title='$newtitle' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                $result = $mysqli->query($edittitle);
                    if($result == FALSE) {
                        echo("Error in changing title name in database.");
                    }   
                } //works
            
        } elseif (($blog_id != 1) && (!empty($_POST['newtitle'])) && (!empty($_POST['content'])) && ($program_id == 1) && ($user_id == 1)) {
            
            $edittitle_and_content="UPDATE Blogs SET Title='$newtitle', Content='$content' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                $result = $mysqli->query($edittitle_and_content);
                    if($result == FALSE) {
                        echo("Error in changing title name and content in database.");
                    }   
                } // works
            
        } elseif (($blog_id != 1) && (!empty($_POST['newtitle'])) && (!empty($_POST['content'])) && ($program_id != 1) && ($user_id == 1)) {
            
            $edittitle_and_content="UPDATE Blogs SET Title='$newtitle', Content='$content' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                $result = $mysqli->query($edittitle_and_content);
                    if($result == FALSE) {
                        echo("Error in changing title name and content in database.");
                    }   
                } //works
            
             $bloginprogram="UPDATE BlogInProgram SET Program_Id='$program_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($bloginprogram);
                        if($result == FALSE) {
                        echo("Error in changing the program of your blog.");
                        }   
                } //works
            
        } elseif (($blog_id != 1) && (empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id != 1) && ($user_id == 1)) {
            
             $bloginprogram="UPDATE BlogInProgram SET Program_Id='$program_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($bloginprogram);
                        if($result == FALSE) {
                        echo("Error in changing the program of your blog.");
                        }   
                } //works

        } elseif (($blog_id != 1) && (empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id == 1) && ($user_id != 1)) {
              
            $edit_userinblog="UPDATE UserInBlog SET User_Id='$user_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($edit_userinblog);
                        if($result == FALSE) {
                        echo("Error in editing username associated with that Blog.");
                        }   
                } //works
                
        } elseif (($blog_id != 1) && (!empty($_POST['newtitle'])) && (!empty($_POST['content'])) && ($program_id != 1) && ($user_id != 1)) {
            
            $edittitle_and_content="UPDATE Blogs SET Title='$newtitle', Content='$content' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                $result = $mysqli->query($edittitle_and_content);
                    if($result == FALSE) {
                        echo("Error in changing title name and content in database.");
                    }   
                } //works
            
             $bloginprogram="UPDATE BlogInProgram SET Program_Id='$program_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($bloginprogram);
                        if($result == FALSE) {
                        echo("Error in changing the program of your blog.");
                        }   
                } //works
            
            $edit_userinblog="UPDATE UserInBlog SET User_Id='$user_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($edit_userinblog);
                        if($result == FALSE) {
                        echo("Error in editing username associated with that Blog.");
                        }   
                } //works
        
        } elseif (($blog_id != 1) && (!empty($_POST['newtitle'])) && (!empty($_POST['content'])) && ($program_id == 1) && ($user_id != 1)) {
            
            $edittitle_and_content="UPDATE Blogs SET Title='$newtitle', Content='$content' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                $result = $mysqli->query($edittitle_and_content);
                    if($result == FALSE) {
                        echo("Error in changing title name and content in database.");
                    }   
                } //works
            
            $edit_userinblog="UPDATE UserInBlog SET User_Id='$user_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($edit_userinblog);
                        if($result == FALSE) {
                        echo("Error in editing username associated with that Blog.");
                        }   
                } //works
            
        } elseif (($blog_id != 1) && (!empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id == 1) && ($user_id != 1)) {
            
            $edittitle="UPDATE Blogs SET Title='$newtitle' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                $result = $mysqli->query($edittitle_and_content);
                    if($result == FALSE) {
                        echo("Error in changing title name in database.");
                    }   
                } //works
            
            $edit_userinblog="UPDATE UserInBlog SET User_Id='$user_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($edit_userinblog);
                        if($result == FALSE) {
                        echo("Error in editing username associated with that Blog.");
                        }   
                } //works
            
        } elseif (($blog_id == 1) && (!empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id == 1) && ($user_id != 1)) {
            
            echo("You must choose a valid blog name in order to change the title");
            
            $edit_userinblog="UPDATE UserInBlog SET User_Id='$user_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($edit_userinblog);
                        if($result == FALSE) {
                        echo("Error in editing username associated with that Blog.");
                        }   
                } //works
            
        } elseif (($blog_id == 1) && (!empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id != 1) && ($user_id == 1)) {
            
            echo("You must choose a valid blog name in order to change the title");
            
            $bloginprogram="UPDATE BlogInProgram SET Program_Id='$program_id' WHERE Blog_Id='$blog_id'";
                if(!isset($_GET['Blog_Id'])){
                    $result = $mysqli->query($bloginprogram);
                        if($result == FALSE) {
                        echo("Error in changing the program of your blog.");
                        }   
                } //works
            
        } elseif (($blog_id == 1) && (empty($_POST['newtitle'])) && (empty($_POST['content'])) && ($program_id == 1) && ($user_id == 1)) {
                echo NULL;
        }  
                
        } else { //pregmatch
                echo "Bad input.";
        }
        
        } //edit blog is pushed
        
?>

<?php       
    if ($_SESSION['logged_user']=="ThuyTranviet"){      
   ?> 

<!-- Add a program -->
<div>
    <button class="accordion">Add a Program</button>
        <div class="panel">
            <div id="addprogram">
        <form method="post" action="bloghome.php" enctype="multipart/form-data">
            <label>Progam Name</label><input type="text" name="programname" required/>
            <label>Program Date</label><input type="text" name="programdate" required/>
            <input type="submit" name="addprogram" value="Add Program">
        </form>
            </div> <!-- add program div -->
                
         </div>  <!-- panel  -->
    </div> <!-- accordion--> 
    
<?php
        if (isset($_POST['addprogram'])){
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['programname']) && (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['programdate']))) {
                $programname= filter_input(INPUT_POST, 'programname');
                $programdate= filter_input(INPUT_POST, 'programdate');
    
                $addprogram="INSERT INTO Programs (Program_Id, Program_Name, Program_Date) VALUES (NULL, '$programname' , '$programdate')";
                $result = $mysqli->query($addprogram);
                print_r($result);
                    if($result == FALSE) {
                        echo("Error in inserting into User in Blog.");
                    }   

            }
        } //end add program

?> 


    <!-- Add a user -->
    <div>
    <button class="accordion">Add a User</button>
        <div class="panel">
            <div id="adduser">
        <form method="post" action="bloghome.php" enctype="multipart/form-data">
            <label>Author Name</label><input type="text" name="newauthorname" required/>
            <label>Password</label><input type="text" name="newpassword" required/>
            <input type="submit" name="adduser" value="Add User">
        </form>
            </div> <!-- add user div div -->
                
         </div>  <!-- panel  -->
    </div> <!-- accordion--> 
 
    
<?php
        if (isset($_POST['adduser'])){
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['newauthorname'])) {
                $new_username= ucwords(filter_input(INPUT_POST, 'newauthorname'));
                $new_password = password_hash(filter_input(INPUT_POST, 'newpassword'), PASSWORD_DEFAULT);

                if (in_array($new_username, $users)) {
                    echo "User already exists";
                }
                else {
                    $new_username = str_replace(' ', '', $new_username);
                    $adduser="INSERT INTO Users (Author_Name, Hash_Password) VALUES ('$new_username', '$new_password');";
                    $result = $mysqli->query($adduser);
                    if($result == FALSE) {
                            echo("Error in adding user to database.");
                        }
                }

            }
        } //end add user
?>
        
    
<!-- Delete a user -->
    <div>
    <button class="accordion">Delete a User</button>
        <div class="panel">
  		    <div id="deleteruser">
        <form method="post" action="bloghome.php" enctype="multipart/form-data">
            <label>Author Name</label><select name="authorname">

                <?php
                    $array="SELECT User_Id, Author_Name from Users ORDER BY User_Id asc";
                    $result = $mysqli->query($array);
                            
                        while($row = $result->fetch_assoc()) {
                            $user_id=$row['User_Id'];
                            $author_name = $row['Author_Name'];
                            echo "<option value=\"$user_id\" label=\" $author_name\">$author_name</option>";
                        }
                ?>
            </select>
            <input type="submit" name="deleteuser" value="Delete User">
        </form>
            </div> <!-- delete user div div -->
                
         </div>  <!-- panel  -->
    </div> <!-- accordion--> 
 
    
<?php
        if (isset($_POST['deleteuser'])){
            if (preg_match("/^[A-Za-z0-9_,.!' ]*$/", $_POST['authorname'])) {
                $user_id= filter_input(INPUT_POST, 'authorname');
    
                $deleteuser="DELETE FROM Users WHERE User_Id='$user_id'";
                $result = $mysqli->query($deleteuser);
                    if($result == FALSE) {
                        echo("Error in deleting user from database.");
                    }   

            }
        } //end delete user
?>

<?php    //this is to only show this information if you are logged in 
}
?>

    </div> <!-- page content div -->
   
<?php    //this is to only show this information if you are logged in 
}
?>
    
    
    <div class="footer-bar"><br>© SAIL 2017</div>
    <script type="text/javascript" src="../scripts/script.js"></script> 
    
</body>
    
</html>  
    