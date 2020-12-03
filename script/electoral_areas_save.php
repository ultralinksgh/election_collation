<?php 
require "ultrafunctions.php";

$constituency = validate($_POST["constituency"]);
$electoral_area = validate($_POST["electarea"]);
$electoral_area = strtoupper($electoral_area);

$table = "electoral_areas";
$fields[] = "constituencies_id,name";
$values[] = "'$constituency','$electoral_area'";

echo insert_data($table,$fields,$values);

?>