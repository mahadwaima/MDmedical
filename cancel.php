<?php 
session_start();
if(!isset($_SESSION['patient'])) {
    header("Location: login.php") ; 
    exit() ;
}

else {
    include('doctor/includes/dbconnection.php');

    if(isset($_GET['appid'])) {
        $id = $_GET['appid'] ;
        $stmt = $dbh->prepare("UPDATE tblappointment SET Status = 'Deleted' WHERE ID = ?") ; 
        $stmt->execute(array($id)) ;
        header("Location: history.php");
        exit();
    }
}



?>
