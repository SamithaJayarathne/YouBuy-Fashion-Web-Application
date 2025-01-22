<?php

session_start();
include "connection.php";

if (isset($_SESSION["a"])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
        <title>Admin Dashboard | YouBuy Fashion</title>
    </head>

    <body class="container-fluid bg-primary-subtle ab" onload="loadChart();">
        <div class="row" onload="loadCharts();">
            <div class="col-12 col-lg-2 text-light text-center pdiv1">
                <a href="home.php">YouBuy Fashion | Home</a>

                <div class="nav flex-column nav-pills me-3 mt-5" role="tablist" aria-orientation="vertical">
                    <nav class="nav flex-column">
                        <a class="nav-link active mt-lg-3 fs-2" aria-current="page" href="#">Dashboard</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageUsers.php">Manage Users</a>
                        <a class="nav-link mt-lg-3 fs-2" href="addProduct.php">Manage Products</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageStock.php">Manage Stock</a>
                        <hr>
                        <a class="nav-link mt-lg-3 fs-2" href="adminReports.php">Reports Generator</a>
                    </nav>
                </div>
            </div>

            <div class="col-12 col-lg-10 bg-light pdiv">
                <div class="container-fluid">

                    <main role="main" class="col-md-12 ml-sm-auto col-lg-12 px-4">
                        <div class="text-center  pt-3 pb-2 mb-3 border-bottom">
                            <h2 class="fw-bold ">Dashboard</h2>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div style="width: 600px;">
                                    <h2 class="text-center">Top Selling Products</h2>
                                    <canvas id="myChart"></canvas>
                                </div>

                            </div>
                            <div class="col-5 offset-lg-1">
                                <div style="width: 400px;">
                                    <h2 class="text-center">Users By Gender</h2>
                                    <canvas id="userChart"></canvas>
                                </div>
                                
                            </div>

                            <div class="col-6">
                                <div style="width: 600px;">
                                    <h2 class="text-center">Category Details</h2>
                                    <canvas id="crtChart"></canvas>
                                </div>

                            </div>

                            <?php
                        $inrs = Database::search("SELECT * FROM `order_history`");
                        $innum = $inrs->num_rows;
                        $intotal = 0;

                        for ($i = 0; $i < $innum; $i++) {
                            $indata = $inrs->fetch_assoc();
                            $intotal = $intotal + $indata["amount"];
                        }
                        ?>
                        <div class="col-6 row mt-4">
                            <div class="col-12 text-center mb-3 animate__animated animate__zoomIn">
                                <div class="card p-2 col-8 offset-lg-2">
                                    <h4>Total Income</h4>
                                    <hr>
                                    <h4 class="text-success fw-bold">LKR. <?php echo $intotal ?>.00</h4>
                                </div>
                            </div>

                            <?php
                            $prs = Database::search("SELECT * FROM `product`");
                            $pnum = $prs->num_rows;
                            ?>

                            <div class="col-12 text-center mb-3 animate__animated animate__zoomIn">
                                <div class="card p-2 col-8 offset-lg-2">
                                    <h4>Total Products</h4>
                                    <hr>
                                    <h4 class="text-primary"><?php echo $pnum ?></h4>
                                </div>
                            </div>

                            <?php
                            $ad_rs = Database::search("SELECT * FROM `users` WHERE `usertype_id`='2'");
                            $ad_num = $ad_rs->num_rows;
                            ?>

                            <div class="col-12 text-center mt-3 animate__animated animate__zoomIn">
                                <div class="card p-2 col-8 offset-lg-2">
                                    <h4>Number Of Admins</h4>
                                    <hr>
                                    <h4><?php echo ($ad_num) ?></h4>
                                </div>
                            </div>

                        </div>



                        </div>


                        <!-- <div class="row mb-4">
                            <div class="col-md-6 ">
                                <canvas id="revenueChart" class="hidden"></canvas>
                            </div>
                            <div class="col-md-6">
                                <h3 class="mb-5">Sales Chart</h3>

                                <canvas id="myChart"></canvas>
                            </div>

                        </div>

                        <div class="row mb-4 mt-4">
                            <div class="col-md-6 mt-4 text-center ">
                                <h3 class="mb-5">Users By Gender</h3>
                                <canvas id="userChart"></canvas>
                            </div> -->


                       

                </div>



                <div class="row">
                    <div class="col-12 animate__animated animate__zoomIn">
                        <div class="card ">
                            <div class="card-header">
                                Recent Sales
                            </div>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>

                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Available Stock</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rrs = Database::search("SELECT * FROM order_item INNER JOIN product ON order_item.product_product_id=product.id ORDER BY order_item.oid DESC LIMIT 5");
                                        $rnum = $rrs->num_rows;
                                        for ($i = 0; $i < $rnum; $i++) {
                                            $rd = $rrs->fetch_assoc();
                                        ?>

                                            <tr>

                                                <td><?php echo $rd["title"] ?></td>
                                                <td>LKR. <?php echo $rd["price"] ?>.00</td>
                                                <td><?php echo $rd["qty"] ?></td>

                                            </tr>
                                            <!-- More rows as needed -->

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
                </main>
            </div>
        </div>
        </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are not a valid Admin");
}

?>