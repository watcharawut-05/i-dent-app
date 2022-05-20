<?php
require_once('connection.php');
$conn = new PDO($db,$username,$password,$options);

$username=$_POST['username'];
$password=$_POST['password'];
$year=$_POST['year'];

if ($username==" " or $password==" ") {
	echo "ERROR : โปรดใส่ username & password"; exit();
}else {
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$query = $conn->prepare("SELECT user_id,username,password,fullname,depcode,priority 
from user 
where username='$username' and password='$password' 
and status='1' ");
$query->bindParam("username", $username,PDO::PARAM_STR) ;
$query->bindParam("password", $password,PDO::PARAM_STR) ;
$query->execute();
$num=$query->rowCount();
$row=$query->fetch(PDO::FETCH_ASSOC);

//เก็บ log การเข้าใช้งาน
$date_login=date('Y-m-d H:i:s');
$sql_log="INSERT INTO mav_log (login,username,pw,password,fullname,depcode,date_login)
      values ('$username','$row[username]','$password','$row[password]','$row[fullname]','$row[depcode]','$date_login')";
mysql_query($sql_log);
$query = $conn->prepare($sql_log);
$query->execute();

if($num<=0) {
	echo "ERROR : Username ไม่ถูกต้อง Password ไม่ถูกต้อง";
}else{
	session_start();
	$_SESSION[sess_userid]=session_id();
	$_SESSION[sess_user_id]=$row[user_id];
	$_SESSION[sess_username]=$row[username];
	$_SESSION[sess_fullname]=$row[fullname];
	$_SESSION[sess_depcode]=$row[depcode];
	$_SESSION[sess_priority]=$row[priority];
	$_SESSION[sess_year]=$year;
	header("location:../main.php");
}
}
?>
