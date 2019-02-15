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
function randStrGen($len){
	$result = "";
    $chars = "abcdefghijklmnopqrstuvwxyz0123456789$$$$$$$1111111";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}

// Ajax calls this REGISTRATION code to execute
if(isset($_POST["create"])){
	// CONNECT TO THE DATABASE
    $dbconnect = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES
	$u = preg_replace('#[^a-z0-9]#i', '', $_POST['username']);
	$e = mysqli_real_escape_string($dbconnect, $_POST['email']);
	$p1 = $_POST['pass1'];
	$p2 = $_POST['pass2'];
    $fn= mysqli_real_escape_string($dbconnect, $_POST['fname']);
    $ln= mysqli_real_escape_string($dbconnect, $_POST['lname']);
    $m = mysqli_real_escape_string($dbconnect, $_POST['major']);
    $phone = mysqli_real_escape_string($dbconnect, $_POST['phone']);
    $blazeid = mysqli_real_escape_string($dbconnect, $_POST['blazerid']);
	// GET USER IP ADDRESS
    $ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));
	// DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
	$sql3 = "SELECT blazerid FROM members WHERE username='$u' LIMIT 1";
    $query1 = mysqli_query($dbconnect, $sql3); 
	$u_check = mysqli_num_rows($query1);
	// -------------------------------------------
	$sql2 = "SELECT blazerid FROM members WHERE uabemail='$e' LIMIT 1";
    $query2 = mysqli_query($dbconnect, $sql2); 
	$e_check = mysqli_num_rows($query2);
    
    if ($u_check > 0){ 
        echo '<div class="error">The username you entered is alreay taken. Please go back.</div>';
        exit();
    } else if ($p1 != $p2){
        echo '<div class="error">Passwords do not match. Please go back.</div>';
        exit();
	} else if ($e_check > 0){ 
        echo '<div class="error">That email address is already in use in the system. Please go back.</div>';
        exit();
	} else if (strlen($u) < 3 || strlen($u) > 16) {
        echo '<div class="error">Username must be between 3 and 16 characters. Please go back.</div>';
        exit(); 
    } else if (is_numeric($u[0])) {
        echo '<div class="error">Username cannot begin with a number. Please go back.</div>';
        exit();
    } else if (strpos($e,'@')==false){
        echo '<div class="error">Invalid Email. Please go back.</div>';
        exit();
        
    }else{

    $cryptpass = crypt($p2);
    $p_hash = randStrGen(20)."$cryptpass".randStrGen(20);
    $sign_date = date('Y-m-d H:i:s');
		// Add user info into the database table for the main site table
    $sql = "INSERT INTO members (username, uabemail, password, fname, blazerid, lname, ip, phone, major, lastlogin, signup) VALUES('$u','$e','$p_hash','$fn','$blazeid','$ln', '$ip', '$phone', '$m', CAST('$sign_date' AS DATETIME), CAST('$sign_date' AS DATETIME))";
    
    if(!mysqli_query($dbconnect, $sql)){
        printf("error: %s. Please go back.\n", mysqli_error($dbconnect));
        exit();
    }else{  
        
        $to = "$e";							 
        $from = "nsbesupport@bossantiques.com";
        $subject = 'yoursitename Account Activation';
		$message = '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>yoursitename Message</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:24px; font-size:17px;">Hello '.$u.',<br /><br />Click the link below to activate your account when ready:<br /><br /><a href="http://nsbe.bossantiques.com/account-activation/?id='.$blazeid.'&u='.$u.'&e='.$e.'&p='.$p_hash.'&id='.$blazeid.'">Click here to activate your account now</a><br /><br />Login after successful activation using your:<br />* E-mail Address: <b>'.$e.'</b></div></body></html>';
		$headers = "From: $from\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
		wp_mail($to, $subject, $message, $headers);
        echo '<p class="confirm">Thank you! Please check '.$e.' to activate your account</p>';
        echo 'Or, go <a href="http://www.nsbe.bossantiques.com">home</a>.';
        exit();
    }
    }
}

get_header();

?>



<script>
function _(x){
    return document.getElementById(x);
}

function restrict(elem){
	var tf = _(elem);
	var rx = new RegExp;
	if(elem == "email"){
		rx = /[' "]/gi;
	} else if(elem == "username"){
		rx = /[^a-z0-9]/gi;
	}
	tf.value = tf.value.replace(rx, "");
}
function emptyElement(x){
	_(x).innerHTML = "";
}
    
function signup(){
	var u = _("username").value;
	var e = _("email").value;
	var p1 = _("pass1").value;
	var p2 = _("pass2").value;
	var fn = _("fname").value;
	var ln = _("lname").value;
	var m = _("major").value;
	var phone = _("phone").value;
	var blazeid = _("blazerid").value;
	var status = _("status");
    if(p1 != p2){
		status.innerHTML = "Your password fields do not match";
	}else {
					window.scrollTo(0,0);
					_("signupform").innerHTML = "OK "+u+", check your email inbox and junk mail box at <u>"+e+"</u> in a moment to complete the sign up process by activating your account. You will not be able to do anything on the site until you successfully activate your account.";
				}
}
    


</script>


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
                        <form name="signupform" id="signupform" method="post" action="" enctype="multipart/form-data">
                            <p>*=required</p>
                            <table class="table">
                                <tr>
                                    <th>First Name *</th>
                                    <td><input type="text" name="fname" required></td>
                                </tr>
                                <tr>
                                    <th>Last Name *</th>
                                    <td><input type="text" name="lname"  required></td>
                                </tr>
                                <tr>
                                    <th>Blazed ID *</th>
                                    <td><input type="text" name="blazerid" required></td>
                                </tr>
                                <tr>
                                    <th>UAB Email *</th>
                                    <td><input id="email" name="email" type="text" onkeyup="restrict('email')" required></td>
                                </tr>
                                <tr>
                                    <th>Major *</th>
                                    <td><input type="text" name="major" required></td>
                                </tr>
                                <tr>
                                    <th>Create Username *</th>
                                    <td><input id ="username" name="username" type="text" onkeyup="restrict('username')" required>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Create Password *</th>
                                    <td><input name="pass1" type="password" required></td>
                                </tr>
                                <tr>
                                    <th>Confirm Password *</th>
                                    <td><input name="pass2" type="password" required></td>
                                </tr>
                            </table>
                            <input type="submit" name="create" value="Sign Up" class="btn btn-primary">
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
