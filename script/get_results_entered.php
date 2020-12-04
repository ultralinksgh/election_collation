<?php 
session_start();
require "ultrafunctions.php";
$polling_station_id = validate($_POST["polling_station_id"]);  
?>
<table class="table table-sm">
    <thead>
        <tr>
            <th class="font-weight-bold">#</th>
            <th class="font-weight-bold text-center">NAME OF PARTY</th>
            <th class="font-weight-bold text-center">PRESIDENTIAL</th>
            <th class="font-weight-bold text-center">PARLIAMENTARY</th>
        </tr>
    </thead>
    <tbody>
        <?php 
$i=0;
$query = select_records_on_condition("results","polling_stations_id = '$polling_station_id'");
while ($rec = mysqli_fetch_assoc($query)) {
    $i++;
    ?>
        <tr>
            <td><?php echo $i.'.'; ?> </td>
            <td class="text-center"><?php echo $rec["party_name"]; ?> </td>
            <td class="text-center"><?php echo $rec["presidential_votes"]; ?> </td>
            <td class="text-center"><?php echo $rec["parliament_votes"]; ?> </td>
        </tr>
        <?php
}
?>
    </tbody>
    <tfoot>
        <tr>
            <th class="font-weight-bold">#</th>
            <th class="font-weight-bold text-center">NAME OF PARTY</th>
            <th class="font-weight-bold text-center">PRESIDENTIAL</th>
            <th class="font-weight-bold text-center">PARLIAMENTARY</th>
        </tr>
    </tfoot>
</table>