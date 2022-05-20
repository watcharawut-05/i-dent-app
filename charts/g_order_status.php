<?php
//include "../includes/connection.php";
	$y3=$y2-1;
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$query = $conn->prepare("SELECT s.status_name,
	(select count(*) from sp_order where order_status=s.status_id
	and order_date between '$y3-10-01' and '$y2-09-30') as tstatus
	FROM sp_status s");

	$query->execute();
	while($rs=$query->fetch(PDO::FETCH_ASSOC)) {
		$status_name=$rs['status_name'];
		$tstatus=$rs['tstatus'];
		$dataset_status[]="['$status_name',$tstatus]";
	}
$dataset_status=implode(",",$dataset_status);
?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Google Chart</title>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("visualization","1",{packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart(){
		var data=new google.visualization.DataTable();
		data.addColumn('string','สถานะ');
		data.addColumn('number','<?php echo $y2+543;?>');
		data.addRows([<?php echo $dataset_status?>]);
				
		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);
		
		var options={
			width:630,height:250,
			vAxis:{title:'จำนวน'},
			hAxis:{title:'สถานะ'}
		};
		var chart=new google.visualization.ColumnChart(document.getElementById('barchart_status'));
		chart.draw(view,options);
	}
</script>
</head>
<body>
	<div id="barchart_status"></div>
</body>
</html>