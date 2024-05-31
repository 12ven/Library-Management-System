<?php
  include "connection.php";
  session_start();
?>

<!DOCTYPE html>
<html>
<head>

  <title>Student Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
  
  <style type="text/css">
    section
    {
      margin-top: -20px;
    }
    img{
      height: 60px;
    }
    .button{
      color: white;
      background-color: blue;
      width: 70px; 
      border-radius: 20px; 
      border: none; 
      height: 30px;
      margin-top: 20px;
      margin-left: 110px;
      font-size: 14px;
    }
  </style>   
</head>
<body>

<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<img src="images/Logonew.png">
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php">HOME</a></li>
				<li><a href="books.php">BOOKS</a></li>
				<li><a href="feedback.php">FEEDBACK</a></li>
			</ul>

			<?php
			if (isset($_SESSION['login_user'])) {
				?>
				<ul class="nav navbar-nav">
					<li><a href="profile.php">PROFILE</a></li>
					<li><a href="fine.php">FINES</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="profile.php">
							<div style="color: white">
								<?php
								echo "<img class='img-circle profile_img' height=30 width=30 src='images/" . $_SESSION['pic'] . "'>";
								echo " " . $_SESSION['login_user'];
								?>
							</div>
						</a>
					</li>
					<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
				</ul>
				<?php
			} else {
				?>
				<ul class="nav navbar-nav navbar-right">
					
					<li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
				</ul>
				<?php
			}
			?>
		</div>
	</nav>

<section>
  <div class="log_img">
   <br>
    <div class="box1">
        <h1 style="text-align: center; font-size: 25px; color: black;">Student Login Form</h1><br>
      <form  name="login" action="" method="post">
        
        <div class="login">
          <input class="form-control" type="text" name="email" placeholder="Email ID" required=""> <br>
          <input class="form-control" type="password" name="password" minlength="8" placeholder="Password" required=""> <br>
          <input class="btn btn-default button" type="submit" name="submit" value="Login"> 
        </div>
      
      <p style="color: white; padding-left: 15px;">
        <br><br>
        <a style="color:red; text-decoration: none;" href="update_password.php">Forgot password?</a> &nbsp &nbsp &nbsp &nbsp &nbsp 
        New to this website?<a style="color: blue; text-decoration: none;" href="registration.php">&nbspSign Up</a>
      </p>
    </form>
    </div>
  </div>
</section>

  <?php

    if(isset($_POST['submit']))
    {
      $count=0;
      $res=mysqli_query($db,"SELECT * FROM `student` WHERE email='$_POST[email]' && password='$_POST[password]';");
      
      $row= mysqli_fetch_assoc($res);
      $count=mysqli_num_rows($res);

      if($count==0)
      {
      ?>
            
              <script type="text/javascript">
                alert("The username and password doesn't match.");
              </script> 
          
         <?php
      }
      else
      {
        $_SESSION['pic']= $row['pic'];
        $_SESSION['login_user'] = $_POST['email'];
        

        ?>
          <script type="text/javascript">
            window.location="profile.php"
          </script>
        <?php
      }
    }

  ?>

</body>
</html>