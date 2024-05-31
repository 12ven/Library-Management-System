<?php 
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>

	<style type="text/css">
		body
		{
			height: 650px;
			background-color: rgb(188, 238, 225);
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
		.wrapper
		{
			width: 400px;
			height: 330px;
			margin:100px auto;
			background-color: whitesmoke;
			opacity: .7;
			color: white;
			padding: 27px 15px;
			border-radius: 25px;
		}
		.form-control
		{
			width: 300px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div style="text-align: center;">
			<h1 style="text-align: center; font-size: 28px;font-family: Lucida Console; color: black;">Change Your Password</h1>
		</div>
	</br>
		<div style="padding-left: 30px; ">
		<form action="" method="post" >
			<input type="text" name="email" class="form-control" placeholder="Email" required=""><br>
			<input type="text" name="password" class="form-control" placeholder="New Password" required=""><br>
			<button class="btn btn-default button" type="submit" name="submit" >Update</button>
		</form>

	</div>
	
	<?php

		if(isset($_POST['submit']))
		{
			if(mysqli_query($db,"UPDATE admin SET password='$_POST[password]' WHERE email='$_POST[email]';"))
			{
				?>
					<script type="text/javascript">
                alert("The Password Updated Successfully.");
              </script> 

				<?php
			}
		}
	?></div>
</body>
</html>