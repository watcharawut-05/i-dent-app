<?php
$db = 'mysql:host=127.0.0.1;dbname=ident';
$username = 'sa';
$password = 'sa';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try {
    $conn = new PDO($db, $username, $password, $options);
    //echo 'ติดต่อฐานข้อมูลสำเร็จ';
} catch (PDOException $e) {
    echo 'ไม่สามารถติดต่อฐานข้อมูลได้ ' . $e->getMessage();
}

$head = "โรงพยาบาลภูเขียวเฉลิมพระเกียรติ";
$title = "I-DENT-APP";
$mtitle = "Dashboard";
$content = "";
$footer1 = "ระบบสารสนเทศสนับสนุน งานทันตกรรม<br>";
$footer2 = "โรงพยาบาลภูเขียวเฉลิมพระเกียรติ  จังหวัดชัยภูมิ<br>";
$footer3 = "โทรศัพท์ 044-861700  ";
//กำหนดปีของข้อมูล
$today = date('Y-m-d');
$t = date('H:i:s');
$y2 = date('Y');
$y3 = $y2 - 1;
$y1 = $y2 + 543;

//limit query
$limit = 30;

//กำหนดอำเภอ
//$amphur = '3610';

//token
//$linetoken='4xWDIMDKckQh39aaOaR486R2qKaSzr6zZREXJ0kUt3q';//ห้องประชุม
//$linetoken = 'AKzviuFz2pX9Zbe7U24ZaPg3B7fdse63zLAyB8Iu13s'; //pick

//depcode MAV
//$dmav = '37';
