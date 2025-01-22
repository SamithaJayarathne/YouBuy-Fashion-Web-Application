<?php

include "connection.php";

$email = $_POST["e"];

if(empty($email)){
    echo("Please enter a email before change status");
}else{
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."'");
    $num = $rs->num_rows;
    if($num == 1){
        $data = $rs->fetch_assoc();
        if($data["status"] == 1){
            //deactive
            Database::iud("UPDATE `users` SET `status`='0' WHERE `email`='".$email."'");
            echo("Deactivated");
        }
        if($data["status"] == 0){
            //active
            Database::iud("UPDATE `users` SET `status`='1' WHERE `email`='".$email."'");
            echo("Activated");
        }
    }else{
        echo("No user for this Email");
    }
}

?>