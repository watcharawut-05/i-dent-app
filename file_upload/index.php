<?php
include '../includes/connection.php';
$month=date('m');
if(($month=='10')||($month=='11')||($month=='12')){$y2=$y2+1;}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="../img/favicon.ico">
  <title>i-Xray</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<?php
include "../function.php";
include "../modal.php";
?>
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">i-Xray</span>
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
      <!-- Sidebar user panel -->
      
      <!-- search form -->
      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN MENU</li>
				<li class="active">
					<a href="#" data-toggle="modal" data-target="#login" data-backdrop="static">
						<i class="fa fa-user"></i> <span>Sign In</span>
					</a>
				</li>
				<li>
					<a href="#" data-toggle="modal" data-target="#about" data-backdrop="static">
						<i class="fa fa-comment-o"></i> <span>About</span>
					</a>
				</li>
		</ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard : ข้อมูลปี <?php echo $y2+543;?>  ณ <?php include ("../includes/thai_today.php")?></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-comments-o"></i></span>

            <div class="info-box-content">
			<?php
				$y3=$y2-1;
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("
				select count(id) as send from xray_send
				where date_send between '$y3-10-01' and '$y2-09-30' ");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$send=$rs['send'];
				}
				?>
              <span class="info-box-text">จำนวนที่ส่งไป</span>
              <span class="info-box-number"><?php echo $send?>  <small>รายการ</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-files-o"></i></span>

            <div class="info-box-content">
			<?php
				$y3=$y2-1;
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("
				select count(id) as giveme from xray_send
				where date_send between '$y3-10-01' and '$y2-09-30' ");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$giveme=$rs['giveme'];
				}
				?>
              <span class="info-box-text">จำนวนที่ถูกส่งมา </span>
              <span class="info-box-number"><?php echo $giveme?>   <small>รายการ</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>

            <div class="info-box-content">
              <?php
				$y3=$y2-1;
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("
				select count(id) as receive from xray_send 
				where date_send between '$y3-10-01' and '$y2-09-30' 
				and status='2' ");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$receive=$rs['receive'];
				}
				?>
              <span class="info-box-text">จำนวนที่รับแล้ว </span>
              <span class="info-box-number"><?php echo $receive?> <small>รายการ</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <?php
				$y3=$y2-1;
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = $conn->prepare("
				select count(user_id) as xuser from xray_user ");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$xuser=$rs['xuser'];
				}
				?>
              <span class="info-box-text">Members</span>
              <span class="info-box-number"><?php echo $xuser?> <small>user</small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
	<!-- callout -->
      <div class="callout callout-warning">
        <h4>สถิติ</h4>

        <p>กราฟแสดงสถิติ การส่งภาพ x-ray ข้อมูลปี <?php echo $y2+543;?>  ณ <?php include ("../includes/thai_today.php")?></p>
      </div>
    <!-- /.callout -->
	
	<div class="row">
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header with-border">
              <h3 class="box-title">กราฟแยกตามหน่วยงานต้นทางที่ ส่งภาพ x-ray</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
				<div class="panel-body">
					<?php include("../charts/g_xray_send.php");?>
				</div>
			</div>
		</div>
	
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header with-border">
              <h3 class="box-title">กราฟแยกตามหน่วยงานปลายทาง ที่รับภาพ x-ray</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
				<div class="panel-body">
					<?php include("../charts/g_xray_receive.php");?>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-6">
			<div class="box box-danger">
				<div class="box-header with-border">
              <h3 class="box-title">กราฟแยกตามเดือนที่ส่ง</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
				<div class="panel-body">
					<?php include("../charts/g_xray_month.php");?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header with-border">
              <h3 class="box-title">กราฟแยกตามประเภทการส่งภาพ x-ray</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
				<div class="panel-body">
					<?php include("../charts/g_xray_type.php");?>
				</div>
			</div>
		</div>
	</div>
	
	                        
      
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
<script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="../plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
