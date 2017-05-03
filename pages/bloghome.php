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
<body>
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
        <div class="page-heading">Blog</div>
        <div class="page-heading-2">A sub-heading</div>
            <button class="accordion">Expand this</button>
            <div class="panel">
                <p>Some content</p>
  <?php       
//    if (isset($_SESSION['logged_user'])){      
   ?>             
                <!-- content to reveal when user is logged in - pseudocode for adding a blog
        
    HTML FORM:
                    div id="addblog">
                    <form method="post" action="bloghome.php" enctype="multipart/form-data">
                    <label>Title</label><input type="text" name="title" required/>
                    <input type="file" name="new_upload_image">Image
                    <label>Add to</label><input type="checkbox" name="addtoprogram"/>
                    <label>Program</label><select name="programname">

                        <?php
        //                    $array="SELECT Program_Id, Program_Name from Programs";
        //                    $result = $mysqli->query($array);
        //                    
        //                            while($row = $result->fetch_assoc()) {
        //                                $program_id=$row['Program_Id'];
        //                                $program_name = $row['Program_Name'];
        //                                echo "<option value=\"$program_id\" label=\" $program_name\">$program_name</option>";
        //                            }
                        ?>
                    </select>

                    <label>Author</label><select name="authorname">

                        <?php
        //                    $array="SELECT User_Id, Author_Name from Users";
        //                    $result = $mysqli->query($array);
        //                    
        //                            while($row = $result->fetch_assoc()) {
        //                                $user_id=$row['User_Id'];
        //                                $author_name = $row['Author_Name'];
        //                                echo "<option value=\"$user_id\" label=\" $author_name\">$author_name</option>";
        //                            }
                        ?>
                    </select>
                    <input type="submit" name="addblog" value="Add Blog">
                </form>


                !-->
                
                
<?php
//                CONNECTING TO DATABASE, ADDING THE BLOG!
                
//        print("<div class='errorprinting'>");
//        if (isset($_POST['addblog'])){
//            if (preg_match('/^[A-Za-z0-9_, ]*$/', $_POST['caption']) && (preg_match('/^[A-Za-z0-9_, ]*$/', $_POST['albumname']))) {
//                $newimage = $_FILES['new_upload_image'];
//                $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
//                $program_id= filter_input(INPUT_POST, 'program_name');
//                $user_id= filter_input(INPUT_POST, 'author_name');
//                
//       if(!empty($_FILES['new_upload_image'])) {
//            $originalname=$newfile['name'];
//            
//            if($newfile['error']==0) { //0 = no error
//                $temporaryname=$newfile['tmp_name'];
//                move_uploaded_file($temporaryname,"../images/$originalname");
//                $_SESSION['new_upload_image'][] = $originalname;
//                print("$originalname was uploaded successfully");
//            
//            } elseif (file_exists("../images/$originalname")){
//                $i=1;
//                $ext=pathinfo("../images/$originalname", PATHINFO_EXTENSION);
//                $originalname=pathinfo("../images/$originalname", PATHINFO_FILENAME);
//                $new_originalname=$originalname . $i . '.' . $ext;
//                $newpath = "../images/" . $new_originalname;
//                $i++;
//                move_uploaded_file($temporaryname, $newpath);
//                print("$new_originalname was uploaded successfully");
//            
//            } else {
//                print("Error in uploading $originalname");
//                print "<img src='$newfile' alt='Image' title=''><br />\n";
//                } 
//        
//            $addblog_query="INSERT INTO Blogs (Blog_Id, Title, Image_File_Path, Content, Date) VALUES (NULL, '$title', '../images/$originalname', NULL)";
//            if(!isset($_GET['Blog_Id'])){
//            $result = $mysqli->query($addblog_query);
//                if($result == FALSE) {
//                    echo("Error in adding blog to database.");
//                }   
//            }
//        
//            $blog_grab="SELECT Blog_Id FROM Blogs ORDER BY Blog_Id desc LIMIT 1";
//            $query = $mysqli->query($blog_grab);
//                 while($result = $query->fetch_assoc()) {
//                     $blog_id=$result['Bhoto_Id'];
//                 }
//            
//           if(isset($_POST['addtoprogram'])) {
//            $myquery="INSERT INTO BlogInProgram (Blog_Id, Program_Id) VALUES (NULL, '$program_id',);";
////                echo($myquery);
//                if(!isset($_GET['program_id'])){
//                    $result = $mysqli->query($myquery);
//                        if($result == FALSE) {
//                        echo("Error in inserting into Program.");
//                        }   
//                }
//            }
//        }
//        
//        } else {
//                echo "Bad input";
//            }
//        }
//            print("</div>"); //errorprinting div
        
?>
            </div>
            <button class="accordion">Expand this</button>
            <div class="panel">
                <p>Some content</p>
            </div>
        <div class="page-heading-2">Another sub-heading</div>
    </div>

    <div class="footer-bar"><br>© SAIL 2017</div>
    <script type="text/javascript" src="../scripts/script.js"></script> 
</body>
    
    