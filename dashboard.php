<?php include('middleware/verifyuser.php'); ?>
<?php require "include/header.php";
require "script/ultrafunctions.php"; ?>

<h3 class="mt-4">Presidential Statistics</h3>
<hr>
<div class="card card-body mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="chart-container">
                <canvas id="chart1"></canvas>
            </div>
        </div>
    </div>
</div>

<?php require "include/footer.php";?>
<?php 
$presidential_query = select_records("parties");
$presidential_query1 = select_records("parties");
?>

<script>
var ctx = document.getElementById("chart1").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [
    <?php while ($rec = mysqli_fetch_assoc($presidential_query)) { ?>
        "<?php echo $rec['name']; ?>",
     <?php } ?>
    ],
    datasets: [{
      backgroundColor: [
        "#14abef",
        "#02ba5a",
        "#d13adf",
        "#1266f1",
        "#f93154",
        "#262626",
        "#4f4f4f",
        "#000",
        "#d63384",
        "#6f42c1",
        "#6610f2",
        "#0d6efd",
      ],
      data: [
        <?php while ($rec = mysqli_fetch_assoc($presidential_query1)) {
            $party = $rec['name'];
            $query = select_single_column_on_condition("presidential_votes","results","party_name='$party'");
            if(mysqli_num_rows($query)>0){
                $row = mysqli_fetch_assoc($query);
                echo $row['presidential_votes'].',';
            }else{
                echo '0,';
            }
        } ?>
      ],
      borderWidth: [0, 0, 0, 0]
    }]
  },
  options: {
    maintainAspectRatio: false,
    legend: {
    position :"bottom",	
    display: false,
      labels: {
        fontColor: '#ddd',  
        boxWidth:15
      }
    },
    tooltips: {
      displayColors:false
    }
  }
});
</script>