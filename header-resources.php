<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NSBE_Support
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'nsbe-support'); ?></a>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if (is_front_page() && is_home()) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				$nsbe_support_description = get_bloginfo('description', 'display');
				if ($nsbe_support_description || is_customize_preview()) :
					?>
					<p class="site-description"><?php echo $nsbe_support_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
			<nav id="site-navigation" class="main-navigation">
				<div class="toggle-btn" onclick="toggleSidebar()">
					<span></span>
					<span></span>
					<span></span>
				</div>
				<div class="search-section">
					<form id="async-search" method="POST" action="" enctype="multipart/form-data">

						<div class="input-group">

							<input id="search-content" type="text" onkeypress="return tableInputKeyPress(event)" class="searchbox form-control" placeholder="What are you looking for?" name="search" required />

							<div class="input-group-btn">

								<button id="search-submit-btn" type="button" name="search-submit" class="sbutton btn btn-default"><i class="fas fa-search"></i></button>
							</div>

						</div>

					</form>

				</div>
				<div class="" <?php
								wp_nav_menu(array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
								));
								?> </nav> <!-- #site-navigation -->
					<script>
						function toggleSidebar() {
							document.getElementById("sidebar").classList.toggle('active');
						}

						function _(x) {
							return document.getElementById(x);
						}


						function tableInputKeyPress(e) {
							e = e || window.event;
							var key = e.keyCode;
							if (key == 13) //Enter
							{

								//do you task here...
								return false; //return true to submit, false to do nothing
							}
						}
					</script>

					<div id="sidebar" class="sidebar-nav">
						<div class="toggle-btn2" onclick="toggleSidebar()">
							<span></span>
							<span></span>
							<span></span>
						</div>
						<?php
						wp_nav_menu(array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						));
						?>
					</div>

					<?php

					$link = admin_url('admin-ajax.php?action=test_action');


					?>



					<div class="filters">
						<div>

							<div class="dropdown">
								<button onclick="toggleBtn(this)" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Resource Type
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
										<input type="radio" name="type" value="all" autocomplete="off">
										All Types
									</label>
									<?php
									$type_list = get_type();
									foreach ($type_list as $type) {
										if ($type == 'class-notes') {
											$res = "Class Notes";
										} else if ($type == 'study-guide') {
											$res = "Study Guide";
										} else if ($type == 'reports') {
											$res = "Reports";
										} else if ($type == 'other') {
											$res = "Other";
										} else if ($type == 'homework') {
											$res = "Homework";
										} else if ($type == 'essay') {
											$res = "Essay";
										} else {
											$res = "Syllabus";
										}

										?>
										<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
											<input type="radio" name="type" value="<?php echo $type ?>" autocomplete="off">
											<p><?php echo $res ?></p>
										</label>
									<?php
									}
									?>
								</div>
							</div>
							<div class="dropdown">
								<button onclick="toggleBtn(this)" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Course
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
										<input type="radio" name="course" value="all" autocomplete="off">
										All Courses
									</label>
									<?php
									$course_list = get_courses();
									foreach ($course_list as $this) {
										$code = $this['course_code'];
										$title = $this['course_title'];
										?>
										<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
											<input type="radio" name="course" value="<?php echo $title ?>" autocomplete="off">
											<p><?php echo '' . $code . '-' . $title . '' ?></p>
										</label>
									<?php
									}
									?>
								</div>
							</div>
							<div class="dropdown">
								<button onclick="toggleBtn(this)" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Year
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
										<input type="radio" name="year" value="all" autocomplete="off">
										All Years
									</label>
									<?php
									$date_list = get_year();
									foreach ($date_list as $one) {
										$date = $one;
										?>
										<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
											<input type="radio" name="year" value="<?php echo $date ?>" autocomplete="off">
											<p><?php echo $date ?></p>
										</label>
									<?php
									}
									?>
								</div>
							</div>
							<div class="dropdown">
								<button onclick="toggleBtn(this)" class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Department
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<label class="btn btn-block btn-sm btn-ghost btn-outline-secondary">
										<input type="radio" name="dept" value="all" autocomplete="off">
										All Departments
									</label>
									<?php
									$major_list = get_majors();
									foreach ($major_list as $one) {
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
							</div>
							<!--<button class="reset-btn" onclick="resetBtn()">
								<i class="fas fa-sync-alt"></i>
								Reset
							</button>-->
						</div>
					</div>
				</div>


	</div>

	</header><!-- #masthead -->

	<div id="content" class="site-content">