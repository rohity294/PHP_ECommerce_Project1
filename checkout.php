<body style="background-image: url('images/MainBackground.jpg');">

<?php
    session_start();
    $emailid = $_SESSION['emailid'];
    $cart = $_SESSION['cart'];
    //print_r($cart);

    //echo sizeof($cart);
    
    echo "<br><br><br><br><br>";
    echo "<h2>Hello,&nbsp;";
    echo $emailid;
    echo "</h2><br><br>";
    echo "<h1>Order Information</h1>";
    echo "<table border=\"1\">";
    echo "<th>Customer Name</th><th>Unit Number</th><th>Street</th><th>City</th><th>Province</th><th>Postal Code</th><th>Email id</th><th>Order Total</th>";
    
    echo "<tr>";
    foreach($cart as $item)
    {
        echo "<td>" . $item . "</td>"; 
    }
    echo "</tr>";

    echo "</table>";
    
?>

<br>
<form method="post" action="payment.php">
    <input type="submit" name="submit" value="Make Payment"></input>
</form>

</body>