<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Invoice | YouBuy Fashion </title>

    <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
</head>
<?php
require "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"];
    $orderHistoryId = $_GET["orderId"];
?>


    <body>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb mt-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>

                <li class="breadcrumb-item active" aria-current="page">Invoice</li>


            </ol>

        </nav>
        <!-- /Breadcrumb -->

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="m-3 mt-5 border border-black p-3 rounded-5">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-end font-size-15"><img src="resources/youbuy3.png" class="img-fluid" style="width: 200px; height: 150px;" alt=""></h4>
                                <div class="mb-4">
                                    <h2 class="mb-1 text-muted fw-bolder">YouBuy Fashion.lk</h2>
                                </div>
                                <div class="text-muted">
                                    <p class="mb-1">No 23, Colombo Street, Kandy</p>
                                    <p class="mb-1"><i class="uil uil-envelope-alt me-1"></i>youbuy@gmail.com</p>
                                    <p><i class="uil uil-phone me-1"></i>+94 812 406 038</p>
                                </div>
                            </div>

                            <hr class="my-4">
                            <?php
                            $address_rs = Database::search("SELECT * FROM `users_has_address` WHERE `users_email`='" . $user["email"] . "'");
                            $address_data = $address_rs->fetch_assoc();
                            ?>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-muted">
                                        <h5 class="font-size-16 mb-3 fw-bold">Billed To:</h5>
                                        <h5 class="font-size-15 mb-2 fw-bold"><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?>,</h5>
                                        <p class="mb-1"><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?>,</p>
                                        <p class="mb-1"><?php echo $user["email"]; ?>,</p>
                                        <p><?php echo $_SESSION["u"]["mobile"]; ?></p>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-6">
                                    <div class="text-muted text-sm-end">

                                        <?php

                                        $invoice_rs = Database::search("SELECT * FROM `order_history` WHERE `oh_id`='" . $orderHistoryId . "'");
                                        $invoice_data = $invoice_rs->fetch_assoc();

                                        ?>

                                        <!-- <div>
                                            <h5 class="font-size-15 mb-1 fw-semibold">Invoice No:</h5>
                                            <p class="fw-bold text-danger"><?php echo $invoice_data["order_id"]; ?></p>
                                        </div> -->
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1 fw-semibold">Invoice Date:</h5>
                                            <p><?php echo $invoice_data["order_date"]; ?></p>
                                        </div>
                                        <div class="mt-4">
                                            <h5 class="font-size-15 mb-1 fw-semibold">Invoice No:</h5>
                                            <p class="fw-bold text-danger"><?php echo $invoice_data["order_id"]; ?></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->


                            <div class="py-2">
                                <u class="mb-3"><h5 class="fs-3 fw-bold">Order Summary</h5></u>

                                <div class="table-responsive table-hover">
                                    <table class="table align-middle table-nowrap table-centered mb-0 table-hover">

                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-end" style="width: 120px;">Total</th>
                                            </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            <?php
                                            $product_rs = Database::search("SELECT * FROM order_item 
                                        INNER JOIN product ON order_item.product_product_id=product.id
                                        INNER JOIN color ON color.color_id=product.color_color_id
                                         INNER JOIN category ON category.cat_id=product.category_cat_id
                                        INNER JOIN size ON size.size_id=product.size_size_id 
                                        WHERE order_item.order_history_oh_id = '" . $orderHistoryId . "'");
                                            $product_num = $product_rs->num_rows;

                                            for ($i = 0; $i < $product_num; $i++) {
                                                $product_data = $product_rs->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <th scope="row"><i class="bi bi-asterisk"></i></th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 mb-1"><?php echo $product_data["title"]; ?></h5>
                                                            <p class="text-muted mb-0"><?php echo $product_data["cat_name"]; ?>, <?php echo $product_data["color_name"]; ?></p>
                                                        </div>
                                                    </td>
                                                    <td>LKR <?php echo $product_data["price"]; ?> .00</td>
                                                    <td><?php echo $product_data["oi_qty"]; ?></td>
                                                    <td class="text-end">LKR <?php echo $product_data["price"] * $product_data["oi_qty"]; ?> .00</td>
                                                </tr>
                                            <?php

                                            }



                                            ?>


                                            <?php

                                            $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`='" . $address_data["city_city_id"] . "'");
                                            $city_data = $city_rs->fetch_assoc();

                                            $delivery = 0;
                                            if ($city_data["district_district_id"] == 7) {
                                                $delivery = $product_data["delivery_fee_kandy"];
                                            } else {
                                                $delivery = $product_data["delivery_fee_other"];
                                            }

                                            // $t = $invoice_data["total"];
                                            // $g = $t - $delivery;

                                            ?>

                                            <tr>
                                                <th scope="row" colspan="4" class="text-end">Sub Total</th>
                                                <td class="text-end">LKR <?php echo $invoice_data["amount"] - 500 ?> .00</td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">
                                                    Delivery fee :</th>
                                                <td class="border-0 text-end">LKR 500 .00</td>
                                            </tr>

                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0 fw-semibold">LKR <?php echo $invoice_data["amount"] ?> .00</h4>
                                                </td>
                                            </tr>
                                            <!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->

                            </div>

                        </div>
                    </div>
                </div>
                <div class="note">
                    <div class="float-start">
                        <h5><strong>Note:</strong>This is computer generated receipt and does not require physical signature</h5>
                    </div>
                </div>
                <div class="d-print-none p-5">
                    <div class="float-end">
                        <a href="javascript:window.print()" class="btn btn-success me-1"><i class="fa fa-print"></i></a>
                        <a href="#" class="btn btn-primary w-md">Send</a>
                    </div>
                </div><!-- end col -->
            </div>
        </div>

    <?php
}
    ?>


    <?php


    ?>



    </body>

</html>