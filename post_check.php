<?php
	session_start();
	$title = $_POST['title'];
	$body = $_POST['body'];
	$id = $_SESSION['id'];
	$type = $_POST['view'];
	$today = new DateTime();
	$date = $today->format('Y-m-d');

	$con = new mysqli('localhost','root','admin12','stopnblog');
	if($con->connect_error)
	{
		die("Failed to connect :".$con->connect_error);
	}
	else
	{
		$pst = $con->prepare("INSERT INTO posts(post_title,post_type,post_body,post_date,user_id) VALUES(?,?,?,?,?)");
		$pst->bind_param("sssss",$title,$type,$body,$date,$id);
		$pst->execute();
		header('location:profile.php');
	}
?>