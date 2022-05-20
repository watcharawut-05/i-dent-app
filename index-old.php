<?php
require_once( 'includes/connection.php' );
$month = date( 'm' );
if ( ( $month == '10' ) || ( $month == '11' ) || ( $month == '12' ) ) {
    $y2 = $y2+1;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset = 'utf-8'>
<meta http-equiv = 'X-UA-Compatible' content = 'IE=edge'>
<link rel = 'shortcut icon' href = 'img/favicon.ico'>
<title><?php echo $title;
?></title>
<!-- Tell the browser to be responsive to screen width -->
<meta content = 'width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name = 'viewport'>
<!-- Bootstrap 3.3.6 -->
<link rel = 'stylesheet' href = 'bootstrap/css/bootstrap.css'>
<!-- Font Awesome -->
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
<!-- Ionicons -->
<link rel = 'stylesheet' href = 'https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css'>
<!-- jvectormap -->
<link rel = 'stylesheet' href = 'plugins/jvectormap/jquery-jvectormap-1.2.2.css'>
<!-- Theme style -->
<link rel = 'stylesheet' href = 'dist/css/AdminLTE.css'>
<!-- AdminLTE Skins. Choose a skin from the css/skins
folder instead of downloading all of them to reduce the load. -->
<link rel = 'stylesheet' href = 'dist/css/skins/_all-skins.min.css'>
<!-- fullCalendar -->
<link href='fullcalendar-2.4.0/fullcalendar.min.css'  rel='stylesheet' />
  <link href='fullcalendar-2.4.0/fullcalendar.print.css'  rel='stylesheet' media='print' />

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
    <a href="index.php" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><?php echo $title;?></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
                    
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <?php include "sidebar-menu-index.php"?>
		</section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?=$mtitle;?></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-television"></i></span>
            <div class="info-box-content">
            <?php
            $y3=$y2-1;
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $conn->prepare("SELECT count(meeting_id) as yt from mav_meeting
            where sdate between '$y3-10-01' and '$y2-09-30' ");

            $query->execute();
            while($rs=$query->fetch(PDO::FETCH_ASSOC)){
            $yt=$rs['yt'];
            }
            ?>
              <span class="info-box-text"><b>จำนวนจองห้องประชุม ปีนี้</b></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="info-box-number"><?php echo number_format($yt);?>  <small>ครั้ง</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-television"></i></span>

            <div class="info-box-content">
			<?php
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$query = $conn->prepare("SELECT count(meeting_id) as mt from mav_meeting
        where MONTH(sdate)=MONTH(CURRENT_DATE()) AND YEAR(sdate)=YEAR(CURRENT_DATE()) ");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$mt=$rs['mt'];
				}
				?>
              <span class="info-box-text"><b>จำนวนจองห้องประชุม เดือนนี้</b></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="info-box-number"><?php echo number_format($mt);?>   <small>ครั้ง</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa  fa-television"></i></span>

            <div class="info-box-content">
			<?php
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$query = $conn->prepare("SELECT count(meeting_id) as dt from mav_meeting
        where sdate=CURRENT_DATE()");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$dt=$rs['dt'];
				}
				?>
              <span class="info-box-text"><b>จำนวนจองห้องประชุม วันนี้</b></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="info-box-number"><?php echo number_format($dt);?>   <small>ครั้ง</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
		
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa  fa-television"></i></span>

            <div class="info-box-content">
			<?php
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$query = $conn->prepare("SELECT count(meeting_id) as st from mav_meeting
        where sdate between '$y3-10-01' and '$y2-09-30' AND meeting_status='2'");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
        $st=$rs['st'];
        $pt=$st*100/$yt;
				}
				?>
              <span class="info-box-text"><b>ร้อยละการอนุมัติ</b></span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="info-box-number"><?php echo number_format($pt);?>   <small>%</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
        <!-- /.col -->
        
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
      <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-body p-0">
              <table id="#" class="table table-bordered table-striped">
                  <tbody>
                    
                  <tr style="color:white" align="center">
                  <?php
                $sql = "SELECT * FROM mav_meeting_room";
                $query = $conn->prepare($sql);
                $query->execute();
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                ?>
                    <td bgcolor="<?=$room_color?>"><?php echo $room_name; ?></td>
                    <?php }?>
                  </tr>
                
                </table>
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->       
        
  
	<div class="row">
  <div class="col-md-12">
  <div class="box box-primary box-solid">
				<div class="box-header with-border">
              <h3 class="box-title">รายการจองห้องประชุมถัดจากวันนี้</h3>

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
                        <th width="2%"></th>
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
												$y3=$y2-1;
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("SELECT m.meeting_id,r.room_name,m.topic,m.capacity,
                        m.sdate,m.stime,m.edate,m.etime,t.meeting_type_name,d.dep_name,m.login,d.dep_tel,
                        f.format_name,s.status_name,m.meeting_status,r.room_color,m.detail,m.reg_date,m.reg_time
                        FROM mav_meeting m
                        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
                        LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
                        LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
                        LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
                        LEFT OUTER JOIN mav_meeting_status s ON s.status_id=m.meeting_status
                        WHERE m.sdate>=CURRENT_DATE()
                        ORDER BY m.sdate,m.stime");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)){
													  extract($row);
												?>
												<tr>
                          <td><?php echo thdate($sdate,sm);?></td>
                          <td><?php echo thdate($edate,sm);?></td>
                          <td><?php echo SUB$stime;?> - <?php echo $etime;?></td>
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
                              <?php } elseif ($meeting_status == '3' ) {
    ;
    ?>
    <span class = 'pull-center badge bg-info'>
    <?php }
    echo $status_name;
    ?></td>
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

    <?php }
    ?>

    </tbody>

    </table>
    </div>
    </div>
    </div>
    </div>

    <div class = 'row'>
    <div class = 'col-md-6'>
    <div class = 'box box-danger'>
    <div class = 'box-header with-border'>
    <h3 class = 'box-title'>กราฟแสดงจำนวนรายการจองห้องประชุม แยกรายเดือน</h3>

    <div class = 'box-tools pull-right'>
    <button type = 'button' class = 'btn btn-box-tool' data-widget = 'collapse'><i class = 'fa fa-minus'></i>
    </button>
    <button type = 'button' class = 'btn btn-box-tool' data-widget = 'remove'><i class = 'fa fa-times'></i></button>
    </div>
    </div>
    <div class = 'panel-body'>
    <?php include( 'charts/g_meeting_month.php' );
    ?>
    </div>
    </div>
    </div>
    <div class = 'col-md-6'>
    <div class = 'box box-success'>
    <div class = 'box-header with-border'>
    <h3 class = 'box-title'>กราฟแสดงรายการจอง แยกห้องประชุม</h3>

    <div class = 'box-tools pull-right'>
    <button type = 'button' class = 'btn btn-box-tool' data-widget = 'collapse'><i class = 'fa fa-minus'></i>
    </button>
    <button type = 'button' class = 'btn btn-box-tool' data-widget = 'remove'><i class = 'fa fa-times'></i></button>
    </div>
    </div>
    <div class = 'panel-body'>
    <?php include( 'charts/g_meeting_room.php' );
    ?>
    </div>
    </div>
    </div>
    </div>

    </section>
    <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->

    <footer class = 'main-footer'>
    <p><?php echo $footer1;
    ?></p>
    <p><?php echo $footer2;
    ?></p>
    <p>&copy;
    <?php echo $footer3;
    ?></p>
    </footer>
    <div class = 'control-sidebar-bg'></div>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery 2.2.3 -->
    <script src = 'plugins/jQuery/jquery-2.2.3.min.js'></script>
    <!-- Bootstrap 3.3.6 -->
    <script src = 'bootstrap/js/bootstrap.min.js'></script>
    <!-- FastClick -->
    <script src = 'plugins/fastclick/fastclick.js'></script>
    <!-- AdminLTE App -->
    <script src = 'dist/js/app.min.js'></script>
    <!-- Sparkline -->
    <script src = 'plugins/sparkline/jquery.sparkline.min.js'></script>
    <!-- jvectormap -->
    <script src = 'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
    <script src = 'plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
    <!-- SlimScroll 1.3.0 -->
    <script src = 'plugins/slimScroll/jquery.slimscroll.min.js'></script>
    <!-- ChartJS 1.0.1 -->
    <script src = 'plugins/chartjs/Chart.min.js'></script>
    <!-- AdminLTE dashboard demo ( This is only for demo purposes ) -->
    <script src = 'dist/js/pages/dashboard2.js'></script>
    <!-- AdminLTE for demo purposes -->
    <script src = 'dist/js/demo.js'></script>

    <span id="trigger_modal" data-toggle="modal" data-target="#calendar_modal"></span>
 
 <!-- Modal For edit data-->
 <div class="modal fade" id="calendar_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         <h4 class="modal-title" id="myModalLabel">รายละเอียด</h4>
       </div>
             <div id="get_calendar"></div>
     </div>
   </div>
 </div>

<!-- Javascript -->
        <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
        <script src='fullcalendar-2.4.0/lib/moment.min.js'></script>
        <script src='fullcalendar-2.4.0/fullcalendar.min.js'></script>
        <script src='fullcalendar-2.4.0/lang/th.js'></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- นำเข้า script File -->
<script>
$(document).ready(function() {
    //show full calendar
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        editable: false,
        eventLimit: true, // allow "more" link when too many events
        lang: 'th',
        events:{
            url:'json-event-meeting.php?get_json=get_json',
        }
    });
    
});
 
//show data for edit    
function get_modal(id){
    
    //trigger modal
    $("#trigger_modal").trigger('click');
    
    //call data from File json-event.php
    $.ajax({
        type:"POST",
        url:"json-event-meeting.php",
        data:{id:id},
        success:function(data){
            $("#get_calendar").html(data);
        }
    });
    
    return false;
}
</script>    

    </body>
    </html>
