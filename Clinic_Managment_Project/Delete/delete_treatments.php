<?php
require_once "Connection/dbconfig.php";
if(isset($_GET['deleteid'])){
    $id = $_GET['deleteid'];
    $sql = "DELETE FROM treatments WHERE treat_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);
    if($stmt->rowCount()>0){
        $msg = "Record deleted successfully";
    }else{
        $msg = "Unable to delete record";
    }
    header("Location: treatments.php?msg=".$msg);
}
?>
