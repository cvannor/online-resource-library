<?php

/**
 * NSBE Support functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package NSBE_Support
 */

$dbconnect1 = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if (!function_exists('nsbe_support_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function nsbe_support_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on NSBE Support, use a find and replace
		 * to change 'nsbe-support' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('nsbe-support', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'menu-1' => esc_html__('Primary', 'nsbe-support'),
		));

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('nsbe_support_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;
add_action('after_setup_theme', 'nsbe_support_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nsbe_support_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('nsbe_support_content_width', 640);
}
add_action('after_setup_theme', 'nsbe_support_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nsbe_support_widgets_init()
{
	register_sidebar(array(
		'name'          => esc_html__('Sidebar', 'nsbe-support'),
		'id'            => 'sidebar-1',
		'description'   => esc_html__('Add widgets here.', 'nsbe-support'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	));
}
add_action('widgets_init', 'nsbe_support_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function nsbe_support_scripts()
{
	wp_enqueue_style('nsbe-support-style', get_stylesheet_uri());

	//wp_enqueue_script('nsbe-support-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);

	wp_enqueue_script('nsbe-support-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);
	wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css');

	wp_enqueue_script('query_js', get_template_directory_uri() . '/js/jquery.min.js');
	//wp_enqueue_script('popper_js', get_template_directory_uri() . '/js/popper.min.js');

	wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js');

	wp_enqueue_script('scripts_js', get_template_directory_uri() . '/js/scripts.js');

	wp_enqueue_script('jscookie_js', get_template_directory_uri() . '/js/js.cookie.js');
	//wp_enqueue_script('dropdown_js', get_template_directory_uri() . '/js/dropdown.js');

	wp_localize_script('scripts_js', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));

	/*wp_enqueue_script( 'upload_js', get_template_directory_uri() . '/upload.js');


    wp_localize_script( 'upload_js', 'myAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));  */

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'nsbe_support_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action("wp_ajax_test_action", "test_action");
add_action("wp_ajax_nopriv_test_action", "test_action");

function test_action()
{
	echo "This worked";
	die();
}


add_action("wp_ajax_upload_action", "upload_action");
add_action("wp_ajax_nopriv_upload_action", "upload_action");

if (isset($_POST['submit'])) {
	upload_action();
}

function upload_action()
{
	$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (isset($_POST['major'])) {

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
		$path = "/home1/cvannor/onlineresourcelibrary.curtisvannor.com/resources/" . $file;
		move_uploaded_file($tmp_name, $path);

		$date = date("Y-m-d");
		$time = date("h:i:sa");

		$queryinsert2 = "INSERT INTO resources (department, course_title, course_code, resource_type, resource_name, brief_desc, date) VALUES ('$major', '$coursetitle', '$courseid', '$resourcetype', '$file', '$briefdesc', CAST('$date' AS DATE))";

		if (!mysqli_query($dbconnect, $queryinsert2)) {
			printf("error: %s\n", mysqli_error($dbconnect));
			die('error');
		}
		echo '<div style="width:100%; height: 100%; text-align: center; background-color: #e2e2e2;"><h1 style="
		color: grey;
		text-align: center;
		padding-top: 90px;" class="confirmation">Thank you for your contribution!</h1><a style="
		font-size: 20px;
		font-weight: bold;
		color: white;
		right: 10px;
		border-radius: 10px;
		border: 2px solid white;
		padding: 10px;
		background-color: rgb(63, 169, 245);
		text-decoration: none;
		/* font-weight: 600; */
		text-align: center;
		margin: 0 auto;" class="view-resources-btn" href="http://onlineresourcelibrary.curtisvannor.com/find-resources">View All Resources</a></div>';
		die();
	}
}

add_action("wp_ajax_filter_action", "filter_action");
add_action("wp_ajax_nopriv_filter_action", "filter_action");

function filter_action()
{
	$dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	if (isset($_POST['course']) && isset($_POST['year']) && isset($_POST['type']) && isset($_POST['department'])) {
		$course = $_POST['course'];
		$year = $_POST['year'];
		$dept = $_POST['department'];
		$type = $_POST['type'];

		$string = "course_title = '$course'";
		$string2 = "department='$dept'";
		$string3 = "resource_type= '$type'";
		$string4 = "YEAR(date)= '$year'";

		$where = "WHERE";

		$count = 3;
		$ands = array();

		if ($course == "" || $course == "all") {
			$string = "";
			$count = $count - 1;
		}
		if ($year == "" || $year == "all") {
			$string4 = "";
			$count = $count - 1;
		}
		if ($dept == "" || $dept == "all") {
			$string2 = "";
			$count = $count - 1;
		}
		if ($type == "" || $type == "all") {
			$string3 = "";
			$count = $count - 1;
		}

		for ($i = 0; $i < 3; $i++) {
			if ($i < $count) {
				$ands[$i] = "AND";
			} else {
				$ands[$i] = "";
			}
		}

		if ($count == -1) {
			$where = "";
		}

		$sql = "SELECT * FROM resources $where $string $ands[0] $string2 $ands[1] $string3 $ands[2] $string4";
	} elseif (isset($_POST['search'])) {
		$search = mysqli_real_escape_string($dbconnect, $_POST['search']);
		$sql = "SELECT * FROM resources WHERE brief_desc LIKE '%$search%' OR course_title LIKE  '%$search%' OR department LIKE '%$search%' OR course_code LIKE '%$search%'";
	} elseif (isset($_POST['reset'])) {
		$sql = "SELECT * FROM resources";
	}

	$rows = array();
	$output = "";
	$the_query = mysqli_query($dbconnect, $sql);
	$queryres = mysqli_num_rows($the_query);

	if ($queryres > 0) {
		while ($row = mysqli_fetch_assoc($the_query)) {
			//$rows[] = $item_row;
			$ctitle = $row['course_title'];
			$ccode = $row['course_code'];
			$resourcetype = $row['resource_type'];
			$date = $row['date'];
			$maj = $row['department'];
			$desc = $row['brief_desc'];
			$id = $row['id'];

			if ($resourcetype == 'class-notes') {
				$res = "Class Notes";
			} else if ($resourcetype == 'study-guide') {
				$res = "Study Guide";
			} else if ($resourcetype == 'reports') {
				$res = "Reports";
			} else if ($resourcetype == 'other') {
				$res = "Other";
			} else if ($resourcetype == 'homework') {
				$res = "Homework";
			} else if ($resourcetype == 'essay') {
				$res = "Essay";
			} else {
				$res = "Syllabus";
			}



			$output .= '<div class="card" style="width: 18rem;">
			<div class="card-body">
			  <a href="http://onlineresourcelibrary.curtisvannor.com/resource?id=' . $id . '"><h5 class="card-title">' . $desc . '</h5></a>
			  <h6 class="card-subtitle mb-2 text-muted">' . $maj . ' | ' . $ccode . '-' . $ctitle . '</h6>
			  <p class="card-text">Type: ' . $res . '</p>
			  <p class="card-text">Date Added: ' . $date . '</p>
	
			</div>
		  </div>';
		};
	};

	echo $output;
	die();
}

function get_items()
{

	global $dbconnect1;
	$rows = array();
	$sql = "SELECT * FROM resources";
	$the_query = mysqli_query($dbconnect1, $sql);
	while ($item_row = mysqli_fetch_assoc($the_query)) {
		$rows[] = $item_row;
	}
	return $rows;
}

function get_majors()
{
	global $dbconnect1;
	$majors = array();
	$sql2 = "SELECT DISTINCT department FROM resources";
	$query = mysqli_query($dbconnect1, $sql2);

	while ($row = mysqli_fetch_assoc($query)) {
		$majors[] = $row['department'];
	}
	return $majors;
}

function get_courses()
{
	global $dbconnect1;
	$courses = array();
	$sql2 = "SELECT DISTINCT course_title, course_code FROM resources";
	$query = mysqli_query($dbconnect1, $sql2);

	while ($row = mysqli_fetch_assoc($query)) {
		$courses[] = $row;
	}
	return $courses;
}

function get_type()
{
	global $dbconnect1;
	$types = array();
	$sql2 = "SELECT DISTINCT resource_type FROM resources";
	$query = mysqli_query($dbconnect1, $sql2);

	while ($row = mysqli_fetch_assoc($query)) {
		$types[] = $row['resource_type'];
	}
	return $types;
}

function get_year()
{

	global $dbconnect1;
	$types = array();
	$sql2 = "SELECT DISTINCT YEAR(date) FROM resources";
	$query = mysqli_query($dbconnect1, $sql2);

	while ($row = mysqli_fetch_assoc($query)) {
		$types[] = $row['YEAR(date)'];
	}
	return $types;
}
