<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<?php
function displayProducts()
{
    //session_start();
    $conn = @mysqli_connect("localhost", "root", "", "project1") OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
    $query = " SELECT * from products where quantity>0 ";
    
   
    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
    

    $num_rows = mysqli_num_rows($result);
   
    if($num_rows>0)
    {   
        
        echo "
        <form method=\"post\" action=\"myFormProcessor.php\">
        <table border='1'>
        <tr>
        <th>Product Id</th>
        <th>Product Name</th>
        <th>Product Image</th>
        <th>Price</th>
        <th>Quantity Left</th>
        <th>Select checkbox for selecting this product</th>
        <th>Choose quantity for this product</th>
        </tr>";

        while($row = mysqli_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $row['productid'] . "</td>";
            echo "<td>" . $row['productname'] . "</td>";
            echo "<td>";
?>
            <img src="images/<?php echo $row['productname']?>.png" alt="Product Image" width="70" height="70">

<?php
          
          

            echo "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            // echo "<td><a href=\"addToCart.php?productid=".$row['productid']."\">Add To Cart</a></td>";
            // echo "<td><a href=\"addToCart.php?productid=".$row['productid']."\">Add To Cart</a></td>";
            
            echo "<td> <input type=\"checkbox\" name=\"mycheckbox[]\" value=\"". $row['productid']."\"> </td>";
            
        ?>

        <?php

        // echo "<td><input type=\"text\" value=\"test\"></td>";
        // $tempStr = "select" . $row['productid'];
        ?>

        <td>
        <select name="myselect[]">
    
        <?php
          for($x = 0; $x <= $row['quantity']; $x++ ) 
            {
        ?>
            
        <?php
                if($x==0)
                {
                    $DefaultSelect = "Choose Quantity";
                    echo "<option value=\"$DefaultSelect\">$DefaultSelect</option>";
                }
                else
                {
                    echo "<option value=\"$x\">$x</option>";
                }
               
        ?>
            

        <?php       
            }
        ?>

        </select>
        </td>
        </tr>

        
        

        <?php
            
        }

        echo "<tr>
                     <td>
                     <input type=\"submit\" name=\"submit\" value=\"Buy Selected Products\">
                     </td>
              </tr>";
        echo "</table>";
        echo "</form>";


        mysqli_close($conn);

        
  
    }
    else
    {
        echo "<br>"."Sorry, currently our store does not have anything left in the inventory"."<br>";
    }

}

function refreshProductsList(){
    //session_start();
    echo "inside refresh function";
    displayProducts();
}

function updateInventory(){
    $cart = $_SESSION['cart'];
    //echo $cart['emailid'];
    $emailid = $cart['emailid'];
    $total = $cart['total'];
    //echo "test:".$emailid;
    //print_r($cart);
    //Array ( [customername] => rohit [unitnumber] => 1 [street] => king street [city] => kitchener [province] => ontario [postalcode] => 12345 [emailid] => rohit@gmail.com [total] => 70 )
    
    $conn = @mysqli_connect("localhost", "root", "", "project1") OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
    $query = " SELECT customerid from customer where customeremailid='$emailid' ";
    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
   
    $num_rows = mysqli_num_rows($result);
    
    $customerid = -1;

    if($num_rows>0)
    {
        while($row = mysqli_fetch_array($result))
        {
        $customerid = $row[0];
        }
    }


    //echo "test:".$customerid; //1

    //mysqli_autocommit($conn, false);
    $flag = true;
    
    //insert into orders values(default,100,1);
    $sql1 = "INSERT INTO orders VALUES (default,'$total','$customerid')";
       if (mysqli_query($conn, $sql1)) {
            echo "Order created....";
        } else {
            $flag = false;
            echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
        }

    //select newly created orderid from orders table which links with orderdetails table as PrimaryKey-ForeignKey relationship 
    
    $query = " SELECT orderid from orders where customerid='$customerid' ";
    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
   
    $num_rows = mysqli_num_rows($result);
    
    $orderid = -1;

    if($num_rows>0)
    {
        while($row = mysqli_fetch_array($result))
        {
        $orderid = $row[0];
        }
    }

    //echo "test:".$orderid; 

    //insert into orderdetails values(default,100,1);
    //and update products table with value of quantity

    $productidArray = $_SESSION['productidArray'];
    $selectedSelectArray = $_SESSION['selectedSelectArray'];

    //print_r($productidArray);
    //print_r($selectedSelectArray);

    for($x=0; $x<sizeof($productidArray); $x++)
    {
        $sql1 = "INSERT INTO orderdetails VALUES ('$orderid','$productidArray[$x]')";
        if (mysqli_query($conn, $sql1)) {
            echo "orderdetails created....";
        } else {
            $flag = false;
            echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
        }


        $query = " SELECT quantity from products where productid='$productidArray[$x]' ";
        $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        $num_rows = mysqli_num_rows($result);
        
        $quantity = -1;

        if($num_rows>0)
        {
            while($row = mysqli_fetch_array($result))
            {
            $quantity = $row[0];
            }
        }

        $newQuantity = $quantity - $selectedSelectArray[$x];

        $sql2 = "UPDATE  products set quantity = '$newQuantity' where productid = '$productidArray[$x]' ";

        if (mysqli_query($conn, $sql2)) {
            echo "product quantity in inventory successfully updated....";
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
    }
    
    

    mysqli_close($conn);

    $updateStatus = true;
    return $updateStatus;
}

    

?>




<!-- MariaDB [project1]> desc orders;
+-------------+---------+------+-----+---------+----------------+
| Field       | Type    | Null | Key | Default | Extra          |
+-------------+---------+------+-----+---------+----------------+
| orderid     | int(11) | NO   | PRI | NULL    | auto_increment |
| order_total | int(11) | YES  |     | NULL    |                |
| customerid  | int(11) | YES  | MUL | NULL    |                |
+-------------+---------+------+-----+---------+----------------+
3 rows in set (0.006 sec)

MariaDB [project1]> desc order_details;
ERROR 1146 (42S02): Table 'project1.order_details' doesn't exist
MariaDB [project1]> desc orderdetails;
+-----------+---------+------+-----+---------+-------+
| Field     | Type    | Null | Key | Default | Extra |
+-----------+---------+------+-----+---------+-------+
| orderid   | int(11) | YES  | MUL | NULL    |       |
| productid | int(11) | YES  | MUL | NULL    |       |
+-----------+---------+------+-----+---------+-------+
2 rows in set (0.024 sec)

MariaDB [project1]> desc products;
+-------------+-------------+------+-----+---------+----------------+
| Field       | Type        | Null | Key | Default | Extra          |
+-------------+-------------+------+-----+---------+----------------+
| productid   | int(11)     | NO   | PRI | NULL    | auto_increment |
| productname | varchar(20) | YES  |     | NULL    |                |
| price       | int(11)     | YES  |     | NULL    |                |
| quantity    | int(11)     | YES  |     | NULL    |                |
+-------------+-------------+------+-----+---------+----------------+
4 rows in set (0.006 sec)

MariaDB [project1]> desc customers;
ERROR 1146 (42S02): Table 'project1.customers' doesn't exist
MariaDB [project1]> desc customer;
+-----------------+-------------+------+-----+---------+----------------+
| Field           | Type        | Null | Key | Default | Extra          |
+-----------------+-------------+------+-----+---------+----------------+
| customerid      | int(11)     | NO   | PRI | NULL    | auto_increment |
| customername    | varchar(20) | YES  |     | NULL    |                |
| customeremailid | varchar(20) | YES  | MUL | NULL    |                |
| addressid       | int(11)     | YES  | MUL | NULL    |                |
+-----------------+-------------+------+-----+---------+----------------+
4 rows in set (0.006 sec)

MariaDB [project1]> desc login;
+----------+-------------+------+-----+---------+-------+
| Field    | Type        | Null | Key | Default | Extra |
+----------+-------------+------+-----+---------+-------+
| loginid  | varchar(20) | NO   | PRI | NULL    |       |
| password | varchar(20) | YES  |     | NULL    |       |
+----------+-------------+------+-----+---------+-------+
2 rows in set (0.006 sec)

MariaDB [project1]>

 -->



       

              














