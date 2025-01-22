<?php

require "connection.php";

if(isset($_GET["id"])){

    $history_id = $_GET["id"];

    $history_rs = Database::search("SELECT * FROM `invoice` WHERE `id`='".$history_id."'");

    if($history_rs->num_rows != 0){

        Database::iud("DELETE FROM `invoice` WHERE `id`='".$history_id."'");
        echo ("Deleted");

    }else{
        echo ("Something went wrong");
    }

}

?>