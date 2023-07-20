<?php 


session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['pharmid']==0)) {
  header('location:logout.php');
  } else{ 
       ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        
        <title>DAMS || All Appointment Detail</title>
        
        <link rel="stylesheet" href="libs/bower/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="libs/bower/material-design-iconic-font/dist/css/material-design-iconic-font.css">
        <!-- build:css assets/css/app.min.css -->
        <link rel="stylesheet" href="libs/bower/animate.css/animate.min.css">
        <link rel="stylesheet" href="libs/bower/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="libs/bower/perfect-scrollbar/css/perfect-scrollbar.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/core.css">
        <link rel="stylesheet" href="assets/css/app.css">
        <!-- endbuild -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800,900,300">
        <script src="libs/bower/breakpoints.js/dist/breakpoints.min.js"></script>
        <script>
            Breakpoints();
        </script>
    </head>
        
    <body class="menubar-left menubar-unfold menubar-light theme-primary">
    <!--============= start main area -->
    
    
    
    <?php include_once('includes/header.php');?>
    
    <?php include_once('includes/sidebar.php');?>
    

    
    <!-- APP MAIN ==========-->
    <main id="app-main" class="app-main">
      <div class="wrap">
        <section class="app-content">
            <div class="row">
                <!-- DOM dataTable -->
                <div class="col-md-12">
                    <div class="widget">
                        <header class="widget-header">
                            <h4 class="widget-title">Add a Medicine</h4>
                        </header><!-- .widget-header -->
                        <hr class="widget-separator">
                        <div class="widget-body">
                        <?php
        if($_SERVER['REQUEST_METHOD'] == "POST")  {
            $M_Name = $_POST['name'] ;
            $M_Price = $_POST['price'] ;
            $Ph_ID = $_SESSION['pharmid'] ;
            $image= $_FILES['img']['name'];
            $image_tmp = $_FILES['img']['tmp_name'];
            $image_name = rand(0 , 1000) . $image ; 
            move_uploaded_file($image_tmp , "C:/xampp/htdocs/ma/images/uploads/" . $image_name ) ;
            $stmt= $dbh->prepare("INSERT INTO tblpharmacy(M_Name , M_Price , Ph_ID , Image , Date) VALUES (? , ? , ? , ? , NOW())") ;
            $stmt->execute(array($M_Name , $M_Price , $Ph_ID , $image_name)) ; 
        }
    ?>
                          <form action="" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label for="">Enter The Medecine Name: </label>
                                  <input type="text" class="form-control"  name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Enter The Medecine Price: </label>
                                    <input type="number" min=0  class="form-control m-5" name="price" required> 
                                </div>
                                <div class="form-group">
                                    <label for="">Medicine Image</label>
                                    <input type="file" class="form-control m-5" name="img" required> 
                                </div>
                                <input type="submit" value="Add" name="add" class="btn btn-info">
                          </form>
                        </div><!-- .widget-body -->
                    </div><!-- .widget -->
                </div><!-- END column -->
                
                
            </div><!-- .row -->
        </section><!-- .app-content -->
    </div><!-- .wrap -->
      <!-- APP FOOTER -->
      <?php include_once('includes/footer.php');?>
      <!-- /#app-footer -->
    </main>
    <!--========== END app main -->
    
        <!-- APP CUSTOMIZER -->
    <?php include_once('includes/customizer.php');?>
    
        
            <!-- build:js assets/js/core.min.js -->
        <script src="libs/bower/jquery/dist/jquery.js"></script>
        <script src="libs/bower/jquery-ui/jquery-ui.min.js"></script>
        <script src="libs/bower/jQuery-Storage-API/jquery.storageapi.min.js"></script>
        <script src="libs/bower/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
        <script src="libs/bower/jquery-slimscroll/jquery.slimscroll.js"></script>
        <script src="libs/bower/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
        <script src="libs/bower/PACE/pace.min.js"></script>
        <!-- endbuild -->
    
        <!-- build:js assets/js/app.min.js -->
        <script src="assets/js/library.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/app.js"></script>
        <!-- endbuild -->
        <script src="libs/bower/moment/moment.js"></script>
        <script src="libs/bower/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="assets/js/fullcalendar.js"></script>
    </body>
    </html>
    <?php }  ?>