<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>List Records</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src ="https://cdn.tailwindcss.com"></script>
        <style>
        body {
            margin: relative;
            /* background: linear-gradient(45deg, #deeaee, #b1cbbb); */
            /* background: linear-gradient(30deg, #49a09d, #5f2c82); */
            background: linear-gradient(30deg, #49a0, #5672c8);
            font-family: sans-serif;
            font-weight: 100;
        }   
        table {
            width: 90%;
            border-collapse: collapse;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
    </style>
    </head>
    <body>
        <?php
            if(isset($_REQUEST['msg'])){
                ?>
                <h4> <?php echo $_REQUEST['msg']; ?></h4>
                <?php
            }
        ?>
    <div class="container my-5">
        <button class="mb-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded">
            <a href = "Add Details/add_check_up.php" class="text-light">Add</a>
        </button>
        <!-- <table class="table table-bordered table-hover "> -->
        <table class="table table-bordered table-hover rounded">
            <thead class="thead-dark">
                <tr >

                    <th scope = "col" >check_id</th>
                    <th scope = "col" >patient_id</th>
                    <th scope = "col" >complains</th>
                    <th scope = "col" >checkUp_date</th>
                    <th scope = "col" >treat_id</th>
                    <th scope = "col" >Edit</th>
                    <th scope = "col" >Delete</th>
                    </tr>
            </thead>
            <tbody>

                <?php
                    require_once "Connection/dbconfig.php";
                    $sql = "Select * from check_up";
                    $result = $pdo->query($sql);
                    if($result->rowCount()>0){
                        while($row = $result->fetch())
                        {
                            ?>
                                <tr>
                                <td><?php echo $row['check_id']; ?></td>
                                <td><?php echo $row['patient_id']; ?></td>
                                <td><?php echo $row['complains']; ?></td>
                                <td><?php echo $row['checkUp_date']; ?></td>
                                <td><?php echo $row['treat_id']; ?></td>

                                <td>
                                    <button class="ml-2 bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 border border-blue-700 rounded"> 
                                    <a href="Update/edit_check_up.php?check_id=<?php echo $row['check_id'];?>">Edit</a></button>
                                </td>
                                <td>
                                    <button class="ml-2 bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 border border-blue-700 rounded"> 
                                    <a href="Delete/delete_check_up.php?deleteid=<?php echo $row['check_id'];?>" onclick = "return confirm('are you sure to delete');">Delete</a></button>
                                </td>

                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    
    </body>
</html>