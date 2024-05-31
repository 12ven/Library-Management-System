<?php
  include "connection.php";
 
	$count=0;
      $res=mysqli_query($db,"SELECT * FROM `student` WHERE email='c' AND password='d';");
      $count=mysqli_num_rows($res);

      echo $count;
      
      if($count==0)
      {
        ?>
          <script type="text/javascript">
            alert("The email and password doesn't match.");
          </script>
        <?php
      }
      else
      {
        ?>
          <script type="text/javascript">
            
          </script>
        <?php
      }

?>