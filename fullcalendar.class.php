<?php
require_once 'function.php';
class Fullcalendar {

    private $host = '127.0.0.1';
    //ชื่อ Host
    private $user = 'sa';
    //ชื่อผู้ใช้งาน ฐานข้อมูล
    private $password = 'sa';
    // password สำหรับเข้าจัดการฐานข้อมูล
    private $database = 'ident';
    //ชื่อ ฐานข้อมูล

    //function เชื่อมต่อฐานข้อมูล
    protected function connect() {

        $mysqli = new mysqli( $this->host, $this->user, $this->password, $this->database );

        $mysqli->set_charset( 'utf8' );

        if ( $mysqli->connect_error ) {

            die( 'Connect Error: ' . $mysqli->connect_error );
        }

        return $mysqli;
    }

    //function show data in fullcalendar

    public function get_fullcalendar() {

        $db = $this->connect();
        $get_calendar = $db->query( "SELECT m.meeting_id,m.topic,CONCAT(m.sdate,' ',m.stime) AS sdate,CONCAT(m.edate,' ',m.etime) AS edate,m.detail,r.room_name,room_color 
        FROM mav_meeting m
        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms " );

        while( $calendar = $get_calendar->fetch_assoc() ) {
            $result[] = $calendar;
        }

        if ( !empty( $result ) ) {

            return $result;
        }
    }

    //show data in modal

    public function get_fullcalendar_id( $get_id ) {

        $db = $this->connect();
        $get_user = $db->prepare( 'SELECT m.meeting_id,m.topic,m.detail,m.sdate,m.stime,m.edate,
        m.etime,r.room_name,t.meeting_type_name,f.format_name,d.dep_name,m.capacity,m.login 
        FROM mav_meeting m
        LEFT OUTER JOIN mav_meeting_room r ON r.room_id=m.rooms
        LEFT OUTER JOIN mav_meeting_type t ON t.meeting_type_id=m.type
        LEFT OUTER JOIN dep d ON d.dep_id=m.depcode
        LEFT OUTER JOIN mav_meeting_format f ON f.format_id=m.set_table
        WHERE m.meeting_id = ?' );
        $get_user->bind_param( 'i', $get_id );
        $get_user->execute();
        $get_user->bind_result( $meeting_id, $topic,$detail, $sdate, $stime, $edate, $etime,
        $room_name,$meeting_type_name,$format_name,$dep_name,$capacity,$login );
        $get_user->fetch();

        $result = array(
            'id'=>$meeting_id,
            'topic'=>$topic,
            'detail'=>$detail,
            'room_name'=>$room_name,
            'sdate'=>thdate($sdate,nm),
            'stime'=>$stime,
            'edate'=>thdate($edate,nm),
            'etime'=>$etime,
            'meeting_type_name'=>$meeting_type_name,
            'format_name'=>$format_name,
            'dep_name'=>$dep_name,
            'capacity'=>$capacity,
            'login'=>$login
        );

        return $result;
    }

    //save new data

    public function new_calendar( $data ) {

        $db = $this->connect();

        $add_user = $db->prepare( 'INSERT INTO calendar (id,title,start,end) VALUES(NULL,?,?,?) ' );

        $add_user->bind_param( 'sss', $data['title'], $data['start'], $data['end'] );

        if ( !$add_user->execute() ) {

            echo $db->error;

        } else {

            echo 'บันทึกข้อมูลเรียบร้อย';
        }
    }

    //edit data

    public function edit_calendar( $data ) {

        $db = $this->connect();

        $add_user = $db->prepare( 'UPDATE calendar SET title = ? , start = ? ,end = ? WHERE id = ?' );

        $add_user->bind_param( 'sssi', $data['title'], $data['start'], $data['end'], $data['edit_calendar_id'] );

        if ( !$add_user->execute() ) {

            echo $db->error;

        } else {

            echo 'บันทึกข้อมูลเรียบร้อย';
        }
    }

    //delete data

    public function del_calendar( $id ) {

        $db = $this->connect();

        $del_user = $db->prepare( 'DELETE FROM calendar WHERE id = ?' );

        $del_user->bind_param( 'i', $id );

        if ( !$del_user->execute() ) {

            echo $db->error;

        } else {

            echo 'ลบข้อมูลเรียบร้อย';
        }
    }

}
?>