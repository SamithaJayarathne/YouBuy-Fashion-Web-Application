<?php
// echo("ok");

include "connection.php";
$rs = Database::search("SELECT product.id, product.title, SUM(order_item.oi_qty) AS `total_sold` FROM order_item 
INNER JOIN product ON order_item.product_product_id=product.id GROUP BY product.id,product.title ORDER BY 
`total_sold` DESC LIMIT 10");

$num = $rs->num_rows;
// echo($num);

$rs2 = Database::search("SELECT category.cat_name,COUNT(product.id)FROM category  
                 LEFT JOIN product  ON category.cat_id = product.category_cat_id
                 GROUP BY category.cat_id, category.cat_name");
$num2 = $rs2->num_rows;


$labels = array();
$data = array();

$labels2 = array();
$data2 = array();

for ($i = 0; $i < $num; $i++) {
    $d = $rs->fetch_assoc();   
    $labels[] = $d["title"];
    $data[] = $d["total_sold"];
}

for ($x = 0; $x < $num2; $x++) {
    $d2 = $rs2->fetch_assoc();
    $labels2[] = $d2["cat_name"];
    $data2[] = $d2["COUNT(product.id)"];
}
$json = array();
$json["labels"] = $labels;
$json["data"] = $data;
$json["data2"] = $data2;
$json["labels2"] = $labels2;

echo json_encode($json,);



?>