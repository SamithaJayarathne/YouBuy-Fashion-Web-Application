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
        <title>User Management | YouBuy Fashion</title>
    </head>

    <body class="container-fluid bg-primary-subtle" onload="loadStock(0);">
        <div class="row">
            <div class="col-12 col-lg-2 text-light text-center">
            <a href="home.php">YouBuy Fashion | Home</a>


                <div class="nav flex-column nav-pills me-3 mt-5" role="tablist" aria-orientation="vertical">
                    <nav class="nav flex-column">
                        <a class="nav-link mt-lg-3 fs-2" href="adminDashboard.php">Dashboard</a>
                        <a class="nav-link  mt-lg-3 fs-2" href="adminManageUsers.php">Manage Users</a>
                        <a class="nav-link mt-lg-3 fs-2" href="addProduct.php">Manage Products</a>
                        <a class="nav-link active mt-lg-3 fs-2" aria-current="page" href="adminManageStock.php">Manage Stock</a>
                        <hr>
                        <a class="nav-link mt-lg-3 fs-2" href="adminReports.php">Reports Generator</a>
                    </nav>
                </div>
            </div>

            <?php
            $rs = Database::search("SELECT * FROM `product`");
            $num = $rs->num_rows;
            $rs0 = Database::search("SELECT * FROM `product` WHERE `qty`='0'");
            $num0 = $rs0->num_rows;
            $current_num = $num - $num0;

            ?>

            <div class="col-12 col-lg-10 bg-light pdiv">
                <h2 class="fw-bold mt-3 text-center">Stock Management</h2>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-5 bg-success rounded-5 shadow-lg offset-lg-1 p-3">
                            <h5 class="fw-bold text-center">Current Stock Items</h5>
                            <h5 class="fw-bold text-center"><?php echo ($current_num) ?></h5>
                        </div>
                        <div class="col-5 bg-danger rounded-5 ms-2 p-3 shadow-lg">
                            <h5 class="fw-bold text-center">Out Of Stock</h5>
                            <h5 class="fw-bold text-center"><button class="btn btn-danger fw-bold text-center text-dark" onclick="seeOutStock();"><?php echo ($num0) ?></button></h5>
                        </div>

                        <div class="col-8 offset-2 d-none" id="table">
                            <table class="table table-hover mt-5 text-center">
                                <thead class="fs-5">
                                    <tr>
                                        <th>Product Name</th>
                                        <td>Added Date</td>
                                        <th>Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    for ($i = 0; $i < $num0; $i++) {
                                        $d0 = $rs0->fetch_assoc();
                                    ?>
                                        <tr>
                                            <td><?php echo ($d0["title"]) ?></td>
                                            <td><?php echo ($d0["datetime_added"]) ?></td>
                                            <td>Out of stock</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="col-12">
                            <table class="table table-hover mt-5">
                                <thead class="fs-5">
                                    <tr>
                                        
                                        <th>Product Name</th>
                                        <th>Product Id</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">



                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>



            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are not a valid Admin");
}

?>