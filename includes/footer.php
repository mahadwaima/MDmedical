<footer id="contact">
            


        <!-- footer section starts  -->

    <section class="footer">

<div class="box-container">

    <div class="box">
        
        <?php
$sql="SELECT * from tblpage where PageType='contactus'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                      
                            <h4>Timing</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                            <a href="#"> <i class="far fa-clock"></i><?php  echo ($row->Timing);?></a>
                            </li></ul>
                            <h4>Email</h4>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                            <a href="#"> <i class="fas fa-envelope"></i> <?php  echo ($row->Email);?></li></a></ul>
                            <h4>Contact Number</h4>
                            <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                            <a href="#"> <i class="fas fa-phone"></i><?php  echo ($row->MobileNumber);?> </li></a>
  </li>
                        </ul>
                            
    </div>
    <div class="box">
<h4>Our Clinic</h4>

                     
<a href="#"> <i class="fas fa-map-marker-alt"></i> <?php  echo ($row->PageDescription);?> </a>
                        <p></p>
                        
    </div>
    
                   
    <?php $cnt=$cnt+1;}} ?>
    <div class="box">
        <h4>our services</h4>
        <a href="#"> <i class="fas fa-chevron-right"></i> dental care </a>
        <a href="#"> <i class="fas fa-chevron-right"></i> message therapy </a>
        <a href="#"> <i class="fas fa-chevron-right"></i> cardioloty </a>
        <a href="#"> <i class="fas fa-chevron-right"></i> diagnosis </a>
        <a href="#"> <i class="fas fa-chevron-right"></i> ambulance service </a>
    </div>

    <div class="box">
        <h4>follow us</h4>
        <a href="#"> <i class="fas fa-user-friends"></i> faceappointment </a>
        <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
        <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
        <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
    </div>

</div>

<div class="credit"> created by <strong>MDmedical</strong> | all rights reserved </div>

</section>

</footer>