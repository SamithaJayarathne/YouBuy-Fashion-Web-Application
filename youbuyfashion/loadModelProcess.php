<?php

require "connection.php";

if(isset($_GET["d"])){

   $brand_id = $_GET["d"];
   
   $brand_rs = Database::search("SELECT * FROM `brand_has_model` WHERE
   `brand_brand_id`='".$brand_id."'");

   $brand_num = $brand_rs->num_rows;

   for($x = 0;$x < $brand_num;$x++){

    $brand_data = $brand_rs->fetch_assoc();

    $model_rs = Database::search("SELECT * FROM `model` WHERE
    `model_id`='".$brand_data["model_model_id"]."'");

    $model_data = $model_rs->fetch_assoc();

    ?>
    
    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>
    
    <?php

   }

}

?>