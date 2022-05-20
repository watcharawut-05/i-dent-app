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

$reg_date = $_POST['reg_date'];
$threg_date = thdate($reg_date, 'sm');
$reg_time = $_POST['reg_time'];
$book_number=substr($reg_date,0,4).substr($reg_date,5,2).substr($reg_date,8,2).substr($reg_time,0,2).substr($reg_time,3,2).substr($reg_time,6,2);
$type = $_POST['type'];
$sql = "SELECT meeting_type_name from mav_meeting_type where meeting_type_id=$type";
$query = $conn->prepare($sql);
$query->execute();
while ($rDep = $query->fetch(PDO::FETCH_ASSOC)) {
    $meeting_type_name = $rDep['meeting_type_name'];   
}

$rooms = $_POST['rooms'];
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
$meeting_status = '1';

//line notify api
//$room_name = $_POST['room_name'];
//$message = "\n" .
//    'จองห้องประชุม' . "\n" .
//    'ห้อง : ' . $room_name . "\n" .
//	'วันที่ : ' . $sdateth . "\n" .
//	'ถึง : ' . $edateth . "\n" .
//	'เวลา : ' . $stime .'  น.'. "\n" .
//	'ถึง : ' . $etime .'  น.'. "\n" .
//	'ประเภท : ' . $meeting_type_name . "\n" .
 //   'หัวข้อ : ' . $topic . "\n" .
//	'จำนวน : ' . $capacity . '  คน' . "\n" .
//	'จัดโต๊ะ : ' . $format_name ."\n" .
 //   'หน่วยงาน : ' . $depname . "\n" .
 //   'โทร : ' . $tel . "\n" .
 //   'ผู้จอง: ' . $login ."\n".
 //   'http://www.phukieo.net/pk-mav/mlogin.php?booknumber='.$book_number;
//sendlinemesg();
//header('Content-Type: text/html; charset=utf-8');
//$res = notify_message($message);
//--------------------

$sql = "INSERT INTO mav_meeting (reg_date,reg_time,book_number,type,rooms,capacity,topic,detail,budget,set_table,depcode,sdate,
stime,edate,etime,projector,visualizer,nb,tv,vcd_dvd,take_photo,label,label_text,lunch,morning_snack,
afternoon_snack,drink,login,meeting_status)
VALUE (:reg_date,:reg_time,:book_number,:type,:rooms,:capacity,:topic,:detail,:budget,:set_table,:depcode,:sdate,
:stime,:edate,:etime,:projector,:visualizer,:nb,:tv,:vcd_dvd,:take_photo,:label,:label_text,:lunch,
:morning_snack,:afternoon_snack,:drink,:login,:meeting_status)";
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare($sql);
$query->bindParam(':reg_date', $reg_date);
$query->bindParam(':reg_time', $reg_time);
$query->bindParam(':book_number', $book_number);
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

//line notify api
//......
//function sendlinemesg()
//{

//    define('LINE_API', "https://notify-api.line.me/api/notify");
    //define('LINE_TOKEN', 'AKzviuFz2pX9Zbe7U24ZaPg3B7fdse63zLAyB8Iu13s'); //pick
//    define('LINE_TOKEN', '4xWDIMDKckQh39aaOaR486R2qKaSzr6zZREXJ0kUt3q'); //ห้องประชุม

//    function notify_message($message)
//    {

//      $queryData = array('message' => $message);
//        $queryData = http_build_query($queryData, '', '&');
//        $headerOptions = array(
//            'http' => array(
//                'method' => 'POST',
//                'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
//                . "Authorization: Bearer " . LINE_TOKEN . "\r\n"
//                . "Content-Length: " . strlen($queryData) . "\r\n",
//                'content' => $queryData,
//            ),
//        );
//        $context = stream_context_create($headerOptions);
//        $result = file_get_contents(LINE_API, false, $context);
//        $res = json_decode($result);
//        return $res;

 //   }

//}

//--------------------

try {
    $query->execute();
    ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'จองห้องประชุม เรียบร้อยแล้ว',
});
</script>
<meta http-equiv="refresh" content="2;url=../main.php" />
<?php
} catch (PDOException $e) {
    echo 'ไม่สามารถเพิ่มข้อมูลได้' . $e->getMessage();
}
?>