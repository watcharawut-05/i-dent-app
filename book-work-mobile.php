<?php
	include "includes/sessionuser.php";
	include "includes/connection.php";
?>

<!DOCTYPE html>
<html class="lockscreen">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="img/favicon.ico">
		<title><?php echo $title; ?></title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
		<!-- iCheck for checkboxes and radio inputs -->
		<link rel="stylesheet" href="plugins/iCheck/all.css">
		
		<!-- DatePicker -->
		<link href="plugins/datepicker/datepicker3.css" rel="stylesheet" />
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php
			include "function.php";
			$booknumber = $_GET['booknumber'];
		?>
	</head>
	<body class="hold-transition login-page">
		<div class="row">
		<div class="col-lg-3">
		</div> 
			
			<div class="col-lg-6"> 
				
				<div class="box box-danger">
					<div class="box-header">
						<center><p class="box-title">บันทึกการปฏิบัติงาน</p></center>
					</div>
					<?php
						$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
						$query = $conn->prepare("SELECT m.meeting_id,r.room_name,m.topic,m.capacity,
						m.sdate,m.stime,m.edate,m.etime,t.meeting_type_name,d.dep_name,m.login,d.dep_tel,
						f.format_name,s.status_name,m.meeting_status,r.room_color,m.detail,m.reg_date,m.reg_time,
						m.wdate,m.wstime,m.wetime,m.worker,m.note_worker
                        FROM mav_meeting m
                        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
                        LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
                        LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
                        LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
                        LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
                        WHERE m.book_number=$booknumber");
						$query->execute();
						while($row=$query->fetch(PDO::FETCH_ASSOC)){
						extract($row);
					?>
				<form action="qry/add_work_mobile.php?booknumber=<?=$booknumber?>" method="post">
				<div class = 'modal-body'>
				<div class = 'form-group col-md-6'>
				<label for = 'recipient-name' class = 'col-form-label'>ห้องประชุม</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $room_name;?>" disabled>
				</div>
				<div class = 'form-group col-md-6'>
				<label for = 'recipient-name' class = 'col-form-label'>ประเภท</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $meeting_type_name;?>" disabled>
				</div>
				<div class = 'form-group col-md-12'>
				<label for = 'recipient-name' class = 'col-form-label'>หัวข้อ</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $topic;?>" disabled>
				</div>
				<div class="form-group col-md-12">
				<label for="recipient-name" class="col-form-label">รายละเอียด</label>
				<input type="text" class="form-control" id="detail" value="<?php echo $detail;?>" disabled>
				</div>
				<div class = 'form-group col-md-6'>
				<label for = 'recipient-name' class = 'col-form-label'>การจัดโต๊ะ</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $format_name;?>" disabled>
				</div>
				<div class = 'form-group col-md-6'>
				<label for = 'recipient-name' class = 'col-form-label'>จำนวน</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $capacity;?> คน" disabled>
				</div>
				<div class = 'form-group col-md-6'>
				<label for = 'recipient-name' class = 'col-form-label'>เริ่มวันที่</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo thdate($sdate,sm);?>  เวลา <?php echo $stime;?>" disabled>
				</div>
				<div class = 'form-group col-md-6'>
				<label for = 'recipient-name' class = 'col-form-label'>ถึงวันที่</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo thdate($edate,sm);?> เวลา <?php echo $etime;?>" disabled>
				</div>
				<div class = 'form-group col-md-6'>
				<label for = 'message-text' class = 'col-form-label'>หน่วยงาน</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $dep_name;?> <?php echo $dep_tel;?>" disabled>
				</div>

				<div class = 'form-group col-md-6'>
				<label for = 'message-text' class = 'col-form-label'>ผู้จอง</label>
				<input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $login;?>" disabled>
				</div>
				<div class = 'form-group'>
				<input type = 'text' class = 'form-control' style="text-align: center" id = 'recipient-name' value="ลงทะเบียน <?php echo thdate($reg_date,sm)?> เวลา <?php echo $reg_time?> น."disabled/>
				</div>
				<div class="form-group col-md-3">
                    <label for="wdate" class="col-form-label">วันที่ปฏิบัติงาน</label>
                        <input type="date" class="form-control" name="wdate" value="<?php echo $wdate;?>">
                    </div>
				<div class="form-group col-md-3">
                    <label for="wstime" class="col-form-label">เวลาเปิดห้องประชุม</label>
                    <input type="time" class="form-control" id="wstime" name="wstime" value="<?php echo $wstime;?>">
                </div>
				<div class="form-group col-md-3">
                    <label for="wetime" class="col-form-label">เวลาปิดห้องประชุม</label>
                    <input type="time" class="form-control" id="wetime" name="wetime" value="<?php echo $wetime;?>">
                </div>
				<div class = 'form-group col-md-3'>
				<label for = 'worker' class = 'col-form-label'>Worker</label>
				<input type = 'text' class = 'form-control' id = 'worker' name='worker' value = "<?php echo $sess_fullname;?>">
				</div>
				<div class="form-group col-md-12">
				<label for="note_worker" class="col-form-label">Note</label>
				<input type="text" class="form-control" id="note_worker" name="note_worker" value="<?php echo $note_worker;?>">
				</div>
				</div>
				<div class = 'modal-footer clearfix'>
				<button type="submit" class="btn btn-primary pull-left">บันทึก</button>
				<a href="mlogin.php?booknumber=<?php echo $booknumber;?>" data-dismiss="modal" aria-hidden="true" class="btn btn-success" >    ปิด   </a>
				</div>
				<?php };?>
				</form>
					
				</div>
			</div>			
		</div>    
		
		<!-- jQuery 2.2.3 -->
		<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
		<!-- Bootstrap 3.3.6 -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<!-- iCheck -->
		<script src="plugins/iCheck/icheck.min.js"></script>
		<!-- DatePicker -->
		<script src="dist/js/bootstrap-datepicker-custom.js"></script>
		<script src="dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
		
		
		
	</body>
</html>		