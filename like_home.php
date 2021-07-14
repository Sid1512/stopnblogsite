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
		$sql = "UPDATE posts SET post_likes = post_likes + 1 WHERE post_id = $postid";
		$result = $con->query($sql);
		header('location:home.php');
	}
?>