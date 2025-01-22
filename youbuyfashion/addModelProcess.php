<?php

include "connection.php";

$model = $_POST["m"];
$gender = $_POST["g"];

if(empty($model)){
    echo("Please enter a Model Name");
}else if(strlen($model) > 45){
    echo("Model name should be less than 45 characters");
}else if(empty($gender)){
    echo("Please select a Model gender");
}else{
    $rs = Database::search("SELECT * FROM `model` WHERE `model_name`='".$model."'");
    $num = $rs->num_rows;
    if($num == 0){
        Database::iud("INSERT INTO `model` (`model_name`,`model_gender_model_gender_id`) VALUES ('".$model."','".$gender."')");
        echo("success");
    }else{
        echo("Requested Model already exists");
    }
}

?>