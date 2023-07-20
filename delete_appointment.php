<?php
// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'damsmsdb');
if (isset($_POST['id'])) {
    $userIdToDelete = $_POST['id'];
    $status="Deleted";
    $remark="";
try {
    // Establish database connection.
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));

    /*$stmt = $dbh->prepare("DELETE FROM tblappointment WHERE id = :userId");
    $stmt->bindParam(':userId', $userIdToDelete);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {*/
        echo 'success';
        
//update status

$sql= "update tblappointment set Status=:status,Remark=:remark where ID=:eid";
$query=$dbh->prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':remark',$remark,PDO::PARAM_STR);
$query->bindParam(':eid',$userIdToDelete,PDO::PARAM_STR);
$query->execute();



   /* } else {
        echo 'failed.';
    }*/
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
}
?>
