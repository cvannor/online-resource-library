<?php
get_header();
$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
?>

<div class="results-container">
    <div class="results-header">
        <h1 class="search-title">Search Results</h1>
        <a href="http://nsbe.bossantiques.com/find-resources/">Back to all resources
        </a>
    </div>

<?php
    if(isset($_POST['search-submit'])){
        $search = mysqli_real_escape_string($dbconnect, $_POST['search']);
        $sql = "SELECT * FROM resources WHERE brief_desc LIKE '%$search%' OR course_title LIKE  '%$search%' OR department LIKE '%$search%' OR course_code LIKE '%$search%'";
        $result = mysqli_query($dbconnect,$sql);
        $queryres = mysqli_num_rows($result);
        
        if ($queryres > 0){
            while($row = mysqli_fetch_assoc($result)){
                
                $desc = $row['brief_desc'];
                $ctitle = $row['course_title'];
                $ccode = $row['course_code'];
                $type = $row['resource_type'];
                $date = $row['date'];
                $sub = $row['department'];
                $user = $row['upload_user_id'];
                $time = $row['time'];
                $id = $row['id'];
?>   
                <div class="container-fluid this">
                    <div class="row">
                        <div class="col-sm-2 imgsection">
                            <a href=""><img class="placeholder" src="http://nsbe.bossantiques.com/wp-content/uploads/sites/3/2018/12/iconfinder_18_2958204.png"></a>
                        </div>
                        <div class="col-sm-4">
                            <a href="http://nsbe.bossantiques.com/resource/?id=<?= $id ?>"><h1><?php echo $desc ?></h1><p><?php echo $sub ?></p><p><?php echo ''.$ctitle.'-'.$ccode.'' ?></p></a>
                        </div>
                        <div class="col-sm-3">
                                        
                        </div>
                        <div class="col-sm-3 extrainfo">
                                <p><?php 
                                if ($type == 'class-notes'){
                                    echo "Class Notes";
                                }else if($type == 'study-guide'){
                                    echo "Study Guide";
                                            
                                }else if($type == 'reports'){
                                    echo "Reports";
                                            
                                }else if($type == 'other'){
                                    echo "Other";
                                            
                                }else if($type == 'homework'){
                                    echo "Homework";
                                            
                                }else if($type == 'essay'){
                                    echo "Essay";
                                            
                                }else{
                                    echo "Syllabus";
                                }
                                ?></p>
                                <p>Date added: <?php echo $date ?></p>
                                    
                        </div>
                                
                    </div> 
                </div>
    
<?php 
            }
            
        }else{
            echo "<h2>Sorry, no results have been found.</h2>";
        }
        
    }
    
?>

</div>
