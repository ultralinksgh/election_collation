<?php 
session_start();
require "ultrafunctions.php";
$type = validate($_POST["type"]);
$constituency = validate($_POST["constituency"]);
$parties = ($_POST["parties"]);

$table = "ballots";
$fields[] = "party_id,constituency_id,type";

if($_SERVER['REQUEST_METHOD']=='POST'){
    if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']){
        echo ('Invalid CSRF token');
    }else{
        foreach($parties as $party){
            global $conn;
            $exec = mysqli_query($conn, "INSERT INTO ballots(party_id,constituency_id,type) VALUES('$party', '$constituency','$type')") or die(mysqli_error($conn));
        }
        if($exec){
            echo 'success';
        }
    }
}
   
?>