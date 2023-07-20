<?php
session_start();

if (!isset($_SESSION['patient'])) {
    header("Location: login.php"); 
    exit() ;
} else {


//error_reporting(0);
include('doctor/includes/dbconnection.php');
// Start Fetch Patient information 
    $patientid = $_SESSION['patient'] ;
    $stmt = $dbh->prepare("SELECT * FROM tplpatients WHERE ID = ?");
    $stmt->execute(array($patientid));
    $pat = $stmt->fetch(); 
// End Fetch Patient information 
    if(isset($_POST['submit']))
  {



$pid=$_POST['pid'];
$doctor=$_POST['doctor'];
$name=$_POST['name'];
$mobnum=$_POST['phone'];
$email=$_POST['email'];
$appdate=$_POST['date'];
$aaptime=$_POST['time'];
$address=$_POST['address'];
$aptnumber=mt_rand(100000000, 999999999);
$cdate=date('Y-m-d');


$stmt = $dbh->prepare("SELECT * FROM tblappointment WHERE AppointmentDate = ? AND AppointmentTime = ?  AND Doctor = ?");
$stmt->execute(array($appdate , $aaptime  , $doctor)) ;
$count = $stmt->rowCount() ;
if($count > 0 ) {
    echo "<div class='alert alert-danger text-center'> This date is already booked, please choose another date </div>" ;
} else {

if($appdate<=$cdate){
       echo '<script>alert("Appointment date must be greater than todays date")</script>';
} else {
$stmt = $dbh->prepare("INSERT  INTO tblappointment(AppointmentNumber, Name, MobileNumber, Email,AppointmentDate, AppointmentTime, Doctor ,  Address,ApplyDate , PID ,Status, inhouse)VALUES(? , ?, ? ,? ,? ,? ,? ,?,?,? ,'Waiting', 1 )");
$stmt->execute(array($aptnumber , $name , $mobnum , $email , $appdate , $aaptime ,$doctor ,  $address  , $cdate , $pid)) ;

   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your Appointment Request Has Been Send. We Will Contact You Soon")</script>';
    echo "<script>window.location.href ='house.php'</script>";

  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
}
}
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
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>

  <!-- font awesome style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Roboto:400,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />



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


            <!-- appointmenting section starts   -->
<div></div>
<section class="appointment" id="appointment">

<h1 class="heading"> <span>home appointment </span> reservation </h1>    

<div class="row">

    <div class="image">
        <img src="images/house.jpg" alt="">
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <?php


        if(isset($message)) {
            foreach($message as $message) {
            echo'<p class ="message">'.$message.'</p>';
        }
        }
    ?>
  
        <h3>Make Appointment</h3>
        
        <input type="hidden"name="pid" placeholder="your name" class="box" value="<?php echo $pat['ID'] ; ?>">
        <input type="hidden"name="doctor" placeholder="your name" class="box" value="<?php echo $doctor = isset($_GET['dID']) ? $_GET['dID']  : 0 ;  ; ?>">
        <input type="text"name="name" placeholder="your name" class="box" value="<?php echo $pat['fullname'] ; ?>">
        <input type="telephone" name="phone" id="phone" placeholder="Enter Phone Number"   maxlength="10" class="box" value="<?php echo $pat['phone'] ; ?>">
        <input type="email"name="email" placeholder="your email" class="box" value="<?php echo $pat['email'] ; ?>">
        <input type="date"name="date" class="box">
        
        <select name="time" id="time" class="box">
            <option value="">Choose the timing</option>
            <?php 
            $hours = array("8:30 AM" , "9:00 AM" , "10:00 AM" , "10:30 AM" , "11:00 AM" , "11:30 AM" , "12:00 PM" , "12:30PM" , "1:00 PM" , "1:30 PM" , "2:00 PM", "2:30 PM" , "3:00 PM" , "3:30 PM" , "4:00 PM" , "4:30 PM" , "5:00 PM" , "5:30 PM") ;
                foreach($hours AS $hour) {
            
            echo "<option value='$hour '> $hour </option>" ;
                }
            ?>
        </select>
        
        <textarea class="box" rows="5" id="message" name="address" placeholder="Enter Your Address"></textarea>
        <button type="submit" class="btn" name="submit" id="submit-button">Book Now</button>  
</form>

</div>

</section>

<!-- appointmenting section ends -->
<?php include_once('includes/footer.php');?>

        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/script.js"></script>

    </body>
</html>

<?php
}

?>