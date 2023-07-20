<?php
session_start();
if(isset($_SESSION['patient'])){
    header("Location: appointment.php");
}
error_reporting(0);
include('includes/dbconnection.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ; 
    $password = md5($_POST['password']); 
    $stmt = $dbh->prepare("SELECT * FROM tplpatients WHERE email = ? AND password = ? AND active = 1") ; 
    $stmt->execute(array($email , $password)) ; 
    $row = $stmt->fetch(); 
    $count = $stmt->rowCount(); 
    if($count > 0 ) {
        $_SESSION['patient'] = $row['ID'] ; 
        header("Location: appointment.php") ;
        exit(); 
    } else {
        $err =  "email or password entered is incorrect";
 }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<title>DAMS - Login Page</title>
	

	<link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/core.css">
	<link rel="stylesheet" href="assets/css/misc-pages.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
</head>
<body class="simple-page">
	<div id="back-to-home">
		<a href="index.php" class="btn btn-outline btn-default"><i class="fa fa-home animated zoomIn"></i></a>
	</div>
	<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			
				<span style="color: white"><i class="fa fa-gg"></i></span>
				<span style="color: white">DAMS</span>
			
		</div><!-- logo -->
		<div class="simple-page-form animated flipInY" id="login-form">
            <?php if(isset($err)) {
                echo "<div class='alert alert-danger'> " . $err . "</div>"  ;
            }?> 
	<h4 class="form-title m-b-xl text-center">Sign In With Your DAMS Account</h4>
	<form method="POST" name="login">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Enter Registered Email ID" required="true" name="email">
		</div>

		<div class="form-group">
			<input type="password" class="form-control" placeholder="Password" name="password" required="true">
		</div>

		
		<input type="submit" class="btn btn-primary" name="login" value="Sign IN">
	</form>
	<hr />
	<a href="signup.php">Signup/Registration</a>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p><a href="forgot-password.php">FORGOT YOUR PASSWORD ?</a></p>
	
</div><!-- .simple-page-footer -->


	</div><!-- .simple-page-wrap -->
</body>
</html>