<?php
get_header();
$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
?>

<div class="results-container">
<?php
    if(isset($_POST['search-submit'])){
        $search = mysqli_real_escape_string($dbconnect, $_POST['search']);
        $sql = "SELECT * FROM resources WHERE brief_desc LIKE '%$search%' OR course_title LIKE  '%$search%' OR department LIKE '%$search%' OR course_code LIKE '%$search%'";
        $result = mysqli_query($dbconnect,$sql);
        $queryres = mysqli_num_rows($result);
        
        if ($queryres > 0){
            
        }else{
            echo "<h1>Sorry no results have been found.</h1>";
        }
        
    }
    
?>

</div>
