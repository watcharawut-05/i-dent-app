<?php
//include "includes/connection.php";
$y3=$y2-1;
	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$query = $conn->prepare("
	select month_sname as month,
	(select count(*) from sp_order where month(order_date)=a.month_id 
	 and order_date between '$y3-10-01' and '$y2-09-30') as torder 
	from rmc_month a");
	
	$query->execute();
	while($rs=$query->fetch(PDO::FETCH_ASSOC)) {
		$month=$rs['month'];
		$torder=$rs['torder'];
		$dataset[]="['$month',$torder]";
		
	}
$data_order=implode(",",$dataset);
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
		data.addColumn('string','เดือน');
		data.addColumn('number','<?php echo $y2+543;?>');
		data.addRows([<?php echo $data_order?>]);
				
		var view = new google.visualization.DataView(data);
		view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);
		
		var options={
			width:630,height:250,
			vAxis:{title:'จำนวน'},
			hAxis:{title:'เดือน'}
		};
		var chart=new google.visualization.LineChart(document.getElementById('chart_in'));
		chart.draw(view,options);
	}
</script>
</head>
<body>
	<div id="chart_in"></div>
</body>
</html>