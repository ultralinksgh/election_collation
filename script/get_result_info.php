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
    <div class="col-sm-2 mt-5"><b>Code</b>:<br> <?php echo $rec['code']; ?></div>
    <div class="col-sm-4 mt-5"><b>Polling Station</b>:<br> <?php echo $rec['polling_name']; ?></div>
    <div class="col-sm-2 mt-5"><b>Electoral Area</b>:<br> <?php echo $rec['electoral_name']; ?></div>
    <div class="col-sm-2 mt-5"><b>Constituency</b>:<br> <?php echo $rec['constituency']; ?></div>
    <div class="col-sm-2 mt-5"><b>Total Voters</b>:<br> <?php echo $rec['voters']; ?></div>

    <?php 
    $constituency_id = $rec['constituency_id'];
    $queries1 = select_records_on_condition("view_ballots", "constituency_id='$constituency_id' AND type='presidential'");
    $queries2 = select_records_on_condition("view_ballots", "constituency_id='$constituency_id' AND type='parliamentary'");
    ?>
    <div>
        <hr>
    </div>
    <div class="col-sm-6 mt-3">
        <h4 class="font-weight-bold">Presidential Results</h4>
        <?php while ($rec = mysqli_fetch_assoc($queries1)) { ?>
        <div class="col-sm-12 p-1 g-1">
            <form action="">
                <div class="row">
                    <div class="col-sm-2">
                        <?php echo $rec['name']; ?>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" />
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>

    <div class="col-sm-6 mt-3">
        <h4 class="font-weight-bold">Parliamentary Results</h4>
        <?php while ($rec = mysqli_fetch_assoc($queries2)) { ?>
        <div class="col-sm-12 p-1 g-1">
            <form action="">
                <div class="row">
                    <div class="col-sm-2">
                        <?php echo $rec['name']; ?>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" />
                    </div>
                </div>
            </form>
        </div>
        <?php } ?>
    </div>
    <br>
    <?php } ?>
</div>