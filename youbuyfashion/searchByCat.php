<?php

session_start();
include "connection.php";

$catid = $_GET["id"];
$rs = Database::search("SELECT * FROM `product` INNER JOIN `category` ON category.cat_id=product.category_cat_id 
INNER JOIN `product_img` ON product_img.product_id=product.id WHERE `cat_id`='" . $catid . "' ORDER BY `product`.`datetime_added` DESC");

$rs2 = Database::search("SELECT * FROM `product` INNER JOIN `category` ON category.cat_id=product.category_cat_id 
INNER JOIN `product_img` ON product_img.product_id=product.id WHERE `cat_id`='" . $catid . "'");
$num = $rs->num_rows;
$cat_d = $rs2->fetch_assoc();
$user = $_SESSION["u"]["email"];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">

    <title>YouBuy Fashion | <?php echo ($cat_d["cat_name"]) ?></title>
</head>
<?php



if (isset($_SESSION["u"])) {

?>

    <body onload="searchByCat(0);">
        <?php
        include "header.php";
        ?>
        <div class="container mt-5">
            <div class="text-center mt-5">
                <h3 style="font-family: Georgia, 'Times New Roman', Times, serif;" class="mb-5">Search Results For <span class="h2 text-danger" style="font-family: Georgia, 'Times New Roman', Times, serif;"> <?php echo ($cat_d["cat_name"]) ?></span></h3>
            </div>

            <div class="row col-12 ms-2">


                <?php

                if ($num > 0) {

                    for ($i = 0; $i < $num; $i++) {
                        $d = $rs->fetch_assoc();
                ?>
                        <div class="card col-12 col-lg-2 mt-2 mb-2 mx-2 p-3" style="width: 18rem;">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                            <?php



                            ?>
                            <a href="<?php echo "singleProductView.php?id=" . ($d["id"]); ?>">
                                <img id="zoomButton" src="<?php echo $d["img_path"]; ?> " class="card-img" alt="...">
                            </a>
                            <div class="card-body">

                                <span class="card-text text-danger">LKR <span class="fs-3 fw-bold"><?php echo $d["price"]; ?></span> .00</span><br />
                                <h5 class="card-title fw-bold"><?php echo $d["title"] ?></h5>
                                <div class="row justify-content-center p-3">

                                </div>

                                <div class="row justify-content-center">

                                </div>
                            </div>
                            <div class="row p-2">
                                <button class="text-white fs-4 mb-2 col-12 btn-cart" onclick="addToCart(<?php echo $d['id']; ?>);"><i class="bi bi-cart-plus"></i></button>

                                <button class="text-white fs-4 col-12 col-5 btn btn-dark" onclick="addToWatchlist(<?php echo $d['id']; ?>);"><i class="bi bi-bag-heart"></i></button>
                            </div>

                        </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="mt-5 mb-5"></div>
                    <div class="mt-5 mb-5"></div>
                    <div class="mt-5 mb-2"></div>

                    <div class="container d-flex justify-content-center align-items-center mt-5">
                        <div class="border border-3 rounded-3 border-primary alert alert-primary">
                            <div class="">
                                <h2 class="">No products Found!</h2>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>





        <script src="sweetalert2.all.min.js"></script>
  <script src="script.js"></script>
  <script src="bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/debug.addIndicators.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>
        <script>
            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    </body>

</html>
<?php
} else {
?>

    <div class="d-flex justify-content-center align-items-center">
        <h1 class="display-1">Please Sign In</h1>
    </div>
<?php

}
