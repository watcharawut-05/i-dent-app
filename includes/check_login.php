<?php
	session_start();
	include "connection.php";
	$strSQL = "select id_coop,id_digit,name 
	from user 
	where id_coop = '".mysql_real_escape_string($_POST['username'])."' 
	and password = '".mysql_real_escape_string($_POST['password'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
	}
	else
	{
			$_SESSION["sess_userid"]=session_id();
			$_SESSION["sess_id_coop"]=$objResult["id_coop"];
			$_SESSION["sess_id_digit"]=$objResult["id_digit"];
			$_SESSION["sess_name"]=$objResult["name"];
	
			header("location:../main.php");
	}
	mysql_close();
?>