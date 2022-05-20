<?php
require_once('../includes/connection.php');
require_once('../function.php');
$conn = new PDO($db,$username,$password,$options);

$booknumber=$_GET['booknumber'];
$wdate=$_POST['wdate'];
$wstime=$_POST['wstime'];
$wetime=$_POST['wetime'];
$worker=$_POST['worker'];
$note_worker=$_POST['note_worker'];
$wupdate=date('Y-m-d H:i:s');

$sql="UPDATE mav_meeting SET wdate=:wdate,wstime=:wstime,
wetime=:wetime,worker=:worker,note_worker=:note_worker,wupdate=:wupdate 
WHERE book_number=$booknumber";

$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare($sql);
$query->bindParam(':wdate',$wdate);
$query->bindParam(':wstime',$wstime);
$query->bindParam(':wetime',$wetime);
$query->bindParam(':worker',$worker);
$query->bindParam(':note_worker', $note_worker);
$query->bindParam(':wupdate',$wupdate);

try {
	$query->execute();
?>
<script>
	window.location = '../success.php';
</script>
<?php
} 
catch(PDOException $e){
	echo 'ไม่สามารถเพิ่มข้อมูลได้' . $e->getMessage();
}
?>