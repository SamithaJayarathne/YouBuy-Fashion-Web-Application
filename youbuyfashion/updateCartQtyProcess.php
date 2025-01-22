<?php

session_start();
include "connection.php";

$qty = $_POST["qty"];
$id = $_POST["id"];



$rs = Database::search("SELECT * FROM `cart` INNER JOIN `product` ON cart.product_id=product.id 
WHERE `cart_id`='".$id."'");
$num = $rs->num_rows;

$d = $rs->fetch_assoc();


if ($qty <= $d["qty"]) {
    Database::iud("UPDATE `cart` SET `qty`='".$qty."' WHERE `cart_id`= '".$id."'");
    echo("success");
}else{
    echo("Maximum Quantity Reached");
}


?>