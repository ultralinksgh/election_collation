<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">Electoral Areas</h3>
<hr>
<button id="btnadd" class="btn btn-primary">Add Electoral Area</button>
<div class="card card-body mt-4">
    <div class="table-responsive">
        <table id="tbllist" class="table table-sm">
            <thead>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">CONSTITUENCY NAME</th>
                    <th class="font-weight-bold">ELECTORAL AREA</th>
                    <th class="font-weight-bold">DROP</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
        $query = select_records("view_electoral_areas");
        while ($rec = mysqli_fetch_assoc($query)) {
            $i++;
           ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $rec["constituency"];?></td>
                    <td><?php echo $rec["name"];?></td>
                    <td><a href="#" data-name="<?php echo $rec['name']; ?>" data-id="<?php echo $rec['id']; ?>" class="font-weight-bold text-danger btn_delete">Drop</a></td>
                </tr>
                <?php
        }        
        ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">CONSTITUENCY NAME</th>
                    <th class="font-weight-bold">ELECTORAL AREAS</th>
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
                <h5 class="modal-title">Add Electoral Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="frmadd" method="POST" autocomplete="off">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label class="form-label font-weight-bold">Constituency</label>
                        <select name="constituency" id="constituency" class="form-control" required>
                            <option value="" selected disabled>Select Constituency</option>
                            <?php 
                        $query = select_records("constituencies");
                        while ($rec = mysqli_fetch_assoc($query)) {
                            ?>
                            <option value="<?php echo $rec['id'];?>">
                                <?php echo $rec["constituency"];?></option>
                            <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-outline">
                        <input type="text" id="electarea" name="electarea" class="form-control" required />
                        <label class="form-label">Electoral Area Name</label>
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
        url: "script/electoral_areas_save.php",
        data: $(this).serialize(),
        success: function(response) {
            if (response == "success") {
                alert("Operation Successful");
                window.location = "electoral_areas.php";
            } else {
                alert(response);
            }
        }
    });
});

//delete
$('#tbllist tbody').on('click', '.btn_delete', function(e){
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this);
    if(confirm($this.data('name')+'\nSure to delete?')){
        $.ajax({
            url: 'script/electoral_areas_delete.php',
            type: 'POST',
            data: {id:$this.data('id')},
            success: function(resp){
                if(resp=='success'){
                    alert('Deleted successful');
                }
                else{
                    alert(resp);
                }
            },
            error: function(resp){
                alert('Something went wrong');
            }
        });
    }
    return false;
});
</script>