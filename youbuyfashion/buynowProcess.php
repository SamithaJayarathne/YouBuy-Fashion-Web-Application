<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];


if (isset($_POST["payment"])) {

    $payment = json_decode($_POST["payment"], true);


    $date = new DateTime();
    $date->setTimezone(new DateTimeZone("Asia/Colombo"));
    $time = $date->format("Y-m-d H-i-s");

    Database::iud("INSERT INTO `order_history` (`order_id`,`order_date`,`amount`,`users_email`) VALUES
    ('" . $payment["order_id"] . "','" . $time . "','" . $payment["amount"] . "','" . $user["email"] . "') ");

    $orderHistoryId = Database::$connection->insert_id; // get latest Id from insert query execution

    Database::iud("INSERT INTO `order_item` (`oi_qty`,`order_history_oh_id`,`product_product_id`) VALUES
    ('" . $payment["qty"] . "','" . $orderHistoryId . "','" . $payment["id"] . "')");

    $rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $payment["id"] . "'");
    $d = $rs->fetch_assoc();

    $newQty = $d["qty"] - $payment["qty"];

    Database::iud("UPDATE `product` SET `qty`='" . $newQty . "' WHERE `id`='" . $payment["id"] . "'");

    $order = array();
    $order["resp"] = "success";
    $order["order_id"] = $orderHistoryId;

    echo json_encode($order);
}
