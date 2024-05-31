<?php
  include "connection.php";
  session_start();
?>

<!DOCTYPE html>
<html>
<head>

  <title>Admin Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="reg.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

  <style type="text/css">
    section
    {
      margin-top: -20px;
    }
    .button{
      color: white;
      background-color: black;
      width: 70px; 
      border-radius: 20px; 
      border: none; 
      height: 30px;
      margin-top: 20px;
      margin-left: 110px;
      font-size: 14px;
    }
  
    img{
      height: 60px;
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
        <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
					
				</ul>
				<?php
			}
			?>
		</div>
	</nav>

<section class="reg_img">
   

    <div class="box2">
        <h1 style="text-align: center; font-size: 25px; color: black;">Admin Registration Form</h1>

      <form name="Registration" action="" method="post">
        
        <div class="login">
          <input class="form-control" type="text" name="first" placeholder="First Name" required=""> <br>
          <input class="form-control" type="text" name="last" placeholder="Last Name" required=""> <br>
          
          <input class="form-control" type="text" name="email"  placeholder="Email" required=""><br>
          <input class="form-control" type="number" name="contact" minlength="10" placeholder="Phone No" required=""><br>
          <input class="form-control" type="password" name="password" minlength="8" placeholder="Password" required=""> <br>
          <input class="btn btn-default button" type="submit" name="submit" value="Sign Up"> </div>
        </div>
      </form>
    </div>

</section>

    <?php
      if(isset($_POST['submit']))
      {
      $first=$_POST['first'];
      $last=$_POST['last'];
    
      $email=$_POST['email'];
      $contact=$_POST['contact'];
      
      $password=$_POST['password'];
      
          
        $count=0;
        $sql="SELECT email from `admin`";
        $res=mysqli_query($db,$sql);

        while($row=mysqli_fetch_assoc($res))
        {
          if($row['email']==$_POST['email'])
          {
            $count=$count+1;
          }
        }
        if($count==0)
        {
          mysqli_query($db,"INSERT INTO `admin` VALUES('$first', '$last', '$email', '$contact','$password', 'p.jpg');");
        ?>
          <script type="text/javascript">
           alert("Registration successful");
           window.location="admin_login.php"
          </script>
        <?php
        }
        else
        {

          ?>
            <script type="text/javascript">
              alert("The username already exist.");
            </script>
          <?php

        }

      }

   
     

    ?>

</body>
</html>