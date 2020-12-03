<?php 
require "script/ultrafunctions.php";
$district = validate($_POST["district"]);
$constituency = validate($_POST["constituency"]);
$district = strtoupper($district);
$constituency = strtoupper($constituency);

$table = "constituencies";
$fields[] = "district,constituency";
$values[] = "'$district','$constituency'";

echo insert_data($table,$fields,$values);

?>