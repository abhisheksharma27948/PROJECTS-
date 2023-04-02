<?php
    require_once "../Connection/dbconfig.php";
    try{
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
            $sql = "update treatments set treat_type=:treat_type,
                                        treat_name=:treat_name,
                                        where treat_id=:treat_id";
            $res = $pdo->prepare($sql);
            $res->bindParam(':treat_id', $_REQUEST['treat_id']);    
            $res->bindParam(':treat_name', $_REQUEST['treat_name']);    
            $res->bindParam(':treat_type', $_REQUEST['treat_type']);    
            $res->execute();
            header('location:../treatments.php?msg=Data Updated..!');
        }else{

            $sql = "select * from treatments where treat_id = :treat_id";
            $res = $pdo->prepare($sql);
            $res->bindParam(':treat_id',$_REQUEST['treat_id']);
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
    <h3> Edit Treatment Data</h3>
    <div class="container my-5">
        
        <form method = "POST"> 

            <label>Treat_id :</label>
            <input type="text" id="treat_id" name="treat_id" value="<?php if(isset($row['treat_id'])){ echo $row['treat_id'];} ?>"/>
            
            <label>Treat_name :</label>
            <input type="text" id="treat_name" name="treat_name" value="<?php if(isset($row['treat_name'])){ echo $row['treat_name'];} ?>"/>
            
            <label>Treat_type :</label>
            <input type="text" id="treat_type" name="treat_type" value="<?php if(isset($row['treat_type'])){ echo $row['treat_type'];} ?>"/>
            
            <input type="submit" value="submit"/>
        </form>
    </div> 
</body>
</html>