<meta charset="utf-8">
<?php
include "../includes/connection.php";

$room_id = $_GET['room_id'];

if ($_FILES["myfile"]["error"] > 0) {
    echo "error";
} else {
    $_FILES["myfile"]["tmp_name"];

    $images = $_FILES["myfile"]["tmp_name"];
    $typeupload = ($_FILES["myfile"]["type"]);
    $nameimages = $_FILES["myfile"]["name"];
    copy($_FILES["myfile"]["tmp_name"], "../room_pic/" . $nameimages);

    $sql = "UPDATE mav_meeting_room SET room_pic='$nameimages' WHERE room_id ='$room_id' ";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = $conn->prepare($sql);

}

try {
    $query->execute();
    ?>
<script>
alert("Upload File เรียบร้อยแล้ว......");
window.location = '../meeting_room.php';
</script>
<?php
} catch (PDOException $e) {
    echo 'ไม่สามารถแก้ไขข้อมูลได้' . $e->getMessage();
}
?>