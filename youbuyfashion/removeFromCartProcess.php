<?php

require "connection.php";

if(isset($_GET["id"])){

    $cart_id = $_GET["id"];

    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `cart_id`='".$cart_id."'");

    if($cart_rs->num_rows != 0){

        Database::iud("DELETE FROM `cart` WHERE `cart_id`='".$cart_id."'");
        echo ("Deleted");

    }else{
        echo ("Something went wrong");
    }

}

?>