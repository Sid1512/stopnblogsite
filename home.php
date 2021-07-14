<?php
	session_start();
	$checkvar = 1;
	$id = $_SESSION['id'];
	$varview = $_SESSION['view_style'];
	$varsort = $_SESSION['sort_style'];
	$con = new mysqli('localhost','root','admin12','stopnblog');
	if($con->connect_error)
	{
		die("Failed to connect :".$con->connect_error);
	}
	if($varview == 'All')
	{
		if($varsort == 0)
		{
			$sql = "SELECT * FROM posts ORDER BY post_date DESC";
			$result = $con->query($sql);
			if($result->num_rows == 0)
			{
				$checkvar = 0;
			}
		}
		else
		{
			$sql = "SELECT * FROM posts ORDER BY post_likes DESC";
			$result = $con->query($sql);
			if($result->num_rows == 0)
			{
				$checkvar = 0;
			}
		}
	}
	else
	{
		if($varsort == 1)
		{
			$stmt = $con->prepare("SELECT * FROM posts WHERE post_type = ? ORDER BY post_date DESC");
			$stmt->bind_param("s",$varview);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows == 0)
			{
				$checkvar = 0;
			}
		}
		else
		{
			$stmt = $con->prepare("SELECT * FROM posts WHERE post_type = ? ORDER BY post_likes DESC");
			$stmt->bind_param("s",$varview);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows == 0)
			{
				$checkvar = 0;
			}
		}
		
	}
	if(isset($_SESSION['commentvar']))
	{
		$pid = $_SESSION['commentvar'];
		$sql2 = "SELECT * FROM comment where post_id = $pid";
		$comresult = $con->query($sql2);
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile Page</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="test.css">
	<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body class="home-page">
	<div class="container">
		<header class="nav">
            <h1 class=logo>Stop<span>'N'</span>Blog</h1>
            <a class="cta" href="home.php">Home</a>
            <nav>
                <ul class="nav__links">
                	<li><a href="createpost.php">Create Post</a></li>
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
        </header>
        <div class="right-side">
        	<div class="home-post">
			<?php
			if($checkvar == 0)
			{
				echo"<div class='profile-post'><form action='view_style.php' method='post'><button name='val' class='del-btn'>View</button>";
				echo"<label class='label' for='view'>Choose category :</label>
					<select id='view' name='view'>
					  <option value='All'>All</option>
					  <option value='Technology'>Technology</option>
					  <option value='Food'>Food</option>
					  <option value='Education'>Education</option>
					  <option value='Sports'>Sports</option>
					</select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
				echo"<label class='label' for='sort'>Sort By :</label>
					<select id='sort' name='sort'>
					  <option value='0'>Date</option>
					  <option value='1'>Likes</option>
					</select></form></div>";
			}
			else
			{	
				echo"<div class='profile-post'><form action='view_style.php' method='post'><button name='val' class='del-btn'>View</button>";
				echo"<label class='label' for='view'>Choose category :</label>
					<select id='view' name='view'>
					  <option value='All'>All</option>
					  <option value='Technology'>Technology</option>
					  <option value='Food'>Food</option>
					  <option value='Education'>Education</option>
					  <option value='Sports'>Sports</option>
					</select>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
				echo"<label class='label' for='sort'>Sort By :</label>
					<select id='sort' name='sort'>
					  <option value='0'>Date</option>
					  <option value='1'>Likes</option>
					</select></form></div>";
				while($row = $result->fetch_assoc()) 
				{
					echo "<div class='profile-post'>";
					$postid = $row['post_id'];
					if($id == 1)
					{
						echo "<form action='del_home.php' method='post'><button name='val' value='$postid' class='del-btn'>Delete Post <i class='fa fa-trash'></i></button></form>";
					}
					$uid = $row['user_id'];
					$sql3 = "SELECT user_name FROM users where user_id = $uid";
					$userresult = $con->query($sql3);
					while($us = $userresult->fetch_assoc())
					{
						$uname = $us['user_name'];
					}
					echo "<p class='post-title'>". $row['post_title']. "</p><p class='post-uname'> By ~ ". $uname."</p><p class='post-type'>". $row['post_type']."</p><hr> <p class='post-body'>". $row['post_body']. "</p><hr><p class='post-date'>". $row['post_date']. "</p><br>";
						echo "<form action='like_home.php' method='post'><button name='val' value='$postid' class='like-btn'><i class='fa fa-heart'></i> ".$row['post_likes']."</button></form>";
					if(!isset($_SESSION['commentvar']))
						{
							echo "<form action='comm_home.php' method='post'><button name='val' value='$postid' class='comm-btn'><i class='fa fa-comment'></i> Comments</button></form>";
						}
						if(isset($_SESSION['commentvar']))
						{
							$pid = $_SESSION['commentvar'];
							if($pid == $postid)
							{
								$_SESSION['post_id'] = $postid;
								echo"<form action='comment_cross_home.php' method='post'><button name='val' value='xyz' class='del-btn'><i class='fa fa-times'></i></button></form>";
								echo "<form action='comm_check_home.php' method='post'><textarea class='comment-field' rows='2' cols='50' name='comment' placeholder=' Enter your comment..' tabindex='4' required></textarea><button name='val' value='$id' class='comm-btn'><i class='fa fa-comment'></i> Comment</button></form>";
								while($comm = $comresult->fetch_assoc())
								{
									$uid = $comm['user_id'];
									$sql3 = "SELECT user_name FROM users where user_id = $uid";
									$userresult = $con->query($sql3);
									while($us = $userresult->fetch_assoc())
									echo "<div class='comment'><p class='comment'><span>".$us['user_name'].":</span>".$comm['comment_body']."</p></div><p class='post-date'>". $comm['comment_date']. "</p><br>";
								}
							}
						}
					echo"</div>";
				}
			}
			?>
			</div>
		</div>
	</div>
</body>
</html>