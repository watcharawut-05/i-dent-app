<?php
require_once '../includes/connection.php';
require_once '../function.php';
$conn = new PDO($db, $username, $password, $options);

$room_id = $_GET['room_id'];

$sql = "DELETE FROM mav_meeting_room WHERE room_id=:room_id ";

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare($sql);
$query->bindParam(':room_id', $room_id);

try {
    $query->execute();
    ?>
<script>
	window.location = '../meeting_room.php';
</script>
<?php
} catch (PDOException $e) {
    echo 'ไม่สามารถเพิ่มข้อมูลได้' . $e->getMessage();
}
?>