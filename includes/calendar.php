<html>
<head>
<title>ปฏิทิน</title>
<style type="text/css">
	.today	{font-family: tahoma; font-size: 10pt; font-weight: bold; background-color: #FF9933; color: #FFFFFF; border: 1 double #000000;}
	.sunday	{font-family: tahoma; font-size: 10pt; background-color: #66CC00; color: #FFFFFF;}
	.norm	{font-family: tahoma; font-size: 10pt; background-color: #FFFFFF; color: #000000;}
</style>
</head>
<body Topmargin="0">
<?php
$diffHour=0;
$diffMinute=0;
if($dfMonth=="") {
	$calTime=getdate(date(mktime(date("H")+$diffHour,date("i")+$diffMinute)));
	$today=$calTime["mday"];
	$month=$calTime["mon"];
	$year=$calTime["year"];
}
else {
	if($dfMonth==0) {
		$dfMonth=12;
		$dfYear=$dfYear-1;
	}
		elseif ($dfMonth==13) {
			$dfMonth =1;
			$dfYear=$dfYear+1;
		}
		$calTime=getdate(date(mktime((date("H")+$diffHour),(date("i")+$diffMinute),0,$dfMonth,$today,$dfYear)));
		$today=$calTime["mday"];
		$month=$calTime["mon"];
		$year=$calTime["year"];
}
$Lday = LastDay($month, $year);
$FTime=getdate(date(mktime(0,0,0,$month,1,$year)));
$wday=$FTime["wday"];
$thmonthname=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตลาคมุ", "พฤศจิกายน","ธันวาคม");
function LastDay($m, $y) {
	for ($i=29; $i<=32; $i++) {
		if (checkdate($m,$i,$y)==0) {
			return $i - 1;
		}
	}
}
?>
<table align="top" border="1" bordercolor="#000000" width="184">
<tr class="norm">
<td width="24" align="center">
<a href="<?php echo $PHP_SELF; ?>
?today=<?php echo $today; ?>
&dfMonth=<?php echo ($month - 1) ?>
&dfYear=<?php echo $year; ?>">&lt;</a>
</td>
<td width="120" align="center" colspan="5" bgcolor="#F9F4DD">
<?php echo $thmonthname[$month - 1]; ?>&nbsp;
<?php echo ($year + 543); ?>
</td>
<td width="24" align="center">
<a href="<?php echo $PHP_SELF; ?>
?today=<?php echo $today; ?>
&dfMonth=<?php echo ($month + 1) ?>
&dfYear=<?php echo $year; ?>">&gt;</a>
</td><tr>
<tr>
<td width="24" align="center" class="sunday">อา</td>
<td width="24" align="center" class="norm">จ</td>
<td width="24" align="center" class="norm">อ</td>
<td width="24" align="center" class="norm">พ</td>
<td width="24" align="center" class="norm">พฤ</td>
<td width="24" align="center" class="norm">ศ</td>
<td width="24" align="center" class="norm">ส</td>
</tr>

<?php
$iday=1;
for ($i=0; $i<=6; $i++) {
	if ($i < $wday) {
		if ($i==0) {
			echo "<td width=\"24\" align=\"center\" class=\"sunday\">&nbsp;</td>\n";
		}
		else {
			echo "<td width=\"24\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
		}
	}
	else {
		if ($i==0 && ($iday !=$today)) {
			echo "<td width=\"24\" align=\"center\" class=\"sunday\">$iday</td>\n";
		}
		elseif($iday==$today) {
			echo "<td width=\"24\" align=\"center\" class=\"today\">$iday</td>\n";
		}
		else {
			echo "<td width=\"24\" align=\"center\" class=\"norm\">$iday</td>\n";
		}
		$iday++;
	}
}
for ($j=0; $j<=4; $j++) {
	if ($iday <= $Lday) {
		echo "<tr>\n";
		for ($i=0; $i<=6; $i++) {
			if ($iday <= $Lday) {
				if ($i==0 && ($iday != $today)) {
					echo "<td width=\"24\" align=\"center\" class=\"sunday\">$iday</td>\n";
				}
				elseif ($i == 0 && ($iday == $today)) {
					echo "<td width=\"24\" align=\"center\" class=\"today\">$iday</td>\n";
				}
				elseif ($iday==$today) {
					echo "<td width=\"24\" align=\"center\" class=\"today\">$iday</td>\n";
				}
				else {
					echo "<td width=\"24\" align=\"center\" class=\"norm\">$iday</td>\n";
				}
				$iday++;
			}
			else {
				echo "<td width=\"24\" align=\"center\" class=\"norm\">&nbsp;</td>\n";
			}
		}
		echo "</tr>\n";
	}
	else {
		break;
	}
}
?>
<tr class="norm">
<td align="center" width="168" colspan="7">
<a href="<?php echo $PHP_SELF; ?>">วันที่ปัจจุบัน</a></td></tr></table>
</body>
</html>