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
    $stmt = $dbh->prepare("SELECT tblappointment.* , tbldoctor.FullName AS doctorname
     FROM tblappointment
    LEFT JOIN tbldoctor ON tbldoctor.ID = tblappointment.Doctor
    WHERE tblappointment.PID = ? AND tblappointment.Status != 'Deleted'") ;    
    $stmt->execute(array($patientid));
    $rows = $stmt->fetchAll() ; 
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


    <h1>My appointments</h1>
    <table class="main-table table table-primary text-center">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Doctor</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
      <th scope="col">Status</th>
      <th scope="col">Place</th>
      <th scope="col">Appointment Number</th>
      <th scope="col">Control</th>  
    </tr>
  </thead>
  <tbody>
      <?php 
          $a = 0 ;
        foreach($rows as $row) {
          $a++ ; 
      ?>
    <tr>
      <th scope="row"><?php echo $a ?></th>
      <td><?php echo $row['doctorname'] ;  ?></td>
      <td><?php echo $row['AppointmentDate'] ;  ?></td>
      <td><?php echo $row['AppointmentTime'] ;  ?></td>
      <td><?php echo $row['Status'] ;  ?></td>
      <td><?php echo $row['inhouse'] == 1 ? "House" : "Clinic" ;  ?></td>
      <td><?php echo $row['AppointmentNumber'] ;  ?></td>
      <td><a href="cancel.php?appid=<?php echo $row['ID'] ?>" class="myBtn">Delete</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>
</section>
<!-- Start Show Medicine -->

    
<section class="blogs" id="blogs">
    <div class="container">
<h2>My Prescription</h2>
      <div class="c_boxes">
          <?php
            $stmt = $dbh->prepare("SELECT prescription.*  , tbldoctor.FullName AS Doctor_Name , 
            tblpharmacy.M_Name , tblpharmacy.Image
            FROM prescription
            INNER JOIN tbldoctor ON tbldoctor.ID = prescription.DID 
            INNER JOIN tblpharmacy ON tblpharmacy.ID = prescription.Prescription_Name 
            WHERE PID = ? ") ; 
            $stmt->execute(array($patientid)); 
            $rows = $stmt->fetchAll(); 
             foreach ($rows as $row) { ?>
              <div class="c_box">
                <img src="images/uploads/<?php echo $row['Image']; ?>" alt="">
                <div class="content">
                  <span><i class="fa fa-capsules"></i> <?php echo $row['M_Name'] ; ?></span>
                  <span class="text-left "> <i class="fa fa-user"></i> <?php echo $row['Doctor_Name'] ; ?></span>
                  <p>
                    <a  data-bs-toggle="collapse" href="#collapseExample-<?php echo $row['ID']; ?>" role="button" aria-expanded="false" aria-controls="collapseExample-<?php echo $row['ID']; ?>">
                    <i class="fa fa-notes-medical"></i>  Notes 
                    </a>
                  </p>
                </div>
                <div class="collapse" id="collapseExample-<?php echo $row['ID']; ?>">
                  <div class="card card-body">
                    <p>
                    <?php echo $row['Notes'] ; ?>
                    </p>
                </div>
                </div>
              </div>
            <?php } ?>
        </div>
        <!-- End Show Medicine -->
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