<?php
try{
// database configuration to connect with DB
$pdo = new PDO("mysql:host=localhost;dbname=clinic_management", "root","Abhi27@#@#");

$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//echo "Connection Done!";
}catch(PDOException $e){
    echo "ERROR: could not connect with DB".$e->getMessage();
}
?>