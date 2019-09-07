<?php
    get_header();
    $dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
    if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM resources WHERE id='$id'";

    $the_query = mysqli_query($dbconnect, $sql);
    while($row = mysqli_fetch_array($the_query))
    {
        $desc = $row['brief_desc'];
        $ctitle = $row['course_title'];
        $ccode = $row['course_code'];
        $type = $row['resource_type'];
        $date = $row['date'];
        $sub = $row['department'];
        $user = $row['upload_user_id'];
        $time = $row['time'];
        $name = $row['resource_name'];
        
    }
        
        if ($type == 'class-notes'){
            $t =  "Class Notes";
        }else if($type == 'study-guide'){
            $t = "Study Guide";
                                            
        }else if($type == 'reports'){
            $t = "Reports";
                                            
        }else if($type == 'other'){
            $t = "Other";
                                            
        }else if($type == 'homework'){
            $t = "Homework";
                                            
        }else if($type == 'essay'){
            $t = "Essay";
                                            
        }else{
            $t = "Syllabus";
        }
                                        
        
    $status = "Working";
    }else{
        echo "Id not found";
    }

?>

<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <!--<section class="jbtrn jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
                    <p class="lead text-muted"><?php echo $ctitle ?></p>
    
                </div>
            </section>-->
            <div class="container resource-cont">
                <div class="row res-cont">
                    <div class="col-md-7">
                        <?php 
                            $ftype = pathinfo($name, PATHINFO_EXTENSION);;
                            if ($ftype == "doc"||$ftype == "docx"){
                        ?>    
                                <iframe src='https://docs.google.com/gview?src=file:///resources/<?= $name ?>' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>

                                
                        <?php         
                            }else{
                        ?>
                                <iframe class="doc" src="/resources/<?= $name ?>"></iframe>

                        <?php
                            }
                        ?>
                        
                    </div>
                    <div class="col-md-5">
                        <h2><?php echo $desc ?></h2>
                        <h4><?php echo ''.$ctitle.'-'.$ccode.'' ?></h4>
                        <h5><?php echo $sub ?></h5>
                        <h6><?php echo $t ?></h6>
                        <p>Date added: <?php echo ''.$date.'' ?></p>
                        <a href="http://onlineresourcelibrary.curtisvannor.com/download/?id=<?= $id ?>" class="btn btn-primary">Download</a>
                    </div>
                    
   
                </div>
            </div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
