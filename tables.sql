--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Author_Name` varchar(255) NOT NULL,
  `Hash_Password` varchar(255) NOT NULL,
  PRIMARY KEY (`User_Id`),
  UNIQUE KEY `idx_unique_Author_Name` (`Author_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Blogs`
--

CREATE TABLE `Blogs` (
  `Blog_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) NOT NULL,
  `Image_File_Path` varchar(255),
  `Content` varchar(255) NOT NULL,
  PRIMARY KEY (`Blog_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `Programs`
--

CREATE TABLE `Programs` (
  `Program_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Program_Name` varchar(255) NOT NULL,
  `Program_Date` varchar(255) NOT NULL,
  PRIMARY KEY (`Program_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `UserInBlog`
--

CREATE TABLE `UserInBlog` (
  `User_Id` int(11) NOT NULL,
  `Blog_Id` int(11) NOT NULL,
  PRIMARY KEY (`User_Id`,`Blog_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `BlogInProgram`
--

CREATE TABLE `BlogInProgram` (
  `Blog_Id` int(11) NOT NULL,
  `Program_Id` int(11) NOT NULL,
  PRIMARY KEY (`Blog_Id`,`Program_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Table structure for table `UserInProgram`
--

CREATE TABLE `UserInProgram` (
  `User_Id` int(11) NOT NULL,
  `Program_Id` int(11) NOT NULL,
  PRIMARY KEY (`User_Id`,`Program_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Update Blogs table to include a timestamp date for blog posts
--

ALTER TABLE Blogs
ADD Date date NOT NULL;