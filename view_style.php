<?php
	session_start();
	$test = $_POST['view'];
	$sort = $_POST['sort'];
	$_SESSION['view_style'] = $test;
	$_SESSION['sort_style'] = $sort;
	header('location:home.php');
?>