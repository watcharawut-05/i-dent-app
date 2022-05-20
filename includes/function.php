<?
function canaccess($right)
{
$result=false;
$accessright=getsqldata('select accessright as cc from opduser where loginname="'.$_SESSION['loginname'].'" limit 1');


if (strpos(strtoupper($accessright), strtoupper(substr($right, 7))) || strpos(strtoupper($accessright),'ADMIN')>0)
//if (strpos(strtoupper($accessright),strtoupper($right)) || strpos(strtoupper($accessright),'ADMIN')>0)  
	$result=true;
if ($result<>true)
	{	echo "<script> ";
		echo "alert('Access Dinied !!  ต้องการสิทธิ์ ".$right." ')";
		echo "</script> ";
	//	
	echo "<ul data-role='listview' data-inset='true' align='center'>   ";
	echo "			<li data-role='list-divider' ><font sixe ='+3' color>Access Denied !! </font> </li> ";
	echo "			<li><a href='javascript:history.back();' data-role='button' data-theme='c' data-icon='back'  >Back</a></li> ";
	echo "		</ul> ";
	exit;
	}
}
function GetFulNameByHn($hn)
{
return getsqldata("select concat(p.pname,' ',p.fname,' ',p.lname) As cc from patient p where hn='".$hn."'");
}


function GetPatientAddress($hn)
{
return getsqldata("select concat(addrpart,' ม.',moopart,td.full_name ) As cc from patient pt,thaiaddress td where td.addressid=concat(pt.chwpart,pt.amppart,pt.tmbpart) and hn='".$hn."'");
}

function GetAddrByHn($hn)
{
return getsqldata("select concat(addrpart,' ม.',moopart,td.full_name ) As cc from patient pt,thaiaddress td where td.addressid=concat(pt.chwpart,pt.amppart,pt.tmbpart) and hn='".$hn."'");
}


function GetHnByAn($an)
{
return getsqldata("select hn as cc from ipt where an='".$an."'");
}


//GetDateRangeDialog


function getserialnumber($para)
{
return getsqldata("select get_serialnumber('".$para."') as cc " );
}

function getsqldata($sql)
{
$obj = null;
db_loadObject($sql,$obj);
return $obj->cc;
}

function GetSQLStringData($sql)
{
$obj = null;
db_loadObject($sql,$obj);
return $obj->cc;
}

function GetSQLIntegerData($sql)
{
$obj = null;
db_loadObject($sql,$obj);
return $obj->num;
}



function FormatThaiDate($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		if ($strHour>0) 
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		else
		return "$strDay $strMonthThai $strYear";
	}



function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		if ($strHour>0) 
		return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
		else
		return "$strDay $strMonthThai $strYear";
	}


function GetSQLSubQueryData($sql)	
{	$text=''; 
	$obj_detail = null;
	$obj_detail = db_loadList(  $AppUI,$sql, NULL );
	$row=0;
	foreach($obj_detail as $key_detail)
	 	{
		if ($row>0)
			$text =$text.','.$key_detail[cc].'';
		else
			$text=''.$key_detail[cc].'';	
		$row=$row+1;
		}
	return $text;	
}

function GetHomeVisit($visit_id)	
{	
	$text='';
	$sql="select p.cid,pa.hn,concat(p.pname,p.fname,' ',p.lname) as ptname,p.pttype,p.pttype_no,p.chronic_disease_list,pv.*,pvt.person_visit_type_name,p.age_y,p.sex,round(pv.bw/(pv.height*pv.height/10000),1) as bmi from person p join patient pa on (pa.cid=p.cid) join person_visit pv on (p.person_id=pv.person_id) left join person_visit_type pvt on (pv.person_visit_type_id=pvt.person_visit_type_id) where pv.person_visit_id=".$visit_id;
	$obj = null;
	db_loadObject($sql,$obj);
	$text="บันทึกการเยี่ยม: \r\n ".$obj->visit_note."\r\n"."อาการและอาการแสดง: \r\n ".$obj->visit_problem." \r\n การพยาบาล: \r\n ".$obj->visit_service."\r\n การให้คำแนะนำ: \r\n".$obj->visit_advice." \r\n การประเมินผล : ".$obj->visit_eval_text;
	return $text;	
}

function GetChronicByHN($hn)
	{
		$strclinic = getsqldata("select c.name as cc from clinicmember cm join clinic c on (cm.clinic=c.clinic) where hn=' ".$hn."'");
		if ($strclinic>0) 
		return "$strclinic";
		else
		return "ปฏิเสธ";
	}

//function getsqlsubquerydata($sql)	
//{	$text=''; 
//	$obj_detail = null;
//	$obj_detail = db_loadList(  $AppUI,$sql, NULL );
//	$row=0;
//	foreach($obj_detail as $key_detail)
//	 	{
//		if ($row>0)
//			$text =$text."'".$key_detail[cc]."'";
//		else
//			$text="'".$key_detail[cc]."'";	
//		$row=$row+1;
//		}
//	return $text;	
//}

?>