<?php

include "connection.php";

$color = $_POST["c"];
// echo($category);

if(empty($color)){
    echo("Please enter a Color Name");
}else if(strlen($color) > 45){
    echo("Color name should be less than 45 characters");
}else{
    $rs = Database::search("SELECT * FROM `color` WHERE `color_name`='".$color."'");
    $num = $rs->num_rows;
    if($num == 0){
        Database::iud("INSERT INTO `color` (`color_name`) VALUES ('".$color."')");
        echo("success");
    }else{
        echo("Requested Color name already exists");
    }
}

?>