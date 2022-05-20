<ul class="sidebar-menu">
	<li class="header">MAIN MENU</li>
	<li>
        <a href="main.php">
            <i class="fa fa-home"></i> <span>HOME</span>
        </a>
    </li>
    <li>
        <a href="book-room.php">
            <i class="fa fa-tasks"></i> <span>ระบบจองนัดทันตกรรม</span>
        </a>
    </li>
    <li>
        <a href="book-room-report.php">
            <i class="fa fa-pie-chart"></i> <span>รายงานการนัดทันตกรรม</span>
        </a>
    </li>
    <li>
          <a href="meeting-calendar-main.php">
              <i class="fa fa-calendar"></i> <span>ปฏิทิน</span>
          </a>
        </li>
    <!---
    <li>
        <a href="main-job.php">
            <i class="fa fa-th"></i> <span>ระบบใบงาน</span>
        </a>
    </li>
    -->
        <li class="treeview">
            <a href="#">
                <i class="fa fa-gear"></i>
                <span>จัดการระบบ</span>
                <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu">
			<?php if (($sess_depcode == $dmav) || ($sess_priority == '3')) {;?>
                <li><a href="meeting_room.php"><i class="fa fa-check"></i> จัดการประเภทการนัด</a></li>
            <?php };?>
            </ul>

            <ul class="treeview-menu">
			<?php if (($sess_depcode == $dmav) || ($sess_priority == '3')) {;?>
                <li><a href="dent-doctor.php"><i class="fa fa-check"></i> จัดการหมอ</a></li>
            <?php };?>
            </ul>
            
        </li>

	<li>
        <a href="#" data-toggle="modal" data-target="#signout" data-backdrop="static">
            <i class="fa fa-power-off"></i> <span>ออกจากระบบ</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">Sign Out</small>
            </span>
        </a>
    </li>
</ul>
