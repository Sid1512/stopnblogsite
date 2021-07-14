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
		$sql = "DELETE FROM comment WHERE post_id = $postid";
		$result = $con->query($sql);
		$sql = "DELETE FROM posts WHERE post_id = $postid";
		$result = $con->query($sql);
		unset($_SESSION['commentvar']);
		header('location:profile.php');
	}
?>