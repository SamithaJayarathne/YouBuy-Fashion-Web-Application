<?php

include "connection.php";

$size = $_POST["s"];
// echo($category);

if(empty($size)){
    echo("Please enter a Size Name");
}else if(strlen($size) > 45){
    echo("Size name should be less than 45 characters");
}else{
    $rs = Database::search("SELECT * FROM `size` WHERE `size_name`='".$size."'");
    $num = $rs->num_rows;
    if($num == 0){
        Database::iud("INSERT INTO `size` (`size_name`) VALUES ('".$size."')");
        echo("success");
    }else{
        echo("Requested Size name already exists");
    }
}

?>