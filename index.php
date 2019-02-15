<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package NSBE_Support
 */

get_header();
?>
<?php
$post_id = 78;
$queried_post = get_post($post_id);
$title = $queried_post->post_title;
$content = $queried_post->post_content;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
             <!--<h9 class="big-text">We want to help you reach the finish line.</h9>
                <div class="dark-screen">
                    <div class="banner-art">
                    </div>
                </div>-->
            <section class="jumbotron text-center index-jumbo">
                <div class="container">
                    <h1 class="jumbotron-heading"><?php echo $title ?></h1>
                    <hr class="featurette-divider">
                    <p class="lead text-muted"><?php echo $content ?></p>
                </div>
            </section>
            <div class="container-fluid">
                
                <div class="row marketing">
                    <div class="col-lg-6">
                        <img class="rounded-circle" src="http://nsbe.bossantiques.com/wp-content/uploads/sites/3/2018/12/iconfinder_icon-61_667366.png" alt="Resourses image" width="140" height="140">
                        <h2>Download Resources</h2>
                        <p>Download notes, homework, tests, reports and more to help with your courses</p>
                        <p><a class="btn btn-secondary" href="http://nsbe.bossantiques.com/find-resources/" role="button">Download Resource &raquo;</a></p>
                    </div>
                    <div class="col-lg-6">
                        <img class="rounded-circle" src="http://nsbe.bossantiques.com/wp-content/uploads/sites/3/2019/01/download.png" alt="Mentorship image" width="140" height="140">
                        <h2>Upload Resources</h2>
                        <p>Upload materials that you have from your previouse courses and help other succeed.</p>
                        <p><a class="btn btn-secondary" href="http://nsbe.bossantiques.com/upload-resources/" role="button">Upload Resources &raquo;</a></p>
                    </div>

                </div>
            
                <!--<div class="row featurette feat-one">
                    <?php
                    $args1 = array(
                        'orderby' =>'date',
                        'posts_per_page' => 3,
                        'order' => 'DESC',
                        'category_name'=>'upcoming-events'
                    );
                    $loop = new WP_Query( $args1 );
                    while ( $loop->have_posts() ) : $loop->the_post();?>
                    <?php endwhile; ?>
                    
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Upcoming Events</h2>
                        <hr class="featurette-divider">
                        <h3><span class="text-muted"><?php the_title(); ?></span></h3>
                        <p class="lead"> <?php the_excerpt(); ?></p>
                    </div>
                    <div class="col-md-5">
                        <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID); ?>
                    </div>
                    <?php wp_reset_query(); ?>
                </div>-->


                <!--<div class="row featurette feat-two">
                    <?php
                    $args1 = array(
                        'orderby' =>'date',
                        'posts_per_page' => 3,
                        'order' => 'DESC',
                        'category_name'=>'recent-events'
                    );
                    $loop = new WP_Query( $args1 );
                    while ( $loop->have_posts() ) : $loop->the_post();?>
                    <?php endwhile; ?>
                    
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">Recent Events</h2>
                        <hr class="featurette-divider">
                        <h3><span class="text-muted"><?php the_title(); ?></span></h3>
                        <p class="lead"> <?php the_excerpt(); ?></p> 
                    </div>
                    <div class="col-md-5 order-md-1">
                        <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID); ?>
                    </div>
                    <?php wp_reset_query(); ?>
                </div>-->
            </div>
            
                      
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
