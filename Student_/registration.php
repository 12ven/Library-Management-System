<?php
  include "connection.php";
  session_start();
?>

<!DOCTYPE html>
<html>
<head>

  <title>Student Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

  <style type="text/css">
    section
    {
      margin-top: -70px;
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
      margin-bottom: 20px;
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
        <li><a href="student_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
					
				</ul>
				<?php
			}
			?>
		</div>
	</nav>


<section>
  <div class="reg_img">

    <div class="box2">
        <h1 style="text-align: center; font-size: 25px;">Student Registration Form</h1>

      <form name="Registration" action="" method="post">
        
        <div class="login">
          <input class="form-control" type="text" name="first" placeholder="First Name" required=""> <br>
          <input class="form-control" type="text" name="last" placeholder="Last Name" required=""> <br>
          <input class="form-control" type="text" name="roll" placeholder="ID number" required=""><br>

          
          <input class="form-control" type="text" name="email" placeholder="Email" required=""><br>
          
          <input class="form-control" type="number" minlength="10" name="contact" placeholder="Phone No" required=""><br>
          <input class="form-control" type="password" minlength="8" name="password" placeholder="Password" required=""> <br>
          <input class="btn btn-default button" type="submit" name="submit" value="submit"> </div>
      </form>
     
    </div>
  </div>
</section>

<?php
  if(isset($_POST['submit'])) { echo "test";
    $first = mysqli_real_escape_string($db,$_POST['first']);
    $last = mysqli_real_escape_string($db,$_POST['last']);
    $id = mysqli_real_escape_string($db,$_POST['roll']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $contact = mysqli_real_escape_string($db,$_POST['contact']);
    $password = mysqli_real_escape_string($db,$_POST['password']);
    
    $count = 0;

    $sql = "SELECT email from `student`";
    $res = mysqli_query($db, $sql);

    while($row = mysqli_fetch_assoc($res)) {
      if($row['email'] == $_POST['email']) {
        $count = $count + 1;
      }
    }
    
    if($count == 0) {
      mysqli_query($db, "INSERT INTO `student` VALUES('$first', '$last', '$id', '$email', '$contact', '$password', 'p.jpg');");
      ?>
      <script type="text/javascript">
        alert("Registration successful");
        window.location="student_login.php"
      </script>
      <?php
    }
 else {
      echo "
      <script type='text/javascript'>
        alert('The email already exists.');
      </script>
      ";
      
    }
  }
?>

</body>
</html>
