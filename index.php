<?php
session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');
    if(isset($_POST['submit']))
  {
 $name=$_POST['name'];
  $mobnum=$_POST['phone'];
 $email=$_POST['email'];
 $appdate=$_POST['date'];
 $aaptime=$_POST['time'];
 $specialization=$_POST['specialization'];
  $doctorlist=$_POST['doctorlist'];
 $message=$_POST['message'];
 $aptnumber=mt_rand(100000000, 999999999);
 $cdate=date('Y-m-d');

if($appdate<=$cdate){
       echo '<script>alert("Appointment date must be greater than todays date")</script>';
} else {
$sql="insert into tblappointment(AppointmentNumber,Name,MobileNumber,Email,AppointmentDate,AppointmentTime,Specialization,Doctor,Message)values(:aptnumber,:name,:mobnum,:email,:appdate,:aaptime,:specialization,:doctorlist,:message)";
$query=$dbh->prepare($sql);
$query->bindParam(':aptnumber',$aptnumber,PDO::PARAM_STR);
$query->bindParam(':name',$name,PDO::PARAM_STR);
$query->bindParam(':mobnum',$mobnum,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':appdate',$appdate,PDO::PARAM_STR);
$query->bindParam(':aaptime',$aaptime,PDO::PARAM_STR);
$query->bindParam(':specialization',$specialization,PDO::PARAM_STR);
$query->bindParam(':doctorlist',$doctorlist,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);

 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Your Appointment Request Has Been Send. We Will Contact You Soon")</script>';
echo "<script>window.location.href ='index.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
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

<section class="home" id="home">

    <div class="image">
        <img src="images/Doc1.gif" alt="">
    </div>

    <div class="content">
        <h3>We take care of your healthy life</h3>
        <p> Welcome to our Cloud-Based Platform, where we offer a range of medical fields to cater to your healthcare needs. Whether you require orthopedics, internal medicine, ophthalmology, family medicine, chest medicine, anesthesia, pathology, pediatrics, or general surgery, we have you covered. 
            By making an appointment, you can conveniently choose the specific service and doctor you prefer. Don't wait any longer—register now to benefit from our exceptional healthcare services. Your well-being is our priority.</p>
        <a href="appointment.php" class="btn"> Book an appointment now <span class="fas fa-chevron-right"></span> </a>
    </div>

</section>

<!-- home section ends --><!-- icons section starts  -->

<section class="icons-container">

<div class="icons">
    <i class="fas fa-user-md"></i>
    <h3>150+</h3>
    <p>doctors at work</p>
</div>

<div class="icons">
    <i class="fas fa-users"></i>
    <h3>1030+</h3>
    <p>satisfied patients</p>
</div>

<div class="icons">
    <i class="fas fa-procedures"></i>
    <h3>490+</h3>
    <p>bed facility</p>
</div>

<div class="icons">
    <i class="fas fa-hospital"></i>
    <h3>70+</h3>
    <p>available hospitals</p>
</div>

</section>

<!-- icons section ends -->

<!-- about section starts  -->
<section class="about" id="about">

<h1 class="heading"> <span>About</span> Us </h1>

<div class="row">

    <div class="image">
        <img src="images/Doc.gif" alt="">
    </div>

    <div class="content">
        <h3>Take the world's best quality treatment</h3>
        <p>We are a dedicated team of innovators transforming healthcare in the Gaza Strip. Our cloud-based platform,
             specialized medical trucks, and remote consultations break down barriers and provide convenient access to quality care. Our mission is to make a lasting impact,
             fostering a healthier and more resilient community. Together, we shape the future of healthcare in Gaza.</p>
    </div>

</div>

</section>
<!-- about section ends -->
<!-- services section starts  -->

<section class="services" id="services">

    <h1 class="heading"> our <span>services</span> </h1>

    <div class="box-container ">

        <div class="box">
            <i class="fas fa-notes-medical"></i>
            <h3>Free checkups</h3>
            <p>We offer complimentary checkups to ensure your health and well-being. 
                Regular screenings and assessments are essential for early detection and prevention of health issues.</p>
            
        </div>

        <div class="box">
            <i class="fas fa-ambulance"></i>
            <h3>24/7 Ambulance</h3>
            <p> In case of emergencies, our dedicated ambulance service is available around the clock, 
                providing swift and efficient transportation to the nearest medical facility.
</p>
            
        </div>

        <div class="box">
            <i class="fas fa-user-md"></i>
            <h3>Expert doctors</h3>
            <p>Our team consists of highly skilled and experienced doctors who are committed to delivering personalized and quality care. You can trust in their expertise and knowledge.</p>
           
        </div>

        <div class="box">
        <i class="fas fa-user-nurse"></i>
            <h3>Various treatment services</h3>
            <p>We offer a wide range of treatment services, catering to diverse medical needs. Whether it's orthopedics, internal medicine, ophthalmology, family medicine, chest medicine, anesthesia, pathology, pediatrics, or general surgery, we have specialized care available.</p>
           
        </div>
        <div class="box">
        <i class="fas fa-prescription-bottle-alt"></i>
            <h3>Pharmacy equipped with medicines</h3>
            <p>Our pharmacy is well-stocked with essential medicines, ensuring that you have access to the medications you need for your treatment and recovery.</p>
           
        </div>
        <div class="box">
        <i class="fas fa-clinic-medical"></i>
            <h3>Home services</h3>
            <p>We understand that accessing healthcare can be challenging for some individuals. To address this, we provide home services, bringing medical care to your doorstep, making it convenient and accessible.</p>
           
        </div>
    </div>

</section>


<!-- services section ends -->
<!-- blogs section starts  -->

<section class="blogs" id="blogs">

    <h1 class="heading"> Our <span>Blogs</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="images/blog-1.jpg" alt="">
            </div>
            <div class="content">
                <div class="icon">
                    <a href="#"> <i class="fas fa-calendar"></i> 21 november, 2022 </a>
                    <a href="#"> <i class="fas fa-user"></i> by win coder </a>
                </div>
                <h3>blog title win coder goes here</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident, eius.</p>
                <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
        </div>

        
        <div class="box">
            <div class="image">
                <img src="images/blog-4.jpg" alt="">
            </div>
            <div class="content">
                <div class="icon">
                    <a href="#"> <i class="fas fa-calendar"></i> 21 november, 2022 </a>
                    <a href="#"> <i class="fas fa-user"></i> by win coder </a>
                </div>
                <h3>blog title win coder goes here</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident, eius.</p>
                <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
        </div>
        <div class="box">
            <div class="image">
                <img src="images/blog-5.jpg" alt="">
            </div>
            <div class="content">
                <div class="icon">
                    <a href="#"> <i class="fas fa-calendar"></i> 21 november, 2022 </a>
                    <a href="#"> <i class="fas fa-user"></i> by win coder </a>
                </div>
                <h3>blog title win coder goes here</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Provident, eius.</p>
                <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
            </div>
        </div>


    </div>

</section>

<!-- blogs section ends -->

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