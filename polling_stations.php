<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">Polling Stations</h3>
<hr>
<button id="btnadd" class="btn btn-primary">Add Polling Station</button>
<div class="card card-body mt-4">
    <div class="table-responsive">
        <table id="tbllist" class="table table-sm">
            <thead>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">ELECTORAL AREA</th>
                    <th class="font-weight-bold">POLLING CODE</th>
                    <th class="font-weight-bold">POLLING STATION</th>
                    <th class="font-weight-bold text-center">VOTERS</th>
                    <th class="font-weight-bold">DROP</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
        $query = select_records("view_polling_stations");
        while ($rec = mysqli_fetch_assoc($query)) {
            $i++;
           ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $rec["electoral_name"];?></td>
                    <td><?php echo $rec["code"];?></td>
                    <td><?php echo $rec["polling_name"];?></td>
                    <td class="text-center"><?php echo $rec["voters"];?></td>
                    <td><a href="#" class="font-weight-bold text-danger">Drop</a></td>
                </tr>
                <?php
        }        
        ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">ELECTORAL AREA</th>
                    <th class="font-weight-bold">POLLING #</th>
                    <th class="font-weight-bold">POLLING STATION</th>
                    <th class="font-weight-bold">VOTERS</th>
                    <th class="font-weight-bold">DROP</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Polling Station</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmadd" method="POST" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label font-weight-bold">Electoral Area</label>
                        <select name="area" id="area" class="form-control" required>
                            <option value="" selected disabled>Select Electoral Area</option>
                            <?php 
                        $query = select_records("electoral_areas");
                        while ($rec = mysqli_fetch_assoc($query)) {
                            ?>
                            <option value="<?php echo $rec['id'];?>">
                                <?php echo $rec["name"];?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" id="pollcode" name="pollcode" class="form-control" required />
                        <label class="form-label">Polling Station Code</label>
                    </div>
                    <div class="form-outline mb-3">
                        <input type="text" id="pollname" name="pollname" class="form-control" required />
                        <label class="form-label">Polling Station Name</label>
                    </div>
                    <div class="form-outline mb-2">
                        <input type="number" id="voters" name="voters" min="0" class="form-control" required />
                        <label class="form-label">Total Voters</label>
                    </div>
                    <input type="hidden" value="<?= $_SESSION['_token']; ?>" name="token" id="token">
                    <button type="submit" class="btn btn-success mt-3">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require "include/footer.php"; ?>
<script>
$('#tbllist').DataTable();

$("#btnadd").on("click", function(e) {
    e.preventDefault();
    $("#modaladd").modal("show");
});

$("#frmadd").on("submit", function(e) {
    e.preventDefault();
    $.ajax({
        type: "post",
        url: "script/polling_stations_save.php",
        data: $(this).serialize(),
        success: function(response) {
            if (response == "success") {
                alert("Operation Successful");
                window.location = "polling_stations.php";
            } else {
                alert(response);
            }
        }
    });
});
</script>