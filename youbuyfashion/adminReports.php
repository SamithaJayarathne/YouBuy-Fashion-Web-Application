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
            <div class="col-12 col-lg-2 text-light text-center pdiv1">
            <a href="home.php">YouBuy Fashion | Home</a>


                <div class="nav flex-column nav-pills me-3 mt-5" role="tablist" aria-orientation="vertical">
                    <nav class="nav flex-column">
                        <a class="nav-link mt-lg-3 fs-2" href="adminDashboard.php">Dashboard</a>
                        <a class="nav-link  mt-lg-3 fs-2" href="adminManageUsers.php">Manage Users</a>
                        <a class="nav-link mt-lg-3 fs-2" href="addProduct.php">Manage Products</a>
                        <a class="nav-link  mt-lg-3 fs-2" href="adminManageStock.php">Manage Stock</a>
                        <hr>
                        <a class="nav-link mt-lg-3 active fs-2 mb-2 shadow-lg" aria-current="page" href="adminReports.php">Reports Generator</a>
                    </nav>
                </div>
            </div>



            <div class="col-12 col-lg-10 bg-light pdiv  ">
                <h2 class="fw-bold mt-3 text-center">Generate Reports</h2>
                <hr />
                <div class="row text-center mb-5" style="background-color: rgb(0, 255, 255);">
                    <div class="col-6 col-lg-6  p-5" style="background-color: rgb(0, 255, 255);">
                        <a href="adminProductReport.php"><button class="btn fs-4 fw-bold p-3 " style="background-color: rgb(0, 255, 255);">Product Report</button></a>
                    </div>

                    <div class="col-6 col-lg-6  p-5 userReportDiv">
                        <a href="adminUserReport.php"><button class="btn fs-4 fw-bold p-3">User Report</button></a>
                    </div>



                </div>
                <div class="row mt-5 text-center" style="background-color: rgb(0, 71, 171);">
                <div class="col-6 col-lg-6  p-5 salesDiv" >
                    <a href="adminSalesReport.php"><button class="btn fs-4 fw-bold p-3 text-white" style="background-color: rgb(19, 76, 90)">Sales Report</button></a>
                </div>
                <div class="col-6 col-lg-6 p-5" style="background-color: rgb(0, 71, 171);">
                    <a href="adminCategoryReport.php"><button class="btn text-white fs-4 fw-bold p-3" style="background-color: rgb(0, 71, 171);">Category Details</button></a>
                </div>

                </div>
               






                <!-- <div class="col-6 col-lg-3 mt-3">
                    <div><button class="btn  fs-4 fw-bold p-3" style="background-color: rgb(167, 199, 231);">Brand Details</button></div>
                </div>

                <div class="col-6 col-lg-3 mt-3">
                    <div><button class="btn text-white fs-4 fw-bold p-3" style="background-color: rgb(0, 0, 128);">Brand Details</button></div>
                </div> -->





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