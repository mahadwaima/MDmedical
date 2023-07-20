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
    $stmt = $dbh->prepare("SELECT tbldoctor.*  , tblspecialization.Specialization AS Spec 
    FROM tbldoctor 
    INNER JOIN  tblspecialization ON tblspecialization.ID = tbldoctor.Specialization
    WHERE tbldoctor.house = true ") ;
    $stmt->execute();
    $rows = $stmt->fetchAll() ; 
    // End Fetch Patient information 
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

  </head>
    
    <body> 
        <main>
            <?php include_once('includes/header.php');?>

<!-- ############ Start Code ######## -->
<!-- home section starts  -->

<section class="home" id="home">


    <h1>Home Visiting Doctors</h1>
    <table class="main-table table table-primary">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Doctor</th>
      <th scope="col">Specialization</th>
      <th scope="col">Phone</th>
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
      <td><?php echo $a;  ?></td>
      <td><?php echo $row['FullName'] ;  ?></td>
      <td><?php echo $row['Spec'] ;  ?></td>
      <td><?php echo $row['MobileNumber'] ;  ?></td>
      <td><a href="takeorder.php?dID=<?php echo $row['ID'] ?>" class="myBtn">Booking</a></td>
    </tr>
    <?php } ?>

  </tbody>
</table>
</section>


<?php 

?>

</main>
<!-- ############ End Code ######## -->


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