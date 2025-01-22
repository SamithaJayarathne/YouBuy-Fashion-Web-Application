<?php
session_start();
include "connection.php";

$email = $_POST["e"];
$password = $_POST["p"];

if(empty($email)) { 
    echo("Please enter your email");
}else if(empty($password)) {
    echo("Please enter your password");
}else {
    $rs = Database::search("SELECT * FROM `users` WHERE `email`='".$email."' AND `password`='".$password."'");
    $num = $rs->num_rows;
   
    if($num == 1) {
        $d = $rs->fetch_assoc();
        if($d["usertype_id"] == 2){
            echo ("success");

            $_SESSION["a"] = $d;
        }else{
            echo("You are not a valid Admin");
        }

    }else{
        echo("Invalid Email or Password");
    }
}
?>