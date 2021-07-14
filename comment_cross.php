<?php
	session_start();
	unset($_SESSION['commentvar']);
	header('location:profile.php');
?>