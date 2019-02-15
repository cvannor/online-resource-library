<?php
if (isset($_GET['id']) && isset($_GET['u']) && isset($_GET['e']) && isset($_GET['p'])) {
	// Connect to database and sanitize incoming $_GET variables
    $dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
    $id = mysqli_real_escape_string($dbconnect, $_GET['id']); 
	$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
	$e = mysqli_real_escape_string($dbconnect, $_GET['e']);
	$p = $_GET['p'];
	// Evaluate the lengths of the incoming $_GET variable
	if($id == "" || strlen($u) < 3 || strlen($e) < 5 || $p == ""){
		// Log this issue into a text file and email details to yourself
        echo '<div>string length issues</div>'; 
        echo $id ;
        echo $u  ;
        echo $e  ;
        echo $p  ;
            
        exit(); 
	}
	// Check their credentials against the database
	$sql = "SELECT * FROM members WHERE blazerid='$id' AND username='$u' AND uabemail='$e' AND password='$p' LIMIT 1";
    $query = mysqli_query($dbconnect, $sql);
	$numrows = mysqli_num_rows($query);
	// Evaluate for a match in the system (0 = no match, 1 = match)
	if($numrows == 0){
		// Log this potential hack attempt to text file and email details to yourself
		echo '<div>Your credentials are not matching anything in our system</div>';
        echo $id ;
        echo $u  ;
        echo $e  ;
        echo $p  ;
    	exit();
	}
	// Match was found, you can activate them
	$sql = "UPDATE members SET activated='1' WHERE blazerid='$id' LIMIT 1";
    $query = mysqli_query($dbconnect, $sql);
	// Optional double check to see if activated in fact now = 1
	$sql = "SELECT * FROM members WHERE blazerid='$id' AND activated='1' LIMIT 1";
    $query = mysqli_query($dbconnect, $sql);
	$numrows = mysqli_num_rows($query);
	// Evaluate the double check
    if($numrows == 0){
		// Log this issue of no switch of activation field to 1
        echo '<h2>Activation Error</h2> Sorry there seems to have been an issue activating your account at this time. We have already notified ourselves of this issue and we will contact you via email when we have identified the issue.';
    	exit();
    } else if($numrows == 1) {
		// Great everything went fine with activation!
        echo '<h2>Activation Success</h2> Your account is now activated. <a href="login.php">Click here to log in</a>';
    	exit();
    }
} else {
	// Log this issue of missing initial $_GET variables
	echo "missing_GET_variables";
    exit(); 
}


get_header();
?>

<?php
get_sidebar();
get_footer();
