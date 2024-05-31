<?php
  include "connection.php";
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fine Calculation </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<style type="text/css">
		.srch
		{
			padding-left: 850px;
		}
		body {
  font-family: "Lato", sans-serif;
  transition: background-color .5s;
}

  img{
    height: 50px;
    width: 50px;
  }

.sidenav {
  height: 100%;
  margin-top: 50px;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #222;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  transition: margin-left .5s;
  padding: 16px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
	margin-left: 20px;
}
.h:hover
{
	color:white;
	width: 300px;
	height: 50px;
	background-color: #00544c;
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
			} 
			?>
		</div>
	</nav>



<!--_________________sidenav_______________-->
	
	<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  			<div style="color: white; margin-left: 60px; font-size: 20px;">

                <?php
                if(isset($_SESSION['login_user']))
                	
                { 
                    echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_user']; 
                }
                
                ?>
            </div>
<br><br>
  <div class="h"><a href="request.php">Book Request</a></div>
  <div class="h"><a href="issue_info.php">Issue Information</a></div>
  <div class="h"><a href="expired.php">Expired List</a></div>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>


<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "white";
}
</script>

	<!--__________________________search bar________________________-->
<div class="container">

	<h2>List Of Students</h2>
	<?php

	$res=mysqli_query($db,"SELECT * FROM `fine` where email='$_SESSION[login_user]' ;");

		echo "<table class='table table-bordered table-hover' >";
			echo "<tr style='background-color: #6db6b9e6;'>";
				//Table header
				echo "<th>"; echo "Email Id";	echo "</th>";
				echo "<th>"; echo " Bid ";  echo "</th>";
				echo "<th>"; echo " Returned ";  echo "</th>";
				echo "<th>"; echo " Days ";  echo "</th>";
				echo "<th>"; echo " Fines";  echo "</th>";
				echo "<th>"; echo " Status ";  echo "</th>";
			echo "</tr>";	

			while($row=mysqli_fetch_assoc($res))
			{
				echo "<tr>";
				
				echo "<td>"; echo $row['email']; echo "</td>";
				echo "<td>"; echo $row['bid']; echo "</td>";
				echo "<td>"; echo $row['returned']; echo "</td>";
				echo "<td>"; echo $row['day']; echo "</td>";
				echo "<td>"; echo $row['fine']; echo "</td>";
				echo "<td>"; echo $row['status']; echo "</td>";

				echo "</tr>";
			}
		echo "</table>";
		

	?>
</div>
</body>
</html>