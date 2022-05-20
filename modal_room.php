<div class="modal fade" id="room_add" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">เพิ่มประเภทการนัด</h4>
			</div>
			<form action="qry/add_room.php" method="post">
				<div class="modal-body">
					<div class="form-group col-md-6">
						<label for="room_name" class="col-form-label">ชื่อประเภทการนัด</label>
						<input type="text" class="form-control" name="room_name">
					</div>
					<!--div class="form-group col-md-6">
						<label for="room_value" class="col-form-label">ความจุคน</label>
						<input type="text" class="form-control" name="room_value">
					</div-->
					<!--div class="form-group col-md-6">
						<label for="room_place" class="col-form-label">สถานที่ตั้ง</label>
						<input type="text" class="form-control" name="room_place">
					</div>
					<div class="form-group col-md-6">
						<label for="room_keeper" class="col-form-label">ผู้ดูแลห้อง</label>
						<input type="text" class="form-control" name="room_keeper">
					</div-->
					<div class="form-group col-md-12">
						<label for="room_detail" class="col-form-label">รายละเอียด</label>
						<input type="text" class="form-control" name="room_detail">
					</div>
					<div class="form-group col-md-12">
						<label for="room_note" class="col-form-label">หมายเหตุ</label>
						<input type="text" class="form-control" name="room_note">
					</div>
					<div class="form-group col-md-6">
						<label for="room_color" class="col-form-label">Color</label>
						<div class="input-group my-colorpicker2">
							<input type="text" class="form-control" name="room_color">
							<div class="input-group-addon">
								<i></i>
							</div>
							</div>
							<!-- /.input group -->
							</div>
							<!-- /.form group -->
							<div class="form-group">
							<input type="text" class="form-control" id="recipient-name" disabled/>
							</div>

							</div>
							<div class="modal-footer clearfix">
							<button type="submit" class="btn btn-primary pull-left">เพิ่ม</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">close</button>
				</div>
			</form>
		</div>
    </div>
</div>
