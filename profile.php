<?php 
session_start();
if(!isset($_SESSION['patient'])) {
    header("Location: login.php") ; 
    exit() ;
} else {
//error_reporting(0);
include('doctor/includes/dbconnection.php');
// Start Fetch Patient information 
    $patientid = $_SESSION['patient'] ;
    $stmt = $dbh->prepare("SELECT * FROM tplpatients WHERE ID = ?") ;    
    $stmt->execute(array($patientid));
    $row = $stmt->fetch  () ; 
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Doctor Appointment Management System || Home Page</title>
<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <!-- CSS FILES -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link href="css/bootstrap-icons.css" rel="stylesheet">

        <link href="css/owl.carousel.min.css" rel="stylesheet">

        <link href="css/owl.theme.default.min.css" rel="stylesheet">

        <link href="css/templatemo-medic-care.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

        <script>
function getdoctors(val) {
  //  alert(val);
$.ajax({

type: "POST",
url: "get_doctors.php",
data:'sp_id='+val,
success: function(data){
$("#doctorlist").html(data);
}
});
}
</script>
    </head>
    
    <body>
    
        <main>

            <?php include_once('includes/header.php');?>

<!-- home section starts  -->
<?php
        if($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = $_POST['username'] ;
            $full = $_POST['fullname'] ;
            $password = empty($_POST['newpassword']) ? $_POST['oldpassword'] : md5($_POST['newpassword']); 
            $stmt = $dbh->prepare("UPDATE tplpatients SET username = ? , fullname = ? , password = ? WHERE ID = ?") ;
            $stmt->execute(array($username , $full , $password , $patientid)) ;
            header("Refresh: 0 ") ;
        }
?>
<section class="home" id="home">
<div class="container w-50">
                    <form class="myform" action="" method="POST">
                        <div class="form-group row mt-3 ">
                            <label class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" name="username" class=" form-control"autocomplete="off"  required="required" value="<?php echo $row['username'] ?>"> 
                            </div>
                        </div>
                   
                        <div class="form-group row mt-3">
                                <label class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-10 ">
                                    <input type="text" name="fullname" class="form-control" autocomplete="off" required="required" value="<?php echo $row['fullname'] ; ?>">
                                </div>
                        </div>

                        <div class="form-group row mt-3">
                                    <label class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10 c">
                                        <input type="hidden" name="oldpassword" class="form-control" value="<?php echo $row['password'] ; ?>">
                                        <input type="password" name="newpassword" class="form-control" autocomplete="new-password" placeholder="Leave Blank  If You Don't Want To Change">
                                        <input type="submit" value="Save " class="myBtn mt-3">
                                    </div>
                        </div>

                    </form>
            </div>
</section>


<?php 
}
?>

</main>
        <?php include_once('includes/footer.php');?>
        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>