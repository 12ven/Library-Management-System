<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Library Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style>
		img {
			height: 50px;
			width: 50px;
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
					<li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
				</ul>
				<?php
			}
			?>
		</div>
	</nav>

	<?php
	if (isset($_SESSION['login_user'])) {
		$day = 0;
		$exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
		// Assuming you have a valid database connection, update the following line to include your database connection.
		// $db = mysqli_connect("host", "username", "password", "database_name");
		$res = mysqli_query($db, "SELECT * FROM `issue_book` WHERE email ='$_SESSION[login_user]' AND approve ='$exp';");

		while ($row = mysqli_fetch_assoc($res)) {
			$d = strtotime($row['return']);
			$c = strtotime(date("Y-m-d"));
			$diff = $c - $d;

			if ($diff >= 0) {
				$day += floor($diff / (60 * 60 * 24));  // Days
			}
		}
		$_SESSION['fine'] = $day * 0.10;
	}
	?>
</body>
</html>
