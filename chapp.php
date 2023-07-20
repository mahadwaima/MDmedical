<?php
session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');

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
     alert(val);
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
    
    <body id="top">
    
        <main>

            <?php include_once('includes/header.php');?>
            

            <section class="section-padding" id="booking">
                
                    <div class="row">
                
                                <h4 >Search For Your Appointment</h4>
                            
                                <form role="form" method="post">


                                            <input type="text" name="searchdata" required="true" class="box" placeholder="Appointment No./Name/Mobile No.">
                                            <button type="submit" class="btn" name="search">Check Here</button>

                                   
                                </form>

                                </div>
                            <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];

  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>
                    
                    <div class="widget-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover js-basic-example dataTable table-custom">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Appointment Number</th>
                                        <th>Patient Name</th>
                                        <th>Mobile Number</th>
                                        <th>Email</th>
                                    <th>Status</th>
                                        <th>Remark</th>
                                        <th>Cancellation</th>

                                    </tr>
                                </thead>
                            
                                <tbody>
                  <?php
             
$sql="SELECT * from tblappointment where  AppointmentNumber like '$sdata%' || Name like '$sdata%' || MobileNumber like '$sdata%' ";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{     if($row->Status!="Deleted"){         
                              echo '<tr id="' . $row->ID . '">'; ?>
                                        <td><?php echo htmlentities($cnt);?></td>
                                        <td><?php  echo htmlentities($row->AppointmentNumber);?></td>
                                        <td><?php  echo htmlentities($row->Name);?></td>
                                        <td><?php  echo htmlentities($row->MobileNumber);?></td>
                                        <td><?php  echo htmlentities($row->Email);?></td>
                                        <?php if($row->Status==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Status);?>
                  </td>
                  <?php } ?>             
                 
                                        <?php if($row->Remark==""){ ?>

                     <td><?php echo "Not Updated Yet"; ?></td>
<?php } else { ?>                  <td><?php  echo htmlentities($row->Remark);?>
                  </td>
                  <?php } 
                  echo '<td><button onclick="deleteUser('.$row->ID.')">Delete</button></td>';
                  ?>
                                    </tr>
                                
    
                                </tbody>
             
                <?php 
$cnt=$cnt+1;
} }} else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
  <?php } }?>
                            </table>
                        </div>

                    </div>
                </div>
            </section>
             
        </main>
        <?php include_once('includes/footer.php');?>
        <!-- JAVASCRIPT FILES -->
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script src="js/scrollspy.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/script.js"></script>
        <script>
    // JavaScript function to handle the delete button action
    function deleteUser(userId) {
        if (confirm('Are you sure you want to cancel this appointment?')) {
            // Send an AJAX request to the server to delete the user
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_appointment.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the server
                    var response = xhr.responseText;
                    if (response === 'success') {
                        // Delete the table row from the DOM
                        /*var row = document.getElementById('appointment-' + userId);
                        if (row) {
                            row.parentNode.removeChild(row);
                        }*/
                        var row = document.getElementById(userId);
                        if (row) {
                            row.parentNode.removeChild(row);
                        }
                    } else {
                        // Display an error message or handle the error condition
                        console.log('Error: ' + response);
                    }
                }
            };
            xhr.send('id=' + userId);
        }
    }
</script>

    </body>
</html>