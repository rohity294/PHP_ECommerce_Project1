<?php
    session_start();
    $cart = $_SESSION['cart'];
?>    
   
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<body style="background-image: url('images/MainBackground.jpg');">

<br><br><br><br><br>
Redirecting to payment gateway<br>
<progress max="100" value="100"></progress>

<h1>Payment successfully received!</h1> 

<?php
   include('dbOperations.php');
   if(updateInventory())
   {
       echo "<p>Thanks for shopping with Nerd Stationery</p>";
       echo "<p>A email containing order details and payment receipt has been emailed to you at your email address: ";
       echo $cart['emailid'];
       echo "<br><br><a href=\"shop.php\">Continue Shopping</a>";
   }
?>

</body>
</html>