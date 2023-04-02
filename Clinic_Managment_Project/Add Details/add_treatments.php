<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require_once "../Connection/dbconfig.php";

        // SQL insert statement
        // $sql = "INSERT INTO treatments(treat_id,treat_type,treat_name) VALUES (:treat_id, treat_type, :treat_name)";
        $sql = "INSERT INTO treatments(treat_type,treat_name,patient_id) VALUES (:treat_type, :treat_name, :patient_id)";
    
        // create prepare statement template
        $res = $pdo->prepare($sql);
    
        // bind parameter to statement
        // $res->bindParam(':treat_id', $_REQUEST['treat_id']);
        $res->bindParam(':treat_type', $_REQUEST['treat_type']);
        $res->bindParam(':treat_name', $_REQUEST['treat_name']);
        $res->bindParam(':patient_id', $_REQUEST['patient_id']);
    
        // execute prepare statement
        if ($res->execute()) {
            header("location: ../treatments.php?msg=Data Inserted...!");
            exit();
        } else {
            echo "Error: " . $res->errorCode();
        }
    
        // close connection
        unset($pdo);
    }

?>

<html>
    <head>
        <title>Add Treatments</title>
        
    </head>

    <body>
        <form method="POST">

            <!-- <label>Treat_id :</label>
            <input type="text" id="treat_id" name="treat_id"/> -->

            <label>Treat_type :</label>
            <input type="text" id="treat_type" name="treat_type"/>

            <label>Treat_name :</label>
            <input type="text" id="treat_name" name="treat_name"/>
            
            <label>Patient_id :</label>
            <input type="text" id="patient_id" name="patient_id"/>

            <button type="submit" id="submit" name = "submit">Add</button>

    </body>

</html>