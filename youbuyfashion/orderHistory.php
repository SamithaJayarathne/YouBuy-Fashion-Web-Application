<?php

session_start();
require "connection.php";

if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"];




?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">

        <title>YouBuy Fashion | Shopping Cart</title>
    </head>

    <body>
        <?php
        // include "header.php";
        ?>
        
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>

              <li class="breadcrumb-item active" aria-current="page">Order History</li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
        <div class="container" style="font-family:'Times New Roman', Times, serif;">
            <h2 class="fw-bold mt-3">Order History</h2>
            <h4 class="mt-2">Chech the status of recent orders.</h4>

            <?php
            $rs = Database::search("SELECT * FROM `order_history` WHERE `users_email`='" . $user["email"] . "'");
            $num = $rs->num_rows;
            // echo($num);
            if ($num > 0) {
                for ($i = 0; $i < $num; $i++) {
                    $d = $rs->fetch_assoc();

            ?>
                    <div class="col-12 border border-5 mt-3 rounded-3">
                        <div class="p-3 row">

                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="fw-bolder">Order ID</h4>
                                        <h5 class="text-danger fw-bold"><?php echo $d["order_id"]?></h5>
                                    </div>

                                </div>
                            </div>

                            <div class="col-4">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="fw-bolder">Date Placed</h4>
                                        <h5><?php echo $d["order_date"]?></h5>
                                    </div>

                                </div>
                            </div>

                            <div class="col-4 text-end">
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="fw-bolder">Amount</h4>
                                        <h5>LKR <?php echo $d["amount"]?>.00</h5>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <hr><hr>

                        <?php
                        $rs2 = Database::search("SELECT * FROM order_item INNER JOIN order_history ON order_item.order_history_oh_id=order_history.oh_id
                        
                        INNER JOIN product ON order_item.product_product_id=product.id WHERE `order_history_oh_id`='".$d["oh_id"]."' ORDER BY order_history.order_date DESC");
                        $num2 = $rs2->num_rows;




                        for ($j = 0; $j < $num2; $j++) {
                            $d2 = $rs2->fetch_assoc();
                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='".$d2["product_product_id"]."'");
                        $img_num = $img_rs->num_rows;

                            $img_data = $img_rs->fetch_assoc();
                            ?>
                             <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img src="<?php echo $img_data["img_path"]?>" width="200" alt="">
                                    </div>
                                    <div class="col-6 mt-4 align-items-center">
                                        <h4 class="fw-bold mb-3"><?php echo $d2["title"]?></h4>
                                        <h5>Qty : <?php echo $d2["oi_qty"]?></h5>
                                        <h5>LKR : <?php echo $d2["price"]?>.00</h5>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 text-end p-3">
                                <h4 class="p-3">LKR <?php echo $d2["price"] * $d2["oi_qty"]?>.00</h4>
                                <button data-bs-toggle="modal" data-bs-target="#myModal" type="button" class="btn btn-success px-3" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">Feedback</button>


                                <div class="mt-5">
                                    <a href=<?php echo "singleProductView.php?id=" . ($d2["product_product_id"]); ?>""><button class="btn btn-dark mt-5 me-3">View Product</button></a>
                                </div>
                                <!--Feedback-->

                      <!-- The Modal -->
                      <div class="modal fade" style="background-image: url(resources/b-bg2.png);" id="myModal">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content p-3">

                            <!--body-->
                            <div class="modal-header text-center">
                              <h5 class="modal-title fw-bold text-center" style="font-family: Georgia, 'Times New Roman', Times, serif;">Your Feedback</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="col-12">
                                <div class="row">
                                  <div class="col-12 mt-3 mb-3">
                                    <div class="row">
                                      <div class="col-3">
                                        <label class="form-label fw-bold text-start" style="font-family: Georgia, 'Times New Roman', Times, serif;">Product Quality</label>
                                      </div>
                                      <div class="col-3">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="type" id="type1" />
                                          <label class="form-check-label text-success fw-bold" for="type1">
                                            Satisfied
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="type" id="type2" checked />
                                          <label class="form-check-label text-warning fw-bold" for="type2">
                                            Average
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-3">
                                        <div class="form-check">
                                          <input class="form-check-input" type="radio" name="type" id="type3" />
                                          <label class="form-check-label text-danger fw-bold" for="type3">
                                            Dissatisfied
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-12">
                                    <div class="row">
                                      <div class="col-3">
                                        <label class="form-label fw-bold text-start" style="font-family: Georgia, 'Times New Roman', Times, serif;">User's Email</label>
                                      </div>
                                      <div class="col-9">
                                        <input type="text" class="form-control" id="mail" value="<?php echo $user["email"] ?>" disabled/>
                                      </div>

                                    </div>
                                  </div>
                                  <div class="col-12 mt-5">
                                    <div class="row">
                                      <div class="col-12">
                                        <label class="form-label fw-bold text-start" style="font-family: Georgia, 'Times New Roman', Times, serif;">Feedback</label>
                                      </div>
                                      <div class="col-12">
                                        <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <hr>
                            
                              <div class="row d-flex justify-content-center align-items-center p-5">
                                
                                <div class="col-12">
                                  <button type="button" class="col-8 btn btn-dark px-5" onclick="saveFeedback(<?php echo $pid; ?>);">Save Feedback</button>
                                </div>


                              </div>

                            
                            <!--body-->


                          </div>
                        </div>
                      </div>

                      <!--Feedback-->
                            </div>
                        </div><hr class="fw-bold">
                            <?php

                        }
                        ?>

                       
                        

                        
                    </div>
            <?php
                }
            }

            ?>




        </div>







        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        <script src="script.js"></script>
        <script src="bootstrap.js"></script>
    </body>

    </html>
<?php
}
?>