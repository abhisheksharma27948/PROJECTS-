<?php
    require_once '../Connection/dbconfig.php';
    try{
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $sql = "update patients set name=:name,
                                    patient_type=:patient_type,
                                    dob = :dob,
                                    age=:age,
                                    gender=:gender,
                                    patients_address=:patients_address,
                                    contact=:contact,
                                    allergies = :allergies,
                                    appointment_date = :appointment_date,
                                    appointment_time = :appointment_time
                                    where patient_id=:patient_id";
            $res = $pdo->prepare($sql);
            $res->bindParam(':patient_id', $_REQUEST['patient_id']);
            $res->bindParam(':name', $_REQUEST['name']);
            $res->bindParam(':patient_type', $_REQUEST['patient_type']);
            $res->bindParam(':dob', $_REQUEST['dob']); 
            $res->bindParam(':age', $_REQUEST['age']);
            $res->bindParam(':gender', $_REQUEST['gender']);
            $res->bindParam(':patients_address', $_REQUEST['patients_address']);
            $res->bindParam(':contact', $_REQUEST['contact']);
            $res->bindParam(':allergies', $_REQUEST['allergies']);      
            $res->bindParam(':appointment_date', $_REQUEST['appointment_date']);      
            $res->bindParam(':appointment_time', $_REQUEST['appointment_time']);      
            $res->execute();
            header('location:../patients.php?msg=Data Updated..!');
        }else{

            $sql = "select * from patients where patient_id = :patient_id";
            $res = $pdo->prepare($sql);
            $res->bindParam(':patient_id',$_REQUEST['patient_id']);
            $res->execute();
            if($res->rowCount() ==1){
                $row = $res->fetch();
            }
        }
        //close connection
        unset($pdo);
    }catch(PDOExecption $e){
        echo "Error: unable to execute SQL query".$e->getMessage();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src ="https://cdn.tailwindcss.com"></script>
        <style>
        body {
            margin: 0;
            background: linear-gradient(45deg, #deeaee, #b1cbbb);
            font-family: sans-serif;
            font-weight: 100;
        }
  
    </style>
</head>
<body>
    <h3> Edit Patients Data</h3>
    <div class="container my-5">
        
        <form method = "POST"> 
            
            <label>patient_id:</label>
            <input type="text" id="patient_id" name="patient_id" value="<?php if(isset($row['patient_id'])){ echo $row['patient_id'];} ?>"/>
            
            <label>Name :</label>
            <input type="text" id="name" name="name" value="<?php if(isset($row['name'])){ echo $row['name'];} ?>"/>

            <label>Patient_type :</label>
            <input type="text" id="patient_type" name="patient_type" value="<?php if(isset($row['patient_type'])){ echo $row['patient_type'];} ?>"/>
            
            <label>Age :</label>
            <input type="text" id="age" name="age" value="<?php if(isset($row['age'])){ echo $row['age'];} ?>"/>

            <label>Address :</label>
            <input type="text" id="address" name="address" value="<?php if(isset($row['address'])){ echo $row['address'];} ?>"/>

            <label>DOB :</label>
            <input type="text" id="dob" name="dob" value="<?php if(isset($row['dob'])){ echo $row['dob'];} ?>"/>

            <label>Allergies :</label>
            <input type="text" id="Allergies" name="allergies" value="<?php if(isset($row['allergies'])){ echo $row['allergies'];} ?>"/>

            <label>Apointments :</label>
            <input type="text" id="apointments" name="apointments" value="<?php if(isset($row['apointments'])){ echo $row['apointments'];} ?>"/>

            <input type="submit" value="submit"/>
        </form>
    </div> 
</body>
</html>