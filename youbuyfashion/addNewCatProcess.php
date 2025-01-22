<?php

include "connection.php";

$category = $_POST["c"];
// echo($category);

if(empty($category)){
    echo("Please enter a Category Name");
}else if(strlen($category) > 45){
    echo("Category name should be less than 45 characters");
}else{
    $rs = Database::search("SELECT * FROM `category` WHERE `cat_name`='".$category."'");
    $num = $rs->num_rows;
    if($num == 0){
        Database::iud("INSERT INTO `category` (`cat_name`) VALUES ('".$category."')");
        echo("success");
    }else{
        echo("Requested category name already exists");
    }
}

?>