<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];

    if(isset($_SESSION["u"])){
        $user = $_SESSION["u"]["email"];
    }

    

    $product_rs = Database::search(" SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_kandy,product.delivery_fee_other,
    product.category_cat_id,product.brand_has_model_id,product.color_color_id,product.status_status_id,
    product.size_size_id,product.users_email,model.model_name AS mname,
    brand.brand_name AS bname, color.color_name AS cname, size.size_name AS sname FROM `product` INNER JOIN `brand_has_model` ON 
    brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON 
    brand.brand_id=brand_has_model.brand_brand_id INNER JOIN `model` ON 
    model.model_id=brand_has_model.model_model_id INNER JOIN `color` ON
    color.color_id=product.color_color_id INNER JOIN `size` ON
    size.size_id=product.size_size_id
    WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="style.css">
            <link rel="stylesheet" href="bootstrap.css">

            <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
            <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
            <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">

            <title><?php echo $product_data["title"]; ?> | YouBuy Fashion</title>
        </head>

        <body>
            <?php include "header.php"; ?>
            <!-- Product section-->
            <section class="">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="main-breadcrumb mt-3">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="home.php">Home</a></li>

                        <li class="breadcrumb-item active" aria-current="page"><?php echo $product_data["title"]; ?></li>
                    </ol>
                </nav>
                <!-- /Breadcrumb -->

                <div class="container-fluid">
                    <div class="row">


                        <div class="col-12 mt-0 bg-white singleProduct">
                            <div class="row">
                                <div class="col-12" style="padding: 10px;">
                                    <div class="row">

                                        <div class="col-12 col-lg-2 order-2 order-lg-1">
                                            <ul>
                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                                                $img_num = $img_rs->num_rows;
                                                $img_list = array();

                                                if ($img_num != 0) {
                                                    for ($x = 0; $x < $img_num; $x++) {
                                                        $img_data = $img_rs->fetch_assoc();
                                                        $img_list[$x] = $img_data["img_path"];
                                                ?>
                                                        <li class="d-flex flex-column justify-content-center align-items-center mb-1">
                                                            <img src="<?php echo $img_list[$x]; ?>" id="product_img<?php echo $x; ?>" onclick="changeMainImg(<?php echo $x; ?>);" class="img-thumbnail mt-1 mb-1" />
                                                        </li>
                                                    <?php

                                                    }
                                                } else {
                                                    ?>
                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                        <img src="resourses/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                    </li>
                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                        <img src="resourses/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                    </li>
                                                    <li class="d-flex flex-column justify-content-center align-items-center 
                                border border-1 border-secondary mb-1">
                                                        <img src="resourses/empty.svg" class="img-thumbnail mt-1 mb-1" />
                                                    </li>
                                                <?php
                                                }

                                                ?>

                                            </ul>
                                        </div>

                                        <div class="col-lg-4 order-2 order-lg-1 d-none d-lg-block">
                                            <div class="row">
                                                <div class="col-12 align-items-center  
                                border-secondary">
                                                    <div class="mainImg" id="mainImg">
                                                        <img src="<?php echo $img_data["img_path"]; ?>" class="img-thumbnail mt-1 mb-1" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-lg-6 order-3">
                                            <div class="row">
                                                <div class="col-12">



                                                    <div class="row">
                                                        <h1 class="display-5 fw-bolder" style="font-family: Georgia, 'Times New Roman', Times, serif;"><?php echo $product_data["title"]; ?></h1>
                                                    </div>


                                                    <?php

                                                    $price = $product_data["price"];
                                                    $add = ($price / 100) * 15;
                                                    $new_price = $price + $add;
                                                    $diff = $new_price - $price;
                                                    $percent = ($diff / $price) * 100;

                                                    ?>

                                                    <div class="fs-5 mb-3">
                                                        <span>LKR <strong class="fs-3"><?php echo $price; ?></strong> .00</span> |
                                                        <span class="text-decoration-line-through">LKR <strong class="fs-3"><?php echo $new_price; ?></strong> .00</span> |
                                                        <span class=" fw-bold text-black-50">
                                                            Save LKR <strong class="fs-3"><?php echo $diff; ?></strong> .00
                                                            (<?php echo $percent; ?>%)
                                                        </span><br>
                                                        <span class="mt-3">
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>
                                                            <i class="bi bi-star-fill text-warning fs-5"></i>

                                                            &nbsp;&nbsp;&nbsp;

                                                            <label class="fs-5 text-dark fw-bold">4.5 Stars | 48 Reviews and Ratings</label>
                                                    </div>
                                                    <p class="lead"><?php echo $product_data["description"]; ?></p>

                                                    <div class="row fs-5 text-black-50">
                                                        <span>Warrenty: 6 Months</span><br>
                                                        <span>In Stock: <?php echo $product_data["qty"]; ?> items</span>
                                                        <?php
                                                        $user_rs = Database::search("SELECT * FROM `users` WHERE 
                                                        `email`='" . $product_data["users_email"] . "'");
                                                        $user_data = $user_rs->fetch_assoc();
                                                        ?>

                                                        <span>Sold: 219 items</span>



                                                    </div>
                                                    <div class="row mt-3">
                                                        <h3 class="col-12">Seller's Information</h3>
                                                        <div class="col-12 col-lg-6">
                                                            <span>Name: <?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></span>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <span>Email: <?php echo $user_data["email"]; ?></span>
                                                        </div>
                                                        <div class="col-12 col-lg-6">
                                                            <span>Mobile: <?php echo $user_data["mobile"]; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-3">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <div class="col-12 my-2">
                                                                    <div class="row g-2">

                                                                        <div class="border border-1 border-secondary rounded overflow-hidden 
                                                        float-left mt-1 position-relative product-qty">
                                                                            <div class="col-12">
                                                                                <span>Quantity : </span>
                                                                                <input type="text" class="border-0 fs-5 fw-bold text-start" style="outline: none;" pattern="[1-9]" value="1" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />

                                                                                <div class="position-absolute qty-buttons">
                                                                                    <div class="justify-content-center d-flex flex-column align-items-center 
                                                                 qty-inc">
                                                                                        <i class="bi bi-caret-up-fill text-primary fs-5" onclick='qty_inc(<?php echo $product_data["qty"]; ?>);'></i>
                                                                                    </div>
                                                                                    <div class="justify-content-center d-flex flex-column align-items-center 
                                                                 qty-dec">
                                                                                        <i class="bi bi-caret-down-fill text-primary fs-5" onclick='qty_dec();'></i>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <br class="mt-5"><br class="mt-2">

                                                                            <div class="row mt-5">
                                                                                <div class="col-12 col-lg-6">
                                                                                    <button class="btn btn-dark" style="width: 300px;" type="submit" id="payhere-payment" onclick="buyNow(<?php echo $pid; ?>);">BUY IT NOW</button>
                                                                                </div>
                                                                                <div class="col-12 col-lg-6">
                                                                                    <button class="btn text-white" style="width: 300px;   background-color: #4F7942;" onclick="addToCart(<?php echo $product_data['id']; ?>);">ADD TO CART</button>
                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 offset-lg-1 col-lg-8">
                                            <h3 class="fw-bold" style="font-family: Georgia, 'Times New Roman', Times, serif;">Product details of <?php echo $product_data["title"];  ?>.</h3>

                                            <ul class="circle-list col-12 fs-4">
                                                <li><i class=" circle-icon"></i>Product Name: <?php echo $product_data["title"];  ?></li>
                                                <li><i class=" circle-icon"></i>Brand: <?php echo $product_data["bname"];  ?></li>
                                                <li><i class=" circle-icon"></i>Model: <?php echo $product_data["mname"];  ?></li>
                                                <li><i class="circle-icon"></i>Color: <?php echo $product_data["cname"];  ?></li>
                                                <li><i class="circle-icon"></i>Size: <?php echo $product_data["sname"];  ?></li>
                                            </ul>


                                        </div>
                                        <div class="col-12 offset-lg-1 col-lg-8 mt-3" id="allFeedback">
                                            <h3 class="fw-bold" style="font-family: Georgia, 'Times New Roman', Times, serif;">Reviews and Ratings</h3>
                                            <div class="col-12 col-lg-6">
                                                <div class="row  me-0">

                                                    <?php

                                                    $feedback_rs = Database::search("SELECT * FROM `feedback` WHERE `product_id`='" . $pid . "'");
                                                    $feedback_num = $feedback_rs->num_rows;

                                                    for ($x = 0; $x < $feedback_num; $x++) {
                                                        $feedback_data = $feedback_rs->fetch_assoc();
                                                    ?>
                                                        <div class="col-12 mt-1 mb-1 mx-1">
                                                            <div class="row border border-1 border-dark rounded me-0">
                                                                <?php

                                                                $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $feedback_data["users_email"] . "'");
                                                                $user_data = $user_rs->fetch_assoc();

                                                                ?>
                                                                <div class="col-10 mt-1 mb-1 ms-0"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></div>
                                                                <div class="col-2 mt-1 mb-1 me-0">
                                                                    <?php
                                                                    if ($feedback_data["type"] == 1) {
                                                                    ?>
                                                                        <span class="badge bg-success">Satisfied</span>
                                                                </div>
                                                            <?php
                                                                    } else if ($feedback_data["type"] == 2) {
                                                            ?>
                                                                <span class="badge bg-warning">Average</span>
                                                            </div>
                                                        <?php
                                                                    } else if ($feedback_data["type"] == 3) {
                                                        ?>
                                                            <span class="badge bg-danger">Dissatisfied</span>
                                                        </div>
                                                    <?php
                                                                    }
                                                    ?>

                                                    <div class="col-12">
                                                        <b>
                                                            <?php echo $feedback_data["feedback"]; ?>
                                                        </b>
                                                    </div>
                                                    <div class="offset-6 col-6 text-end">
                                                        <label class="form-label fs-6 text-black-50"><?php echo $feedback_data["date"]; ?></label>
                                                    </div>
                                                </div>

                                            </div>
                                        <?php
                                                    }

                                        ?>
                                        <div>
                                            <!-- <button onclick="viewAllFeedback();">All Reviews and Ratings</button> -->
                                        </div>


                                        </div>
                                    </div>
                                </div>



                                <!-- Related items section-->
                                <section class="py-5 bg-light">
                                    <div class="container px-4 px-lg-5 mt-5">
                                        <h2 class="fw-bolder text-center mb-5" style="font-family: Georgia, 'Times New Roman', Times, serif;">You May Also Like</h2>
                                        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                                            <?php

                                            $related_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $product_data["category_cat_id"] . "'LIMIT 8");
                                            $related_num = $related_rs->num_rows;


                                            if ($related_num != 0) {
                                                for ($x == 0; $x < $related_num; $x++) {
                                                    $related_data = $related_rs->fetch_assoc();
                                                    $img_id = $related_data["id"];


                                            ?>
                                                    <div class="col mb-5">
                                                        <div class="card h-100">
                                                            <!-- Sale badge-->
                                                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                                            <!-- Product image-->
                                                            <?php
                                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $img_id . "'");
                                                            $img_num = $img_rs->num_rows;
                                                            if ($img_num != 0) {
                                                                $img_data = $img_rs->fetch_assoc();

                                                            ?>
                                                                <a href="<?php echo "singleProductView.php?id=" . ($related_data["id"]); ?>">
                                                                    <img class="card-img-top" src="<?php echo $img_data["img_path"]; ?>" alt="..." />
                                                                </a>
                                                            <?php
                                                            }
                                                            ?>

                                                            <!-- Product details-->
                                                            <div class="card-body p-4">
                                                                <div class="text-center">
                                                                    <!-- Product name-->
                                                                    <h5 class="fw-bolder"><?php echo $related_data["title"]; ?></h5>
                                                                    <!-- Product reviews-->
                                                                    <div class="d-flex justify-content-center small text-warning mb-2">
                                                                        <div class="bi-star-fill"></div>
                                                                        <div class="bi-star-fill"></div>
                                                                        <div class="bi-star-fill"></div>
                                                                        <div class="bi-star-fill"></div>
                                                                        <div class="bi-star-fill"></div>
                                                                    </div>
                                                                    <!-- Product price-->
                                                                    <span class="text-dark">LKR <?php echo $related_data["price"]; ?> .00</span>

                                                                </div>
                                                            </div>
                                                            <!-- Product actions-->
                                                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                                                <button class="col-12 btn btn-outline-dark mt-auto text-center" onclick="addToCart(<?php echo $product_data['id']; ?>);"> Add to cart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <h4>No related items yet.</h4>
                                            <?php
                                            }




                                            ?>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </div>


                    </div>
                </div>


                </div>
                </div>
                </div>
                <!-- Footer-->
                <footer class="py-5 bg-dark text-white">
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-12 col-md-3 col-lg-3 mx-auto mt-3">
                                <p>Copyright &copy; 2023 YouBuy Fashion.lk All Rights Reserved </p>
                                <p>Designed By <a href="#" class="text-danger fw-bold text-decoration-none" style="font-family:monospace;"> CodeTaprobane&trade; </a></p>
                            </div>
                        </div>
                </footer>


                <script src="bootstrap.js"></script>
                <script src="script.js"></script>

                <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

        </body>

        </html>

    <?php

    } else {
    ?> <script>
            alert("Something went wrong");
        </script> <?php
                }
            }


                    ?>