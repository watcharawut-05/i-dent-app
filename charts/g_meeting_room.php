<?php
//require_once('../includes/config.php');
$y3=$y2-1;
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$query = $conn->prepare("SELECT r.room_name,r.room_color,
	(select count(*) from mav_meeting where rooms=r.room_id
	and sdate between '$y3-10-01' and '$y2-09-30') as rtotal
	from mav_meeting_room r");
	
	$query->execute();
	while($rs=$query->fetch(PDO::FETCH_ASSOC)) {
		$room_name=$rs['room_name'];
		$rtotal=$rs['rtotal'];
		$room_color=$rs['room_color'];
		$dataset_room[]="['$room_name',$rtotal,'$room_color']";
			
	}
	$data_room=implode(",",$dataset_room);
?>

<!DOCTYPE HTML>
<html>
  <head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {packages: ['corechart', 'bar']});
	  google.charts.setOnLoadCallback(drawBasic);

	  function drawBasic() {

		var data = google.visualization.arrayToDataTable([
         ['Element', '<?php echo $y1;?>',{ role: 'style' }],
         <?php echo $data_room;?>
      ]);
	 

      var options = {
        title: '',
        hAxis: {
          title: 'ห้องประชุม',
          
        },
        vAxis: {
          title: 'ครั้ง'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }
	</script>
  </head>
  <body>
    <div id="chart_div" style="width: 600px; height: 300px;"></div>
  </body>
</html>