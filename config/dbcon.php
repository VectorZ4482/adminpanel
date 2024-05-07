<?php 

$host = "localhost";
$name = "root";
$password = "";
$db_name = "panel";



$conn = mysqli_connect($host,$name,$password,$db_name);


if(!$conn){
    header("Location: ../errors/db.php");
    die();
}



?>

