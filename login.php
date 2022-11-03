<?php

$loginid=" ";
$password=" ";

if(isset($_POST['loginid'])&&isset($_POST['password']))
{
	require('cc.php');
	$pdo=connect();
	$loginid=$_POST["loginid"];
	$password=$_POST["password"];
	
	$sql="SELECT * FROM `login-details` WHERE username='".$loginid."' AND password='".$password."';"  ;
	$user=runqueryrow($pdo,$sql);
	
	if(!$user)
	{
		header("Location:index.html");
	}
	
	else
	{
			session_start();
			$_SESSION["auth"]="YES";
			$_SESSION["id"]=$user["username"];
			header("Location:home.php");	
	}
}


?>