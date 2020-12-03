<?php 
include('middleware/verifyuser.php');
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">Constituency Ballots</h3>
<hr>
<div class="card card-body mt-4">
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            <form id="frmadd" autocomplete="off">
                <input type="hidden" value="<?php echo $_SESSION['_token']; ?>" name="_token" readonly>
                <div class="form-group mb-4 validate">
                    <select name="type" id="type" class="form-control">
                        <option value="">--Select type--</option>
                        <option value="presidential">Presidential</option>
                        <option value="parliamentary">Parliamentary</option>
                    </select>
                    <span class="text-danger small" role="alert"></span>
                </div>

                <div class="form-group mb-4 validate">
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
                <div class="row">
                <?php 
                $query = select_records("parties");
                while ($rec = mysqli_fetch_assoc($query)) { ?>
                    <div class="col-sm-2">
                        <input type="checkbox" name="parties[]" value="<?php echo $rec['id']; ?>" />
                        <?php echo $rec['name']; ?>
                    </div>
                <?php } ?>

                
                <span class="text-danger small" style="display:none" id="selectMsg" role="alert">Select parties</span>
                </div>
                <button type="submit" class="btn btn-success mt-3">Save</button>
            </form>
        </div>
    </div>
</div>

<?php require "include/footer.php"; ?>
<script>

$("#frmadd").on("submit", function(e) {
    e.preventDefault();
    var valid = true;
    $('#frmadd select').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            valid = false;
            $this.parents('.validate').find('span').text('The '+$this.attr('name').replace(/[\_]+/g, ' ')+' field is required');
        }
    });

    if($("#frmadd input[name='parties[]']:checked").length == 0){
        valid=false;
        $("#selectMsg").show('fast');
    }

    if(valid){
        var data = $("#frmadd").serialize();
        $("#selectMsg").hide('fast');
        $.ajax({
            type: "post",
            url: "script/ballot_save.php",
            data: $(this).serialize(),
            success: function(response) {
                if (response == "success") {
                    alert("Operation Successful");
                    window.location = "ballot.php";
                } else {
                    alert(response);
                }
            }
        });
    }
    return false;
});
</script>