<?php
	session_start();
	$postid = $_POST['val'];
	$con = new mysqli('localhost','root','admin12','stopnblog');
	if($con->connect_error)
	{
		die("Failed to connect :".$con->connect_error);
	}
	else
	{
		$_SESSION['commentvar'] = $postid;
		header('location:home.php');
		
	}
?>