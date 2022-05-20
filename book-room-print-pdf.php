<?php
include 'includes/chksession.php';
include 'function-tis620.php';
include 'includes/connection-tis.php';	

$mid=$_GET['mid'];
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("SELECT m.*,r.room_name,d.dep_name,d.dep_tel,d.dep_head,
t.meeting_type_name,f.format_name,r.room_value,r.room_place,hp.position_name,hl.level_position_name,
l.lunch_name,sn1.snack_name AS morning_snack,sn2.snack_name AS afternoon_snack,dr.drink_name,bg.budget_name
    FROM mav_meeting m 
    LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
    LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
    LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
    LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
    LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
	LEFT OUTER JOIN mav_meeting_lunch l ON l.lunch_id=m.lunch
	LEFT OUTER JOIN mav_meeting_snack sn1 ON sn1.snack_id=m.morning_snack
	LEFT OUTER JOIN mav_meeting_snack sn2 ON sn2.snack_id=m.afternoon_snack
	LEFT OUTER JOIN mav_meeting_drink dr ON dr.drink_id=m.drink
	LEFT OUTER JOIN mav_meeting_budget bg ON bg.budget_id=m.budget
	LEFT OUTER JOIN user u ON u.fullname=m.login
	LEFT OUTER JOIN hr_person h ON h.user_id=u.user_id
	LEFT OUTER JOIN hr_position hp ON hp.position_id=h.position
	LEFT OUTER JOIN hr_level_position hl ON hl.level_position_id=h.level_position
    WHERE m.meeting_id=$mid");
			$query->execute();
			while($rs=$query->fetch(PDO::FETCH_ASSOC)){
			extract($rs);	
		
require("fpdf/ThaiPDF.class.php");
$pdf=new ThaiPDF();
$pdf->AddThaiFont();
$pdf->AddPage();
$pdf->SetLeftMargin(20);
$pdf->SettopMargin(40);
$pdf->SetrightMargin(10);

$pdf->SetFont("cordia","B",18);
$pdf->Write(5,"\n");
$pdf->Write(8,"                                             แบบขอใช้ห้องประชุม                         ");
$pdf->SetFont("cordia","",16);
$pdf->Write(8," เลขที่  ");
$pdf->Write(8,$meeting_id);
$pdf->Write(8,"\n");
$pdf->SetFont("cordia","",16);
$pdf->Write(8,"                                                         ".$hos);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"                                                                                       วันที่  ".thdate($reg_date,'lm')." เวลา ".$reg_time);
$pdf->Write(10,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"เรื่อง  ขออนุมัติใช้ห้องประชุม ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$room_name);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"เรียน  ผู้อำนวยการ".$hos);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"           ข้าพเจ้า   ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$login);
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"          ตำแหน่ง   ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$position_name." ".$level_position_name);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"หน่วยงาน   ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$dep_name);
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"   เบอร์โทร  ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$dep_tel);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"มีความประสงค์ขออนุญาตใช้ห้องประชุมของ ".$hos);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"ในวันที่  ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,thdate($sdate,'lm'));
$pdf->Write(7,"   เวลา  ");
$pdf->Write(7,$stime);
$pdf->Write(7," น. ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"  ถึงวันที่    ");
$pdf->Write(7,thdate($edate,'lm'));
$pdf->Write(7,"   เวลา  ");
$pdf->Write(7,$etime);
$pdf->Write(7," น. ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"เพื่อใช้ในการ    ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$meeting_type_name);
$pdf->Write(7," ".$topic);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"รายละเอียด    ");
$pdf->Write(7,$detail);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"ห้องประชุมที่ขอใช้  : ");
$pdf->Write(7,"".$room_name." ".$room_place);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"การจัดโต๊ะ  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$format_name);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"   จำนวนผู้เข้าร่วม  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$capacity);
$pdf->Write(7,"  คน  ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"อุปกรณ์  ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
if($projector=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"Projector");
$pdf->SetFont("cordia","",15);
if($visualizer=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"Visualizer");
$pdf->SetFont("cordia","",15);
if($nb=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"Notebook");
$pdf->SetFont("cordia","",15);
if($tv=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"TV      ");
$pdf->SetFont("cordia","",15);
if($vcd_dvd=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"CVD/DVD");
$pdf->SetFont("cordia","",15);
if($take_photo=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"ถ่ายภาพ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
if($label=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"ป้ายหน้าห้อง  ระบุข้อความ  ".$label_text);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"งบประมาณ  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$budget_name);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"อาหารกลางวัน  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$lunch_name);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"       อาหารว่าง เช้า  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$morning_snack);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"        อาหารว่าง บ่าย  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$afternoon_snack);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"    เครื่องดื่ม  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$drink_name);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"           จึงเรียนมาเพื่อทราบและโปรดพิจารณาอนุมัติ");
$pdf->Write(10,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"               ............................................... หัวหน้างาน                                          ...........................................ผู้ขอใช้ ");
$pdf->Write(7,"\n");
$pdf->Write(7,"                   ($dep_head)                                                                  (".$login.")");
$pdf->Write(10,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"                                         [     ] อนุมัติ  [     ] ไม่อนุมัติ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"              .....................................................ผู้อนุมัติ");
$pdf->Write(7,"\n");
$pdf->Write(7,"                                                                                                                      (".$boss.")");
$pdf->Write(7,"\n");
$pdf->Write(7,"                                                                                                       ผู้อำนวยการ".$hos);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"-------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"งานบริการห้องประชุม");
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"[   ] ประสานงานผู้เกี่ยวข้อง");
$pdf->Write(7,"\n");
$pdf->Write(7,"     [   ]  โภชนาศาสตร์ ..................................................."."                    .........................................................");
$pdf->Write(7,"\n");
$pdf->Write(7,"     [   ]  ผู้ดูแลห้องประชุม..............................................."."                   (.........................................................)");
$pdf->Write(7,"\n");
$pdf->Write(7,"     [   ]  ผู้ประสานงาน....................................................."."                  ................/......................./..................");
$pdf->Write(10,"\n");
$pdf->Write(7,"                                                                                                         ........................................................");
$pdf->Write(7,"\n");
$pdf->Write(7,"                                                                          หัวหน้ากลุ่มงานประกันสุขภาพ ยุทธศาสตร์และสารสนเทศทางการแพทย์");


$pdf->Output();
}
?>

