<?php
get_header();
$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
if(isset($_POST['add2'])){
    
        $major = trim($_POST['major']);
		$major = mysqli_real_escape_string($dbconnect, $major);
		
		$coursetitle = trim($_POST['course-title']);
		$coursetitle = mysqli_real_escape_string($dbconnect, $coursetitle);

		$courseid = trim($_POST['course-id']);
		$courseid = mysqli_real_escape_string($dbconnect, $courseid);
		
		$resourcetype = trim($_POST['resource-type']);
		$resourcetype = mysqli_real_escape_string($dbconnect, $resourcetype);
    
        $briefdesc = trim($_POST['desc-short']);
		$briefdesc = mysqli_real_escape_string($dbconnect, $briefdesc);

        $file = $_FILES["file"]["name"];
        $tmp_name = $_FILES["file"]["tmp_name"];
        $path = "/home1/cvannor/bossantiques.com/resources/".$file;
        move_uploaded_file($tmp_name,$path);
    
        $date = date("Y-m-d");
        $time = date("h:i:sa");
    
        $queryinsert2 = "INSERT INTO resources (department, course_title, course_code, resource_type, resource_name, brief_desc, date, time) VALUES ('$major', '$coursetitle', '$courseid', '$resourcetype', '$file', '$briefdesc', CAST('$date' AS DATE), CAST('$time' AS TIME))";
    
        if(!mysqli_query($dbconnect, $queryinsert2)){
            echo $major;
            echo $coursetitle;
            echo $courseid;
            echo $resourcetype;
            echo $file;
            printf("error: %s\n", mysqli_error($dbconnect));
            die('error');

        }
        $newrecord = '<h1 class="response">Thank you! Resource has been added!</h1>';
}
?>

	<div id="primary" class="content-area upload-page">
		<main id="main" class="site-main">
            <header class="entry-header h-resources">
                <section class="jbtrn jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
                    <p class="lead text-muted">Add anything that you would like to share from your previous courses.</p>
    
                </div>
            </section>
            </header><!-- .entry-header -->  
            <div class="container upload-cont">
                <div class="row">
                    <div class="col-md-12">
                        <h1><?php echo $newrecord;?></h1>
                       <form method="post" action="" enctype="multipart/form-data">
                           <p>*=required</p>
                            <table class="table">
                                <tr>
                                    <th>Subject(Department) *</th>
                                    <td><input type="text" name="major" required></td>
                                </tr>
                                <tr>
                                    <th>Course Title *</th>
                                    <td><input type="text" name="course-title" required></td>
                                </tr>
                                <tr>
                                    <th>Course ID *</th>
                                    <td><input type="text" name="course-id" required></td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td><input type="text" name="desc-short"></td>
                                </tr>
                                <tr>
                                    <th>Resource Type</th>
                                    <td><select name="resource-type">
                                        <option value="class-notes">Notes</option>
                                        <option value="essay">Essay</option>
                                        <option value="syllabus">Syllabus</option>
                                        <option value="study-guide">Study Guide</option>
                                        <option value="reports">Report</option>
                                        <option value="other">Other</option>
                                        <option value="homework">Homework</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Upload Resource</th>
                                    <td><input type="file" name="file" id="filename" required></td>
                                </tr>
                            </table>
                            <input type="submit" name="add2" value="Add" class="btn btn-primary">
                            <input type="reset" value="cancel" class="btn btn-default">
                            <!--<div class="progress">
                                <div id="progressBar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                                    0%
                                </div>
                            </div>-->
                        </form>
                    </div>
                </div>
            </div>
                    
            <script>
  
              
                
            </script>
            

		
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
