<?php
session_start();

// echo "login processor";

$emailid = "";
$password = "";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    $emailid = $_POST['emailid'];
    $password = $_POST['password'];

    $_SESSION['emailid'] = $emailid;

    // echo $emailid;
    // echo $password;

    $error_message="";

    if(empty($emailid))
    {
       $error_message = "UserId field cannnot be left empty";
    }

    if(empty($password))
    {
       $error_message = $error_message . "<br>" ."Password field cannnot be left empty";
    }

    if($error_message!="")
    {
        include_once("index.php");
        echo $error_message;
    }

    else
    {
        authenticateUser($emailid, $password);   
    }




}

  function authenticateUser($emailid, $password)
  {
    
    include_once("mysqli_connect.php");
    // echo $emailid;
    // echo "<br>";
    // echo $password;
    // echo "<br>";

    $emailid = trim($emailid);
    $password = trim($password);
    //$query = "select * from login where loginid = 'rohit@gmail.com' and password = 'password' ";
    $query = " SELECT * from login where loginid = '$emailid' and password = '$password' ";
    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
   
    $num_rows = mysqli_num_rows($result);
    //echo $num_rows;

    if($num_rows==1)
    {
        // include("UserProfile.php");

        header("Location: UserProfile.php?emailid=$emailid");
    }
    else
    {
        include("index.php");
        echo "<br>"."Login failed, Kindly retry with correct login credentials"."<br>";
        
    }

    
  }

?>