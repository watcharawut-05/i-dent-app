<?php
include "connection.php";
	session_start();
	$sess_userid=$_SESSION['sess_userid'];
	$sess_fullname=$_SESSION['sess_fullname'];
	if ($sess_userid<>session_id() or $sess_fullname==" ") {
		header("location:../main.php"); exit();
}
?>
