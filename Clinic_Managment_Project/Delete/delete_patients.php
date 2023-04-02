<?php
require_once "../Connection/dbconfig.php";
if(isset($_GET['deleteid'])){
    //$id = $_GET['deleteid'];
    $sql = "DELETE FROM patients WHERE patient_id = :patient_id";
    $stmt = $pdo->prepare($sql);
    //$stmt->execute([$id]);
    $stmt->bindParam(':patient_id',$_REQUEST['deleteid']);
    $stmt->execute();
    if($stmt->rowCount()>0){
        $msg = "Record deleted successfully";
    }else{
        $msg = "Unable to delete record";
    }
    header("Location: ../patients.php?msg=".$msg);
}
?>
