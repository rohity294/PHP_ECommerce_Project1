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

<?php
// echo "registrastion processor";

$customerid = "";
$password = "";
$name =  "";
$unit_number =  "";
$street =  "";
$city =  "";
$province =  "";
$postalcode =  "";

$error_message = "";


if($_SERVER['REQUEST_METHOD']=="POST")
{
    $customerid = strip_tags($_POST['customerid']);
    $password = strip_tags($_POST['password']);
    $name = strip_tags($_POST['name']);
    $unit_number = strip_tags($_POST['unit_number']);
    $street = strip_tags($_POST['street']);
    $city = strip_tags($_POST['city']);
    $province = strip_tags($_POST['province']);   
    $postalcode = strip_tags($_POST['postalcode']);

    // $customerid,$password,$name,$unit_number,$street,$city,$province,$postalcode

    $error_message = "";

    $error_message = checkValidation($customerid,$password,$name,$unit_number,$street,$city,$province,$postalcode,$error_message);

    if($error_message!="")
    {
        include_once("register.php");
        echo $error_message;
        // echo "<br><br>";
        // echo "<a href=\"register.html\">Back to registration form</a>";

    }

    else
    {
    registerUser($customerid,$password,$name,$unit_number,$street,$city,$province,$postalcode,$error_message); 

    }
    

}





function checkValidation($customerid,$password,$name,$unit_number,$street,$city,$province,$postalcode,$error_message)
{
 
 if($customerid=="") 
 {
    $error_message = "EmailId field cannot be left empty";
 }

 if($password=="") 
 {
    $error_message = $error_message . "<br>" . "Password field cannot be left empty";
 }

 if($name=="") 
 {
    $error_message =  $error_message . "<br>" ."Name field cannot be left empty";
 }

 if($unit_number=="") 
 {
    $error_message =  $error_message . "<br>" ."Unit Number field cannot be left empty";
 }

 if($street=="") 
 {
    $error_message =  $error_message . "<br>" ."Street field cannot be left empty";
 }

 if($city=="") 
 {
    $error_message =  $error_message . "<br>" ."City field cannot be left empty";
 }

 if($province=="") 
 {
    $error_message =  $error_message . "<br>" ."Province field cannot be left empty";
 }

 if($postalcode=="") 
 {
    $error_message =  $error_message . "<br>" ."Postal Code field cannot be left empty";
 }
 
 return $error_message;

}


function registerUser($customerid,$password,$name,$unit_number,$street,$city,$province,$postalcode,$error_message)
   {
       echo "User is being registered....";

       include_once("mysqli_connect.php");
       mysqli_autocommit($conn, false);
       $flag = true;

       
       $addressid = 0;

       $loginid = $customerid;
       $sql1 = "INSERT INTO login VALUES ('$loginid','$password')";
       if (mysqli_query($conn, $sql1)) {
            echo "Login credentials successfully created....";
        } else {
            $flag = false;
            echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
        }

        $temp = "no";
        //INSERT INTO address VALUES (DEFAULT,'1','king','kitchener','ontario','n2c1k7','no');
        $sql2 = "INSERT INTO address VALUES (DEFAULT, '$unit_number','$street','$city','$province','$postalcode','$temp')";
        if (mysqli_query($conn, $sql2)) {
            echo "User address entered in database....";
        } else {
            $flag = false;
            echo "Error: " . $sql2 . "<br>" . mysqli_error($conn);
        }

        $sql3 = "SELECT addressid FROM address WHERE assigned = 'no'";
        
        $result = @mysqli_query($conn, $sql3) or die(mysqli_error($conn));

        while($row = mysqli_fetch_array($result)){
            $addressid = (int) $row["addressid"];
        }

        if($addressid==0)
        {
            $flag = false;
        }

        $sql4 = "INSERT INTO customer VALUES (default,'$name','$loginid','$addressid')";
        if (mysqli_query($conn, $sql4)) {
            echo "User profile fully created....";
        } else {
            $flag = false;
            echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
        }



        $sql5 = "UPDATE address set assigned = 'yes' where assigned = 'no'";
        if (mysqli_query($conn, $sql5)) {
        } else {
            $flag = false;
            echo "Error: " . $sql5 . "<br>" . mysqli_error($conn);
        }
        
        if($flag)
        {
            mysqli_commit($conn);
            echo "All data saved";
        }
        else
        {
            mysqli_rollback($conn);
            echo "Everything rolledback";
        }

        mysqli_close($conn);




   }

   
?>

<br><br>
<a href="index.php">Proceed to login<a>

</body>
</html>