<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">View Election Results</h3>
<hr>
<div class="card card-body mt-4">
    <div class="col-sm-12">
        <form id="formFilter" autocomplete="off" class="form-inline">
            <div class="row">
                <div class="col-sm-8">
                    <div class="validate">
                        <select name="polling_station_id" id="polling_station_id" class="form-control select">
                            <option value="" selected disabled>Enter code or station name to find</option>
                            <?php 
                        $query = select_records("view_polling_stations");
                        while ($rec = mysqli_fetch_assoc($query)) {
                            ?>
                            <option value="<?php echo $rec["id"]; ?>">
                                <?php echo $rec["code"]." / ".$rec["polling_name"]." / ".$rec["constituency"]." / ".$rec["electoral_name"]; ?>
                            </option>
                            <?php
                        }
                        ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-success btn_filter">FILTER</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-sm-12 mt-5">
    <div id="filterContent"></div>
</div>
<br>
<br>

<?php require "include/footer.php"; ?>
<script>
$('.select').chosen();

$("#formFilter").on("submit", function(e) {
    e.preventDefault();
    let data = $(this).serialize();
    $.ajax({
        type: "post",
        url: "script/get_results_entered.php",
        data: data,
        success: function (response) {
            $("#filterContent").html(response);
        }
    });
});
</script>