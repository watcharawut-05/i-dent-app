<?php
require_once('includes/connection.php');
$month=date('m');
if(($month=='10')||($month=='11')||($month=='12')){$y2=$y2+1;}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="img/favicon.ico">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link href='fullcalendar-2.4.0/fullcalendar.min.css'  rel='stylesheet' />
  <link href='fullcalendar-2.4.0/fullcalendar.print.css'  rel='stylesheet' media='print' />
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
<style>
     #calendar{
         margin-top:10px;
     }
 </style>
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
    
    <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
        
          
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
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  </div>
  <!-- /.content-wrapper -->

	<!-- Button trigger modal Edit data-->
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