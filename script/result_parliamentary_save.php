<?php 
session_start();
require "ultrafunctions.php";
$polling_id = validate($_POST["polling_id"]);
$rejected = validate($_POST["rejected"]);
$votes = ($_POST["votes"]);


if($_SERVER['REQUEST_METHOD']=='POST'){
    if(empty($_POST['_token']) || $_POST['_token']!=$_SESSION['_token']){
        echo ('Invalid CSRF token');
    }else{
        foreach($votes as $key=>$vote){
            global $conn;
            $query = select_records_on_condition("results", "polling_stations_id='$polling_id' AND party_name='$key'");
            if (mysqli_num_rows($query)>0){
                $exec = mysqli_query($conn, "UPDATE results SET parliament_votes='$vote', parliamentary_rejected_ballot='$rejected' WHERE polling_stations_id='$polling_id' AND party_name='$key'") or die(mysqli_error($conn));
            }else {
                $exec = mysqli_query($conn, "INSERT INTO results(polling_stations_id,party_name,parliament_votes,parliamentary_rejected_ballot) VALUES('$polling_id', '$key', '$vote', '$rejected')") or die(mysqli_error($conn));
            }            
        }
        if($exec){
            echo 'success';
        }
    }
}
   
?>