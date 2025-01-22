<?php

require "connection.php";

$text = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product`";


if (!empty($text) && $select == 0) {

    $query .= " WHERE `title` LIKE '%" . $text . "%'";
} else if (empty($text) && $select != 0) {

    $query .= " WHERE `category_cat_id`='" . $select . "'";
} else if (!empty($text) && $select != 0) {

    $query .= " WHERE `title` LIKE '%" . $text . "%' AND `category_cat_id`='" . $select . "'";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row justify-content-center">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 4;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " 
                                            OFFSET " . $page_results . " ");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $selected_data = $selected_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                                    `product_id`='" . $selected_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

            ?>

                <!-- products -->

                <div class="col-12 mb-3">
                    




                            <div class="card col-6 col-lg-2 mt-2 mb-2 mx-2 p-3 animate__animated animate__zoomIn" style="width: 20rem;">

                                <a href="<?php echo "singleProductView.php?id=" . ($selected_data["id"]); ?>">
                                    <img id="zoomButton" src="<?php echo $product_img_data["img_path"]; ?> " class="card-img" alt="...">
                                </a>
                                <div class="card-body">

                                    <span class="card-text text-danger">LKR <span class="fs-3 fw-bold"><?php echo $selected_data["price"]; ?></span> .00</span><br />
                                    <h5 class="card-title fw-bold"><?php echo $selected_data["title"] ?></h5>
                                    <div class="row justify-content-center p-3">
                                        <span class="badge  col-3 text-bg-warning">Choice</span><br />
                                        <span class="badge rounded-pill col-2 text-bg-danger">New</span><br />
                                    </div>
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    <div class="row justify-content-center">

                                    </div>
                                </div>
                                <button class=" col-12  btn-cart" onclick="addToCart(<?php echo $selected_data['id']; ?>);">Add to Cart</button>
                                <hr>
                                <button class=" col-12 btn btn-dark" onclick="addToWatchlist(<?php echo $selected_data['id']; ?>);">Add to Watchlist</button>
                            </div>







                        <?php
                    }

                        ?>

                     

                    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination pagination-lg justify-content-center">
                                <li class="page-item">
                                    <a class="page-link" <?php if ($pageno <= 1) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="basicSearch(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                } ?> aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                                <?php

                                for ($y = 1; $y <= $number_of_pages; $y++) {
                                    if ($y == $pageno) {
                                ?>
                                        <li class="page-item active">
                                            <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                                        </li>
                                    <?php
                                    } else {
                                    ?>
                                        <li class="page-item">
                                            <a class="page-link" onclick="basicSearch(<?php echo ($y); ?>);"><?php echo $y; ?></a>
                                        </li>
                                <?php
                                    }
                                }

                                ?>

                                <li class="page-item">
                                    <a class="page-link" <?php if ($pageno >= $number_of_pages) {
                                                                echo ("#");
                                                            } else {
                                                            ?> onclick="basicSearch(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                } ?> aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>