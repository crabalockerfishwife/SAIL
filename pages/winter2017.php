<?php session_start();

if (isset($_SESSION['logged_user'])){
    if (isset($_POST['logoutsubmit'])) {     
            unset($_SESSION["logged_user"]);
        } 
}

$myfile = fopen("../includes/users.txt", "r") or die("Unable to open file!");
$all_users = fread($myfile,filesize("../includes/users.txt"));
fclose($myfile);

$all_users_array = explode(", ", $all_users);

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
        <div class="page-heading-20">
            <h3>Student Blogs</h3>
        <p>Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta. Click on each student below to learn more about their time and experiences in the Mekong Delta.</p>
        </div>
        
        
        
      <?php 
     
        $bios = array( 
            'ThuyTranviet' => 'Thuy is the prof', 
            'MarcAlessi' => 'Hi everyone! My name is Marc Alessi and I am currently a junior at Cornell University studying atmospheric sciences.  Since I was little, I have been fascinated by the weather.  I spent countless hours watching The Weather Channel, tracking hurricanes, and reporting weather observations to the National Weather Service.  By high school, I became aware of climate change, the most important global issue my generation will have to deal with.  Recently, I have become a climate activist, advocating and protesting for such policies as clean, renewable energy and global reduction in CO2 emissions.  My college education has taught me the importance of looking at climate change as an interdisciplinary issue, rather than just a scientific one; when I studied abroad last semester in Germany, I took an international relations class that spent some time on the impact of international institutions like the UN on climate change.  Although I am more interested in the physics that drives climate change, I see myself in the future being a climate scientist that advises these international institutions.', 
            'StevanicaAugustine' => 'Hey there! My name is Stevanica Augustine, and I am currently a sophomore pursuing a double major in Development Sociology and Environmental Science and Sustainability. Ever since I was little, I was always intrigued by all that the world holds--the cities, the cultures, the people. Last year, I was fortunate enough to have been given the opportunity to spend my entire freshman year in Florence, Italy, where I traveled to 28 cities in 11 different countries. During my time abroad, I further developed my passion for traveling. I know that I want to spend my life being in all these beautiful places, but it is easy to say that when you are sitting in a café looking at the Colosseum or the Sagrada Familia. Traveling has to mean more, and that is when I became passionate about the environment. There are so many parts of the world, like the Mekong Delta, where people livelihoods face daily turmoil because of extreme environmental challenges. I hope that on this trip to Vietnam, I can listen to the stories that have not been told or have been ignored and lend a voice to them--not just for the people in Vietnam, but for everyone whose lives are impacted by climate change--and share their stories with the world.',
            'BeckyCardinali' => 'My name is Becky Cardinali, and I am a sophomore studying Economics at Cornell University. I am particularly interested in international development, so I am excited to travel to Vietnam to see firsthand how the environment affects the economy and vice versa in a developing country. I look forward to exploring the economic impacts of climate change on the Vietnamese people and practicing the small portion of the language I have learned. Outside of class, I enjoy playing soccer, canoeing, and watching movies. I grew up in central New Jersey where I developed a passion for traveling and adventure. I can’t wait to travel to Vietnam to build meaningful relationships with people across the world, be immersed in the culture and history, and educate myself and others about the critical issue of climate change.',
            'GailFletcher' => 'Hi everyone! My name is Gail Fletcher and I am a senior double majoring in History and Government.  Growing up near the heart of the Everglades, I have always been very aware of the environment and its increasing degradation. Over the years, I have witnessed the deterioration of lands and biodiversity near my home.  I gained a better understanding of the pervasiveness of the detrimental effects of climate change when I traveled to Thailand to study the effects of changing agricultural landscapes in rural areas. Inspired by what I have seen, I hope to help to improve the balance between development and environmental sustainability.  My participation in the Climate Change Awareness and Service Learning Course will aid me in realizing this goal.  While in Vietnam, I intend to learn more about the social impacts of climate change in communities in the Mekong Delta and more about the rich history and culture of the country.',
            'JeffreyFralick' => 'Hello! My name is Jeffrey Fralick and I am a junior in CALS studying Environmental Science and Sustainability with a minor in climate change.  I am from West Chester, Pennsylvania but grew up in a small town outside of Kansas City, Missouri. I have always had a fascination with the weather. This fascination quickly turned into a passion and I began my career at Cornell as an Atmospheric Science major before discovering a new passion - the environment.  My hope is to combine these two passions and focus on how the weather will impact our environment in the face of climate change.  Upon graduation, I hope to attend law school for environmental law and work to help defend people from environmental harms. I am also interested in environmental policy and working towards developing and implementing new policies to address climate change.  I took this class to further explore my passion for climate, to learn about a new culture, and to experience first-hand how climate change is impacting local farmers.',
            'TreijonJohnson' => 'How is it going? My name is Treijon Johnson, a Senior Environmental Science and Sustainability student at Cornell University. Growing up in Atlanta, I quickly developed a passion for food, wildlife, and sustainability. This is simply due to the fact that I learned to cook at an early age. Attending this trip means so much to me because I believe strongly that the effects of climate change are not only concerns for the future-- they are concerns for millions of people today. This is the story that needs to be brought to the table so that we can face this issue with more urgency and sincerity. I believe that there is no better way to build the relationships necessary to solve these problems than through culture and cuisine. Not only is food something that everyone can relate to, but there is always a deeper story behind how the food got to the plate. This is the story I hope to tell. Stay tuned :).',
            'TianaLe' => 'Xin chào! My name is Tiana Le, and I am a senior undergraduate in the Cornell College of Human Ecology studying Human Biology, Health, and Society. During the Fall of 2016, I took VIET 1121 to improve my Vietnamese language skills. I am excited to take the skills I learned in the classroom and to practice them abroad in Vietnam. I am thrilled to be given the opportunity to study Climate Change Awareness in Vietnam because I am interested in how the environment may affect the health and the mental well-being of humans. Climate change is affecting many parts of human life. I think it is important to address all these factors like health to show the impact climate change has on society. In the future, I hope to pursue a Master’s Degree in Public Health and a Medical Degree. I am looking forward to the experiences and the interactions I will have in Vietnam. I think this will help me learn about the needs of the Vietnamese people while also exploring my identity as a Vietnamese American.',
            'ConorMcCabe' => 'Greetings! My name is Conor McCabe and I am a Junior in the College of Agriculture and Life Sciences studying animal science with a focus in dairy science. I come to Cornell all the way from a small swine, pumpkin, and Christmas tree farm located just outside of Portland, OR. Upon entering college, I paired my livestock background with my love for the sciences and have grown a new passion for agriculture research to feed everyday families and I am excited to see the management decisions used by Vietnamese farmers. My interest in this course stems from my background in production agriculture and the impact that climate change has on food systems. I hope to improve upon my story telling ability during our travels by bringing back the stories of farmers who are one of the first to be combating climate change head on.',
            'KerryMullins' => 'Hello! My name is Kerry Mullins and I’m a junior studying sustainable agriculture with a minor in philosophy. I’m interested in the ethical grounding food systems and how food systems can be used to impact the health of people and communities. I grew up on and around farms, and came to Cornell thinking I wanted to be a farmer myself. However, as I’ve been exposed to endless resources here, my interests have shifted towards food justice and agricultural policy. I’m excited to travel to Vietnam and learn from farmers and business owners there, as well as see first hand how agriculture is conducted in a food system so different then ours. I am also excited to explore all the rich cuisine that Vietnam has to offer.',
            'CoreyNg' => 'What is up, I am Corey. I am a senior Ecology and Evolutionary Biology major at Cornell and I have been obsessed with the outdoors and the natural world my whole life. I want to dedicate my life to protecting those sacred places from the scourge of climate change, and plan on going to law school and working in environmental policy. I am so excited to be traveling to Vietnam and to have the opportunity to learn from the Vietnamese people about the unique pressures they are facing from the changing climate and the steps their government is taking to help alleviate those stressors. I cannot wait to explore everything the Mekong Delta has to offer!',);
     
            $bio_image = array('ThuyTranviet' => "<img src='../images/faculty.jpg' alt=''>",'MarcAlessi' => "<img src='../images/2.jpg' alt=''>", 'StevanicaAugustine' => "<img src='../images/stevanica_augustine.jpg' alt=''>", 
            'BeckyCardinali' => "<img src='../images/becky_cardinali.jpg' alt=''>", 
            'GailFletcher' => "<img src='../images/gail_fletcher.jpg' alt=''>", 
            'JeffreyFralick' => "<img src='../images/jeffrey_fralick.jpg' alt=''>", 
            'TreijonJohnson' => "<img src='../images/treijon_johnson.jpg' alt=''>", 
            'TianaLe' => "<img src='../images/tiana_le.jpg' alt=''>", 
            'ConorMcCabe' => "<img src='../images/conor_mccabe.jpg' alt=''>", 
            'KerryMullins' => "<img src='../images/kerry_mullins.jpg' alt=''>", 
            'CoreyNg' => "<img src='../images/corey_ng.jpg' alt=''>",);
            
        $allinfo = $mysqli->query("SELECT Blogs.*, Programs.*, BlogInProgram.*, UserInBlog.*, Users.* from Blogs LEFT JOIN BlogInProgram on Blogs.Blog_Id = BlogInProgram.Blog_Id LEFT JOIN Programs on BlogInProgram.Program_Id = Programs.Program_Id LEFT JOIN UserInBlog on Blogs.Blog_Id = UserInBlog.Blog_Id INNER JOIN Users on UserInBlog.User_Id = Users.User_Id GROUP BY Users.User_Id"); 
        
        $all_users_array_index = 1;
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
            $user = $all_users_array[$all_users_array_index];
            $all_users_array_index = $all_users_array_index+1;
            
            foreach($bio_image as $key => $value) {
                if ($key == $user) {
                echo("<div class='biopix'>");
                echo $value . " <br> <br>";
                echo("</div>");
                }
            }
            
            foreach($bios as $key => $value) {
                if ($key == $user) {
                echo("<div class='bios'>");
                echo $value;
                
                
                }
            }
            echo(" Click to read <a href='winter2017.php?user_id=$all_users_array_index'>$user's</a> blogs.</p>"); echo("</div>");
            echo"<br>";
            echo"<br>";
            
            echo("</div>");
    }
 
 } else if (isset($_GET['user_id'])){
    $user_id=($_GET['user_id']);
 
  ?>   
    <div class="page-heading-20">
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
            
            echo("<div class='page-heading-17'>");
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

	</div>

    <div class="footer-bar"><br>© SAIL 2017</div>
	<script type="text/javascript" src="../scripts/script.js"></script> 
</body>