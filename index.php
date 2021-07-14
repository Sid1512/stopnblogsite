<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login And Signup</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="form-base">
    <div class="form-panel">
      <div class="btn-panel">
        <div id="btn-coleff"></div>
        <button type="button" class="toggle-btn" onclick="login()">Login In</button>
        <button type="button" class="toggle-btn" onclick="signup()">Sign Up</button>
      </div>
      <form action="log_check.php" method="post" id="login" class="input-group">
        <input name="email" type="email" class="input-field" placeholder="Email Id" required>
        <input name="passw" type="password" class="input-field" placeholder="Enter Password" required>
        <button type="submit" class="submit-btn">Log In</button>
        <?php
          if(isset($_SESSION['checkvar']))
          {
            echo '<script>alert("Invalid Username or Password")</script>';
          }
        ?>
      </form>
      <form action="reg_check.php" method="post" id="signup" class="input-group">
        <input name="name" type="text" class="input-field" placeholder="Name" required>
        <input name="email" type="email" class="input-field" placeholder="Email Id" required>
        <input name="num" type="number" class="input-field" placeholder="Phone Number" required>
        <input name="date" type="date" class="input-field" required>
        <div class="input-field">
          <label><input name="occup" type="radio" value="Student"> Student</label>
          <label><input name="occup" type="radio" value="Working"> Working</label>
        </div>
        <input name="occupname" type="text" class="input-field" placeholder="Work Area/Institution Name" required>
        <div class="input-field">
          <label><input name="gender" type="radio" value="M"> Male</label>
          <label><input name="gender" type="radio" value="F"> Female</label>
          <label><input name="gender" type="radio" value="O"> Other</label>
        </div>
        <input name="passw" type="password" class="input-field" placeholder="Enter Password" required>
        <button type="submit" class="submit-btn">Sign Up</button>
      </form>
    </div>
  </div>
  <script>
    var x = document.getElementById("login");
    var y = document.getElementById("signup");
    var z = document.getElementById("btn-coleff");
    function signup(){
      x.style.left = "-400px"
      y.style.left = "50px"
      z.style.left = "110px"
    }
    function login(){
      x.style.left = "50px"
      y.style.left = "450px"
      z.style.left = "0"
    }
  </script>
</body>
</html>