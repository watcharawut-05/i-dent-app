<?php
require_once('includes/chksession.php');
require_once('includes/connection.php');
$ya=$sess_year-1;
$yb=$sess_year;
$yy=$sess_year+543;
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
		<?php include("sidebar-menu.php") ?> 
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php	echo $mtitle;?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php include ("box_main.php")?>
    <div class="row">
  <div class="col-md-12">
  <div class="box box-primary box-solid">
				<div class="box-header with-border">
              <h3 class="box-title">รายการนัดทันตกรรม | <?=$dep_name;?></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
  <div class="panel-body">
            <table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr class="info">
                      <th width="8%">วันที่</th>
                        <th width="7%">เวลา</th>
                        <th width="8%">ชื่อ-สกุล</th>
                        <th width="2%"></th>
                        <th width="8%">ประเภท</th>
                        <th width="8%">งาน</th>
												<th width="10%">นัดหมอ</th>
                        <th width="10%">ผู้ลงนัด</th>
                        <th width="8%">สถานะ</th>
                        <th width="5%">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$y3=$y2-1;
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("SELECT m.meeting_id,r.room_name,r.room_color,m.topic,m.capacity,
                        m.sdate,m.stime,m.edate,m.etime,t.meeting_type_name,d.dep_name,m.login,d.dep_tel,
                        f.format_name,s.status_name,m.meeting_status,r.room_color,m.detail
                        FROM mav_meeting m
                        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
                        LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
                        LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
                        LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
                        LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
                        WHERE m.sdate BETWEEN '$ya-10-01' AND '$yb-09-30'
                        AND depcode=$sess_depcode
                        ORDER BY m.sdate DESC");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)){
													  extract($row);
												?>
												<tr>
                          <td><?php echo thdate($sdate,sm);?></td>
                          <td><?php echo substr($stime,0,5);?> - <?php echo substr($etime,0,5);?></td>
                          <td><?php echo $detail;?></td>
                          <td style="color:white" bgcolor="<?=$room_color?>"></td>
                          <td><?php echo $room_name;?></td>
                          <td><?php echo $topic;?></td>
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
                          <td align="center"><div class="btn-group">
                              <button type="button" class="btn btn-success btn-flat">Click</button>
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                  <?php if ($meeting_status=='1') { ;?>
                                <li><a href="book-room-edit.php?mid=<?=base64_encode($meeting_id);?>">แก้ไข</a></li>
                                <li><a href="book-room-del.php?mid=<?=base64_encode($meeting_id);?>">ลบ</a></li>
                                <?php };?>
                                <li><a href="book-room-detail.php?mid=<?=base64_encode($meeting_id);?>">รายละเอียด</a></li>                   
                                <!--li><a href="book-room-print-pdf.php?mid=<?=$meeting_id;?>" target="_blank">พิมพ์ใบจอง</a></li-->
                              </ul>
                </div></td>
                        </tr>   
                        <?php }?>									
											
										</tbody>
										
						</table>
        </div>
        </div>
    </div>
  </div>
<?php if(($sess_depcode==$dmav)||($sess_username=='pikepid')){;?>
<div class="row">
  <div class="col-md-12">
  <div class="box box-danger box-solid">
				<div class="box-header with-border">
              <h3 class="box-title">รายการนัดทันตกรรม รออนุมัติ</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
  <div class="panel-body">
            <table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr class="danger">
												<th width="8%">วันที่</th>
                        <th width="8%">ถึง</th>
                        <th width="10%">เวลา</th>
                        <th width="2%"></th>
                        <th width="10%">ห้องประชุม</th>
                        <th width="8%">ประเภท</th>
												<th width="15%">หน่วยงาน</th>
                        <th width="15%">ผู้จอง</th>
                        <th width="8%">สถานะ</th>
                        <th width="8%">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$y3=$y2-1;
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("SELECT m.meeting_id,r.room_name,r.room_color,m.topic,m.capacity,
                        m.sdate,m.stime,m.edate,m.etime,t.meeting_type_name,d.dep_name,m.login,d.dep_tel,
                        f.format_name,s.status_name,m.meeting_status,r.room_color
                        FROM mav_meeting m
                        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
                        LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
                        LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
                        LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
                        LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
                        WHERE m.sdate BETWEEN '$ya-10-01' AND '$yb-09-30'
                        AND meeting_status='1'
                        ORDER BY m.sdate DESC");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)){
													  extract($row);
												?>
												<tr>
                          <td><?php echo thdate($sdate,sm);?></td>
                          <td><?php echo thdate($edate,sm);?></td>
                          <td><?php echo substr($stime,0,5);?> - <?php echo substr($etime,0,5);?></td>
                          <td style="color:white" bgcolor="<?=$room_color?>"></td>
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
                          <td align="center"><div class="btn-group">
                              <button type="button" class="btn btn-success btn-flat">Click</button>
                              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>
                              <ul class="dropdown-menu" role="menu">
                                <li><a href="book-room-edit.php?mid=<?=base64_encode($meeting_id);?>">แก้ไข</a></li>
                                <li><a href="book-room-del.php?mid=<?=base64_encode($meeting_id);?>">ลบ</a></li>
                                <li><a href="book-room-approve.php?mid=<?=base64_encode($meeting_id);?>">อนุมัติ</a></li>  
                                <li><a href="book-room-detail.php?mid=<?=base64_encode($meeting_id);?>">รายละเอียด</a></li>                   
                                <li><a href="book-room-print-pdf.php?mid=<?=$meeting_id;?>" target="_blank">พิมพ์ใบจอง</a></li>
                              </ul>
                </div></td>
                        </tr>   
                        <?php }?>									
											
										</tbody>
										
						</table>
        </div>
        </div>
    </div>
  </div>
<?php };?>
  
<?php if(($sess_depcode==$x)||($sess_username=='0')){;?>
<div class="row">
  <div class="col-md-12">
  <div class="box box-success box-solid">
				<div class="box-header with-border">
              <h3 class="box-title">รายการจองห้องประชุม รอบันทึกผลการปฏิบัติงาน</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
  <div class="panel-body">
            <table id="example1" class="table table-bordered table-striped">
										<thead>
											<tr class="success">
												<th width="8%">วันที่</th>
                        <th width="8%">ถึง</th>
                        <th width="10%">เวลา</th>
                        <th width="2%"></th>
                        <th width="10%">ห้องประชุม</th>
                        <th width="8%">ประเภท</th>
												<th width="15%">หน่วยงานที่จอง</th>
                        <th width="15%">ผู้ดูแลห้อง</th>
                        <th width="8%">สถานะ</th>
                        <th width="8%">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$y3=$y2-1;
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("SELECT m.meeting_id,r.room_name,r.room_color,m.topic,m.capacity,
                        m.sdate,m.stime,m.edate,m.etime,t.meeting_type_name,d.dep_name,m.login,d.dep_tel,
                        f.format_name,s.status_name,m.meeting_status,r.room_color,r.room_keeper,m.book_number,
                        m.reg_date,m.reg_time
                        FROM mav_meeting m
                        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
                        LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
                        LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
                        LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
                        LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
                        WHERE m.sdate BETWEEN '$ya-10-01' AND '$yb-09-30'
                        AND m.worker='' OR m.worker IS NULL
                        ORDER BY m.sdate DESC");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)){
													  extract($row);
												?>
												<tr>
                          <td><?php echo thdate($sdate,sm);?></td>
                          <td><?php echo thdate($edate,sm);?></td>
                          <td><?php echo substr($stime,0,5);?> - <?php echo substr($etime,0,5);?></td>
                          <td style="color:white" bgcolor="<?=$room_color?>"></td>
                          <td><?php echo $room_name;?></td>
                          <td><a href="" data-toggle="tooltip" title="<?=$topic;?>"><?php echo $meeting_type_name;?></a></td>
                          <td><?php echo $dep_name;?></td>
                          <td><?php echo $room_keeper;?></td>
                          <td align="center">
                              <?php if ($meeting_status == '1') {?>
                              <span class="pull-center badge bg-red">
                              <?php } elseif ($meeting_status == '2') {;?>
                              <span class="pull-center badge bg-green">
                              <?php } elseif ($meeting_status == '3') {;?>
                              <span class="pull-center badge bg-info">
                              <?php } echo $status_name; ?></td>
                              <td align = 'center'><a class = 'btn btn-primary' data-toggle = 'modal' data-target = "#meeting_work<?=$book_number;?>" data-backdrop = 'static'><i class = 'glyphicon glyphicon-ok' aria-hidden = 'true'></i></a></td>
                        </tr>   
                        <div class = 'modal fade' id = "meeting_work<?=$book_number;?>" tabindex = '-1' role = 'dialog' aria-hidden = 'true'>
                        <div class = 'modal-dialog' role = 'document'>
                        <div class = 'modal-content'>
                        <div class = 'modal-header'>
                        <button type = 'button' class = 'close' data-dismiss = 'modal' aria-label = 'Close'>
                        <span aria-hidden = 'true'>&times;
                        </span></button>
                        <h4 class = 'modal-title'>บันทึกผลการปฏิบัติงาน</h4>
                        </div>
                        <form action="qry/add_work_pc.php?booknumber=<?=$book_number?>" method="post">
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
                        <div class="form-group col-md-6">
                                        <label for="wdate" class="col-form-label">วันที่ปฏิบัติงาน</label>
                                            <input type="date" class="form-control" name="wdate" value="<?php echo $wdate;?>">
                                        </div>
                                        <div class = 'form-group col-md-6'>
                            <label for = 'worker' class = 'col-form-label'>Worker</label>
                            <input type = 'text' class = 'form-control' id = 'worker' name='worker' value = "<?php echo $sess_fullname;?>">
                            </div>
                            <div class="form-group col-md-6">
                                        <label for="wstime" class="col-form-label">เวลาเปิดห้องประชุม</label>
                                        <input type="time" class="form-control" id="wstime" name="wstime" value="<?php echo $wstime;?>">
                                    </div>
                            <div class="form-group col-md-6">
                                        <label for="wetime" class="col-form-label">เวลาปิดห้องประชุม</label>
                                        <input type="time" class="form-control" id="wetime" name="wetime" value="<?php echo $wetime;?>">
                                    </div>
                            <div class="form-group col-md-12">
                            <label for="note_worker" class="col-form-label">Note</label>
                            <input type="text" class="form-control" id="note_worker" name="note_worker" value="<?php echo $note_worker;?>">
                            </div>
                            <div class = 'form-group'>
                        <input type = 'text' class = 'form-control' style="text-align: center" id = 'recipient-name' value="Update <?php echo thdate($today,sm)?> เวลา <?php echo $t?> น."disabled/>
                        </div>
                            </div>
                            <div class = 'modal-footer clearfix'>
                            <button type="submit" class="btn btn-primary pull-left">บันทึก</button>
                            <a data-dismiss="modal" aria-hidden="true" class="btn btn-success" >    ปิด   </a>
                            </div>
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
                                  <?php };?>
            
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

	<footer class="main-footer">
    	<p><?php echo $footer1;?></p>
		<p><?php echo $footer2;?></p>
		<p>&copy; <?php echo $footer3;?></p>
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
