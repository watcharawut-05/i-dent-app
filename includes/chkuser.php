<?php
include "connection.php";
$conn = new PDO($db,$username,$password,$options);

$booknumber=$_POST['booknumber'];
$cid=$_POST['cid'];

if ($cid==" ") {
	echo "ERROR : โปรดใส่ รหัส"; exit();
}else {
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("
SELECT user_id,cid,fullname FROM user WHERE cid='$cid' ");
$query->bindParam("cid", $cid,PDO::PARAM_STR) ;
$query->execute();
$num=$query->rowCount();
$row=$query->fetch(PDO::FETCH_ASSOC);

if($num<=0) {
	echo "ERROR : รหัส ไม่ถูกต้อง";
}else{
	session_start();
	$_SESSION[sess_userid]=session_id();
	$_SESSION[sess_cid]=$row[cid];
	$_SESSION[sess_fullname]=$row[fullname];
	header("location:../book-work-mobile.php?booknumber=$booknumber");
}
}
?>
