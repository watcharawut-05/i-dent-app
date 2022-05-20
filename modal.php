<!-- Login -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></i>Please Sign In</h4>
            </div>
            <form action="includes/chkmember.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username" class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="password" class="col-sm-4 control-label">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                    </div>
					<div class="form-group">
						<label for="year" class="col-sm-4 control-label">เลือกปีงบประมาณ</label>
						
						<select name="year" id="year" width="22" class="form-control">
							<option value="2020" <?php if($y2=='2020') {echo "selected";}?>>2563</option>
							<option value="2021" <?php if($y2=='2021') {echo "selected";}?>>2564</option>
							<option value="2022" <?php if($y2=='2022') {echo "selected";}?>>2565</option>
                            <option value="2023" <?php if($y2=='2023') {echo "selected";}?>>2566</option>
                            <option value="2024" <?php if($y2=='2024') {echo "selected";}?>>2567</option>
                            <option value="2025" <?php if($y2=='2025') {echo "selected";}?>>2568</option>
                            <option value="2026" <?php if($y2=='2026') {echo "selected";}?>>2569</option>
                            <option value="2027" <?php if($y2=='2027') {echo "selected";}?>>2570</option>
						</select>
						
					</div>

                </div>

                <div class="modal-footer clearfix">

                    <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-user"></i>  Sign In</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> cancel</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- COMPOSE MESSAGE MODAL เกี่ยวกับระบบ -->
<div class="modal fade" id="about" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><i class="fa fa-info-circle"></i> เกี่ยวกับระบบ PK-MAV V.1</h4>
            </div>
            <div class="modal-body">
               	<b>พัฒนาโดย</b></br></br>
				<img src="img/photo.jpg" width="100" height="100" border="0" /></br>
					นายปรเมษฐ  แควภูเขียว  นักวิชาการสาธารณสุขชำนาญการ</br>
					กลุ่มงานประกันสุขภาพ ยุทธศาสตร์และสารสนเทศทางการแพทย์</br>
					โรงพยาบาลภูเขียวเฉลิมพระเกียรติ  จังหวัดชัยภูมิ</br></br>
				<b>feature</b></br>
				<li>ระบบงานสนับสนุนงานโสตทัศนศึกษา</li>
                <li>จองห้องประชุม Online</li>
                <li>แจ้งเตือนการจองผ่าน Line Notify</li>
                
                </br></br>
				มีปัญหาการใช้งานติดต่อ 419, 0898411484
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal ออกจากระบบ-->
<div class="modal fade" id="signout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Sign Out</h4>
            </div>
            <div class="modal-body">
                คุณต้องการออกจากระบบใช่หรือไม่
            </div>
            <div class="modal-footer">
                <a href="includes/logout.php" id="btnYes" class="btn btn-danger">Yes</a>
                <a href="#" data-dismiss="modal" aria-hidden="true" class="btn btn-default">No</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- order add -->
<div class="modal fade" id="order-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  สร้างใบเบิกของจ่ายกลาง</h4>
            </div>
            <form action="qry/add_order.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="order_date" class="col-sm-2 control-label">วันที่เบิก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="order_date" value="<?php echo thdate($today,'sm');?>" disabled/>
										<input type="hidden" name="order_date" value="<?php print $today; ?>"/>
									</div>
									<label for="order_time" class="col-sm-2 control-label">เวลาเบิก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="order_time" value="<?php echo $t;?>" disabled/>
										<input type="hidden" name="order_time" value="<?php print $t; ?>"/>
									</div>
								</div>
								
								<?php
									$sql="select dep_name from dep where dep_id=$sess_depcode";
									$query = $conn->prepare($sql);
									$query->execute();
									while($rDep=$query->fetch(PDO::FETCH_ASSOC))
									$depname=$rDep['dep_name'];
								?>
								
								<div class="form-group">
									<label for="depname" class="col-sm-2 control-label">หน่วยงาน</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="depname" name="depname" value="<?php echo $depname;?>" disabled/>
										<input type="hidden" name="depcode" value="<?php print $sess_depcode; ?>"/>
										<input type="hidden" name="depname" value="<?php print $depname; ?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="order_user" class="col-sm-2 control-label">ผู้เบิก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="order_user" name="order_user" value="<?php echo $sess_fullname;?>" disabled/>
										<input type="hidden" name="order_user" value="<?php print $sess_fullname; ?>"/>
									</div>
									
								</div>
							</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-left">สร้างใบเบิก</button>
							<a href="order.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success">    ปิด   </a>
						</div>
					</form>
					
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- fa-order-add -->
<div class="modal fade" id="fa-order-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  สร้างใบเบิกของซักฟอก</h4>
            </div>
            <form action="qry/fa_add_order.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="order_date" class="col-sm-2 control-label">วันที่เบิก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="order_date" value="<?php echo thdate($today,'sm');?>" disabled/>
										<input type="hidden" name="order_date" value="<?php print $today; ?>"/>
									</div>
									<label for="order_time" class="col-sm-2 control-label">เวลาเบิก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="order_time" value="<?php echo $t;?>" disabled/>
										<input type="hidden" name="order_time" value="<?php print $t; ?>"/>
									</div>
								</div>
								
								<?php
									$sql="select dep_name from dep where dep_id=$sess_depcode";
									$query = $conn->prepare($sql);
									$query->execute();
									while($rDep=$query->fetch(PDO::FETCH_ASSOC))
									$depname=$rDep['dep_name'];
								?>
								
								<div class="form-group">
									<label for="depname" class="col-sm-2 control-label">หน่วยงาน</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="depname" name="depname" value="<?php echo $depname;?>" disabled/>
										<input type="hidden" name="depcode" value="<?php print $sess_depcode; ?>"/>
										<input type="hidden" name="depname" value="<?php print $depname; ?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="order_user" class="col-sm-2 control-label">ผู้เบิก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="order_user" name="order_user" value="<?php echo $sess_fullname;?>" disabled/>
										<input type="hidden" name="order_user" value="<?php print $sess_fullname; ?>"/>
									</div>
									
								</div>
							</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-left">สร้างใบเบิก</button>
							<a href="main-fa.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success">    ปิด   </a>
						</div>
					</form>
					
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- items add all -->
<div class="modal fade" id="order-items-add" tabindex="-1" role="dialog" aria-hidden="true">
            <?php
			$oid=$_GET['oid'];
		    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  เพิ่มรายการ : order id : <?php echo $oid;?></h4>
            </div>
                    <form action="../qry/add_order_items.php" method="post">
							<div class="box-body">
								<div class="form-group">
                                    <input type="hidden" name="oid" value="<?php print $oid; ?>"/>
									<label for="items_id" class="col-sm-2 control-label">รายการ</label>
									<div class="col-sm-6">
										<select class="form-control select2" style="width: 100%;" id="items_id" name="items_id" data-validation="required">
											<option value="0">--Please Select--</option>
											<?php
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("
												select items_id,items_name
                                                from sp_items 
                                                where istatus='1'
                                                order by items_name");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)) {
												?>
												<option value="<?php echo $row['items_id'] ?>"><?php echo $row['items_name']?></option>
												<?php
												}
											?>
										</select>
									</div>
									<label for="qty" class="col-sm-2 control-label">เบิก</label>
									<div class="col-sm-2">
										<input type="text" class="form-control" style="text-align: center" name="qty" >
									</div>
								</div>
							
							</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-rigth">เพิ่ม</button>
							<!--<a href="order.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success">    ปิด   </a>-->
						</div>
					</form>
					
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- fa items add all -->
<div class="modal fade" id="fa-order-items-add" tabindex="-1" role="dialog" aria-hidden="true">
            <?php
			$oid=$_GET['oid'];
		    ?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  เพิ่มรายการ : order id : <?php echo $oid;?></h4>
            </div>
                    <form action="../qry/fa_add_order_items.php" method="post">
							<div class="box-body">
								<div class="form-group">
                                    <input type="hidden" name="oid" value="<?php print $oid; ?>"/>
									<label for="items_id" class="col-sm-2 control-label">รายการ</label>
									<div class="col-sm-6">
										<select class="form-control select2" style="width: 100%;" id="items_id" name="items_id" data-validation="required">
											<option value="0">--Please Select--</option>
											<?php
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("
												select items_id,items_name
                                                from fa_items 
                                                where istatus='1'
                                                order by items_name");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)) {
												?>
												<option value="<?php echo $row['items_id'] ?>"><?php echo $row['items_name']?></option>
												<?php
												}
											?>
										</select>
									</div>
									<label for="qty" class="col-sm-2 control-label">เบิก</label>
									<div class="col-sm-2">
										<input type="text" class="form-control" style="text-align: center" name="qty" >
									</div>
								</div>
							
							</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-rigth">เพิ่ม</button>
							<!--<a href="order.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success">    ปิด   </a>-->
						</div>
					</form>
					
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- jQuery 2.0.2 -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
		
	<script src="js/jquery.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script>
                        if (top.location != location) {
                    top.location.href = document.location.href ;
                  }
                                $(function(){
                                        window.prettyPrint && prettyPrint();
                                        
                                        $('#datepicker').datepicker();

                        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
		});
	</script>


<link href="css/datepicker.css" rel="stylesheet">
        <style>
	.container {
		background: #fff;
	}
	#alert {
		display: none;
	}
	</style>
        

