<!DOCTYPE html>
<html class="lockscreen">
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
		<script src="../dist/sweetalert2.min.js"></script>
		<link rel="stylesheet" href="../dist/sweetalert2.min.css">
	</head>
<body>
</body>
<?php
require_once '../includes/connection.php';
require_once '../function.php';
$conn = new PDO($db, $username, $password, $options);

$mid=$_GET['mid'];

$reg_date = $_POST['reg_date'];
$threg_date = thdate($reg_date, 'sm');
$reg_time = $_POST['reg_time'];
$type = $_POST['type'];
$sql = "SELECT meeting_type_name from mav_meeting_type where meeting_type_id=$type";
$query = $conn->prepare($sql);
$query->execute();
while ($rDep = $query->fetch(PDO::FETCH_ASSOC)) {
    $meeting_type_name = $rDep['meeting_type_name'];   
}

$rooms = $_POST['rooms'];
$sql = "SELECT room_name FROM mav_meeting_room WHERE room_id=$rooms";
$query = $conn->prepare($sql);
$query->execute();
while ($rDep = $query->fetch(PDO::FETCH_ASSOC)) {
    $room_name = $rDep['room_name'];   
}
$capacity = $_POST['capacity'];
$topic = $_POST['topic'];
$detail = $_POST['detail'];
$budget = $_POST['budget'];
$set_table = $_POST['set_table'];
$sql = "SELECT format_name from mav_meeting_format where format_id=$set_table";
$query = $conn->prepare($sql);
$query->execute();
while ($rDep = $query->fetch(PDO::FETCH_ASSOC)) {
    $format_name = $rDep['format_name'];
}

$depcode = $_POST['depcode'];
$sql = "select dep_name,dep_tel from dep where dep_id=$depcode";
$query = $conn->prepare($sql);
$query->execute();
while ($rDep = $query->fetch(PDO::FETCH_ASSOC)) {
    $depname = $rDep['dep_name'];
    $tel = $rDep['dep_tel'];
}

$sdate = $_POST['sdate'];
$edate = $_POST['edate'];
$sdateth = thdate($sdate,nm);
$edateth = thdate($edate,nm);
$stime = $_POST['stime'];
$etime = $_POST['etime'];
$projector = $_POST['projector'];
$visualizer = $_POST['visualizer'];
$nb = $_POST['nb'];
$tv = $_POST['tv'];
$vcd_dvd = $_POST['vcd_dvd'];
$take_photo = $_POST['take_photo'];
$label = $_POST['label'];
$label_text = $_POST['label_text'];
$lunch = $_POST['lunch'];
$morning_snack = $_POST['morning_snack'];
$afternoon_snack = $_POST['afternoon_snack'];
$drink = $_POST['drink'];
$login = $_POST['login'];
$approve_user = $_POST['approve_user'];
$meeting_status = $_POST['meeting_status'];

$sql = "UPDATE mav_meeting SET reg_date=:reg_date,reg_time=:reg_time,type=:type,rooms=:rooms,
capacity=:capacity,topic=:topic,detail=:detail,budget=:budget,set_table=:set_table,depcode=:depcode,sdate=:sdate,
stime=:stime,edate=:edate,etime=:etime,projector=:projector,visualizer=:visualizer,nb=:nb,tv=:tv,
vcd_dvd=:vcd_dvd,take_photo=:take_photo,label=:label,label_text=:label_text,lunch=:lunch,
morning_snack=:morning_snack,afternoon_snack=:afternoon_snack,drink=:drink,login=:login,
meeting_status=:meeting_status WHERE meeting_id=$mid";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare($sql);
$query->bindParam(':reg_date', $reg_date);
$query->bindParam(':reg_time', $reg_time);
$query->bindParam(':type', $type);
$query->bindParam(':rooms', $rooms);
$query->bindParam(':capacity', $capacity);
$query->bindParam(':topic', $topic);
$query->bindParam(':detail', $detail);
$query->bindParam(':budget', $budget);
$query->bindParam(':set_table', $set_table);
$query->bindParam(':depcode', $depcode);
$query->bindParam(':sdate', $sdate);
$query->bindParam(':stime', $stime);
$query->bindParam(':edate', $edate);
$query->bindParam(':etime', $etime);
$query->bindParam(':projector', $projector);
$query->bindParam(':visualizer', $visualizer);
$query->bindParam(':nb', $nb);
$query->bindParam(':tv', $tv);
$query->bindParam(':vcd_dvd', $vcd_dvd);
$query->bindParam(':take_photo', $take_photo);
$query->bindParam(':label', $label);
$query->bindParam(':label_text', $label_text);
$query->bindParam(':lunch', $lunch);
$query->bindParam(':morning_snack', $morning_snack);
$query->bindParam(':afternoon_snack', $afternoon_snack);
$query->bindParam(':drink', $drink);
$query->bindParam(':login', $login);
$query->bindParam(':meeting_status', $meeting_status);


try {
    $query->execute();
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'อนุมัติการนัด เรียบร้อยแล้ว',
});
</script>
<meta http-equiv="refresh" content="2;url=../main.php" />
<?php
} catch (PDOException $e) {
    echo 'ไม่สามารถเพิ่มข้อมูลได้' . $e->getMessage();
}
?>