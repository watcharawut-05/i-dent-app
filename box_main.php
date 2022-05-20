<?php if($sess_depcode<>$dmav){;?>
<div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
            <?php
            $y3=$y2-1;
            $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $query = $conn->prepare("SELECT count(meeting_id) as yt from mav_meeting
            where sdate between '$ya-10-01' and '$yb-09-30' AND depcode=$sess_depcode");

            $query->execute();
            while($rs=$query->fetch(PDO::FETCH_ASSOC)){
            $yt=$rs['yt'];
            }
            ?>
              <span class="info-box-text"><b>จำนวนนัดทันตกรรม ปีนี้</b></span>
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
          <div class="info-box bg-blue">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
			<?php
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$query = $conn->prepare("SELECT count(meeting_id) as mt from mav_meeting
        where MONTH(sdate)=MONTH(CURRENT_DATE()) AND YEAR(sdate)=YEAR(CURRENT_DATE()) AND depcode=$sess_depcode");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$mt=$rs['mt'];
				}
				?>
              <span class="info-box-text"><b>จำนวนนัดทันตกรรม เดือนนี้</b></span>
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
          <div class="info-box bg-purple">
            <span class="info-box-icon"><i class="fa  fa-calendar"></i></span>

            <div class="info-box-content">
			<?php
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$query = $conn->prepare("SELECT count(meeting_id) as dt from mav_meeting
        where sdate=CURRENT_DATE() AND depcode=$sess_depcode");

				$query->execute();
        while($rs=$query->fetch(PDO::FETCH_ASSOC)){
				$dt=$rs['dt'];
				}
				?>
              <span class="info-box-text"><b>จำนวนนัดทันตกรรม วันนี้</b></span>
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
            <span class="info-box-icon"><i class="fa  fa-calendar"></i></span>

            <div class="info-box-content">
			<?php
				$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				$query = $conn->prepare("SELECT count(meeting_id) as st from mav_meeting
        where sdate between '$y3-10-01' and '$y2-09-30' AND meeting_status='2' AND depcode=$sess_depcode");

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
<?php };?>

<?php if($sess_depcode==$dmav){;?>
<div class="row">
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
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
              <span class="info-box-text"><b>จำนวนนัดทันตกรรม ปีนี้</b></span>
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
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

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
              <span class="info-box-text"><b>จำนวนนัดทันตกรรม เดือนนี้</b></span>
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
            <span class="info-box-icon"><i class="fa  fa-calendar"></i></span>

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
              <span class="info-box-text"><b>จำนวนนัดทันตกรรม วันนี้</b></span>
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
            <span class="info-box-icon"><i class="fa  fa-calendar"></i></span>

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
<?php };?>