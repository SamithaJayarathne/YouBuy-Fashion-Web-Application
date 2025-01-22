<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {
    $user = $_SESSION["u"]["email"];
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
    <title>YouBuy Fashion | Home</title>
</head>

<body style="position: relative;" data-spy="scroll" data-target="#scrollnavbar">

    <?php include "header.php"; ?>
    <br><br class="mb-2">
    <div class="container-fluid">
        <div class="row">
            <!-- Advanced search -->


            <div class="col-3" style="background: linear-gradient(to left, #bdc3c7 8%, #2c3e50 98%);">
                <h2 class="text-center mt-3" style="font-family: Georgia, 'Times New Roman', Times, serif;">Search Items</h2>
                <div class="row mt-3">
                    <div class="col-12 col-lg-9 mt-2 mb-1">
                        <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                    </div>
                    <div class="col-12 col-lg-2 mt-2 mb-1">
                        <button class="btn btn-dark" onclick="advancedSearch(0);">Search</button>
                    </div>

                    <div class="col-12  mt-3">
                        <select class="form-select" id="c1">
                            <option value="0">Select Category</option>
                            <?php

                            $category_rs = Database::search("SELECT * FROM `category`");
                            $category_num = $category_rs->num_rows;

                            for ($x = 0; $x < $category_num; $x++) {
                                $category_data = $category_rs->fetch_assoc();
                            ?>
                                <option value="<?php echo $category_data["cat_id"] ?>"><?php echo $category_data["cat_name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>
                    <div class="col-12  mt-3">
                        <select class="form-select" id="b1">
                            <option value="0">Select Brand</option>
                            <?php

                            $brand_rs = database::search("SELECT * FROM `brand`");
                            $brand_num = $brand_rs->num_rows;

                            for ($x = 0; $x < $brand_num; $x++) {
                                $brand_data = $brand_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $brand_data["brand_id"] ?>"><?php echo $brand_data["brand_name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>
                    <div class="col-12  mt-3">
                        <select class="form-select" id="m">
                            <option value="0">Select Model</option>
                            <?php

                            $model_rs = database::search("SELECT * FROM `model`");
                            $model_num = $model_rs->num_rows;

                            for ($x = 0; $x < $model_num; $x++) {
                                $model_data = $model_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $model_data["model_id"] ?>"><?php echo $model_data["model_name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>
                    <div class="col-12 col-lg-6 mt-3"><select class="form-select" id="c2">
                            <option value="0">Select Size</option>
                            <?php

                            $size_rs = database::search("SELECT * FROM `size`");
                            $size_num = $size_rs->num_rows;

                            for ($x = 0; $x < $size_num; $x++) {
                                $size_data = $size_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $size_data["size_id"] ?>"><?php echo $size_data["size_name"] ?></option>
                            <?php
                            }

                            ?>

                        </select></div>
                    <div class="col-12 col-lg-6 mt-3">
                        <select class="form-select" id="c3">
                            <option value="0">Select Colour</option>
                            <?php

                            $color_rs = database::search("SELECT * FROM `color`");
                            $color_num = $color_rs->num_rows;

                            for ($x = 0; $x < $color_num; $x++) {
                                $color_data = $color_rs->fetch_assoc();

                            ?>

                                <option value="<?php echo $color_data["color_id"] ?>"><?php echo $color_data["color_name"] ?></option>
                            <?php
                            }

                            ?>

                        </select>
                    </div>
                    <div class="col-12 col-lg-6 mt-3">
                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                    </div>

                    <div class="col-12 col-lg-6 mt-3">
                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                    </div>

                    <div class="col-12 mt-5">

                        <select class="form-select " id="s">
                            <option value="0">SORT BY</option>
                            <option value="1">PRICE LOW TO HIGH</option>
                            <option value="2">PRICE HIGH TO LOW</option>
                            <option value="3">QUANTITY LOW TO HIGH</option>
                            <option value="4">QUANTITY HIGH TO LOW</option>
                        </select>

                    </div>

                    <button class="col-12 offset-lg-2 col-lg-8 btn btn-dark mt-5" onclick="advancedSearch(0);">Search</button>




                </div>

            </div>
            <!-- Advanced search -->


            <!-- Basic search -->

            <div class="col-9" >
                <div class="row">
                    <div class="col-12 justify-content-center mt-5">
                        <div class="row col-lg-12">

                            <div class="col-9 col-lg-5 offset-lg-3">

                                <div class="input-group mb-3  col-12">
                                    <input type="text" id="kw" class="form-control col-8" aria-label="Text input with dropdown button" onkeyup="basicSearch(0);">
                                    <select class="form-select col-4" id="c" style="max-width: 250px;">
                                        <option value="0"> Categories</option>

                                        <?php

                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;

                                        for ($x = 0; $x < $category_num; $x++) {

                                            $category_data = $category_rs->fetch_assoc();

                                        ?>

                                            <option value="<?php echo $category_data["cat_id"]; ?>">
                                                <?php echo $category_data["cat_name"]; ?>
                                            </option>

                                        <?php

                                        }

                                        ?>

                                    </select>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                    </ul>

                                </div>

                            </div>
                            <div class="col-1"><button class="btn btn-dark text-white" onclick="basicSearch(0);"><i class="bi bi-search"></i></button></div>


                        </div>
                    </div>




                    <!-- products -->

                    <div id="basicSearchResult">
                    <div class="col-12 mb-3" id="newarrivals">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="row justify-content-center gap-5">

                                    <?php

                                    $product_rs = Database::search("SELECT * FROM `product` WHERE 
                              `status_status_id`='1' ");

                                    $product_num = $product_rs->num_rows;

                                    for ($x = 0; $x < $product_num; $x++) {
                                        $product_data = $product_rs->fetch_assoc();

                                    ?>

                                        <div class="card col-12 col-lg-2 mt-2 mb-2 mx-2 p-3" style="width: 20rem;">
                                            <?php

                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                          `product_id`='" . $product_data['id'] . "'");

                                            $img_data = $img_rs->fetch_assoc();

                                            ?>
                                            <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">
                                                <img id="zoomButton" src="<?php echo $img_data["img_path"]; ?> " class="card-img" alt="...">
                                            </a>
                                            <div class="card-body">

                                                <span class="card-text text-danger">LKR <span class="fs-3 fw-bold"><?php echo $product_data["price"]; ?></span> .00</span><br />
                                                <h5 class="card-title fw-bold"><?php echo $product_data["title"] ?></h5>
                                                <div class="row justify-content-center p-3">
                                                    <span class="badge  col-3 text-bg-warning">Choice</span><br />
                                                    <span class="badge rounded-pill col-2 text-bg-danger">New</span><br />
                                                </div>
                                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <div class="row justify-content-center">

                                                </div>
                                            </div>
                                            <button class=" col-12  btn-cart" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                                            <hr>
                                            <button class=" col-12 btn btn-dark" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">Add to Watchlist</button>
                                        </div>



                                    <?php
                                    }

                                    ?>


                                </div>

                            </div>

                        </div>
                    </div>
                    </div>

                   
                    <!-- products -->

                </div>
            </div>
            <!-- Basic search -->


            <?php include "footer.php"; ?>

        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="script.js"></script>
    
</body>


</html>