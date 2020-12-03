<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">Constituencies</h3>
<hr>
<button id="btnadd" class="btn btn-primary">Add Constituency</button>
<div class="card card-body mt-4">
    <div class="table-responsive">
        <table id="tbllist" class="table table-sm">
            <thead>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">DISTRICT</th>
                    <th class="font-weight-bold">CONSTITUENCY NAME</th>
                    <th class="font-weight-bold">DROP</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
        $query = select_records("constituencies");
        while ($rec = mysqli_fetch_assoc($query)) {
            $i++;
           ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $rec["district"];?></td>
                    <td><?php echo $rec["constituency"];?></td>
                    <td><a href="#" class="font-weight-bold text-danger">Drop</a></td>
                </tr>
                <?php
        }        
        ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">DISTRICT</th>
                    <th class="font-weight-bold">CONSTITUENCY NAME</th>
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
                <h5 class="modal-title">Add Constituency</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmadd" method="POST" autocomplete="off">
                <div class="modal-body">
                    <div class="form-outline mb-4">
                        <input type="text" id="district" name="district" class="form-control" required />
                        <label class="form-label">District</label>
                    </div>
                    <div class="form-outline">
                        <input type="text" id="constituency" name="constituency" class="form-control" required />
                        <label class="form-label">Constituency</label>
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
        url: "constituencies_save.php",
        data: $(this).serialize(),
        success: function(response) {
            if (response == "success") {
                alert("Operation Successful");
                window.location = "constituencies.php";
            } else {
                alert(response);
            }
        }
    });
});
</script>