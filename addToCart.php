<?php
//echo $_GET['productid'];

// session_start();

// if( !isset($_SESSION['productidArray']) )
// {
//     $productidArray = array();
//     $_SESSION['productidArray'] = $productidArray;
// }

// $productidArray = $_SESSION['productidArray'];
// array_push($productidArray, $_GET['productid']);
// $_SESSION['productidArray'] = $productidArray;

if(!isset($productidArray))
{
    $productidArray = array();
    echo "array initialized";
}

array_push($productidArray, $_GET['productid']);
print_r($productidArray);


// echo "<br>"."Item successfully added to cart, following is your cart status"."<br>";
// displayCart();
?>


<?php
function displayCart()
{
    $conn = @mysqli_connect("localhost", "root", "", "project1") OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

    $productidArray = $_SESSION['productidArray'];
    print_r($productidArray);
 
    foreach ($productidArray as $item) {
        $query = " SELECT * from products where productid = '$item' ";
        $result = @mysqli_query($conn, $query) or die(mysqli_error($conn));
    
        $num_rows = mysqli_num_rows($result);
    
        if($num_rows>0)
        { 
            $billing_total = 0;

            echo "<table border='1'>
            <tr>
            <th>Product Id</th>
            <th>Product Name</th>
            <th>Price</th>
            </tr>";

            while($row = mysqli_fetch_array($result))
            {
            echo "<tr>";
            echo "<td>" . $row['productid'] . "</td>";
            echo "<td>" . $row['productname'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
            }
            echo "</table>";

            mysqli_close($conn);
    
        }
    }

   
    


}
?>
