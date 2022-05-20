<?php
//include "../includes/connection.php";
$y3=$y2-1;
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$query = $conn->prepare("SELECT month_sname as month,
	(select count(*) from mav_meeting where month(sdate)=a.month_id 
	 and sdate between '$y3-10-01' and '$y2-09-30') as meet_total
	from rmc_month a");
	
	$query->execute();
	while($rs=$query->fetch(PDO::FETCH_ASSOC)) {
		$month=$rs['month'];
    	$meet_total=$rs['meet_total'];
		$data_month[]="['$month',$meet_total]";
		
	}
$dataset_month=implode(",",$data_month);
?>

<!DOCTYPE HTML>
<html>
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart', 'line']});
      google.charts.setOnLoadCallback(drawCrosshairs);

function drawCrosshairs() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'day');
      data.addColumn('number', '<?php echo $y1;?>');
      data.addRows([
        <?php echo $dataset_month;?>
      ]);

      var options = {
        hAxis: {
          title: 'เดือน'
        },
        vAxis: {
          title: 'ครั้ง'
        }
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_month'));

      chart.draw(data, options);
      chart.setSelection([{row: 38, column: 1}]);
    }
    </script>
  </head>
  <body>
    <div id="chart_month" style="width: 600px; height: 300px;"></div>
  </body>
</html>