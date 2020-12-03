<?php 
require "include/header.php"; 
require "script/ultrafunctions.php"; 
?>
<h3 class="mt-4">Parties</h3>
<hr>
<!-- <button id="btnadd" class="btn btn-primary">Add Polling Station</button> -->
<div class="card card-body mt-4">
    <div class="table-responsive">
        <table id="tbllist" class="table">
            <thead>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">PARTY NAME</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i=0;
        $query = select_records("parties");
        while ($rec = mysqli_fetch_assoc($query)) {
            $i++;
           ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $rec["name"];?></td>
                </tr>
                <?php
        }        
        ?>
            </tbody>
            <tfoot>
                <tr>
                    <th class="font-weight-bold">#</th>
                    <th class="font-weight-bold">NAME</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<?php require "include/footer.php"; ?>
<script>
// $('#tbllist').DataTable();
</script>