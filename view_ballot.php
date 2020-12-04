<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">View Ballots</h3>
<small>Use this module to view all ballots created for each constituency</small>
<hr>
<div class="card card-body mt-4">
    <div class="col-sm-12">
        <form id="formFilter" autocomplete="off" class="form-inline">
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group mb-4 validate">
                        <label for="" class="font-weight-bold">Constituency</label>
                        <select name="constituency" id="constituency" class="form-control">
                            <option value="">--Select constituency--</option>
                            <?php 
                $query = select_records("constituencies");
                while ($rec = mysqli_fetch_assoc($query)) { ?>
                            <option value="<?php echo $rec['id']; ?>"><?php echo $rec['constituency']; ?></option>
                            <?php } ?>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group mb-4 validate">
                        <label for="" class="font-weight-bold">Election Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="">--Select type--</option>
                            <option value="presidential">Presidential</option>
                            <option value="parliamentary">Parliamentary</option>
                        </select>
                        <span class="text-danger small" role="alert"></span>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group mb-4 pt-4">
                    <button type="submit" class="btn btn-success btn_filter">FILTER</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-sm-12">
        <div id="filterContent"></div>
    </div>
</div>

<?php require "include/footer.php"; ?>
<script>
$("#formFilter").on('submit', function(e) {
    e.preventDefault();
    $this = $(this);
    var valid = true;
    $('#formFilter select').each(function() {
        var $this = $(this);

        if (!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The ' + $this.attr('name').replace(/[\_]+/g,
                ' ') + ' field is required');
        }
    });

    if (valid) {
        $('.btn_filter').html('Filtering...').attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            url: "script/get_ballots.php",
            type: "POST",
            data: data,
            success: function(resp) {
                $("#filterContent").hide().fadeIn('fast').html(resp);
                $('.btn_filter').html('Filter').attr('disabled', false);
            },
            error: function(resp) {
                alert('Something went wrong');
                $('.btn_filter').html('Filter').attr('disabled', false);
            }
        });
    }
    return false;

});
</script>