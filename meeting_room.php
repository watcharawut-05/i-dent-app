<?php
require_once 'includes/chksession.php';
require_once 'includes/connection.php';
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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- DataTables -->
		<link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.css">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
		<!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">

    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php
include "function.php";
include "modal.php";
include "modal_room.php";
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
		<section class="content-header">
		<h1><?php echo $mtitle; ?></h1>
		<ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
		</ol>
		</section>

		<!-- Main content -->
		<section class="content">
		<!-- Info boxes -->
		<?php //include ("box_main.php")?>
		<!-- /.row -->

		<?php if (($sess_depcode == $dmav) || ($sess_priority == '3')) {;?>

		<div class="box-body">
		<div class="row">
		<div class="col-lg-3">
		<div>
		<a class="btn btn-success" data-toggle="modal" data-target="#room_add" data-backdrop="static">เพิ่มประเภทการนัด</a>
		<a href="main.php" class="btn btn-danger" data-dismiss="modal" aria-hidden="true" class="btn btn-default">ปิด</a>
		</div>
		</div><!-- /.col -->
		</div>
		</div>
		<div class="box">
		<div class="box-header">
		<h3 class="box-title">รายการประเภทการนัด ของ :  <?php echo $head; ?>	</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
		<table id="example1" class="table table-bordered table-striped">
		<thead>
		<tr class="info" >
		<th width="5%">ID</th>
		<th width="10%">ชื่อประเภทการนัด</th>
		<!--th width="8%">ความจุ</th-->
		<!--th width="12%">สถานที่</th-->
		<th width="20%">รายละเอียด</th>
    <!--th width="10%">ผู้ดูแล</th-->
    <th width="5%">สถานะ</th>
		<th width="10%">Action</th>
		</tr>
		</thead>
		<tbody>
		<?php
    $sql = "SELECT * FROM mav_meeting_room";
    $query = $conn->prepare($sql);
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
    ?>
		<tr>
		<td bgcolor="<?=$room_color?>" align="center"><?php echo $room_id; ?></td>
		<td><?php echo $room_name; ?></td>
		<!--td><?php echo $room_value; ?>  คน</td-->
		<!--td><?php echo $room_place; ?></td-->
		<td><?php echo $room_detail; ?></td>
    <!--td><?php echo $room_keeper; ?></td-->
    <td align="center">
      <?php if ($room_status == 'On') {?>
      <span class="pull-center badge bg-green">
      <?php } elseif ($room_status == 'Off') {;?>
      <span class="pull-center badge bg-red">
      <?php }?><?php echo $room_status; ?></td>
		<td align="center">
		<a class="btn btn-primary" data-toggle="modal" data-target="#room_edit<?=$room_id;?>" data-backdrop="static"><i class="glyphicon glyphicon-pencil" aria-hidden="true"></i></a>
		<a class="btn btn-danger" data-toggle="modal" data-target="#room_del<?=$room_id;?>" data-backdrop="static"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i></a>
		<a class="btn btn-info" data-toggle="modal" data-target="#room_pic<?=$room_id;?>" data-backdrop="static"><i class="glyphicon glyphicon-picture" aria-hidden="true"></i></a>
		</td>
		</tr>
		<!-- Room Edit-->
		<div class="modal fade" id="room_edit<?=$room_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">แก้ไขห้องประชุม</h4>
		</div>
		<form action="qry/edit_room.php?room_id=<?=$room_id;?>" method="post">
		<div class="modal-body">
		<div class="form-group col-md-6">
		<label for="room_name" class="col-form-label">ชื่อห้องประชุม</label>
		<input type="text" class="form-control" name="room_name" value="<?php echo $room_name; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_value" class="col-form-label">ความจุคน</label>
		<input type="text" class="form-control" name="room_value" value="<?php echo $room_value; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_place" class="col-form-label">สถานที่ตั้ง</label>
		<input type="text" class="form-control" name="room_place" value="<?php echo $room_place; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_keeper" class="col-form-label">ผู้ดูแลห้อง</label>
		<input type="text" class="form-control" name="room_keeper" value="<?php echo $room_keeper; ?>">
		</div>
		<div class="form-group col-md-12">
		<label for="room_detail" class="col-form-label">รายละเอียด</label>
		<input type="text" class="form-control" name="room_detail" value="<?php echo $room_detail; ?>">
		</div>
        <div class="form-group col-md-12">
          <label for="room_note" class="col-form-label">หมายเหตุ</label>
          <input type="text" class="form-control" name="room_note" value="<?php echo $room_note; ?>">
        </div>
        <div class="form-group col-md-6">
            <label for="room_color" class="col-form-label">Color</label>
              <div class="input-group my-colorpicker2">
                <input type="text" class="form-control" name="room_color" value="<?php echo $room_color; ?>">
              <div class="input-group-addon">
              <i></i>
              </div>
		    </div>
		<!-- /.input group -->
		</div>
    <!-- /.form group -->
    <div class="form-group col-md-6">
      <label for="room_status" class="col-form-label">สถานะ</label>
        <select class="form-control" name="room_status">
          <option value="On" <?php if ($room_status == "On") {echo " selected ";}?>>เปิดใช้งาน</option>
          <option value="Off" <?php if ($room_status == "Off") {echo " selected ";}?>>ปิดใช้งาน</option>
        </select>
    </div>



		<div class="form-group">
		<input type="text" class="form-control" id="recipient-name" disabled/>
		</div>

		</div>
		<div class="modal-footer clearfix">
		<button type="submit" class="btn btn-primary pull-left">แก้ไข</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
		</div>
		</form>
		</div>
		</div>
    </div>

    <!-- Room Del-->
		<div class="modal fade" id="room_del<?=$room_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">ลบห้องประชุม</h4>
		</div>
		<form action="qry/del_room.php?room_id=<?=$room_id;?>" method="post">
		<div class="modal-body">
		<div class="form-group col-md-6">
		<label for="room_name" class="col-form-label">ชื่อห้องประชุม</label>
		<input type="text" class="form-control" name="room_name" value="<?php echo $room_name; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_value" class="col-form-label">ความจุคน</label>
		<input type="text" class="form-control" name="room_value" value="<?php echo $room_value; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_place" class="col-form-label">สถานที่ตั้ง</label>
		<input type="text" class="form-control" name="room_place" value="<?php echo $room_place; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_keeper" class="col-form-label">ผู้ดูแลห้อง</label>
		<input type="text" class="form-control" name="room_keeper" value="<?php echo $room_keeper; ?>">
		</div>
		<div class="form-group col-md-12">
		<label for="room_detail" class="col-form-label">รายละเอียด</label>
		<input type="text" class="form-control" name="room_detail" value="<?php echo $room_detail; ?>">
		</div>
		<div class="form-group col-md-12">
		<label for="room_note" class="col-form-label">หมายเหตุ</label>
		<input type="text" class="form-control" name="room_note" value="<?php echo $room_note; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_color" class="col-form-label">Color</label>
		<div class="input-group my-colorpicker2">
		<input type="text" class="form-control" name="room_color" value="<?php echo $room_color; ?>">
		<div class="input-group-addon">
		<i></i>
		</div>
		</div>
		<!-- /.input group -->
		</div>
    <!-- /.form group -->
    <div class="form-group col-md-6">
      <label for="room_status" class="col-form-label">สถานะ</label>
        <select class="form-control" name="room_status">
          <option value="On" <?php if ($room_status == "On") {echo " selected ";}?>>เปิดใช้งาน</option>
          <option value="Off" <?php if ($room_status == "Off") {echo " selected ";}?>>ปิดใช้งาน</option>
        </select>
    </div>
		<div class="form-group">
		<input type="text" class="form-control" id="recipient-name" disabled/>
		</div>

		</div>
		<div class="modal-footer clearfix">
		<button type="submit" class="btn btn-primary pull-left">ลบ</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
		</div>
		</form>
		</div>
		</div>
    </div>

    <!-- Room Picture-->
		<div class="modal fade" id="room_pic<?=$room_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title">รูปห้องประชุม</h4>
		</div>
		<form action="qry/pic_room.php?room_id=<?=$room_id;?>" method="post" enctype="multipart/form-data">
		<div class="modal-body">
		<div class="form-group col-md-6">
		<label for="room_name" class="col-form-label">ชื่อห้องประชุม</label>
		<input type="text" class="form-control" name="room_name" value="<?php echo $room_name; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_value" class="col-form-label">ความจุคน</label>
		<input type="text" class="form-control" name="room_value" value="<?php echo $room_value; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_place" class="col-form-label">สถานที่ตั้ง</label>
		<input type="text" class="form-control" name="room_place" value="<?php echo $room_place; ?>">
		</div>
		<div class="form-group col-md-6">
		<label for="room_keeper" class="col-form-label">ผู้ดูแลห้อง</label>
		<input type="text" class="form-control" name="room_keeper" value="<?php echo $room_keeper; ?>">
		</div>
		<div class="form-group col-md-12">
				<?php echo "<img src=\"room_pic/$room_pic\" width=\"100%\"> "; ?><br>
    </div>
    <div class="form-group col-md-12">
		  	<input type="file" name="myfile"  />
		</div>
		<div class="form-group">
		<input type="text" class="form-control" id="recipient-name" disabled/>
		</div>


		</div>
		<div class="modal-footer clearfix">
		<button type="submit" class="btn btn-primary pull-left">Upload</button>
		<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
		</div>
		</form>
		</div>
		</div>
    </div>

		<?php }
    ;?>
		</tbody>

		</table>
		</div>
		<!-- /.box-body -->
		</div>
		<!-- /.box -->
		<?php }
;?>



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
		<!-- bootstrap color picker -->
    <script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

		<!-- page script -->
		<script>
		//Colorpicker
		$(".my-colorpicker1").colorpicker();
		//color picker with addon
		$(".my-colorpicker2").colorpicker();

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
