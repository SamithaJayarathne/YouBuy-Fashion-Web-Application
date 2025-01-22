<?php

include "connection.php";

$brand = $_POST["b"];
// echo($category);

if(empty($brand)){
    echo("Please enter a Brand Name");
}else if(strlen($brand) > 45){
    echo("Brand name should be less than 45 characters");
}else{
    $rs = Database::search("SELECT * FROM `brand` WHERE `brand_name`='".$brand."'");
    $num = $rs->num_rows;
    if($num == 0){
        Database::iud("INSERT INTO `brand` (`brand_name`) VALUES ('".$brand."')");
        echo("success");
    }else{
        echo("Requested Brand name already exists");
    }
}

?>