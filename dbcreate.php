<?php 

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

// Check connection
if(!$conn){  
    die('Could not connect: '.mysqli_connect_error());  
}  
    echo 'Connected successfully<br/>';  
  
//Example sql table, edit variable for your own
    $sql = "CREATE TABLE `resources` (
  `department` varchar(60) CHARACTER SET latin1 NOT NULL,
  `course_title` varchar(60) CHARACTER SET latin1 NOT NULL,
  `course_code` varchar(20) CHARACTER SET latin1 NOT NULL,
  `resource_type` varchar(60) CHARACTER SET latin1 NOT NULL,
  `resource_name` varchar(60) CHARACTER SET latin1 NOT NULL,
  `brief_desc` varchar(100) CHARACTER SET latin1 NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL
)";
    if(mysqli_query($conn, $sql)){  
        echo "Table created successfully";  
    } else {  
        echo "Table is not created successfully ";  
    } 

    mysqli_close($conn);  

?>