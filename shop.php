<?php
    include("dbOperations.php"); 
    //echo "test:".$_SESSION['emailid']
    $emailid = $_SESSION['emailid']
?>

<?php
    //print_r($_SESSION);
    if(isset($_SESSION['emailid']))
    {
      $emailid = $_SESSION['emailid'];
    }
    
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body style="background-image: url('images/MainBackground.jpg');">

<ul class="mynav">
  <li><a href="UserProfile.php?<?php echo $emailid?>">Home</a></li> 
  <!-- <li><a href="about.html">AboutUs</a></li> -->
  <li><a href="shop.php">Shop</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

<div class="content">
  

  <h2>Hello,&nbsp;<?php echo $emailid?></h2>
  <h1>The Nerd Stationery</h1>
  <h2>Following products are available</h2>

  <p>
    <?php
      echo displayProducts();
    ?>
  </p>
 
  <p>

  <br><input type="button" name="refresh" value="refresh" onclick="refresh()"><br>
    
  <?php  
     
      echo '<script type="text/JavaScript">  
           function refresh()
           {
            location.reload();
           }
          
          </script>' 
      ; 
  ?>
      
    
  </p>

</div>

</body>
</html>
