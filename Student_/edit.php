<?php
	include "connection.php";
	session_start();
	
	if (!isset($_SESSION['login_user'])) {
		header("location: student_login.php"); // Redirect to login page if user is not logged in
		exit();
	}

	// Handle form submission
	if (isset($_POST['submit'])) {
		$first = $_POST['first'];
		$last = $_POST['last'];
		$ID_Number = $_POST['roll'];
		$email = $_POST['email'];
		$contact = $_POST['phonenumber'];
		$pic = $_FILES['file']['name'];

		// Move uploaded profile picture to a designated folder
		move_uploaded_file($_FILES['file']['tmp_name'], "images/".$pic);

		// Update user's profile information in the database
		$sql = "UPDATE student SET first='$first', last='$last', roll='$ID_Number', email='$email', phonenumber='$contact', pic='$pic' WHERE email='" . $_SESSION['login_user'] . "'";
		if (mysqli_query($db, $sql)) {
			// Redirect to profile page if update is successful
			header("location: profile.php");
			exit();
		} else {
			echo "Error: " . mysqli_error($db);
		}
	}

	// Retrieve user's profile information from the database
	$sql = "SELECT * FROM student WHERE email='" . $_SESSION['login_user'] . "'";
	$result = mysqli_query($db, $sql) or die(mysqli_error($db));

	while ($row = mysqli_fetch_assoc($result)) {
		$first = $row['first'];
		$last = $row['last'];
		$ID_Number = $row['roll'];
		$email = $row['email'];
		$contact = $row['phonenumber'];
		$pic = $row['pic'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		.form-control {
			width: 250px;
			height: 38px;
		}
		.form1 {
			margin: 0 auto;
			width: 300px;
			padding: 20px;
			border: 1px solid #ccc;
			background-color: #f1f1f1;
			border-radius: 5px;
		}
		label {
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
		<ul class="nav navbar-nav">
			<li><a href="profile.php">PROFILE</a></li>
			<li><a href="fine.php">FINES</a></li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="profile.php">
					<div style="color: white">
						<img class='img-circle profile_img' height=30 width=30 src='images/<?php echo $pic; ?>'>
						<?php echo $_SESSION['login_user']; ?>
					</div>
				</a>
			</li>
			<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
		</ul>
	</div>
</nav>

<h2 style="text-align: center; color: #fff;">Edit Information</h2>

<div class="form1">
	<form action="" method="post" enctype="multipart/form-data">
		<input class="form-control" type="file" name="file">
		<label><h4><b>First Name:</b></h4></label>
		<input class="form-control" type="text" name="first" value="<?php echo $first; ?>">
		<label><h4><b>Last Name:</b></h4></label>
		<input class="form-control" type="text" name="last" value="<?php echo $last; ?>">
		<label><h4><b>ID Number:</b></h4></label>
		<input class="form-control" type="text" name="roll" value="<?php echo $ID_Number; ?>">
		<label><h4><b>Email:</b></h4></label>
		<input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
		<label><h4><b>Contact No:</b></h4></label>
		<input class="form-control" type="text" name="phonenumber" value="<?php echo $contact; ?>">
		<br>
		<div style="text-align: center;">
			<button class="btn btn-default" type="submit" name="submit">Save</button>
		</div>
	</form>
</div>

</body>
</html>
