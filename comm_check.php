<?php
	session_start();
	$id = $_SESSION['id'];
	$postid = $_SESSION['post_id'];
	$cbdy = $_POST['comment'];
	$today = new DateTime();
	$date = $today->format('Y-m-d');
	$con = new mysqli('localhost','root','admin12','stopnblog');
	if($con->connect_error)
	{
		die("Failed to connect :".$con->connect_error);
	}
	else
	{
		$reg = $con->prepare("INSERT INTO comment(user_id,post_id,comment_body,comment_date) VALUES(?,?,?,?)");
		$reg->bind_param("iiss",$id,$postid,$cbdy,$date);
		$reg->execute();
		header('location:profile.php');
	}
?>
