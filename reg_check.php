<?php
	session_start();
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['passw'];
	$num = $_POST['num'];
	$date = $_POST['date'];
	$occup = $_POST['occup'];
	$occupname = $_POST['occupname'];
	$gender = $_POST['gender'];

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
			echo '<script>alert("Email Exists")</script>';		
		}
		else
		{
			$reg = $con->prepare("INSERT INTO users(user_name,user_email,user_phno,user_dob,user_occup,user_occupname,user_gender,user_pw) VALUES(?,?,?,?,?,?,?,?)");
			$reg->bind_param("ssisssss",$name,$email,$num,$date,$occup,$occupname,$gender,$pass);
			$reg->execute();

			$stmt = $con->prepare("SELECT * FROM users WHERE user_email = ?");
			$stmt->bind_param("s",$email);
			$stmt->execute();
			$stmt_result = $stmt->get_result();
			$data = $stmt_result->fetch_assoc();
			
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
	}
?>