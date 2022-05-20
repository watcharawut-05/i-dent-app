<?php
function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน",
	"ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
}

function checkemail($checkemail) {
	if(ereg("^[^@]+@([a-zA-Z0-9\-]+\.)+([a-zA-Z0-9\-]{2}
	|net|com|gov|mil|org|edu|int)$",$checkemail)) {
		return true;
}else{
	return false;
}
}

function thdate($dval,$m)
	{
	$thaimonthFull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน","ธันวาคม");
	$thaimonth=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.", "พ.ย.","ธ.ค.");
	$dval=str_replace('-','',$dval);
	$vm=substr($dval,4,2)-1;
	switch($m) {
		case "nm" :  return substr($dval,6,2).'/'.substr($dval,4,2).'/'.(substr($dval,0,4)+543); break ;
		case "sm" :  return substr($dval,6,2).' '.$thaimonth[$vm].' '.(substr($dval,0,4)+543); break ;
		case "lm" :  return substr($dval,6,2).' '.$thaimonthFull[$vm].' '.(substr($dval,0,4)+543); break ;
		}
	}

function d2dsql($dval) {
	$dval=str_replace("/","-",$dval);
	$da=explode('-',$dval);
	return ($da[2]-543).'-'.$da[1].'-'.$da[0] ;
}
?>
