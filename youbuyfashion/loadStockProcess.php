<?php

include "connection.php";

$pageno = 0;
$page = $_POST["p"];
// echo($page);

if (0 != $page) {
    $pageno = $page;
} else {
    $pageno = 1;
}
$q = "SELECT product.id,product.price,product.qty,product.description,
product.title,product.datetime_added,product.delivery_fee_kandy,product.delivery_fee_other,
product.category_cat_id,product.brand_has_model_id,product.color_color_id,product.status_status_id,
product.size_size_id,product.users_email,model.model_name AS mname,
brand.brand_name AS bname, color.color_name AS cname, size.size_name AS sname, category.cat_name AS catname, status.status_name AS ss FROM `product` INNER JOIN `brand_has_model` ON 
brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON 
brand.brand_id=brand_has_model.brand_brand_id INNER JOIN `model` ON 
model.model_id=brand_has_model.model_model_id INNER JOIN `color` ON
color.color_id=product.color_color_id INNER JOIN `size` ON
size.size_id=product.size_size_id INNER JOIN `category` ON
category.cat_id=product.category_cat_id INNER JOIN `status` ON
status.status_id=product.status_status_id
 
 ORDER BY `product`.`id` ASC";

$rs = Database::search($q);
$num = $rs->num_rows;
// echo($num);

$results_per_page = 6;
$num_of_pages = ceil($num / $results_per_page);
// echo($num_of_pages);

$page_results = ($pageno - 1) * $results_per_page;
// echo($page_results);

$q2 = $q . " LIMIT $results_per_page OFFSET $page_results"; //select set of 4 results to page  1-4, 5-8, 9-12, ... | (offset 2 = skip 2 products)

$rs2 = Database::search($q2);
$num2 = $rs2->num_rows;
// echo($num2);

for ($i = 0; $i < $num2; $i++) {
    $d = $rs2->fetch_assoc();
?>
    <div class="row">
        <div class="col-12">
            <tr>
               
                <td><?php echo ($d["title"]) ?></td>
                <td><?php echo ($d["id"]) ?></td>
                <td><?php echo ($d["price"]) ?></td>
                <td><?php echo ($d["qty"]) ?></td>
                <td><?php echo ($d["catname"]) ?></td>
                <td><?php echo ($d["bname"]) ?></td>
                <td><?php echo ($d["cname"]) ?></td>
                <td><?php echo ($d["sname"]) ?></td>
                <td>

                <?php

                            if ($d["status_status_id"] == 1) {
                                ?>
                                <div class="row">
                                    <div class="col-7" id="a">
                                    <?php
                                    echo("Available");
                                    ?>
                                    </div>
                                    <div class="col-5">
                                    <button id="ub<?php echo $d['id']; ?>" class="btn btn-danger" onclick="blockProduct('<?php echo $d['id']; ?>');">Block</button> 
                                    </div>
                                </div>
                                <?php
                                
                            ?>
                                
                            <?php
                            } else {
                                ?>
                                <div class="row">
                                    <div class="col-7" id="ua">
                                    <?php
                                echo("Unavailable");
                            ?>
                                    </div>
                                    <div class="col-5">
                                    <button id="ub<?php echo $d['id']; ?>" class="btn btn-success" onclick="blockProduct('<?php echo $d['id']; ?>');">Unblock</button>
                                    </div>
                                </div>
                                
                                
                            <?php

                            }

                            ?>

                </td>

            </tr>
        </div>


    <?php
}
    ?>


    <!-- pagination -->
    <div class="d-flex justify-content-center">


        <div class="">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" <?php

                                                                if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="loadStock(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                    }


                                                                                                                        ?>>Previous</a></li>

                    <?php
                    for ($i = 1; $i <= $num_of_pages; $i++) {
                        if ($i == $pageno) {
                    ?>
                            <li class="page-item active"><a class="page-link" onclick="loadStock(<?php $i ?>);"><?php echo $i ?></a></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a class="page-link" onclick="loadStock(<?php echo ($i) ?>);"><?php echo ($i) ?></a></li>
                        <?php
                        }
                        ?>

                    <?php
                    }
                    ?>


                    <li class="page-item"><a class="page-link" <?php
                                                                if ($pageno >= $num_of_pages) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="loadStock(<?php echo ($pageno + 1) ?>);" <?php
                                                                                                                    }
                                                                                                                        ?>>Next</a></li>
                </ul>
            </nav>
        </div>




    </div>
    </div>
    <!-- pagination -->
    <?php


    ?>