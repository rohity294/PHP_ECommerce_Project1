<?php

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    foreach($_POST['mycheckbox'] as $item){
        echo $item;//c1
        $temp = substr($item, -1);//1
        echo $_POST[$temp];
    }



    // echo $_POST['1'];
    // echo $_POST['2'];

    
}    

?>

