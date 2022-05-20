<?php
require_once('../includes/connection.php');
require_once('../function.php');
$conn = new PDO($db,$username,$password,$options);

$room_name=$_POST['room_name'];
$room_value=$_POST['room_value'];
$room_place=$_POST['room_place'];
$room_detail=$_POST['room_detail'];
$room_pic = 'meeting_room.jpg';
$room_note=$_POST['room_note'];
$room_color=$_POST['room_color'];
$room_keeper=$_POST['room_keeper'];
$room_status='On';


$sql="INSERT INTO mav_meeting_room (room_name,room_value,room_place,room_detail,room_pic,room_note,room_color,room_keeper,room_status)
	  VALUES (:room_name,:room_value,:room_place,:room_detail,:room_pic,:room_note,:room_color,:room_keeper,:room_status)";

$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare($sql);
$query->bindParam(':room_name',$room_name);
$query->bindParam(':room_value',$room_value);
$query->bindParam(':room_place',$room_place);
$query->bindParam(':room_detail',$room_detail);
$query->bindParam(':room_pic', $room_pic);
$query->bindParam(':room_note',$room_note);
$query->bindParam(':room_color',$room_color);
$query->bindParam(':room_keeper', $room_keeper);
$query->bindParam(':room_status', $room_status);


try {
	$query->execute();
?>
<script>
	window.location = '../meeting_room.php';
</script>
<?php
} 
catch(PDOException $e){
	echo 'ไม่สามารถเพิ่มข้อมูลได้' . $e->getMessage();
}
?>