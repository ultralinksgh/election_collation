<?php 
session_start();
require "ultrafunctions.php";
$type = validate($_POST["type"]);
$constituency = validate($_POST["constituency"]);  
?>

<div class="row">
<?php 
$query = select_records_on_condition("view_ballots", "constituency_id='$constituency' AND type='$type'");
while ($rec = mysqli_fetch_assoc($query)) { ?>
    <div class="col-sm-2">
        <input type="checkbox" name="parties[]" value="<?php echo $rec['id']; ?>" />
        <?php echo $rec['name']; ?>
    </div>
<?php } ?>
</div>