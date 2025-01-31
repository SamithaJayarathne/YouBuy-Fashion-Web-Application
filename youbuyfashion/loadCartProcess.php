<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"]["email"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;

?>

<?php include "header.php" ?>

<?php

$cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
$cart_num = $cart_rs->num_rows;

if ($cart_num == 0) {
?>

    <!-- empty_view -->
    <section class="h-100 h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Shopping Cart&nbsp;&nbsp; <i class="bi bi-emoji-frown"></i></h1>
                                            <h6 class="mb-0 text-muted"><?php echo $cart_num; ?> items</h6>
                                        </div>
                                        <hr class="my-4">

                                        <!--items-->

                                        <span class="fs-4">"Your cart is feeling a little empty right now. Why not explore our amazing selection of products and add some items to your cart? Happy shopping!"</span>

                                        <!--items-->

                                        <hr class="my-4">

                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="home.php" class="text-decoration-none text-dark fs-4"><i class="fas fa-long-arrow-alt-left me-2"></i>⇐ Back to shop</a></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-grey" style="background-image: linear-gradient(135deg, #d7d2cc 10%, #304352 100%);">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1 text-center">Summary</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">items <?php echo $cart_num; ?> </h5>
                                            <h5>LKR <?php echo $total; ?> .00</h5>
                                        </div>
                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">shipping </h5>
                                            <h5>LKR <?php echo $shipping; ?> .00</h5>
                                        </div>







                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total price</h5>
                                            <h5>LKR <?php echo $total + $shipping; ?> .00</h5>
                                        </div>

                                        <button type="button" class=" col-12 btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Checkout (<?php echo $cart_num; ?>)</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>
</div>

<!-- empty_view -->

<?php
} else {
?>
<section class="h-100 h-custom" style="background-image: linear-gradient(135deg, #f5f7fa 10%, #c3cfe2 100%);">
<div class="container py-5 h-100">
<div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0 ">
                <div class="row g-0">
                    <div class="col-lg-8">
                        <div class="p-5">
                            <div class="d-flex justify-content-between align-items-center mb-5">
                                <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                <h6 class="mb-0 text-danger fw-bolder fs-4"><?php echo $cart_num; ?> items</h6>
                            </div>
                            <hr class="my-4">
                            <?php

                            for ($x = 0; $x < $cart_num; $x++) {

                                $cart_data = $cart_rs->fetch_assoc();

                                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                        `id`='" . $cart_data["product_id"] . "'");
                                $product_data = $product_rs->fetch_assoc();



                                $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                $address_rs = Database::search("SELECT district.district_id AS `did` FROM 
                                        `users_has_address` INNER JOIN `city` ON
                                        users_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                                        city.district_district_id=district.district_id WHERE `users_email`='" . $user . "'");
                                $address_data = $address_rs->fetch_assoc();

                                $ship = 0;

                                if ($address_data["did"] == 7) {
                                    $ship = $product_data["delivery_fee_kandy"];
                                    $shipping = $shipping + $product_data["delivery_fee_kandy"];
                                } else {
                                    $ship = $product_data["delivery_fee_other"];
                                    $shipping = $shipping + $product_data["delivery_fee_other"];
                                }

                                $seller_rs = Database::search("SELECT * FROM `users` WHERE 
                                        `email`='" . $product_data["users_email"] . "'");
                                $seller_data = $seller_rs->fetch_assoc();
                                $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                        `product_id`='" . $cart_data["product_id"] . "'");
                                $img_data = $img_rs->fetch_assoc();

                                $size_rs = Database::search("SELECT * FROM `size` INNER JOIN `product` ON 
                                        product.size_size_id=size.size_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                $size_data = $size_rs->fetch_assoc();

                                $color_rs = Database::search("SELECT * FROM `color` INNER JOIN `product` ON 
                                        product.color_color_id=color.color_id WHERE `id`='" . $cart_data["product_id"] . "'");
                                $color_data = $color_rs->fetch_assoc();

                                $productPrice = $product_data["price"] * $cart_data["qty"];

                            ?>
                                <!--items-->

                                <div class="card mb-3 animate__animated animate__zoomIn" style="max-width: 750px;">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>"><img src="<?php echo $img_data["img_path"] ?>" class="img-fluid rounded-start" alt="..."></a>

                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="row">
                                                    <h5 class="col-7 card-title fw-bolder text-grey mt-2"><?php echo $product_data["title"]; ?></h5>
                                                    <span class="col-5 card-text text-danger text-lg-end">LKR <span class="fs-3 fw-bold"><?php echo $productPrice; ?></span> .00</span>
                                                </div>

                                                <span>Color: <?php echo $color_data["color_name"]; ?> </span> | <span>Size: <?php echo $size_data["size_name"]; ?></span><br class="mb-2">

                                                <div class="d-flex align-items-center gap-2">
                                                    <button class="btn btn-light btn-sm" onclick="decrementQty('<?php echo $cart_data["cart_id"] ?>');">-</button>
                                                    <input type="number" class="form-control form-control-sm text-center" style="max-width: 100px;" value="<?php echo $cart_data["qty"] ?>" disabled id="qty<?php echo $cart_data["cart_id"] ?>">
                                                    <button class="btn btn-light btn-sm" onclick="incrementQty('<?php echo $cart_data["cart_id"] ?>');">+</button>

                                                </div>
                                                <span>Delivery Fee: LKR <?php echo $shipping; ?> .00</span><br class="mb-3">

                                                <div class="row">

                                                    <button class="offset-6 col-2 btn btn-white" onclick="removeFromCart(<?php echo $cart_data['cart_id']; ?>)"><i class="bi bi-trash3 text-success"></i></button>

                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div><br>

                                <!--items-->
                            <?php
                            }

                            ?>



                            <hr class="my-4">

                            <div class="pt-5">
                                <h6 class="mb-0"><a href="home.php" class="text-decoration-none text-dark fs-4"><i class="fas fa-long-arrow-alt-left me-2"></i>⇐ Back to shop</a></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 bg-grey" style="background-image: linear-gradient(135deg, #d7d2cc 10%, #304352 100%);">
                        <div class="p-5">
                            <h3 class="fw-bold mb-5 mt-2 pt-1 text-center">Summary</h3>
                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-uppercase">items <?php echo $cart_num; ?> </h5>
                                <h5>LKR <?php echo $total; ?> .00</h5>
                            </div>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="text-uppercase">shipping </h5>
                                <h5>LKR <?php echo $shipping; ?> .00</h5>
                            </div>







                            <hr class="my-4">

                            <div class="d-flex justify-content-between mb-5">
                                <h5 class="text-uppercase">Total price</h5>
                                <h5>LKR <?php echo $total + $shipping; ?> .00</h5>
                            </div>

                            <!-- <a type="button" class=" col-12 btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark" href="">Checkout (<?php echo $cart_num; ?>)</a> -->
                            <button class="col-12 btn btn-dark btn-block btn-lg" onclick="checkout();">CHECKOUT(<?php echo $cart_num; ?>)</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
<?php
}

?>
<?php
} else {
    include "header.php"
?>
    <div class="row container-fluid mt-5">
        <div class="col-12">
            <h2 class="text-center fw-bolder">We're Sorry, You have to Sign In before access the Cart</h2>


        </div>
        <div class="col-4 offset-lg-5 mt-5">
            <a href="index.php"><button class="btn btn-dark col-4">Sign In</button></a>
        </div>
    </div>
<?php
}

?>