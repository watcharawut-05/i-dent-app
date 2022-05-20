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
$login = $_POST['login'];


$sql = "DELETE FROM mav_meeting WHERE meeting_id=$mid";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare($sql);


try {
    $query->execute();
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'ลบข้อมูลการนัด เรียบร้อยแล้ว',
});
</script>
<meta http-equiv="refresh" content="2;url=../main.php" />
<?php
} catch (PDOException $e) {
    echo 'ไม่สามารถเพิ่มข้อมูลได้' . $e->getMessage();
}
?>