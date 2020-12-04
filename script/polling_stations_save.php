<?php 
require "ultrafunctions.php";

$area = validate($_POST["area"]);
$pollcode = validate($_POST["pollcode"]);
$pollname = validate($_POST["pollname"]);
$voters = validate($_POST["voters"]);
$pollname = strtoupper($pollname);
// $stmt = select_records_on_condition("polling_stations","electroal_areas_id = '$area'");
// if ($stmt) {
//     echo "Polling Station Code Exists";
// } else {

// }


$table = "polling_stations";
$fields[] = "electroal_areas_id,code,name,voters";
$values[] = "'$area','$pollcode','$pollname','$voters'";

echo insert_data($table,$fields,$values);
?>