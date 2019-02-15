<?php
get_header('resources');
$dbconnect1 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);

 
function get_items(){
    
    global $dbconnect1;
    $rows = array();
    $sql = "SELECT * FROM resources";
    $the_query = mysqli_query($dbconnect1, $sql);
    while($item_row = mysqli_fetch_assoc($the_query))
    {
        $rows[] = $item_row;
    }
    return $rows;
}

function get_majors(){
    global $dbconnect1;
    $majors = array();
    $sql2 = "SELECT DISTINCT department FROM resources";
    $query = mysqli_query($dbconnect1,$sql2);
    
    while($row = mysqli_fetch_assoc($query)){
        $majors[] = $row['department'];
    }
    return $majors;
}

function get_courses(){
    global $dbconnect1;
    $courses = array();
    $sql2 = "SELECT DISTINCT course_title, course_code FROM resources";
    $query = mysqli_query($dbconnect1,$sql2);
    
    while($row = mysqli_fetch_assoc($query)){
        $courses[] = $row;
    }
    return $courses;
}

function get_type(){
    global $dbconnect1;
    $types = array();
    $sql2 = "SELECT DISTINCT resource_type FROM resources";
    $query = mysqli_query($dbconnect1,$sql2);
    
    while($row = mysqli_fetch_assoc($query)){
        $types[] = $row['resource_type'];
    }
    return $types;
}


?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <section class="jbtrn jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
                    <p class="lead">Here you can find notes, reports and essays from previous semesters. Search for what you need or filter by department, course, and type.</p>
    
                </div>
            </section>
            <div class="search-section">
                    <form method="POST" class="search-form"   action="http://nsbe.bossantiques.com/csearch/">
 
                        <div class="input-group">
	
                            <input type="text" class="searchbox form-control" placeholder="What are you looking for?"  name="search" required/>
  
                            <div class="input-group-btn">

                                <button type="submit" name="search-submit" class="sbutton btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
 
                        </div>

                    </form>
      
                </div>
            <div class="container-fluid">
                <div class="row">
                    <button type="button" class="btntoggle btn btn-block btn-outline-secondary d-md-none" data-toggle="toggle" data-target="#search-filters">Toggle filters</button>
                    <div class="col-md-3 filters">
                        <form action="" method="POST" id="search-filters" class="d-md-block d-none">
                            <fieldset class="form-group">
                                <legend>Department:</legend>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
                                       <input type="radio" name="dept" value="all" autocomplete="off">
                                        All Departments
                                    </label>
                        <?php
                        $major_list = get_majors();
                        foreach($major_list as $one)
                        {
                            $major = $one;
                        ?>
                            <label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
                                        <input type="radio" name="dept" value="<?php echo $major ?>" autocomplete="off">
                                        <p><?php echo $major ?></p>
                            </label>
                        <?php 
                        }
                        ?>
                                </div>
                                <script>
                                    $(".btntoggle").on('click',function(){
                                        document.getElementById("search-filters").classList.toggle('d-none');
                                    });
                                </script>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend>Course:</legend>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
                                        <input type="radio" name="course" value="all" autocomplete="off">
                                        All Courses
                                    </label>
                                    <?php
                                    $course_list = get_courses();
                                    foreach($course_list as $this)
                                    {
                                        $code = $this['course_code'];
                                        $title = $this['course_title'];
                                    ?>
                                    <label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
                                        <input type="radio" name="course" value="<?php echo $code ?>" autocomplete="off">
                                        <p><?php echo ''.$code.'-'.$title.'' ?></p>
                                    </label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </fieldset>
                            <fieldset class="form-group">
                                <legend>Resource Type:</legend>
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
                                        <input type="radio" name="type" value="all" autocomplete="off">
                                        All Types
                                    </label>
                                    <?php
                                    $type_list = get_type();
                                    foreach($type_list as $type)
                                    {
                                        if ($type == 'class-notes'){
                                            $res = "Class Notes";
                                        }else if($type == 'study-guide'){
                                            $res = "Study Guide";
                                            
                                        }else if($type == 'reports'){
                                            $res = "Reports";
                                            
                                        }else if($type == 'other'){
                                            $res = "Other";
                                            
                                        }else if($type == 'homework'){
                                            $res = "Homework";
                                            
                                        }else if($type == 'essay'){
                                            $res = "Essay";
                                            
                                        }else{
                                            $res = "Syllabus";
                                        }
                                        
                                    ?>
                                    <label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
                                        <input type="radio" name="type" value="<?php echo $res ?>" autocomplete="off">
                                        <p><?php echo $res ?></p>
                                    </label>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <div class="col-md-9 maincontent">
                        <div class="topborder"></div>
                        
                        <?php
                        $resources = get_items($sql);
                        foreach($resources as $this)
                        {
                            
                            $desc = $this['brief_desc'];
                            $ctitle = $this['course_title'];
                            $ccode = $this['course_code'];
                            $type = $this['resource_type'];
                            $date = $this['date'];
                            $sub = $this['department'];
                            $user = $this['upload_user_id'];
                            $time = $this['time'];
                            $id = $this['id'];
                            
                        ?>    
                            
                            <div class="container-fluid this">
                                <div class="row">
                                <div class="col-sm-2 imgsection">
                                    <a href=""><img class="placeholder" src="http://nsbe.bossantiques.com/wp-content/uploads/sites/3/2018/12/iconfinder_18_2958204.png"></a>
                                </div>
                                    <div class="col-sm-4"><a href="http://nsbe.bossantiques.com/resource/?id=<?= $id ?>"><h1><?php echo $desc ?></h1><p><?php echo $sub ?></p><p><?php echo ''.$ctitle.'-'.$ccode.'' ?></p></a>
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
                    
                        ?>
                    </div>
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
