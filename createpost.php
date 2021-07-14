<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Create Post</title>
  <link rel="stylesheet" href="style2.css">
  <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="form-post">
        <header class="nav">
            <h1 class=logo>Stop<span>'N'</span>Blog</h1>
            <nav>
                <ul class="nav__links">
                    <li><a href="home.php">Home</a></li>
                </ul>
            </nav>
            <a class="cta" href="createpost.php">Create Post</a>
            <nav>
                <ul class="nav__links">
                    <li><a href="profile.php">Profile</a></li>
                </ul>
            </nav>
        </header>
        <div class="form-postpanel">
            <form action="post_check.php" method="POST" class="input-group" id="post">
                <label for="name" class="form-label">Title</label>
                <input type="text" class="input-field" name="title" placeholder="Enter Post Title" tabindex="1" required>
                <br>
                <br>
                <label class='form-label' for='view'>Choose category :</label>
                    <select id='view' name='view' required>
                      <option value='Technology'>Technology</option>
                      <option value='Food'>Food</option>
                      <option value='Education'>Education</option>
                      <option value='Sports'>Sports</option>
                    </select>
                <br>
                <br>
                <label for="message" class="form-label">Body</label>
                <textarea class="input-field" rows="15" cols="50" name="body" placeholder="Write body for your post here..." tabindex="4" required></textarea>
                <button type="submit" class="submit-btn">Post</button>
                <br>
                <br>
            </form>
        </div>
    </div>
</body>
</html>