<?php

include "connection.php";
session_start();
$user = $_SESSION["u"];

$stockList = array();
$qtyList = array();

if (isset($_POST["cart"]) && $_POST["cart"] == "true") {
    // echo("From Cart");
    $rs = Database::search("SELECT * FROM cart WHERE `users_email`='" . $user["email"] . "'");
    $num = $rs->num_rows;
    // echo($num);

    for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();

        $stockList[] = $d["product_id"];
        $qtyList[] = $d["qty"];
        
    }
} else {
    // From Buy Now
    // echo("from buy");
    $stockList[] = $_POST["productId"];
    $qtyList[] = $_POST["qty"];

    
}

$merchantId = "1223969";
$merchantSecret = "MzA1ODM5MzkxODEwMjI2NDA4NzQxNDMyMzA3MTA1MjcwODc0Njk1Mw==";
$items = "";
$netTotal = 0;
$currency = "LKR";
$orderId = uniqid();

// Load Products to the array
for ($i = 0; $i < sizeof($stockList); $i++) {
    $rs2 = Database::search("SELECT * FROM product WHERE `id`='" . $stockList[$i] . "'");
    $num2 = $rs2->num_rows;
    // echo($num2);
    $d2 = $rs2->fetch_assoc();

    $stockQty = $d2["qty"]; // Checking available quantity from stock
    if ($stockQty >= $qtyList[$i]) {
        // Success

        $items .= $d2["title"]; // Concat & Assign

        if ($i != sizeof($stockList) - 1) {  // adding ", " (watch, tshirt, cap)
            $items .= ", ";
        }

        $netTotal += (intval($d2["price"]) * intval($qtyList[$i])); // Plus & Assign
    } else {
        // Failed
        echo ("Product has no available stock");
    }
}
// Shipping fee
$netTotal += 500;

$address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `users` ON users.email=users_has_address.users_email
WHERE `users_email`='".$user["email"]."'");
$address_num = $address_rs->num_rows;
$address_data = $address_rs->fetch_assoc();

$hash = strtoupper(
    md5(
        $merchantId . 
        $orderId . 
        number_format($netTotal, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchantSecret)) 
    ) 
);

$payment = array();

$payment["sandbox"] = true;
$payment["merchant_id"] = $merchantId;
$payment["first_name"] = $user["fname"];
$payment["last_name"] = $user["lname"];
$payment["email"] = $user["email"];
$payment["phone"] = $user["mobile"];
$payment["address"] = $address_data["postal_code"] . "," . $address_data["line1"];
$payment["city"] = $address_data["line2"];
$payment["country"] = "Sri Lanka";
$payment["order_id"] = $orderId;
$payment["items"] = $items;
$payment["currency"] = $currency;
$payment["amount"] = number_format($netTotal, 2, '.', '');
$payment["hash"] = $hash;
$payment["return_url"] = "";
$payment["cancel_url"] = "";
$payment["notify_url"] = "";

echo json_encode($payment);

















