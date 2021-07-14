<?php
	session_start();
	$id = $_SESSION['id'];
	$checkvar = 1;
	$con = new mysqli('localhost','root','admin12','stopnblog');
	$pid;
	if($con->connect_error)
	{
		die("Failed to connect :".$con->connect_error);
	}
	$sql1 = "SELECT * FROM posts where user_id = $id ORDER BY post_date DESC";
	$result = $con->query($sql1);
	if($result->num_rows == 0)
	{
		$checkvar = 0;
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
<body class="profile-page">
	<div class="container">
		<header class="nav">
            <h1 class=logo>Stop<span>'N'</span>Blog</h1>
            <nav>
                <ul class="nav__links">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="createpost.php">Create Post</a></li>
                </ul>
            </nav>
            <a class="cta" href="profile.php">Profile</a>
            <nav>
                <ul class="nav__links">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
		<div class="profile-head">
			<div class="profile-pic">
				<img src="images/defaultpp.jpg" width="200" alt="">
			</div>
			<div class="profile-name">
				<h3 class="user-name"><?php echo $_SESSION['name']; ?></h3>
			</div>
		</div>
		<div class="main-info">
			<div class="left-side">
				<div class="profile-side">
					<p class="mob-no"><i class="fa fa-phone"></i>+91 
						<?php
							echo $_SESSION['phno'];
						?>
					</p>
					<p class="user-mail"><i class="fa fa-envelope"></i><?php
							echo $_SESSION['email'];
						?>
					</p>
					<p class="user-mail"><i class="fa fa-briefcase"></i><?php
							echo $_SESSION['occup'];
						?>
					</p>				
					<p class="user-mail"><i class="fa fa-building-o"></i><?php
							echo $_SESSION['occupname'];
						?>
					</p>
				</div>
			</div>
			<div class="right-side">
				<?php
				if($checkvar == 0)
				{
					echo "<div class='profile-post'><p class='post-title'>You have not posted anything.</p></div>";
				}
				else
				{
					while($row = $result->fetch_assoc()) 
					{
						$postid = $row['post_id'];
						echo "<div class='profile-post'><form action='del_profile.php' method='post'><button name='val' value='$postid' class='del-btn'>Delete Post <i class='fa fa-trash'></i></button></form>";
						echo "<p class='post-title'>". $row['post_title']. "</p><p class='post-type'>". $row['post_type']."</p><hr> <p class='post-body'>". $row['post_body']. "</p><hr><p class='post-date'>". $row['post_date']. "</p><br>";
						echo "<form action='like_profile.php' method='post'><button name='val' value='$postid' class='like-btn'><i class='fa fa-heart'></i> ".$row['post_likes']."</button></form>";
						if(!isset($_SESSION['commentvar']))
						{
							echo "<form action='comm_profile.php' method='post'><button name='val' value='$postid' class='comm-btn'><i class='fa fa-comment'></i> Comments</button></form>";
						}
						if(isset($_SESSION['commentvar']))
						{
							$pid = $_SESSION['commentvar'];
							if($pid == $postid)
							{
								$_SESSION['post_id'] = $postid;
								echo"<form action='comment_cross.php' method='post'><button name='val' value='xyz' class='del-btn'><i class='fa fa-times'></i></button></form>";
								echo "<form action='comm_check.php' method='post'><textarea class='comment-field' rows='2' cols='50' name='comment' placeholder=' Enter your comment..' tabindex='4' required></textarea><button name='val' value='$id' class='comm-btn'><i class='fa fa-comment'></i> Comment</button></form>";
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
						echo "</div>";
						
					}
				}
				?>
			</div>
		</div>
	</div>
</body>
</html>