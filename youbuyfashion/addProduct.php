<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
<?php

session_start();
if (isset($_SESSION["a"])) {
?>

    <body class="container-fluid bg-primary-subtle">

        <div class="row">

            <div class="col-12 col-lg-2 text-light text-center ">
            <a href="home.php">YouBuy Fashion | Home</a>

                

                <div class="nav flex-column nav-pills me-3 mt-5" role="tablist" aria-orientation="vertical">
                    <nav class="nav flex-column">
                        <a class="nav-link mt-lg-3 fs-2" href="adminDashboard.php">Dashboard</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageUsers.php">Manage Users</a>
                        <a class="nav-link active mt-lg-3 fs-2" aria-current="page" href="adminManageProduct.php">Manage Products</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageStock.php">Manage Stock</a>
                        <hr>
                        <a class="nav-link mt-lg-3 fs-2" href="adminReports.php">Reports Generator</a>
                    </nav>
                </div>
            </div>



            <div class="col-12 col-lg-10 bg-light pdiv">
                <h2 class="fw-bold mt-3 text-center">Product Management</h2>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <img src="resources\add.svg" alt="">
                </button>

                <!-- Modal -->
                <div class="modal fade ms-5" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Add</h1> -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row ">
                                    <div class="col-12">
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
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                    Add New Model
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-4 fw-bold" id="exampleModalLabel">Register Model Before Add a New Product</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body row">
                                <div class="col-8">
                                <input type="text" class="form-control" placeholder="Add New Model" id="newModel">
                                </div>
                                
                                <div class="col-4">
                                    <select id="mgender" class="form-select">
                                        <?php
                                        include "connection.php";
                                        $grs = Database::search("SELECT * FROM `model_gender`");
                                        $gnum = $grs->num_rows;
                                        ?>
                                        <option value="0">Select Gender</option>
                                        <?php
                                        for ($i = 0; $i < $gnum; $i++){
                                            $gd = $grs->fetch_assoc();
                                            ?>
                                            <option value="<?php echo $gd["model_gender_id"]?>"><?php echo $gd["model_gender_name"]?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-dark" onclick="addModel();">Register</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="row card-body">
                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold">Add a title to your product</label>
                            <input type="text" class="form-control" id="title">
                        </div>

                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold"> Select Category</label>
                            <select class="form-select text-center" id="category">
                                <option value="0">Select Category</option>
                                <?php

                                

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>"><?php echo $category_data["cat_name"]; ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold"> Select Brand</label>
                            <select class="form-select text-center" id="brand">
                                <option value="0">Select Brand</option>
                                <?php

                                $brand_rs = Database::search("SELECT * FROM `brand`");
                                $brand_num = $brand_rs->num_rows;

                                for ($x = 0; $x < $brand_num; $x++) {
                                    $brand_data = $brand_rs->fetch_assoc();
                                ?>
                                    <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>
                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold"> Select Model</label>
                            <select class="form-select text-center" id="model">
                                <option value="0">Select Model</option>
                                <?php

                                $model_rs = Database::search("SELECT * FROM `model`");
                                $model_num = $model_rs->num_rows;

                                for ($x = 0; $x < $model_num; $x++) {
                                    $model_data = $model_rs->fetch_assoc();

                                ?>

                                    <option value="<?php echo $model_data["model_id"]; ?>"><?php echo $model_data["model_name"]; ?></option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold"> Select Quantity</label>
                            <input type="number" class="form-control" value="0" min="0" id="qty" />
                        </div>
                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold"> Select Size</label>
                            <select class="form-select text-center" id="size">
                                <option value="0">Select Size</option>
                                <?php

                                $size_rs = Database::search("SELECT * FROM `size`");
                                $size_num = $size_rs->num_rows;

                                for ($x = 0; $x < $size_num; $x++) {
                                    $size_data = $size_rs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $size_data["size_id"]; ?>"><?php echo $size_data["size_name"]; ?></option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-12 col-lg-6 mt-3 text-center">
                            <label class="form-label fw-bold"> Select Product Color</label>
                            <select class="form-select text-center" id="clr">
                                <option value="0">Select Colour</option>
                                <?php

                                $clr_rs = Database::search("SELECT * FROM `color`");
                                $clr_num = $clr_rs->num_rows;

                                for ($x = 0; $x < $clr_num; $x++) {
                                    $clr_data = $clr_rs->fetch_assoc();
                                ?>

                                    <option value="<?php echo $clr_data["color_id"]; ?>"><?php echo $clr_data["color_name"]; ?></option>

                                <?php
                                }

                                ?>
                            </select>
                        </div>

                        <div class="col-12 col-lg-6 mt-3">
                            <label class="form-label fw-bold">Product Description</label>
                            <textarea cols="30" rows="1" class="form-control" id="desc" placeholder="Product Description"></textarea>
                        </div>
                        <div class="col-12 col-lg-4 mt-3 text-center">
                            <label class="form-label fw-bold">Cost Per Item</label>
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




                    </div>
                </div>

                <div class="col-12 col-lg-4">

                    <div class="col-12">

                        <div class="offset-2 col-10  ">
                            <img src="resources\download.png" class="img-fluid" style="width: 250px;" id="i0" />
                        </div>

                    </div>
                    <div class="offset-lg-3 col-12 col-lg-6 d-grid mt-3">
                        <input type="file" class="d-none" id="imageuploader" multiple />
                        <label for="imageuploader" class="col-12 btn btn-dark" onclick="changeProductImage();">Upload Image</label>
                    </div>




                </div><br>



                <button class=" col-4 btn btn-outline-dark fw-bold fs-5 my-3" onclick="addProduct();">Add Product</button>

            </div>








        </div>
        </div>
    <?php

} else {
    ?>

        <div class="mt-auto" style=" display: flex; justify-content: center; align-items: center;">
            <span style="font-size: 50px;
    display: flex;
    
    justify-content: center;

    margin-top: auto;
    font-weight: 900;
    font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
                Sorry, You Must Sign in Before Sell a Product.</span>
        </div>

    <?php
}

    ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    </body>

</html>