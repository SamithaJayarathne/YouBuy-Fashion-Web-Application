<?php
session_start();
include "connection.php";

if (isset($_SESSION["a"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
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
        <title>Sales Report</title>
    </head>

    <body>
        <div class="container mt-3">
            <a href="adminReport.php"> <img src="Resources/img/back.png" alt="" height="25"></a>
        </div>
        <div class="container mt-3">
            <h2 class="text-center fw-bold">Sales Report</h2>
            <table class="table table-hover mt-5">
                <thead>
                    <tr>
                        <th class="bg-primary-subtle">Product</th>
                        <th class="bg-primary-subtle">Order Id</th>
                        <th class="bg-primary-subtle">Color</th>
                        <th class="bg-primary-subtle">Size</th>
                        
                        
                        <th class="bg-primary-subtle">Amount</th>
                        <th class="bg-primary-subtle">Buyer</th>
                        <th class="bg-primary-subtle">Date</th>



                    </tr>
                </thead>
                <tbody>

                <?php
                $rs =Database::search("SELECT * FROM invoice INNER JOIN product ON invoice.product_id=product.id 
                INNER JOIN color ON color.color_id=product.color_color_id
                INNER JOIN `size` ON size.size_id=product.size_size_id
                INNER JOIN users ON users.email=product.users_email ORDER BY `invoice`.`date` DESC");

                
                $num = $rs->num_rows;

                for ($i = 0; $i < $num; $i++) {
                    $data = $rs->fetch_assoc();
                    
                    
                    ?>
                    <tr>
                            <td class="bg-info-subtle"><?php echo($data["title"])?></td>
                            <td class="bg-info-subtle"><?php echo($data["order_id"])?></td>
                            <td class="bg-info-subtle"><?php echo($data["color_name"])?></td>
                            <td class="bg-info-subtle"><?php echo($data["size_name"])?></td>
                            
                            <td class="bg-info-subtle text-danger">Rs. <?php echo($data["total"])?></td>
                            
                            <td class="bg-info-subtle"><?php echo($data["fname"]." ". $data["lname"] )?></td>
                            <td class="bg-info-subtle"><?php echo($data["date"])?></td>
                           
                            
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
} else {
?>
    <h2>Your are not a valid admin, Please sign in as admin to access reports</h2>
<?php
}
?>