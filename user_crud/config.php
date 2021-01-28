<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "crud";

$conn = mysqli_connect($server,$user,$pass,$db);

if($conn->connect_error){
    die('Unable to Connect!');
}
?>