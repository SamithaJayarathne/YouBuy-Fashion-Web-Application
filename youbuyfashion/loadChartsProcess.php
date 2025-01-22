<?php
include "connection.php";

//active users
$aurs = Database::search("SELECT * FROM `users` WHERE `gender_id`='1'");
$aunum = $aurs->num_rows;

//inactive users
$iurs = Database::search("SELECT * FROM `users` WHERE `gender_id`='2'");
$iunum = $iurs->num_rows;

// $crs = Database::search("SELECT category.cat_name,COUNT(product.id)FROM category  
// LEFT JOIN product  ON category.cat_id = product.category_cat_id
// GROUP BY category.cat_id, category.cat_name");
// $cnum = $cnum->num_rows;
// $cd = $crs->fetch_assoc();

$data = array("au" => $aunum, "iu" => $iunum,);
echo json_encode($data);

?>