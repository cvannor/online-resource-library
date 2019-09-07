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
    <main id="main" style="background-color: #d7e8f7 !important;" class="site-main">
        <!--<h9 class="big-text">We want to help you reach the finish line.</h9>
                <div class="dark-screen">
                    <div class="banner-art">
                    </div>
                </div>-->
        <section class="index-jumbo">
            <div class="container">
                <h1 class="jumbotron-heading">Online Resource Library</h1>
                <p class="lead">Access high quality study materials to get better grades</p>
                <div class="row">
                    <div class="col-md-9">
                        <a class="view-resources-btn" href="http://onlineresourcelibrary.curtisvannor.com/find-resources/">Click Here To Find Resources!</a>

                    </div>
                    <div class="col-md-3">
                    </div>
                </div>
            </div>
        </section>
        <div class="resource-options">
            <div class="resource-card">
                <img style="padding-top:15px" src="http://onlineresourcelibrary.curtisvannor.com/wp-content/uploads/2019/08/Group-1.png" alt="Get better grades image" width="140" height="140">
                <h4 style="margin-bottom:28px">Get Better Grades</h4>
                <p>Find high quality study materials to help you pass your tests!</p>
            </div>
            <div class="resource-card middle-card">
                <img style="padding-top: 2px;" src="http://onlineresourcelibrary.curtisvannor.com/wp-content/uploads/2019/08/piggy-bank.png" alt="Save Money image" width="140" height="140">
                <h4>Save Money</h4>
                <p>Save money on extra study materials and use this open source library for what you need!</p>
            </div>
            <div class="resource-card">
                <img style="padding-top:30px;" src="http://onlineresourcelibrary.curtisvannor.com/wp-content/uploads/2019/08/charity.png" alt="Contribute image" width="140" height="140">
                <h4>Make a contribution</h4>
                <p>Contribute to the success of others and add some of your class materials!</p>
            </div>

        </div>
        <div class="container">
            <div class="row courses-departments">
                <div class="col-md-6">
                    <h2>Find your department:</h2>
                    <p>Get resources for the major you're studying.</p>
                    <ul>
                        <?php
                        $major_list = get_majors();
                        foreach ($major_list as $one) {
                            $major = $one;
                            ?>
                            <li>
                                <button class="majors-btn" name="<?php echo $major?>" style="padding: 0;background-color: transparent;border: 0px;"><?php echo $major ?></button>

                            </li>

                        <?php
                        }
                        ?>
                    </ul>

                </div>
                <div class="col-md-6">
                    <h2>Find your course:</h2>
                    <p>Find stuff for a particular course.</p>
                    <ul>
                        <?php
                        $course_list = get_courses();
                        foreach ($course_list as $this) {
                            $code = $this['course_code'];
                            $title = $this['course_title'];
                            ?>
                            <li><button class="courses-btn" style="padding: 0;background-color: transparent;border: 0px;" name="<?php echo $title?>"><?php echo '' . $code . '-' . $title . '' ?></button>
                            </li>


                        <?php
                        }
                        ?>

                    </ul>

                </div>
            </div>
        </div>
        <!--<div class="container">
            <div class="row resource-options">
                <div class="col-md-3">
                    <h2>What are you looking for?</h2>
                    <p>Search based on the type of resource you need.</p>
                </div>
                <div class="col-md-3">
                    <div class="resource-card">
                        <img class="rounded-circle" src="http://onlineresourcelibrary.curtisvannor.com/wp-content/uploads/2019/08/iconfinder_icon-61_667366-300x300.png" alt="Resourses image" width="140" height="140">
                        <h2>Download Resources</h2>
                        <p>Download notes, homework, tests, reports and more to help with your courses</p>
                        <p><a class="btn btn-secondary" href="http://onlineresourcelibrary.curtisvannor.com/index.php/find-resources/" role="button">Download Resource &raquo;</a></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="resource-card">
                        <img class="rounded-circle" src="http://onlineresourcelibrary.curtisvannor.com/wp-content/uploads/2019/08/iconfinder_icon-61_667366-300x300.png" alt="Resourses image" width="140" height="140">
                        <h2>Download Resources</h2>
                        <p>Download notes, homework, tests, reports and more to help with your courses</p>
                        <p><a class="btn btn-secondary" href="http://onlineresourcelibrary.curtisvannor.com/index.php/find-resources/" role="button">Download Resource &raquo;</a></p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="resource-card">
                        <img class="rounded-circle" src="http://onlineresourcelibrary.curtisvannor.com/wp-content/uploads/2019/08/iconfinder_icon-61_667366-300x300.png" alt="Resourses image" width="140" height="140">
                        <h2>Download Resources</h2>
                        <p>Download notes, homework, tests, reports and more to help with your courses</p>
                        <p><a class="btn btn-secondary" href="http://onlineresourcelibrary.curtisvannor.com/index.php/find-resources/" role="button">Download Resource &raquo;</a></p>
                    </div>
                </div>

            </div>

            <div class="row featurette feat-one">
                    <?php
                    $args1 = array(
                        'orderby' => 'date',
                        'posts_per_page' => 3,
                        'order' => 'DESC',
                        'category_name' => 'upcoming-events'
                    );
                    $loop = new WP_Query($args1);
                    while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php endwhile; ?>
                    
                    <div class="col-md-7">
                        <h2 class="featurette-heading">Upcoming Events</h2>
                        <hr class="featurette-divider">
                        <h3><span class="text-muted"><?php the_title(); ?></span></h3>
                        <p class="lead"> <?php the_excerpt(); ?></p>
                    </div>
                    <div class="col-md-5">
                        <?php if (has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID); ?>
                    </div>
                    <?php wp_reset_query(); ?>
                </div>-->


        <!--<div class="row featurette feat-two">
                    <?php
                    $args1 = array(
                        'orderby' => 'date',
                        'posts_per_page' => 3,
                        'order' => 'DESC',
                        'category_name' => 'recent-events'
                    );
                    $loop = new WP_Query($args1);
                    while ($loop->have_posts()) : $loop->the_post(); ?>
                    <?php endwhile; ?>
                    
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading">Recent Events</h2>
                        <hr class="featurette-divider">
                        <h3><span class="text-muted"><?php the_title(); ?></span></h3>
                        <p class="lead"> <?php the_excerpt(); ?></p> 
                    </div>
                    <div class="col-md-5 order-md-1">
                        <?php if (has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID); ?>
                    </div>
                    <?php wp_reset_query(); ?>
                </div>-->
</div>


</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
