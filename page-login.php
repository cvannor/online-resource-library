<?php
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
                        <p class="lead text-muted"><?php
		while ( have_posts() ) :
			the_post();
            the_content();

		endwhile; 
		?></p>
                    </div>
                </section>
            </header><!-- .entry-header -->
            <div class="container">
                <div class="row login-row">
                    <div class="col-md-12">
                        <form name="loginform" id="loginform" method="post" action="" enctype="multipart/form-data">
                            <p>*=required</p>
                            <table class="table">
                                <tr>
                                    <th>Email</th>
                                    <td><input id="email" name="email" type="text" onkeyup="restrict('email')" required></td>
                                </tr>
                                <tr>
                                    <th>Password</th>
                                    <td><input name="pass1" type="password" required></td>
                                </tr>
                               
                            </table>
                            <input type="submit" name="create" value="Login" class="btn btn-primary">
                            <span id="status"><?php echo $outcome ?></span>
                        </form>
                        
                    </div>
                </div>
            </div>

            

		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_sidebar();
get_footer();
