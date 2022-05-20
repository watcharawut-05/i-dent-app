<?php
require_once 'includes/chksession.php';
require_once 'includes/connection.php';
$ya = $sess_year - 1;
$yb = $sess_year;
$yy = $sess_year + 543;
?>
<!DOCTYPE html>
<html>
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.7.0/css/ionicons.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="plugins/select2/select2.min.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
			folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
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
include "modal.php";
?>
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="main.php" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $title; ?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <?php include "navbar-right.php"?>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		<?php include "sidebar-menu.php"?>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
    <?php //include ("box_main.php")?>
    <?php
$room_id = $_GET['room_id'];
$sql = "SELECT room_name FROM mav_meeting_room WHERE room_id='$room_id' ";
$query = $conn->prepare($sql);
$query->execute();
while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $room_name = $row['room_name'];
}
?>
<div class="row">
  <div class="col-md-12">
    <div class="box box-success box-solid">
	    <div class="box-header with-border">
              <h3 class="box-title">รายการจองห้องประชุม | <?=$room_name;?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
        </div>
        <div class="panel-body">
            <table id="#" class="table table-bordered table-striped">
				<thead>
					<tr class="success">
                        <th width="8%">วันที่</th>
                        <th width="8%">ถึง</th>
                        <th width="10%">เวลา</th>
                        <th width="10%">ห้องประชุม</th>
                        <th width="8%">ประเภท</th>
						            <th width="15%">หน่วยงาน</th>
                        <th width="15%">ผู้จอง</th>
                        <th width="8%">สถานะ</th>
                        <th width="5%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
                    $y3 = $y2 - 1;
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = $conn->prepare("SELECT m.meeting_id,r.room_name,r.room_color,m.topic,m.capacity,
                    m.sdate,m.stime,m.edate,m.etime,t.meeting_type_name,d.dep_name,m.login,d.dep_tel,
                    f.format_name,s.status_name,m.meeting_status,m.detail,m.reg_date,m.reg_time
                    FROM mav_meeting m
                    LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
                    LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
                    LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
                    LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
                    LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
                    WHERE m.sdate>=CURRENT_DATE()
                    AND m.rooms=$room_id
                    ORDER BY m.sdate DESC");
                    $query->execute();
                    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        extract($row);
                        ?>
					<tr>
                          <td><?php echo thdate($sdate,sm);?></td>
                          <td><?php echo thdate($edate,sm);?></td>
                          <td><?php echo $stime;?> - <?php echo $etime;?></td>
                          <td><?php echo $room_name;?></td>
                          <td><a href="" data-toggle="tooltip" title="<?=$topic;?>"><?php echo $meeting_type_name;?></a></td>
                          <td><?php echo $dep_name;?></td>
                          <td><?php echo $login;?></td>
                          <td align="center">
                              <?php if ($meeting_status == '1') {?>
                              <span class="pull-center badge bg-red">
                              <?php } elseif ($meeting_status == '2') {;?>
                              <span class="pull-center badge bg-green">
                              <?php } elseif ($meeting_status == '3') {;?>
                              <span class="pull-center badge bg-info">
                              <?php } echo $status_name; ?></td>
                              <td align = 'center'><a class = 'btn btn-success' data-toggle = 'modal' data-target = "#meeting_view<?=$meeting_id;?>" data-backdrop = 'static'><i class = 'glyphicon glyphicon-zoom-in' aria-hidden = 'true'></i></a></td>
                    </tr>
                    <div class = 'modal fade' id = "meeting_view<?=$meeting_id;?>" tabindex = '-1' role = 'dialog' aria-hidden = 'true'>
    <div class = 'modal-dialog' role = 'document'>
    <div class = 'modal-content'>
    <div class = 'modal-header'>
    <button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>
    <span aria-hidden = 'true'>&times;
    </span></button>
    <h4 class = 'modal-title'>รายละเอียด</h4>
    </div>
    <form>
    <div class = 'modal-body'>
    <div class = 'form-group col-md-6'>
    <label for = 'recipient-name' class = 'col-form-label'>ห้องประชุม</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $room_name;?>">
    </div>
    <div class = 'form-group col-md-6'>
    <label for = 'recipient-name' class = 'col-form-label'>ประเภท</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $meeting_type_name;?>">
    </div>
    <div class = 'form-group col-md-12'>
    <label for = 'recipient-name' class = 'col-form-label'>หัวข้อ</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $topic;?>">
    </div>
    <div class="form-group col-md-12">
    <label for="recipient-name" class="col-form-label">รายละเอียด</label>
    <input type="text" class="form-control" id="detail" value="<?php echo $detail;?>">
    </div>
    <div class = 'form-group col-md-6'>
    <label for = 'recipient-name' class = 'col-form-label'>การจัดโต๊ะ</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $format_name;?>">
    </div>
    <div class = 'form-group col-md-6'>
    <label for = 'recipient-name' class = 'col-form-label'>จำนวน</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $capacity;?> คน">
    </div>
    <div class = 'form-group col-md-6'>
    <label for = 'recipient-name' class = 'col-form-label'>เริ่มวันที่</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo thdate($sdate,sm);?>  เวลา <?php echo $stime;?>">
    </div>
    <div class = 'form-group col-md-6'>
    <label for = 'recipient-name' class = 'col-form-label'>ถึงวันที่</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo thdate($edate,sm);?> เวลา <?php echo $etime;?>">
    </div>
    <div class = 'form-group col-md-6'>
    <label for = 'message-text' class = 'col-form-label'>หน่วยงาน</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $dep_name;?> <?php echo $dep_tel;?>">
    </div>

    <div class = 'form-group col-md-6'>
    <label for = 'message-text' class = 'col-form-label'>ผู้จอง</label>
    <input type = 'text' class = 'form-control' id = 'recipient-name' value = "<?php echo $login;?>">
    </div>
    <div class = 'form-group'>
    <input type = 'text' class = 'form-control' style="text-align: center" id = 'recipient-name' value="ลงทะเบียน <?php echo thdate($reg_date,sm)?> เวลา <?php echo $reg_time?> น."disabled/>
    </div>

    </div>
    <div class = 'modal-footer clearfix'>
    <button type = 'button' class = 'btn btn-danger' data-dismiss = 'modal'>close</button>
    </div>
    </form>
    </div>
    </div>
    </div>
                    <?php }?>

				</tbody>

			</table>
        </div>
    </div>
    </div>
  </div>
    <div class="row">
        <div class="col-md-12">
          <div class="box box-danger">

            <div class="box-body">
            <form action="qry/book_room_add.php" method="post">
                    <div class="modal-body">
                        <h4><mark class="bg-info text-light">จองห้องประชุม</mark> </h4>
                        <div class="form-group col-md-3">
                            <label for="sdate" class="col-form-label">จองวันที่</label>
                            
                                <input type="date" class="form-control" name="sdate">
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="stime" class="col-form-label">เวลา</label>
                            <input type="time" class="form-control" id="stime" name="stime" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="edate" class="col-form-label">ถึงวันที่</label>
                            
                                <input type="date" class="form-control" name="edate">
                            
                        </div>
                        <div class="form-group col-md-3">
                            <label for="etime" class="col-form-label">เวลา</label>
                            <input type="time" class="form-control" id="etime" name="etime" required>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="rooms" class="col-form-label">ห้องประชุม</label>
                            <input type="text" class="form-control" id="rooms" value="<?php echo $room_name; ?>" disabled/>
                            <input type="hidden" name="rooms" value="<?php print $room_id;?>"/>
                            <input type="hidden" name="room_name" value="<?php print $room_name;?>"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="type" class="control-label">ประเภท</label>
							<select class="form-control select2" style="width: 100%;" id="type" name="type" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT meeting_type_id,meeting_type_name FROM mav_meeting_type");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
							<option value="<?php echo $row['meeting_type_id'] ?>"><?php echo $row['meeting_type_name'] ?></option>
							<?php };?>
							</select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="capacity" class="col-form-label">จำนวนผู้เข้าร่วม</label>
                            <input type="text" class="form-control" id="capacity" name="capacity" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="set_table" class="control-label">รูปแบบการจัดโต๊ะ</label>
							<select class="form-control select2" style="width: 100%;" id="set_table" name="set_table" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT format_id,format_name FROM mav_meeting_format");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
							<option value="<?php echo $row['format_id'] ?>"><?php echo $row['format_name'] ?></option>
							<?php };?>
							</select>
                      </div>
                        <div class="form-group col-md-9">
                            <label for="topic" class="col-form-label">หัวข้อ</label>
                            <input type="text" class="form-control" id="topic" name="topic" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="budget" class="col-form-label">งบประมาณ</label>
                            <select class="form-control select2" style="width: 100%;" id="budget" name="budget" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT budget_id,budget_name FROM mav_meeting_budget");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
							<option value="<?php echo $row['budget_id'] ?>"><?php echo $row['budget_name'] ?></option>
							<?php };?>
							</select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="detail" class="col-form-label">รายละเอียด</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="ถ้ามี">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="lunch" class="control-label">อาหารกลางวัน</label>
							<select class="form-control select2" style="width: 100%;" id="lunch" name="lunch" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT lunch_id,lunch_name FROM mav_meeting_lunch");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
							<option value="<?php echo $row['lunch_id'] ?>"><?php echo $row['lunch_name'] ?></option>
							<?php };?>
							</select>
                      </div>
                      <div class="form-group col-md-3">
                            <label for="morning_snack" class="control-label">อาหารว่าง เช้า</label>
							<select class="form-control select2" style="width: 100%;" id="morning_snack" name="morning_snack" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT snack_id,snack_name FROM mav_meeting_snack");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
							<option value="<?php echo $row['snack_id'] ?>"><?php echo $row['snack_name'] ?></option>
							<?php };?>
							</select>
                      </div>
                      <div class="form-group col-md-3">
                            <label for="afternoon_snack" class="control-label">อาหารว่าง บ่าย</label>
							<select class="form-control select2" style="width: 100%;" id="afternoon_snack" name="afternoon_snack" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT snack_id,snack_name FROM mav_meeting_snack");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                            <option value="<?php echo $row['snack_id'] ?>"><?php echo $row['snack_name'] ?></option>
                            <?php };?>
							</select>
                      </div>
                      <div class="form-group col-md-3">
                            <label for="drink" class="control-label">เครื่องดื่ม</label>
							<select class="form-control select2" style="width: 100%;" id="drink" name="drink" data-validation="required">
								<?php
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = $conn->prepare("SELECT drink_id,drink_name FROM mav_meeting_drink");
                                $query->execute();
                                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
							<option value="<?php echo $row['drink_id'] ?>"><?php echo $row['drink_name'] ?></option>
							<?php };?>
							</select>
                      </div>
                      <h4><mark class="bg-danger text-light">อุปกรณ์</mark> </h4>
                        <div class="form-row bg-ker py-4">
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="projector" name="projector" value="Y">
                                <label class="custom-control-label" for="projector">Projector</label>
                            </div>
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="visualizer" name="visualizer"  value="Y">
                                <label class="custom-control-label" for="visualizer">Visualizer</label>
                            </div>
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="nb" name="nb"  value="Y">
                                <label class="custom-control-label" for="nb">Nookbook</label>
                            </div>
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="tv" name="tv"  value="Y">
                                <label class="custom-control-label" for="tv">TV</label>
                            </div>
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="vcd_dvd" name="vcd_dvd"  value="Y">
                                <label class="custom-control-label" for="vcd_dvd">DVD/VCD</label>
                            </div>
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="take_photo" name="take_photo"  value="Y">
                                <label class="custom-control-label" for="take_photo">ถ่ายภาพ</label>
                            </div>
                            <div class="col-md-2 offset-1 px-3 pt-2">
                                <input type="checkbox" class="custom-control-input" id="label" name="label"  value="Y">
                                <label class="custom-control-label" for="label">ป้ายหน้าห้อง</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="label_text" name="label_text" placeholder="ระบุข้อความ">
                            </div>
                        </div>
                        <h4><mark class="bg-danger text-light">วันเดือนปีที่จอง</mark> </h4>
                        <div class="form-group col-md-3">
                            <label for="reg_date" class="col-form-label">วันที่</label>
                            <input type="text" class="form-control" id="reg_date" name="reg_date" value="<?php echo thdate($today, 'sm'); ?>" disabled/>
                            <input type="hidden" name="reg_date" value="<?php print $today;?>"/>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="reg_time" class="col-form-label">เวลา</label>
                            <input type="text" class="form-control" id="reg_time" name="reg_time" value="<?php echo $t; ?>" disabled/>
                            <input type="hidden" name="reg_time" value="<?php print $t;?>"/>
                        </div>
                        <div class="form-group col-md-3">
                        <label for="depcode">หน่วยงาน</label>
                        <select class="form-control select2" id="depcode" name="depcode" data-validation="required">
                          <?php
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = $conn->prepare("SELECT dep_id,dep_name,dep_tel FROM dep WHERE dep_status='Y' GROUP BY dep_name");
                            $query->execute();
                            while ($rowD = $query->fetch(PDO::FETCH_ASSOC)) {
                                $depcode = $rowD['dep_id'];
                                $depname = $rowD['dep_name'];
                                $tel = $rowD['dep_tel'];
                                ?>
                            <option value="<?php echo $depcode; ?>" <?php if ($sess_depcode == $depcode) {echo " selected ";}?>><?php echo $depname; ?></option>
							<?php	};?>
                        </select>

                    </div>
                        <div class="form-group col-md-3">
                        <label for="login">ผู้จอง</label>
                        <select class="form-control select2" id="login" name="login" data-validation="required">
                          <?php
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = $conn->prepare("SELECT user_id,fullname FROM user WHERE status='1' ORDER BY fullname");
                            $query->execute();
                            while ($rowD = $query->fetch(PDO::FETCH_ASSOC)) {
                                $user_id = $rowD['user_id'];
                                $fullname = $rowD['fullname'];
                                ?>
                          <option value="<?php echo $fullname; ?>" <?php if ($sess_user_id == $user_id) {echo " selected ";}?>><?php echo $fullname; ?></option>
                          <?php };?>
					    </select>
                    </div>
            </div>
                <div class="form-row">
					<button type="submit" class="btn btn-primary pull-left">บันทึก</button>
					<a href="main.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success pull-right" >    ปิด   </a>
				</div>
            </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

	<footer class="main-footer">
    	<p><?php echo $footer1; ?></p>
		<p><?php echo $footer2; ?></p>
		<p>&copy; <?php echo $footer3; ?></p>
	</footer>
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- DatePicker -->
<script src="dist/js/bootstrap-datepicker-custom.js"></script>
<script src="dist/locales/bootstrap-datepicker.th.min.js" charset="UTF-8"></script>
		<script>
			$(document).ready(function () {
				$('#datepicker1').datepicker({
					format: 'dd/mm/yyyy',
					todayBtn: true,
					language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
					thaiyear: true ,              //Set เป็นปี พ.ศ.
					autoclose: true
				}).datepicker("setDate", "0");
				//กำหนดเป็นวันปัจุบัน
				$('#datepicker2').datepicker({
					format: 'dd/mm/yyyy',
					todayBtn: true,
					language: 'th',             //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
					thaiyear: true ,              //Set เป็นปี พ.ศ.
					autoclose: true
				}).datepicker("setDate", "0");
			});
		</script>
        <!-- End DatePicker -->

<!-- page script -->
<script>
  $(".select2").select2();
  $(function () {
    $("#example1").DataTable({
	  "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
	  });

	$("#example2").DataTable({
	  "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false
	  });
    $('#example3').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false

    });
  });
</script>
</body>
</html>
