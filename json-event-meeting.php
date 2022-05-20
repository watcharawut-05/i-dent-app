<?php
require 'fullcalendar.class.php';
//new object
$fullcalendar = new Fullcalendar();

//check data for show fullcalendar
if ( isset( $_GET['get_json'] ) ) {

    //call method get_fullcalendar
    $get_calendar = $fullcalendar->get_fullcalendar();

    foreach ( $get_calendar as $calendar ) {

        $json[] = array(
            'id'=>$calendar['meeting_id'],
            'room'=>$calendar['room_name'],
            'title'=>$calendar['topic'],
            'start'=>$calendar['sdate'],
            'end'=>$calendar['edate'],
            'stime'=>$calendar['stime'],
            'etime'=>$calendar['etime'],
            'url'=>'javascript:get_modal('.$calendar['meeting_id'].');',
            'color'=>$calendar['room_color'],
        );
    }

    //return JSON object
    echo json_encode( $json );
}

//show edit data modal
if ( isset( $_POST['id'] ) ) {

    $get_data = $fullcalendar->get_fullcalendar_id( $_POST['id'] );

    echo'<div class="modal-body">
            <form id="edit_fullcalendar" >
                  <div class="form-group col-md-6">
                    <label >ห้องประชุม</label>
                    <input type="text" class="form-control" name="room_name" value="'.$get_data['room_name'].'">
                  </div>
                  <div class="form-group col-md-6">
                    <label >ประเภท</label>
                    <input type="text" class="form-control" name="meeting_type_name" value="'.$get_data['meeting_type_name'].'">
                  </div>
                  <div class="form-group col-md-12">
                    <label >หัวข้อ</label>
                    <input type="text" class="form-control" name="title" value="'.$get_data['topic'].'">
                  </div>
                  <div class="form-group col-md-12">
                    <label >รายละเอียด</label>
                    <input type="text" class="form-control" name="title" value="'.$get_data['detail'].'">
                  </div>
                  <div class="form-group col-md-6">
                    <label >การจัดโต๊ะ</label>
                    <input type="text" class="form-control" name="format_name" value="'.$get_data['format_name'].'">
                  </div>
                  <div class="form-group col-md-6">
                    <label >จำนวน</label>
                    <input type="text" class="form-control" name="capacity" value="'.$get_data['capacity'].'">
                  </div>
                  <div class="form-group col-md-3">
                    <label >วันที่</label>
                    <input type="text" class="form-control" name="sdate"  value="'.$get_data['sdate'].'">
                  </div>
                  <div class="form-group col-md-3">
                    <label >เวลา</label>
                    <input type="text" class="form-control" name="stime" value="'.$get_data['stime'].'">
                  </div>
                  <div class="form-group col-md-3">
                    <label >ถึงวันที่</label>
                    <input type="text" class="form-control" name="sdate"  value="'.$get_data['edate'].'">
                  </div>
                  <div class="form-group col-md-3">
                    <label >เวลา</label>
                    <input type="text" class="form-control" name="stime" value="'.$get_data['etime'].'">
                  </div>
                  <div class="form-group col-md-6">
                    <label >หน่วยงาน</label>
                    <input type="text" class="form-control" name="dep_name" value="'.$get_data['dep_name'].'">
                  </div>
                  <div class="form-group col-md-6">
                    <label >ผู้จอง</label>
                    <input type="text" class="form-control" name="login" value="'.$get_data['login'].'">
                  </div>
                  <div class = "form-group">
                    <input type = "text" class = "form-control" id = "recipient-name" disabled/>
                  </div>
                    <input type="hidden" name="edit_calendar_id" value="'.$get_data['id'].'">
                </form>
            </div>
          <div class="modal-footer">
    
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
          </div>';
}

//save new data
if ( isset( $_POST['new_calendar_form'] ) ) {

    $fullcalendar->new_calendar( $_POST );
}

//edit new data
if ( isset( $_POST['edit_calendar_id'] ) ) {

    $fullcalendar->edit_calendar( $_POST );
}

//delete data
if ( isset( $_POST['del_id'] ) ) {

    $fullcalendar->del_calendar( $_POST['del_id'] );
}