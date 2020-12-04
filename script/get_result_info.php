<?php 
session_start();
require "ultrafunctions.php";
$polling_station_code = validate($_POST["polling_station_code"]);  
?>

<div class="row border border-solid p-3">
    <?php 
    $query = select_records_on_condition("view_polling_stations", "code='$polling_station_code'");
    if (mysqli_num_rows($query)>0) { 
        $rec = mysqli_fetch_assoc($query); ?>
    <div class="col-sm-2 mt-1"><b>Code</b><br> <?php echo $rec['code']; ?></div>
    <div class="col-sm-4 mt-1"><b>Polling Station</b><br> <?php echo $rec['polling_name']; ?></div>
    <div class="col-sm-2 mt-1"><b>Electoral Area</b><br> <?php echo $rec['electoral_name']; ?></div>
    <div class="col-sm-2 mt-1"><b>Constituency</b><br> <?php echo $rec['constituency']; ?></div>
    <div class="col-sm-2 mt-1"><b>Voters</b><br> <?php echo $rec['voters']; ?></div>

    <?php 
    $polling_id = $rec['id'];
    $constituency_id = $rec['constituency_id'];
    $queries1 = select_records_on_condition("view_ballots", "constituency_id='$constituency_id' AND type='presidential'");
    $queries2 = select_records_on_condition("view_ballots", "constituency_id='$constituency_id' AND type='parliamentary'");
    ?>
    <div>
        <hr>
    </div>
    <div class="col-sm-6 mt-3">
        <h4 class="font-weight-bold">Presidential Results</h4>
        <form id="formPresident" autocomplete="off">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>" readonly>
            <input type="hidden" name="polling_id" value="<?php echo $polling_id; ?>" readonly />
            <?php while ($rec = mysqli_fetch_assoc($queries1)) { ?>
            <div class="col-sm-12 p-1 g-1">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="mt-2"><?php echo $rec['name']; ?></p>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="votes[<?php echo $rec['name']; ?>]" class="form-control"
                            onkeypress="return isNumber(event);" />
                    </div>
                </div>
            </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary offset-3 mt-1 mb-3 btn_pres_save">Save Results</button>
        </form>
    </div>

    <div class="col-sm-6 mt-3">
        <h4 class="font-weight-bold">Parliamentary Results</h4>
        <form id="formParliament" autocomplete="off">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>" readonly>
            <input type="hidden" name="polling_id" value="<?php echo $polling_id; ?>" readonly />
            <?php while ($rec = mysqli_fetch_assoc($queries2)) { ?>
            <div class="col-sm-12 p-1 g-1">
                <div class="row">
                    <div class="col-sm-2">
                        <p class="mt-2"><?php echo $rec['name']; ?></p>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" name="votes[<?php echo $rec['name']; ?>]]" class="form-control"
                            onkeypress="return isNumber(event);" />
                    </div>
                </div>
            </div>
            <?php } ?>
            <button class="btn btn-secondary offset-3 mt-1 mb-3 btn_par_save">Save Results</button>
        </form>
    </div>
    <br>
    <?php }else{
        echo '<div class="col-sm-12 font-weight-bold text-danger">No Records Found</div>';
    } ?>
</div>

<script>
$("#formPresident").on('submit', function(e) {
    e.preventDefault();
    $this = $(this);
    var valid = true;
    $('#formPresident input').each(function() {
        var $this = $(this);

        if (!$this.val()) {
            valid = false;
            // $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });

    if (valid) {
        $('.btn_pres_save').html('Saving Results...').attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            url: "script/result_prensidential_save.php",
            type: "POST",
            data: data,
            success: function(resp) {
                if (resp == 'success') {
                    alert("Saved Successful");
                }
                $('.btn_pres_save').html('Save Results').attr('disabled', false);
            },
            error: function(resp) {
                alert('Something went wrong');
                $('.btn_pres_save').html('Save Results').attr('disabled', false);
            }
        });
    }
    return false;

});

$("#formParliament").on('submit', function(e) {
    e.preventDefault();
    $this = $(this);
    var valid = true;
    $('#formParliament input').each(function() {
        var $this = $(this);

        if (!$this.val()) {
            valid = false;
            // $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });

    if (valid) {
        $('.btn_par_save').html('Saving Results...').attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            url: "script/result_parliamentary_save.php",
            type: "POST",
            data: data,
            success: function(resp) {
                if (resp == 'success') {
                    alert("Saved Successful");
                }
                $('.btn_par_save').html('Save Results').attr('disabled', false);
            },
            error: function(resp) {
                alert('Something went wrong');
                $('.btn_par_save').html('Save Results').attr('disabled', false);
            }
        });
    }
    return false;

});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
</script>