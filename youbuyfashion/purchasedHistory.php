<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.css">

  <link rel="shortcut icon" href="resources/y.png" type="image/x-icon">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Dosis:wght@200&family=Kaisei+Tokumin&family=Mukta:wght@200&family=Poppins:wght@200&family=Righteous&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">

  <title>YouBuy Fashion | Purchased History</title>
</head>

<body>
  <?php
  require "connection.php";
  session_start();
  if (isset($_SESSION["u"])) {
    $mail = $_SESSION["u"]["email"];

    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `users_email`='" . $mail . "' ORDER BY `invoice`.`date` DESC");
    $invoice_num = $invoice_rs->num_rows;
  ?>
    <div class="col-12 text-light" style="background-color: #166d3b;
background-image: linear-gradient(147deg, #166d3b 0%, #000000 74%);">
      <h1 class="text-center p-5 display-2" style="font-family: Georgia, 'Times New Roman', Times, serif;">Purchased History</h1>
    </div>

    <div class="container">

      <?php
      if ($invoice_num == 0) {

      ?>
        <div class="col-12 text-center bg-body" style="height: 450px;">
          <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
            You have not purchased any item yet...
          </span>
        </div>
      <?php

      } else {
      ?>

        <div class="table-responsive">
          <table class="table text-center p-3">
            <thead>
              <tr class="bg-primary" style="font-family: Georgia, 'Times New Roman', Times, serif;">
                <th class="bg-primary-subtle" style="font-family: Georgia, 'Times New Roman', Times, serif;" scope="col">#</th>
                <th class="bg-primary-subtle" style="font-family: Georgia, 'Times New Roman', Times, serif;" scope="col">Order Details</th>
                <th class="bg-primary-subtle" style="font-family: Georgia, 'Times New Roman', Times, serif;" scope="col">Order ID</th>
                <th class="bg-primary-subtle" style="font-family: Georgia, 'Times New Roman', Times, serif;" scope="col">Total Cost</th>
                <th class="bg-primary-subtle" style="font-family: Georgia, 'Times New Roman', Times, serif;" scope="col">Purchased Date & Time</th>

              </tr>
            </thead>
            <?php

            for ($x = 0; $x < $invoice_num; $x++) {
              $invoice_data = $invoice_rs->fetch_assoc();
            ?>
              <tbody>
                <tr>
                  <th style="background-color:#E0FFFF;" scope="row"><?php echo $invoice_data["id"]; ?></th>
                  <?php
                  $pid = $invoice_data["product_id"];
                  $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "' ");
                  $image_data = $image_rs->fetch_assoc();
                  ?>
                  <td class="">
                    <div class="row mt-3">
                      <div class="col-12 col-lg-4">
                        <img src="<?php echo $image_data["img_path"]; ?>" width="100" height="100" class="rounded-circle" alt="Cinque Terre"><br>
                        <div class="mt-3">
                          <button data-bs-toggle="modal" data-bs-target="#myModal" type="button" class="btn btn-success px-3" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">Feedback</button>
                          <button class="btn btn-dark px-4" onclick="removeFromPurchasedHistory(<?php echo $invoice_data['id']; ?>);">Delete</button>
                        </div>

                      </div>
                      
                      <?php
                      $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                      $product_data = $product_rs->fetch_assoc();

                      $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "' ");
                      $seller_data = $seller_rs->fetch_assoc();
                      ?>
                      <div class="col-12 col-lg-8 text-lg-start">

                        <div class="col-12 fs-4" style="font-family: Georgia, 'Times New Roman', Times, serif;"><?php echo $product_data["title"]; ?></div>
                        <div class="col-12 text-danger
                        mt-3">LKR <strong class="fs-4"><?php echo $product_data["price"]; ?></strong> .00</div>
                        <div class="col-12 text-lg-start">Quantity: <strong><?php echo $invoice_data["qty"]; ?></strong></div>
                        <!-- <div class="col-12 text-lg-start">Seller: <strong><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></strong></div> -->

                      </div>
                    </div>
                  </td>
                  <td class="bg-dark-subtle"><?php echo $invoice_data["order_id"]; ?></td>
                  <td>LKR <?php echo $invoice_data["total"]; ?> .00</td>
                  <td class="bg-dark-subtle"><?php echo $invoice_data["date"]; ?></td>

                </tr>

              </tbody>
            <?php

            }
            ?>
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
                                        <input type="text" class="form-control" id="mail" value="<?php echo $mail; ?>" disabled/>
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


          </table>
        </div>
    </div>

  <?php
      }
  ?>


<?php

  }
?>


<script src="script.js"></script>
<script src="bootstrap.js"></script>
<script src="bootstrap.bundle.js"></script>
</body>

</html>