<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">Add New Results</h3>
<hr>
<div class="card card-body mt-4">
<div class="col-sm-6">
    <form id="formFilter" autocomplete="off" class="form-inline">
        <div class="validate mb-2">
            <div class="form-outline">
                <input type="text" name="polling_station_code" class="form-control" />
                <label class="form-label">Polling Station No</label>
            </div>
            <span class="text-danger small" role="alert"></span>
        </div>
        
        <button type="submit" class="btn btn-success mt-3 btn_filter">FILTER</button>
    </form>
</div>
<div class="col-sm-12">
    <div id="filterContent"></div>
</div>
</div>

<?php require "include/footer.php"; ?>
<script>
$("#formFilter").on('submit', function(e){
    e.preventDefault();
    $this = $(this);
    var valid = true;
    $('#formFilter input').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });

    if(valid){
        $('.btn_filter').html('Filtering...').attr('disabled', true);
        var data = $(this).serialize();
        $.ajax({
            url: "script/get_result_info.php",
            type: "POST",
            data: data,
            success: function(resp){
                $("#filterContent").hide().fadeIn('fast').html(resp);
                $('.btn_filter').html('Filter').attr('disabled', false);
            },
            error: function(resp){
                alert('Something went wrong');
                $('.btn_filter').html('Filter').attr('disabled', false);
            }
        });
    }
    return false;
       
});

</script>