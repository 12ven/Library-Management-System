<?php
  include "connection.php";
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Expired List</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

	<style type="text/css">

		.srch
		{
			padding-left: 70%;

		}
		.form-control
		{
			width: 300px;
			height: 40px;
			background-color: black;
			color: white;
		}


    img{
      height: 50px;
      width: 50px;
    }
		
		body {
			background-image: url("images/aa.jpg");
			background-repeat: no-repeat;
  	font-family: "Lato", sans-serif;
  	transition: background-color .5s;
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
  color: white;
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
  padding-left: 15px;
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
.container
{
	height: 600px;
  width: 85%;
	background-color: black;
	opacity: .6;
	color: white;
  margin-top: 10px;
  border-radius: 10px;
}
.scroll
{
  width: 100%;
  height: 400px;
  overflow: auto;
}
th,td
{
  width: 10%;
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

  			<div style="color: white; margin-left: 20px; font-size: 20px;">

                <?php
                if(isset($_SESSION['login_user']))

                { 	echo "<img class='img-circle profile_img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                    echo "</br></br>";

                    echo "Welcome ".$_SESSION['login_user']; 
                }
                ?>
            </div><br><br>

 
  <div class="h"> <a href="books.php">Books</a></div>
  <div class="h"> <a href="request.php">Requested Books</a></div>
  <div class="h"> <a href="issue_info.php">Issue Information</a></div>
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
  <div class="container">
    
    <?php
      if(isset($_SESSION['login_user']))
      {
        ?>

      <div style="float: left; padding-left:  5px; padding-top: 20px;">
      
      <div style="float: right;padding-top: 10px;">
        
        <?php 
        $var=0;
          $result=mysqli_query($db,"SELECT * FROM `fine` where email='$_SESSION[login_user]' and status='not paid' ;");
          while($r=mysqli_fetch_assoc($result))
          {
            $var=$var+$r['fine'];
          }
          $var2=$var+$_SESSION['fine'];

         ?>
        <h3>Your fine is: 
          <?php
            echo "₹".$var2;
          ?>
        </h3>
      </div>
<br><br><br><br>
        <?php
      }

      
         $ret='<p style="color:yellow; background-color:green;">RETURNED</p>';
         $exp='<p style="color:yellow; background-color:red;">EXPIRED</p>';
        
        if(isset($_POST['submit2']))
        {
          
        $sql="SELECT student.email,roll,books.bid,name,authors,edition,approve,issue_date,issue_book.return_date FROM student inner join issue_book ON student.email=issue_book.email inner join books ON issue_book.bid=books.bid WHERE issue_book.approve ='$ret' and issue_book.email ='$_SESSION[login_user]'  ORDER BY `issue_book`.`return_date` DESC";
        $res=mysqli_query($db,$sql);

        }
        else if(isset($_POST['submit3']))
        {
        $sql="SELECT student.email,roll,books.bid,name,authors,edition,approve,issue_date,issue_book.return_date FROM student inner join issue_book ON student.email=issue_book.email inner join books ON issue_book.bid=books.bid WHERE issue_book.approve ='$exp' and issue_book.email ='$_SESSION[login_user]' ORDER BY `issue_book`.`return_date` DESC";
        $res=mysqli_query($db,$sql);
        }
        else
        {
        $sql="SELECT student.email,roll,books.bid,name,authors,edition,approve,issue_date,issue_book.return_date FROM student inner join issue_book ON student.email=issue_book.email inner join books ON issue_book.bid=books.bid WHERE issue_book.approve !='' and issue_book.approve !='Yes'  and issue_book.email ='$_SESSION[login_user]' ORDER BY `issue_book`.`return_date` DESC";
        $res=mysqli_query($db,$sql);
        }


        
       echo "<div class='scroll'>";
       echo "<table class='table table-bordered' >";
        echo "<table class='table table-bordered' style='width:100%;' >";
        //Table header
        
        echo "<tr style='background-color: #6db6b9e6;'>";
        echo "<th>"; echo "Email Id";  echo "</th>";
        echo "<th>"; echo "Roll No";  echo "</th>";
        echo "<th>"; echo "BID";  echo "</th>";
        echo "<th>"; echo "Book Name";  echo "</th>";
        echo "<th>"; echo "Authors Name";  echo "</th>";
        echo "<th>"; echo "Edition";  echo "</th>";
        echo "<th>"; echo "Status";  echo "</th>";
        echo "<th>"; echo "Issue Date";  echo "</th>";
        echo "<th>"; echo "Return Date";  echo "</th>";

      echo "</tr>"; 
    

      while($row=mysqli_fetch_assoc($res))
      {
        echo "<tr>";
          echo "<td>"; echo $row['email']; echo "</td>";
          echo "<td>"; echo $row['roll']; echo "</td>";
          echo "<td>"; echo $row['bid']; echo "</td>";
          echo "<td>"; echo $row['name']; echo "</td>";
          echo "<td>"; echo $row['authors']; echo "</td>";
          echo "<td>"; echo $row['edition']; echo "</td>";
          echo "<td>"; echo $row['approve']; echo "</td>";
          echo "<td>"; echo $row['issue_date']; echo "</td>";
          echo "<td>"; echo $row['return_date']; echo "</td>";
        echo "</tr>";
      }
    echo "</table>";
        echo "</div>";

    ?>
  </div>
</div>
</body>
</html>