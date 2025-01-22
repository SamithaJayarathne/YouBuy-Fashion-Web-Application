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
$q = "SELECT * FROM `users` INNER JOIN `gender` ON users.gender_id=gender.id ORDER BY `users`.`fname` ASC";

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

                <td><?php echo $d["fname"] . "   " .  $d["lname"]; ?></td>
                <td><?php echo $d["email"] ?></td>
                <td><?php echo $d["mobile"] ?></td>
                <td><?php echo $d["gender_name"] ?></td>
                <td><?php echo $d["joined_date"] ?></td>
                <td>
                    <?php
                    if ($d["status"] == "1") {
                        echo ("Active");
                    } else {
                        echo ("Deactive");
                    }
                    ?>
                </td>

            </tr>
        </div>


    <?php
}
    ?>


    <!-- pagination -->
    <div class="mt-5 row">


        <div class="col-4 ms-auto mx-5">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" <?php

                                                                if ($pageno <= 1) {
                                                                    echo ("#");
                                                                } else {
                                                                ?> onclick="loadUsers(<?php echo ($pageno - 1) ?>);" <?php
                                                                                                                    }


                                                                                                                        ?>>Previous</a></li>

                    <?php
                    for ($i = 1; $i <= $num_of_pages; $i++) {
                        if ($i == $pageno) {
                    ?>
                            <li class="page-item active"><a class="page-link" onclick="loadUsers(<?php $i ?>);"><?php echo $i ?></a></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a class="page-link" onclick="loadUsers(<?php echo ($i) ?>);"><?php echo ($i) ?></a></li>
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
                                                                ?> onclick="loadUsers(<?php echo ($pageno + 1) ?>);" <?php
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