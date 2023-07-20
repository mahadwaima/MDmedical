<?php

//error_reporting(0);
include('includes/dbconnection.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    $newpass = rand(123456654 , 654663211) ;
    $hashedPass = md5($newpass) ;
    $email      = $_POST['email'] ; 
    $check = $dbh->prepare("SELECT * FROM tplpatients WHERE email = ?") ;
    $check->execute(array($email));
    $count = $check->rowCount();
    if($count > 0) {
        require_once 'mail.php' ;
        $mail->setFrom('damsdamsweb@gmail.com', 'DAMS');
        $mail->addAddress($email);               //Name is optional
        $mail->Subject = 'إعادة تعيين كلمة المرور';
        $mail->Body    = "كلمة السر الجديدة : " . "<strong>$newpass</strong>";
        $mail->send() ;
        $stmt = $dbh->prepare("UPDATE tplpatients SET password = ? WHERE email = ? "); 
        $stmt->execute(array($hashedPass , $email)); 
    } else { 
        echo "<div class='container'>" ;
        echo "لم يتم العثور على البريد الالكتروني " ;
        echo "</div>"; 
    }           }
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
	<h4 class="form-title m-b-xl text-center">Reset Password</h4>
	<form method="POST" name="login">
		<div class="form-group">
			<input type="text" class="form-control" placeholder="Enter Registered Email ID" required="true" name="email">
		</div>		
		<input type="submit" class="btn btn-primary" name="login" value="Sign IN">
	</form>
	<hr />
	<a href="login.php">Login</a>
</div><!-- #login-form -->



	</div><!-- .simple-page-wrap -->
</body>
</html>
