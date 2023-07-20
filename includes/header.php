<nav class="navbar navbar-expand-lg bg-light fixed-top shadow-lg">
                <div class="container">
                <header class="header">
                <a href="index.php" class="logo"> <i class="fas fa-heartbeat"></i> <strong>MD</strong>medical </a>
</header>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>

                            <!-- <li class="nav-item">
                                <a class="nav-link" href="check-appointment.php">Check Appointment</a>
                            </li> -->
                            <li class="nav-item">
                            <a class="nav-link" href="Medicine.php">Pharmacy</a>
                            </li>
                            <li class="nav-item">
                             <a class="nav-link" href="Blogs.php">Blogs</a>
                             </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Appointment.php">Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="house.php">House Dr</a>
                            </li>
            <?php 
            if(isset($_SESSION['patient'])) {
                $patientid = $_SESSION['patient'] ;
                $stmt = $dbh->prepare("SELECT * FROM tplpatients WHERE ID = ?") ;
                $stmt->execute(array($patientid));
                $row = $stmt->fetch() ;  ?>
            
            <li class="nav-item">
                <a href="history.php" class="nav-link">History</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo $row['fullname'] ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">logout</a></li>
                </ul>
            </li>   

                    <?php   } else {
                        echo '     <li class="nav-item active">
                        <a class="nav-link" href="login.php"><i class="fas fa-user fa-1x" style="color:#000000"></i></a>
                    </li>' ;
                        echo '     <li class="nav-item active">
                        <a class="nav-link" href="doctor/login.php"><i class="fas fa-user-tie fa-1x" style="color:#000000"></i></a>
                    </li>' ;
                    }
                ?>
                
    
                        </ul>
                    </div>

                </div>
            </nav>