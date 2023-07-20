<?php 
session_start();
// error_reporting(0);
include('includes/dbconnection.php');

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$code = md5(rand(0 , 100));	
    $username = $_POST['username'] ;
    $full = $_POST['full'] ;
    $email = $_POST['email'] ;
    $password = $_POST['password'] ;
    $hashedPass = md5($password) ;
    $phone = $_POST['phone'] ;
    $formErrors = array();
    if (!preg_match('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.(com|edu|gov|org|net|mil)\b/', $email)) {
        $formErrors[] = "Please enter the email correctly";
    }
    if(empty($formErrors)) {
        $check = $dbh->prepare("SELECT * FROM tplpatients WHERE email = ?") ; 
        $check->execute(array($email)) ;
        $count = $check->rowCount(); 
        if($count == 0 ) {


			require_once "mail.php" ;
							$mail->setFrom('damsdamsweb@gmail.com', 'DAMS');
                            $mail->addAddress($email) ; 

                            $mail->Subject = "رابط التحقق من البريد الإلكتروني" ;
                            $mail->Body  =  "رابط التحقق هو " . "<a href='http://localhost/ma/signup.php?activatecode=$code'><strong>$code</strong></a>" ; 
                          $success = $mail->send();

						   if(isset($success)) {
							$suc = "<div class='alert alert-success'>Verification link has been successfully sent to the entered email</div>" ;
							$stmt = $dbh->prepare("INSERT INTO tplpatients(username ,fullname ,email , password , phone , code) VALUES(? , ? , ? , ? , ? , ?)") ;
							$stmt->execute(array($username , $full , $email , $hashedPass , $phone ,$code)) ;
						   } else {
							$suc = "<div class='alert alert-danger'>No Internet</div>" ;
						   }
        } else {
            $formErrors[] = "This email already exists.";
        }
    }
}
if(isset($_GET['activatecode'])) {
	$code = isset($_GET['activatecode'])? $_GET['activatecode'] : 0 ;
	$stmt = $dbh->prepare("UPDATE tplpatients SET active = 1 WHERE code = ?") ; 
	$stmt->execute(array($code));
	header("Location: login.php") ;
	exit(); 
}
?>


<!doctype html>
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
    <span style="color: white">DAMS</span><br>
    </div><!-- logo -->
  
    <div class="simple-page-form animated flipInY" id="login-form">
    <?php 
        if(!empty($formErrors)) {
            foreach($formErrors as $error ) {
                echo "<div class='alert alert-danger text-center'>" .  $error . "</div>"; 
            }
        }
		
		// print successfully message 
		echo isset($suc) ? $suc : '' ;
    ?>
	<h4 class="form-title m-b-xl text-center">Sign Up With Your DAMS Account</h4>
	<form action="" method="POST">
		<div class="form-group">
			<input id="fname" type="text" class="form-control" placeholder="User Name" name="username" required="true">
		</div>
		<div class="form-group">
			<input id="fname" type="text" class="form-control" placeholder="Full Name" name="full" required="true">
		</div>
		<div class="form-group">
			<input id="email" type="email" class="form-control" placeholder="Email" name="email" required="true">
		</div>
		<div class="form-group">
			<input id="mobno" type="text" class="form-control" placeholder="Mobile" name="phone" maxlength="10" pattern="[0-9]+" required="true">
		</div>
		<div class="form-group">
			<input id="password" type="password" class="form-control" placeholder="Password" name="password" required="true">
		</div>
		<input type="submit" class="btn btn-primary" value="Register" name="submit">
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p>
		<small>Do you have an account ?</small>
		<a href="login.php">SIGN IN</a>
	</p>
</div>


	</div><!-- .simple-page-wrap -->
</body>
</html>