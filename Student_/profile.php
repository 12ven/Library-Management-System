<?php 
	include "connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		.wrapper {
			width: 300px;
			margin: 0 auto;
			color: white;
		}
		img {
			height: 50px;
			width: 50px;
		}
	</style>
</head>
<body style="background-color: #004528;">

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
				<li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
			</ul>
			<?php
		}
		?>
	</div>
</nav>

<div class="container">
	<form action="" method="post">
		<button class="btn btn-default" style="float: right; width: 70px;" name="submit1">Edit</button>
	</form>
	<div class="wrapper">
		<?php
		if (isset($_POST['submit1'])) {
			header("location: edit.php"); // Redirect to the edit page
			exit();
		}
		$q = mysqli_query($db, "SELECT * FROM student WHERE email='$_SESSION[login_user]'");
		$row = mysqli_fetch_assoc($q);
		?>

		<h2 style="text-align: center;">My Profile</h2>

		<div style="text-align: center;">
			<img class="img-circle profile-img" height="110" width="120" src="images/<?php echo $_SESSION['pic']; ?>">
		</div>

		<div style="text-align: center;">
			<b>Welcome,</b>
			<h4><?php echo $_SESSION['login_user']; ?></h4>
		</div>

		<b>
		<table class="table table-bordered">
			<tr>
				<td><b>First Name:</b></td>
				<td><?php echo $row['first']; ?></td>
			</tr>
			<tr>
				<td><b>Last Name:</b></td>
				<td><?php echo $row['last']; ?></td>
			</tr>
			<tr>
				<td><b>ID Number:</b></td>
				<td><?php echo $row['roll']; ?></td>
			</tr>
			<tr>
				<td><b>Email:</b></td>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td><b>Phone Number:</b></td>
				<td><?php echo $row['phonenumber']; ?></td>
			</tr>
		</table>
		</b>
	</div>
</div>
</body>
</html>
