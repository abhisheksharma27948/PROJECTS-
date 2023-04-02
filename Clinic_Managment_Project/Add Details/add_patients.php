<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $errors = array();
        // require_once "../Connection/dbconfig.php";
        require_once "../Connection/dbconfig.php";

        // Prepare SQL insert statement
        //$sql = "INSERT INTO patients(patient_id, name, patient_type, age, address, treat_id) VALUES (:patient_id, :name, :patient_type, :age, :address, :treat_id)";
        $sql = "INSERT INTO patients(name, patient_type, dob, age, gender,patients_address, contact, allergies, appointment_date, appointment_time) 
        VALUES (:name, :patient_type, :dob, :age, :gender, :patients_address, :contact, :allergies, :appointment_date, :appointment_time)";

        // Create prepared statement
        $stmt = $pdo->prepare($sql);
            
        // Bind parameters to statement
        $stmt->bindParam(':name', $_POST['name']);
        $stmt->bindParam(':patient_type', $_POST['patient_type']);
        $stmt->bindParam(':dob', $_POST['dob']);
        $stmt->bindParam(':age', $_POST['age']);
        $stmt->bindParam(':gender', $_POST['gender']);
        $stmt->bindParam(':patients_address', $_POST['patients_address']);
        $stmt->bindParam(':contact ', $_POST['contact ']);
        $stmt->bindParam(':allergies', $_POST['allergies']);
        $stmt->bindParam(':appointment_date', $_POST['appointment_date']);
        $stmt->bindParam(':appointment_time', $_POST['appointment_time']);
                
        // Execute statement
        if ($stmt->execute()) { 
            echo "<p class='alert alert-success'>Patient record added successfully!</p>";
            // header('location:../patients.php');
        } else {
            echo "<p class='error'>Error: " . $stmt->errorCode() . "</p>";
        }
            
        // Close connection
        unset($pdo);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add Patients</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
		form {
			background-color: white;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
			padding: 20px;
			margin: 50px auto;
			max-width: 500px;
		}

		h1 {
			text-align: center;
			margin-top: 0;
		}

		label {
			display: block;
			margin-bottom: 5px;
			font-weight: bold;
		}

		input[type="text"] {
			padding: 10px;
			border-radius: 3px;
			border: 1px solid #ccc;
			width: 100%;
			margin-bottom: 20px;
			box-sizing: border-box;
		}

		button[type="submit"] {
			background-color: #4CAF50;
			color: white;
			padding: 10px 20px;
			border-radius: 3px;
			border: none;
			cursor: pointer;
			font-size: 16px;
			font-weight: bold;
			transition: background-color 0.3s ease;
			margin-top: 20px;
		}

		button[type="submit"]:hover {
			background-color: #3e8e41;
		}
/* 
        .success {
            position: relative;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 3px;
            font-weight: bold;
        } */

        </style>
    </head>

    <body>
        <h1>Add Patients</h1>
        <form method="POST">
            <!-- <label for="patient_id">Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" required/> -->

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required/>
            
            <label for="patient_type">Patient Type:</label>
            <input type="text" id="patient_type" name="patient_type"/>
            
            <label for="dob">DOB:</label>
            <input type="date" id="dob" name="dob" required onchange="calculateAge()">

            <label for="age">Age:</label>
            <input type="text" id="age" name="age" required/>

            <label for="age">Gender:</label>
            <input type="text" id="gender" name="gender" required/>
            
            <label for="patients_address">Address:</label>
            <input type="text" id="patients_address" name="patients_address" required/>

            <label for="contact">contact:</label>
            <input type="text" id="contact" name="contact" required/>

            <label for="allergies">Allergies:</label>
            <input type="text" id="allergies" name="allergies">
            
            <label for="appointment_date">Appointment_date:</label>
            <input type="text" id="appointment_date" name="appointment_date">

            <label for="appointment_time">Appointment_time:</label>
            <input type="text" id="appointment_time" name="appointment_time">

            <button type="submit" id="submit" name="submit">Add Patient</button>
        </form>
        <script src="Script/script_patients.js"></script>
    </body>
</html>
