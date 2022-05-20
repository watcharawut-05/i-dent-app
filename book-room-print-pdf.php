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
$pdf->Write(8,"                                             Ẻ������ͧ��Ъ��                         ");
$pdf->SetFont("cordia","",16);
$pdf->Write(8," �Ţ���  ");
$pdf->Write(8,$meeting_id);
$pdf->Write(8,"\n");
$pdf->SetFont("cordia","",16);
$pdf->Write(8,"                                                         ".$hos);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"                                                                                       �ѹ���  ".thdate($reg_date,'lm')." ���� ".$reg_time);
$pdf->Write(10,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"����ͧ  ��͹��ѵ�����ͧ��Ъ�� ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$room_name);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"���¹  ����ӹ�¡��".$hos);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"           ��Ҿ���   ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$login);
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"          ���˹�   ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$position_name." ".$level_position_name);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"˹��§ҹ   ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$dep_name);
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"   ������  ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$dep_tel);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"�դ������ʧ���͹حҵ����ͧ��Ъ���ͧ ".$hos);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"��ѹ���  ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,thdate($sdate,'lm'));
$pdf->Write(7,"   ����  ");
$pdf->Write(7,$stime);
$pdf->Write(7," �. ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"  �֧�ѹ���    ");
$pdf->Write(7,thdate($edate,'lm'));
$pdf->Write(7,"   ����  ");
$pdf->Write(7,$etime);
$pdf->Write(7," �. ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"������㹡��    ");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,$meeting_type_name);
$pdf->Write(7," ".$topic);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"��������´    ");
$pdf->Write(7,$detail);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"��ͧ��Ъ��������  : ");
$pdf->Write(7,"".$room_name." ".$room_place);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"��èѴ���  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$format_name);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"   �ӹǹ����������  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$capacity);
$pdf->Write(7,"  ��  ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"�ػ�ó�  ");
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
$pdf->Write(7,"�����Ҿ");
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","",15);
if($label=="Y"){
$pdf->Write(7,"      [  /  ]  ");
}else{
$pdf->Write(7,"      [     ]  ");
}
$pdf->Write(7,"����˹����ͧ  �кآ�ͤ���  ".$label_text);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"������ҳ  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$budget_name);
$pdf->Write(6,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"����á�ҧ�ѹ  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$lunch_name);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"       �������ҧ ���  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$morning_snack);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"        �������ҧ ����  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$afternoon_snack);
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"    ����ͧ����  :  ");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,$drink_name);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"           �֧���¹�����ͷ�Һ����ô�Ԩ�ó�͹��ѵ�");
$pdf->Write(10,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"               ............................................... ���˹�ҧҹ                                          ...........................................������ ");
$pdf->Write(7,"\n");
$pdf->Write(7,"                   ($dep_head)                                                                  (".$login.")");
$pdf->Write(10,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"                                         [     ] ͹��ѵ�  [     ] ���͹��ѵ�");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"              .....................................................���͹��ѵ�");
$pdf->Write(7,"\n");
$pdf->Write(7,"                                                                                                                      (".$boss.")");
$pdf->Write(7,"\n");
$pdf->Write(7,"                                                                                                       ����ӹ�¡��".$hos);
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"-------------------------------------------------------------------------------------------------------------------------------------------------------");
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","B",15);
$pdf->Write(7,"�ҹ��ԡ����ͧ��Ъ��");
$pdf->Write(7,"\n");
$pdf->SetFont("cordia","",15);
$pdf->Write(7,"[   ] ����ҹ�ҹ�������Ǣ�ͧ");
$pdf->Write(7,"\n");
$pdf->Write(7,"     [   ]  �������ʵ�� ..................................................."."                    .........................................................");
$pdf->Write(7,"\n");
$pdf->Write(7,"     [   ]  ��������ͧ��Ъ��..............................................."."                   (.........................................................)");
$pdf->Write(7,"\n");
$pdf->Write(7,"     [   ]  ������ҹ�ҹ....................................................."."                  ................/......................./..................");
$pdf->Write(10,"\n");
$pdf->Write(7,"                                                                                                         ........................................................");
$pdf->Write(7,"\n");
$pdf->Write(7,"                                                                          ���˹�ҡ�����ҹ��Сѹ�آ�Ҿ �ط���ʵ��������ʹ�ȷҧ���ᾷ��");


$pdf->Output();
}
?>

