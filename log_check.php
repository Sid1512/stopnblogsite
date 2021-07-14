<?php
	session_start();
	$email = $_POST['email'];
	$pass = $_POST['passw'];

	$con = new mysqli('localhost','root','admin12','stopnblog');
	if($con->connect_error)
	{
		die("Failed to connect :".$con->connect_error);
	}
	else
	{
		$stmt = $con->prepare("SELECT * FROM users WHERE user_email = ?");
		$stmt->bind_param("s",$email);
		$stmt->execute();
		$stmt_result = $stmt->get_result();
		if($stmt_result->num_rows > 0)
		{
			$data = $stmt_result->fetch_assoc();
			if($data['user_pw'] === $pass)
			{
				$_SESSION['id'] = $data['user_id'];
				$_SESSION['name'] = $data['user_name'];
				$_SESSION['email'] = $data['user_email'];
				$_SESSION['phno'] = $data['user_phno'];
				$_SESSION['occup'] = $data['user_occup'];
				$_SESSION['occupname'] = $data['user_occupname'];
				$_SESSION['view_style'] = 0;
				$_SESSION['sort_style'] = 0;
				header('location:profile.php');
			}
			else
			{
				$_SESSION['checkvar'] = 1;
				header('location:index.php');
			}
		}
		else
		{
			$_SESSION['checkvar'] = 1;
			header('location:index.php');
		}
	}
?>