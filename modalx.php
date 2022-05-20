<!-- items add dep -->
<div class="modal fade" id="order-items-dep-add" tabindex="-1" role="dialog" aria-hidden="true">
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
											<?php
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("
												select a.items_id,b.items_name
                                                from sp_items_dep a
                                                left outer join sp_items b on b.items_id=a.items_id 
                                                where b.istatus='1'
                                                and a.depcode=$sess_depcode
                                                order by b.items_name");
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

<!-- fa items add dep -->
<div class="modal fade" id="fa-order-items-dep-add" tabindex="-1" role="dialog" aria-hidden="true">
<?php
$oid=$_GET['oid'];
?>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  เพิ่มรายการเบิกงานซักฟอก : order id : <?php echo $oid;?></h4>
            </div>
                    <form action="../qry/fa_add_order_items.php" method="post">
							<div class="box-body">
								<div class="form-group">
                                    <input type="hidden" name="oid" value="<?php print $oid; ?>"/>
									<label for="items_id" class="col-sm-2 control-label">รายการ</label>
									<div class="col-sm-4">
										<select class="form-control select2" style="width: 100%;" id="items_id" name="items_id" data-validation="required">
											<option value="0">--Please Select--</option>
											<?php
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("SELECT a.items_id,b.items_name,a.stock
                                                from fa_items_dep a
                                                left outer join fa_items b on b.items_id=a.items_id 
                                                where b.istatus='1'
                                                and a.depcode=$sess_depcode
                                                order by b.items_name");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)) {
												?>
												<option value="<?php echo $row['items_id'] ?>"><?php echo $row['items_name']?> [<?php echo $row['stock']?>]</option>
												<?php
												}
											?>
										</select>
									</div>
									<div class="col-sm-2">
										<input type="text" class="form-control" style="text-align: center" name="used" placeholder="ใช้ไป" required>
									</div>
									<div class="col-sm-2">
										<input type="text" class="form-control" style="text-align: center" name="balance" placeholder="คงเหลือ" required>
									</div>
									<div class="col-sm-2">
										<input type="text" class="form-control" style="text-align: center" name="qty" placeholder="เบิก" required>
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

<!-- ส่งผ้าซัก -->
<div class="modal fade" id="send_fa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  ส่งผ้าซักภายนอก</h4>
            </div>
            <form action="qry/add_send_fa.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="send_date" class="col-sm-2 control-label">วันที่</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="send_date" value="<?php echo thdate($today,'sm');?>" disabled/>
										<input type="hidden" name="send_date" value="<?php print $today; ?>"/>
									</div>
									<label for="send_time" class="col-sm-2 control-label">เวลา</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="send_time" value="<?php echo $t;?>" disabled/>
										<input type="hidden" name="send_time" value="<?php print $t; ?>"/>
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
									<div class="col-sm-4">
										<input type="text" class="form-control" id="depname" name="depname" value="<?php echo $depname;?>" disabled/>
										<input type="hidden" name="depcode" value="<?php print $sess_depcode; ?>"/>
										<input type="hidden" name="depname" value="<?php print $depname; ?>"/>
									</div>
									<label for="send_user" class="col-sm-2 control-label">ผู้ส่ง</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="send_user" name="send_user" value="<?php echo $sess_fullname;?>" disabled/>
										<input type="hidden" name="send_user" value="<?php print $sess_fullname; ?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="weight" class="col-sm-2 control-label">น้ำหนัก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="weight" name="weight" required>
									</div>
									<label for="nop" class="col-sm-2 control-label">จำนวน</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="nop" name="nop">
									</div>
								</div>
								<div class="form-group">
									<label for="company" class="col-sm-2 control-label">ผู้รับ</label>
									<div class="col-sm-10">
										<select class="form-control select2" style="width: 100%;" id="company" name="company" data-validation="required">
											<?php
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("
												select company_name
                                                from fa_company");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)) {
												?>
												<option value="<?php echo $row['company_name'] ?>"><?php echo $row['company_name']?></option>
												<?php
												}
											?>
										</select>
									</div>
								</div>
							</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-left">บันทึก</button>
							<a href="order.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success">    ปิด   </a>
						</div>
					</form>
					
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- รับผ้าซัก -->
<div class="modal fade" id="receive_fa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">  รับผ้าซักจากภายนอก</h4>
            </div>
            <form action="qry/add_receive_fa.php" method="post">
							<div class="box-body">
								<div class="form-group">
									<label for="receive_date" class="col-sm-2 control-label">วันที่</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="receive_date" value="<?php echo thdate($today,'sm');?>" disabled/>
										<input type="hidden" name="receive_date" value="<?php print $today; ?>"/>
									</div>
									<label for="receive_time" class="col-sm-2 control-label">เวลา</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" style="text-align: center" name="receive_time" value="<?php echo $t;?>" disabled/>
										<input type="hidden" name="receive_time" value="<?php print $t; ?>"/>
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
									<div class="col-sm-4">
										<input type="text" class="form-control" id="depname" name="depname" value="<?php echo $depname;?>" disabled/>
										<input type="hidden" name="depcode" value="<?php print $sess_depcode; ?>"/>
										<input type="hidden" name="depname" value="<?php print $depname; ?>"/>
									</div>
									<label for="receive_user" class="col-sm-2 control-label">ผู้รับ</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="receive_user" name="receive_user" value="<?php echo $sess_fullname;?>" disabled/>
										<input type="hidden" name="receive_user" value="<?php print $sess_fullname; ?>"/>
									</div>
								</div>
								
								<div class="form-group">
									<label for="weight" class="col-sm-2 control-label">น้ำหนัก</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="weight" name="weight" required>
									</div>
									<label for="nop" class="col-sm-2 control-label">จำนวน</label>
									<div class="col-sm-4">
										<input type="text" class="form-control" id="nop" name="nop">
									</div>
								</div>
								<div class="form-group">
									<label for="company" class="col-sm-2 control-label">รับจาก</label>
									<div class="col-sm-10">
										<select class="form-control select2" style="width: 100%;" id="company" name="company" data-validation="required">
											<?php
												$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
												$query = $conn->prepare("
												select company_name
                                                from fa_company");
												$query->execute();
												while($row=$query->fetch(PDO::FETCH_ASSOC)) {
												?>
												<option value="<?php echo $row['company_name'] ?>"><?php echo $row['company_name']?></option>
												<?php
												}
											?>
										</select>
									</div>
								</div>
							</div>

						<div class="modal-footer">
							<button type="submit" class="btn btn-primary pull-left">บันทึก</button>
							<a href="order.php" data-dismiss="modal" aria-hidden="true" class="btn btn-success">    ปิด   </a>
						</div>
					</form>
					
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

