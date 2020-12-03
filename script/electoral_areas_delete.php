<?php 
require "ultrafunctions.php";
$id = validate($_POST["id"]);

$table = "electoral_areas";
$condition = "id='$id'";

echo delete_record_on_condition($table, $condition);

?>