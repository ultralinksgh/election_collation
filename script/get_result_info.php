<?php 
session_start();
require "ultrafunctions.php";
$polling_station_code = validate($_POST["polling_station_code"]);  
?>

<div class="row mt-2">
    <?php 
    $query = select_records_on_condition("view_polling_stations", "code='$polling_station_code'");
    if ($query) { 
        $rec = mysqli_fetch_assoc($query); ?>
        <div class="col-sm-2">Code:<br> <?php echo $rec['code']; ?></div>
        <div class="col-sm-4">Polling Station:<br> <?php echo $rec['polling_name']; ?></div>
        <div class="col-sm-2">Electoral Area:<br> <?php echo $rec['electoral_name']; ?></div>
        <div class="col-sm-2">Constituency:<br> <?php echo $rec['constituency']; ?></div>
        <div class="col-sm-2">Total Voters:<br> <?php echo $rec['voters']; ?></div>
    <?php 
    $constituency_id = $rec['constituency_id'];
    $queries1 = select_records_on_condition("view_ballots", "constituency_id='$constituency_id' AND type='presidential'");
    $queries2 = select_records_on_condition("view_ballots", "constituency_id='$constituency_id' AND type='parliamentary'");
    ?>
    <div><hr></div>
    <div class="col-sm-6 mt-3">
    <h4>Presidential</h4>
    <?php while ($rec = mysqli_fetch_assoc($queries1)) { ?>
        <div class="col-sm-12">
            <?php echo $rec['name']; ?> <input type="text" />
        </div>
    <?php } ?>
    </div>

    <div class="col-sm-6 mt-3">
    <h4>Parliamentary</h4>
    <?php while ($rec = mysqli_fetch_assoc($queries2)) { ?>
        <div class="col-sm-12">
            <?php echo $rec['name']; ?> <input type="text" />
        </div>
    <?php } ?>
    </div>
    <?php } ?>
</div>