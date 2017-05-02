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