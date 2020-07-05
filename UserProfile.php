<?php
    
    session_start();
    $emailid = $_SESSION['emailid'];
    
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body style="background-image: url('images/MainBackground.jpg');">

<ul class="mynav">
  <li><a href="UserProfile.php?<?php echo $_SESSION['emailid']?>">Home</a></li> 
  <!-- <li><a href="about.html">AboutUs</a></li> -->
  <li><a href="shop.php">Shop</a></li>
  <li><a href="logout.php">Logout</a></li>


</ul>

<div class="content">
  <h1>Hello <?php echo $emailid?>, You are now logged in.</h1>
  <p>
      
    
  </p>
</div>

</body>
</html>