<?php

session_start();
require "connection.php";

$email = $_SESSION["a"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$pname = $_POST["p"];
$size = $_POST["s"];
$clr = $_POST["col"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwk = $_POST["dwk"];
$dok = $_POST["dok"];
$desc = $_POST["desc"];
$img_file = 0;

if (empty($pname)) {
    echo ("Please enter a product name");
} else if (strlen($pname) > 100) {
    echo ("Product name should be less than 100 characters");
} else if (empty($category)) {
    echo ("Please select a category");
} else if (empty($brand)) {
    echo ("Please select a brand");
} else if (empty($clr)) {
    echo ("Please select a color");
} else if (empty($qty)) {
    echo ("Please select a quantity");
} else if (empty($cost)) {
    echo ("Please select a unit price");
} else if (empty($dwk)) {
    echo ("Please enter delivery cost(Kandy)");
} else if (empty($dok)) {
    echo ("Please enter delivery cost(Out of Kandy)");
} else if (empty($desc)) {
    echo ("Please enter a description");
} else {
    if (isset($_FILES["img"])) {
        $img_file = $_FILES["img"];

        $rs = Database::search("SELECT * FROM `product` WHERE `title`='" . $pname . "' AND `price`='" . $cost . "' 
        AND `color_color_id`='" . $clr . "' AND `size_size_id`='" . $size . "'");
        $num = $rs->num_rows;
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        if ($num == 1) {
            //update only qty,date,delivery fee, description
            $data = $rs->fetch_assoc();
            $new_qty = $qty + $data["qty"];
            Database::iud("UPDATE `product` SET `qty`='" . $new_qty . "', `description`='" . $desc . "', `datetime_added`='" . $date . "', `delivery_fee_kandy`='" . $dwk . "'
            , `delivery_fee_other`='" . $dok . "', `users_email`='" . $email . "'");
            echo ("Product's Stock updated successfully");
        } else {
            //insert product
            Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_kandy`,
            `delivery_fee_other`,`category_cat_id`,`status_status_id`,`brand_has_model_id`,`users_email`,`color_color_id`,`size_size_id`)
            VALUES ('" . $cost . "','" . $qty . "','" . $desc . "','" . $pname . "','" . $date . "','" . $dwk . "','" . $dok . "','" . $category . "','1','9','" . $email . "','" . $clr . "','" . $size . "') ");

            $file_name = "resources\product_images" . uniqid() .".png";
            move_uploaded_file($img_file["tmp_name"], $file_name);

            $product_id = Database::$connection->insert_id;

            Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) 
                VALUES ('" . $file_name . "','" . $product_id . "')");

            echo ("Product registered successfully");
        }
    } else {
        echo ("Please select a product image");
    }
}
