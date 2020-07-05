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

<div class="content">
  <h1>The Nerd Stationery</h1>
  <h2>Registration Form</h2>
  <form method="post" action="registrationProcessor.php">
      <fieldset>
        <legend>Registration Form</legend>
        EmailId:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="customerid" placeholder="enter EmailId"
        <?php
        if(isset($_POST['customerid']) && !empty($_POST['customerid']))
        {
            echo "value = $customerid";
        }
        ?>
        >
        <br>

        <br>password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" placeholder="enter password"
        <?php
        if(isset($_POST['password']) && !empty($_POST['password']))
        {
            echo "value = $password";
        }
        ?>
        >
        <br>

        <br>name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="name" placeholder="enter name"
        <?php
        if(isset($_POST['name']) && !empty($_POST['name']))
        {
            echo "value= $name";
        }
        ?>
        >
        <br>

        <br>unit number: <input type="text" name="unit_number" placeholder="enter unit number"
        <?php
        if(isset($_POST['unit_number']) && !empty($_POST['unit_number']))
        {
            echo "value= $unit_number";
        }
        ?>
        >
        <br>

        <br>street:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="street" placeholder="enter street"
        <?php
        if(isset($_POST['street']) && !empty($_POST['street']))
        {
            echo "value= $street";
        }
        ?>
        >
        <br>

        <br>city:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="city" placeholder="enter city"
        <?php
        if(isset($_POST['city']) && !empty($_POST['city']))
        {
            echo "value= $city";
        }
        ?>
        >
        <br>

        <br>province:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="province" placeholder="enter province"
        <?php
        if(isset($_POST['province']) && !empty($_POST['province']))
        {
            echo "value= $province";
        }
        ?>
        >
        <br>

        <br>postal code:&nbsp;&nbsp;<input type="text" name="postalcode" placeholder="enter postal code"
        <?php
        if(isset($_POST['postalcode']) && !empty($_POST['postalcode']))
        {
            echo "value = $postalcode";
        }
        ?>
        >
        <br>

        <br><input type="submit" name="register" value="register">
      </fieldset>   
  </form>
</div>



</body>
</html>
