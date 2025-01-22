<?php

require "connection.php";

if(isset($_GET["id"])){

    $pid = $_GET["id"];

    $rs = Database::search("SELECT * FROM `product` INNER JOIN `status` ON status.status_id=product.status_status_id WHERE `id`='".$pid."'");
    $num = $rs->num_rows;

    if($num == 1){

        $data = $rs->fetch_assoc();

        if($data["status_status_id"] == 1){
            Database::iud("UPDATE `product` SET `status_status_id`= '2' WHERE `id`='".$pid."'");
            echo ("blocked");
        }else if($data["status_status_id"] == 2){
            Database::iud("UPDATE `product` SET `status_status_id`= '1' WHERE `id`='".$pid."'");
            echo ("unblocked");
        }

    }else{
        echo ("Cannot find the Product. Please try again later.");
    }

}else{
    echo ("Something went wrong.");
}

?>