<?php
session_start();
include "connection.php";

if(isset($_SESSION["a"])){
?>
<!DOCTYPE html>
    <html lang="en">

    <head>
    <link rel="stylesheet" href="bootstrap.css">
        <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
        <title>Product Report</title>
    </head>

    <body>
        <div class="container mt-3">
            <a href="adminReport.php"> <img src="Resources/img/back.png" alt="" height="25"></a>
        </div>
        <div class="container mt-3">
            <h2 class="text-center">Product Report</h2>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th class="bg-dark-subtle">Product Id</th>
                        <th class="bg-dark-subtle">Product Name</th>
                        <th class="bg-dark-subtle">Brand Name</th>
                        <th class="bg-dark-subtle">Category</th>
                        <th class="bg-dark-subtle">Color</th>
                        <th class="bg-dark-subtle">Size</th>
                        <th class="bg-dark-subtle">Quantity</th>
                        <th class="bg-dark-subtle">Added Date</th>

                        

                        <th class="bg-dark-subtle">Image</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $rs =Database::search(" SELECT product.id,product.price,product.qty,product.description,
                product.title,product.datetime_added,product.delivery_fee_kandy,product.delivery_fee_other,
                product.category_cat_id,product.brand_has_model_id,product.color_color_id,product.status_status_id,
                product.size_size_id,product.users_email,model.model_name AS mname,
                brand.brand_name AS bname, color.color_name AS cname, size.size_name AS sname, category.cat_name AS catname FROM `product` INNER JOIN `brand_has_model` ON 
                brand_has_model.id=product.brand_has_model_id INNER JOIN `brand` ON 
                brand.brand_id=brand_has_model.brand_brand_id INNER JOIN `model` ON 
                model.model_id=brand_has_model.model_model_id INNER JOIN `color` ON
                color.color_id=product.color_color_id INNER JOIN `size` ON
                size.size_id=product.size_size_id INNER JOIN `category` ON 
                category.cat_id=product.category_cat_id ORDER BY product.id ASC");

                
                $num = $rs->num_rows;

                for ($i = 0; $i < $num; $i++) {
                    $data = $rs->fetch_assoc();
                    $irs  = Database::search("SELECT * FROM `product_img` WHERE `product_id`='".$data["id"]."'");
                    $idata = $irs->fetch_assoc();
                    ?>
                    <tr>
                            <td><?php echo($data["id"])?></td>
                            <td><?php echo($data["title"])?></td>
                            <td><?php echo($data["bname"])?></td>
                            <td><?php echo($data["catname"])?></td>
                            <td><?php echo($data["cname"])?></td>
                            <td><?php echo($data["sname"])?></td>
                            <td><?php echo($data["qty"])?></td>
                            <td><?php echo($data["datetime_added"])?></td>
                            <td><img src="<?php echo $idata["img_path"] ?>" class="card-img-top" height="100" alt="..."></td>

                            
                        </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end container mt-5 mb-5">
            <button class="btn btn-dark col-2" onclick="window.print();">Print</button>
        </div>


    </body>

    </html>
<?php
}else{
    ?>
    <h2>Your are not a valid admin, Please sign in as admin to access reports</h2>
    <?php
}
?>