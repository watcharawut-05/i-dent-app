<?php
require_once('connection.php');
	session_start();
	$sess_userid=$_SESSION['sess_userid'];
	$sess_user_id=$_SESSION['sess_user_id'];
	$sess_username=$_SESSION['sess_username'];
	$sess_fullname=$_SESSION['sess_fullname'];
	$sess_depcode=$_SESSION['sess_depcode'];
	$sess_priority=$_SESSION['sess_priority'];
	$sess_year=$_SESSION['sess_year'];
	if ($sess_userid<>session_id() or $sess_username==" " or $sess_fullname==" ") {
		header("location:../main.php"); exit();
}
?>
