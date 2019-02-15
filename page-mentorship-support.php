<?php
$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
if isset($_GET['send']){
    $sub = trim($_POST['subject']);
    
}
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NSBE_Support
 */
// If user is logged in, header them away

get_header();

?>


<div id="primary" class="content-area">
		<main id="main" class="site-main">
            <header class="entry-header">
                <section class="jbtrn jumbotron text-center">
                    <div class="container">
                        <h1 class="jumbotron-heading"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></h1>
                        <p class="lead text-muted">Here you can contact us about any issues or for help. We will reply to you through email.</p>
                    </div>
                </section>
            </header><!-- .entry-header -->
            <div class="container">
                <div class="row login-row">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="request.php">

                            <label for="subject">What do you need help with?</label>
                            <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                            <input name="send" type="submit" value="Submit">

                        </form>
                        
                    </div>
                </div>
                <div class="row">
                    <!--<h3 class="mentor-h1">Tips and FAQ</h3>-->
                    <div class="content">
                    <?php
		                  while ( have_posts() ) :
			              the_post();
                          the_content();

		                  endwhile; 
		            ?>
                    </div>
                    
                </div>
            </div>

            

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
