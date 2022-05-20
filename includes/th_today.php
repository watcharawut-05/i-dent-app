<? session_start();
include "includes/connection.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$title?></title>
</head>
</html>
<font face="tahoma" size="2">
<?
$thai_w=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์",);
$thai_n=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาาคม","พฤศจิกายน",
"ธันวาคม",);
$w=$thai_w[date("w")];
$d=date("d");
$n=$thai_n[date("n")-1];
$y=date("y")+2543;
echo "วัน $w ที่ $d $n $y";
?>
</font>
