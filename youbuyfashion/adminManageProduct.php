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
        <title>Admin Dashboard | YouBuy Fashion</title>
    </head>

    <body class="container-fluid bg-primary-subtle">
        <div class="row">
            <div class="col-12 col-lg-2 text-light text-center ">
            <a href="home.php">YouBuy Fashion | Home</a>


                <div class="nav flex-column nav-pills me-3 mt-5" role="tablist" aria-orientation="vertical">
                    <nav class="nav flex-column">
                        <a class="nav-link mt-lg-3 fs-2" href="adminDashboard.php">Dashboard</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageUsers.php">Manage Users</a>
                        <a class="nav-link active mt-lg-3 fs-2" aria-current="page" href="addProduct.php">Manage Products</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageStock.php">Manage Stock</a>
                        <hr>
                        <a class="nav-link mt-lg-3 fs-2" href="adminReports.php">Reports Generator</a>
                    </nav>
                </div>
            </div>

            <div class="col-12 col-lg-10 bg-light pdiv">
                <h2 class="fw-bold mt-3 text-center">Product Management</h2>

                <div class="row mt-3">
                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-6 mt-5">
                                <label for="" class="form-label">Product Name :</label>
                                <input type="text" class="form-control" id="pname">
                            </div>

                            <div class="col-6 mt-5">
                                <label for="" class="form-label">Category :</label>
                                <select name="" id="category" class="form-select">
                                    <option value="0">select</option>
                                    <?php
                                    $cat_rs = Database::search("SELECT * FROM `category`");
                                    $cat_num = $cat_rs->num_rows;
                                    for ($i = 0; $i < $cat_num; $i++) {
                                        $cat_data = $cat_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($cat_data["cat_id"]) ?>"><?php echo ($cat_data["cat_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <label for="" class="form-label">Brand :</label>
                                <select name="" id="brand" class="form-select">
                                    <option value="0">select</option>
                                    <?php
                                    $b_rs = Database::search("SELECT * FROM `brand`");
                                    $b_num = $cat_rs->num_rows;
                                    for ($i = 0; $i < $b_num; $i++) {
                                        $b_data = $b_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($b_data["brand_id"]) ?>"><?php echo ($b_data["brand_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <label for="" class="form-label">Color :</label>
                                <select name="" id="color" class="form-select">
                                    <option value="0">select</option>
                                    <?php
                                    $col_rs = Database::search("SELECT * FROM `color`");
                                    $col_num = $col_rs->num_rows;
                                    for ($i = 0; $i < $col_num; $i++) {
                                        $col_data = $col_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($col_data["color_id"]) ?>"><?php echo ($col_data["color_name"]) ?></option>
                                        <?php
                                    }
                                        ?>>
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <label for="" class="form-label">Size :</label>
                                <select name="" id="size" class="form-select">
                                    <option value="0">select</option>
                                    <?php
                                    $s_rs = Database::search("SELECT * FROM `size`");
                                    $s_num = $s_rs->num_rows;
                                    for ($i = 0; $i < $s_num; $i++) {
                                        $s_data = $s_rs->fetch_assoc();
                                    ?>
                                        <option value="<?php echo ($s_data["size_id"]) ?>"><?php echo ($s_data["size_name"]) ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="col-6 mt-3">
                                <label for="" class="form-label">Quantity :</label>
                                <input type="number" class="form-control" value="0" min="0" id="qty">
                            </div>
                            <div class="col-12 mt-3">
                                <label for="" class="form-label">Description :</label>
                                <textarea name="" id="desc" size="50" class="form-control"></textarea>
                            </div>

                            <div class="col-12 col-lg-4 mt-3 text-center">
                                <label class="form-label fw-bold">Unit Price</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs</span>
                                    <input type="text" class="form-control" id="cost" />
                                    <span class="input-group-text">.00</span>
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 mt-3 text-center">
                                <label class="form-label fw-bold">Delivery Cost (Kandy)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs</span>
                                    <input type="text" class="form-control" id="dwk" />
                                    <span class="input-group-text">.00</span>
                                </div>

                            </div>
                            <div class="col-12 col-lg-4 mt-3 text-center">
                                <label class="form-label fw-bold">Delivery Cost (Out of Kandy)</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rs</span>
                                    <input type="text" class="form-control" id="dok" />
                                    <span class="input-group-text">.00</span>
                                </div>

                            </div>

                            <div class="col-12 mt-3">
                                <label for="form-label">Product Image :</label>
                                <input type="file" class="form-control" id="file" multiple>
                            </div>

                            <div class="col-12 col-lg-4 mt-3 d-grid mb-3 offset-lg-4">
                                <button class="btn btn-dark fw-bold" onclick="productReg();">Register Product</button>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-4 my-auto bg-grey">
                        <div class="row ">
                            <div class="col-12 mt-5">
                                <div class="col-12 d-none" id="d1" onclick="reload();">
                                    <div class="alert alert-danger" id="m1"></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Add new Category" id="newCat">
                                <button class="btn btn-outline-dark col-12 mt-3" onclick="addNewCat();">Add</button>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="col-12 d-none" id="d2" onclick="reload();">
                                    <div class="alert alert-danger" id="m2"></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Add new Brand" id="newBrand">
                                <button class="btn btn-outline-dark col-12 mt-3" onclick="addNewBrand();">Add</button>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="col-12 d-none" id="d3" onclick="reload();">
                                    <div class="alert alert-danger" id="m3"></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Add new Color" id="newColor">
                                <button class="btn btn-outline-dark col-12 mt-3" onclick="addNewColor();">Add</button>
                            </div>

                            <div class="col-12 mt-5">
                                <div class="col-12 d-none" id="d4" onclick="reload();">
                                    <div class="alert alert-danger" id="m4"></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Add new Size" id="newSize">
                                <button class="btn btn-outline-dark col-12 mt-3 mb-3" onclick="addNewSize();">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are not a valid Admin");
}

?>