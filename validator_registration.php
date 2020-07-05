<?php 

// $customerid,$password,$name,$unit_number,$street,$city,$province,$postalcode
  if ($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['customerid']))
  {
    echo "<br> Userid cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['password']))
  {
    echo "<br> Password cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['name']))
  {
    echo "<br> Name cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['unit_number']))
  {
    echo "<br> Unit Number cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['street']))
  {
    echo "<br> Street cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['city']))
  {
    echo "<br> City cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['province']))
  {
    echo "<br> Province cannot be empty";
  }

  else if($_SERVER['REQUEST_METHOD'] == "POST" && empty($_POST['postalcode']))
  {
    echo "<br> Postal Code cannot be empty";
  }

//   else if($_SERVER['REQUEST_METHOD'] == "POST" && !is_numeric($_POST['age']))
//   {
//     echo "<br> Age needs to be a number.";
//   }

  
  else ($_SERVER['REQUEST_METHOD'] == "POST")
  {
    echo "<br> Form successfully submitted.";
  }


?>