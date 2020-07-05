<?php
    session_start();
    //print_r($_SESSION);
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
  <li><a href="UserProfile.php?<?php echo $emailid?>">Home</a></li> 
  <!-- <li><a href="about.html">AboutUs</a></li> -->
  <li><a href="shop.php">Shop</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

<div class="content">

        <?php
       
        // echo "hello";

        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            echo "<h2>Hello,&nbsp;";
            echo $emailid;
            echo "</h2><br><br>";
            echo "<br>"."Your current cart status is as follows:"."<br><br>";

            $productidArray = array();
            foreach($_POST['mycheckbox'] as $item){
                //echo $item;
                array_push($productidArray, $item);
            }


            // $indicesArray = array();
            // for($x=0; $x<count($productidArray); $x++)
            // {
            //     array_push($indicesArray, $x);
            // }
            
            $wholeSelectArray = array();
            foreach($_POST['myselect'] as $item){
                //echo $item;
                array_push($wholeSelectArray, $item);
            }

            
            $selectedSelectArray = array();
            for($x=0; $x<count($wholeSelectArray); $x++)
            {
                if($wholeSelectArray[$x] != 'Choose Quantity')
                {
                    array_push($selectedSelectArray, $wholeSelectArray[$x]);
                }
               
            }

        
            // echo "<br>productidArray<br>";
            // foreach($productidArray as $item)
            // {
            //     echo $item. "<br>";
            // }

            // echo "<br>wholeSelectArray<br>";
            // foreach($wholeSelectArray as $item)
            // {
            //     echo $item. "<br>";
            // }

            // echo "<br>selectedSelectArray<br>";
            // foreach($selectedSelectArray as $item)
            // {
            //     echo $item. "<br>";
            // }

            // echo "<br>IndicesArray<br>";
            // foreach($indicesArray as $item)
            // {
            //     echo $item. "<br>";
            // }

    

           

            // $selected_val = $_POST['select1'];  
            // echo "You have selected :" .$selected_val;  
            
            $_SESSION['productidArray'] = $productidArray;
            $_SESSION['selectedSelectArray'] = $selectedSelectArray;
            showCart($productidArray, $selectedSelectArray);
        
        }    

        

        ?>

        <?php
                    function showCart($productidArray, $selectedSelectArray)
                {
                        $conn = @mysqli_connect("localhost", "root", "", "project1") OR die('Could not connect to MySQL: ' . mysqli_connect_error() );
                        //select * from products where productid = 1 or productid =2
                        $query = " SELECT * from products where productid = ";
        ?>

        <?php 
                
                    $mystr="";
                    
                    for($x=0; $x<sizeof($productidArray); $x++)
                    {
                        if($x==0)
                        {
                            $mystr = $mystr . $productidArray[$x];
                        }
                        else
                        {
                            $mystr = $mystr . " OR productid = " . $productidArray[$x];
                        }
        
                    }

                    $query = $query . $mystr;
                    //echo $query; 

                    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
                
                    // echo "ProductId"."\t"."ProductName"."\t"."Price". "<br>";
                    // while($row = mysqli_fetch_array($result))
                    // {
                    //         echo $row["productid"]."&nbsp;&nbsp;&nbsp;&nbsp;".$row["productname"]."&nbsp;&nbsp;&nbsp;&nbsp;".$row["price"]. "<br>";
                    // }
                 
                    ?>

                    

                    <?php
                         $num_rows = mysqli_num_rows($result);
                        

                         if($num_rows>0)
                        {
                            echo"<table border=1>
                            <tr>
                            <th>Product Id</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Quantity Ordered</th>
                            </tr>";
       
                            $x = 0;
                            $total = 0;
                            
                            while($row = mysqli_fetch_array($result))
                            {
                            echo "<tr>";
                            echo "<td>" . $row['productid'] . "</td>";
                            echo "<td>" . $row['productname'] . "</td>";
                            echo "<td>" . $row['price'] . "</td>";
                            echo "<td>" . $selectedSelectArray[$x] . "</td>";
                            $total = $total + ($row['price'] * $selectedSelectArray[$x]);
                            $x = $x + 1;
                            echo "</tr>";
                            }

                            echo "</table>";

                            echo "<br>"."Your order total is:".$total."<br>";

                            $_SESSION['total'] = $total;

                        }

                         else
                         {
                             echo "<br>"."Your cart is empty"."<br>";
                         }

                        //  $_SESSION['productidArray'] = -1;
                        //  $_SESSION['selectedSelectArray'] = -1;
                         
                    ?>
                    
                     

                    <?php
            
                }

                    ?>

                    
                    </table>

                    
</div>

<br><br>

<?php
    include_once("mysqli_connect.php");
    
    $query = "select * from customer where customeremailid = '$emailid'";

    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
   
    $num_rows = mysqli_num_rows($result);

    $customerid = "";
    $customername = "";
    $addressid = "";


    if($num_rows>0)
    {

        while($row = mysqli_fetch_array($result))
        {
            $customerid = $row['customerid'];
            $customername = $row['customername'];
            $addressid = $row['addressid'];

        }

    }

    $query = "select * from address where addressid= '$addressid'";

    $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
   
    $num_rows = mysqli_num_rows($result);

    $unitnumber = "";
    $street = "";
    $city = "";
    $province = "";
    $postalcode = "";
    $assigned = "";

    if($num_rows>0)
    {

        while($row = mysqli_fetch_array($result))
        {
            $addressid = $row['addressid'];
            $unitnumber = $row['unitnumber'];
            $street = $row['street'];
            $city = $row['city'];
            $province = $row['province'];
            $postalcode = $row['postalcode'];
            $assigned = $row['assigned'];
            
        }

    }
   
    $cart = array(
            //'customerid' => $customerid,
            'customername' => $customername,
            //'addressid' => $addressid,
            'unitnumber' => $unitnumber,
            'street' => $street,
            'city' => $city,
            'province' => $province,
            'postalcode' => $postalcode,
            //'assigned' => $assigned,
            'emailid' => $emailid,
            'total' => $_SESSION['total']
    );

   $_SESSION['cart'] = $cart;
   


?>
  
<form method="post" action="checkout.php">
    <br><input type="submit" name="checkout" value="checkout">
</form>

</body>
</html>