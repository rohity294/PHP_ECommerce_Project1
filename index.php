<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body style="background-image: url('images/MainBackground.jpg');">


<ul class="mynav">
  <li><a href="index.php">Home</a></li>
  <li><a href="about.html">AboutUs</a></li>
</ul>



<div class="content" >
  <h2><?php 
  
  if(isset($_GET['loggedOut']) && $_GET['loggedOut']=="yes")
  {
    echo "<br>"."You have successfully loggedOut"."<br>";
  }  
  ?></h2>


  <h1>The Nerd Stationery</h1>
  <p>
    Our mission is to provide the best of the stationary at unbeatble prices.<br><br>
    New users kindly proceed to register. Already registererd users can login below.
  </p>
  <p>
    <a href="register.php">New User Registration</a><br><br>

    <form method="post" action="loginProcessor.php">
      <legend>Login Form</legend>
      <fieldset>
        EmailId:&nbsp;&nbsp;&nbsp;<input type="text" name="emailid" placeholder="enter EmailId"><br>
        <br>password: <input type="password" name="password" placeholder="enter password"><br>
        <br><input type="submit" name="login" value="login">
      </fieldset>   
    </form>
  </p>
</div>

</body>
</html>
