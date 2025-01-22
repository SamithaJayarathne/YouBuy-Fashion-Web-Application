<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {
  $user = $_SESSION["u"]["email"];
}


?>


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
  <title>YouBuy Fashion | Home</title>
</head>

<body style="position: relative;" data-spy="scroll" data-target="#scrollnavbar">

  <?php include "header.php"; ?>

  <!-- carousel -->
  <div id="carouselExampleFade" class="carousel col-12 slide carousel-fade " data-bs-ride="carousel">
    <div class="carousel-inner">

      <div class="carousel-item active" data-bs-interval="3000">
        <img src="resources/c1.png" class="d-block w-100" alt="...">

      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img src="resources/c2.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item" data-bs-interval="3000">
        <img src="resources/c3.jpg" class="d-block w-100" alt="...">
      </div>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
  <br><br>


  <!-- carousel -->

  <!-- Trending Product -->
  <div class="container">
    <span class="text-center mt-5 mb-3 fs-1" style="font-family: Georgia, 'Times New Roman', Times, serif;">What's Trending</span>
    <div class="row">
      <?php
      $rs = Database::search("SELECT product.id, product.title, SUM(order_item.oi_qty) AS `total_sold` FROM order_item 
      INNER JOIN product ON order_item.product_product_id=product.id GROUP BY product.id,product.title ORDER BY 
      `total_sold` DESC LIMIT 5");
      $num = $rs->num_rows;

      for ($i = 0; $i < $num; $i++) {
        $d = $rs->fetch_assoc();
        $top_rs = Database::search("SELECT * FROM `product` INNER JOIN `product_img` ON product.id=product_img.product_id WHERE product.id='" . $d["id"] . "'");
        $top_num = $top_rs->num_rows;
        $top_data = $top_rs->fetch_assoc();
      ?>
        <div class="card col-12 col-lg-2 mt-2 mb-2 mx-2 p-3" style="width: 15rem;">
          <!-- Sale badge-->
          <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
          <?php



          ?>
          <a href="<?php echo "singleProductView.php?id=" . ($top_data["id"]); ?>">
            <img id="zoomButton" src="<?php echo $top_data["img_path"]; ?> " class="card-img" alt="...">
          </a>
          <div class="card-body">

            <span class="card-text text-danger">LKR <span class="fs-3 fw-bold"><?php echo $top_data["price"]; ?></span> .00</span><br />
            <h5 class="card-title fw-bold"><?php echo $top_data["title"] ?></h5>
            <div class="row justify-content-center p-3">

            </div>

            <div class="row justify-content-center">

            </div>
          </div>
          <div class="row p-2">
          <button class=" col-12  btn-cart" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                  <hr>
                  <button class=" col-12 btn btn-dark" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">Add to Watchlist</button>
          </div>

        </div>
      <?php

      }

      ?>
    </div>
  </div>

  <!-- Trending Product -->


  <div class="container-fluid">
    <div class="row">
      <span class="text-center mt-5 mb-3 fs-1" style="font-family: Georgia, 'Times New Roman', Times, serif;" id="categories">Categories</span>


      <!-- categories -->
      <?php
      $c_rs = Database::search("SELECT * FROM `category`");
      $c_num = $c_rs->num_rows;

      for ($y = 0; $y < $c_num; $y++) {

        $c_data = $c_rs->fetch_assoc();
      ?>
        <div class="col-12 col-lg-3 gap-3 mt-3">
          <div class="image-container">

            <img src="<?php echo $c_data["cat_img_path"] ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <div class="overlay">
                <a href="<?php echo "searchByCat.php?id=" . ($c_data["cat_id"]); ?>" class="text-decoration-none text-white">
                  <p style="font-family: Georgia, 'Times New Roman', Times, serif;" class="border border-white p-4 text-decoration-none"><?php echo $c_data["cat_name"] ?></p>
                </a>

              </div>
            </div>
          </div>
        </div>
      <?php

      }

      ?>










      <!-- categories -->
      <div class="row" id="about">
        <div class="offset-2 col-8  col-lg-8 text-center mt-5 mb-5">
          <a href="products.php" class="text-decoration-none link-dark">Shop More</a>
        </div>
      </div>
      <hr>



      <!-- blogs -->
      <div id="blogs" class="mt-5 text-center">
        <span class="text-center mt-5 mb-3 fs-1" style="font-family: Georgia, 'Times New Roman', Times, serif;">Blogs</span>

        <div class="row justify-content-center p-3 mb-3">
          <div class="col-12 col-lg-3 mb-3 mx-5">
            <div class="card" style="width: 25rem;">
              <img src="resources/bg4.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center fw-bold">Fashion Essentials: Must-Have Items for Every Wardrobe</h5>
                <p class="card-text text-center">Discover versatile fashion essentials like the white button-down, little black dress, and classic jeans on our app, creating endless stylish possibilities.</p>
              </div>
            </div>
          </div><br>
          <div class="col-12 col-lg-3 mb-3 mx-5">
            <div class="card" style="width: 25rem;">
              <img src="resources/bg10.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center fw-bold">Fashion Forward: The Evolution of Sustainable Fashion</h5>
                <p class="card-text text-center">Join the sustainable fashion movement through our app, finding eco-friendly options, ethical brands, and tips to make a positive impact on the environment.</p>
              </div>
            </div>
          </div><br>
          <div class="col-12 col-lg-3 mb-3 mx-5">
            <div class="card" style="width: 25rem;">
              <img src="resources/bg7.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center fw-bold">Unlocking Style: How to Find Your Personal Fashion Identity</h5>
                <p class="card-text text-center">Unearth your unique style through our app's diverse fashion options, tools for wardrobe curation, and inspirational user stories.</p>
              </div>
            </div>
          </div>

        </div><br>
        <div class="row justify-content-center p-3 mb-3">

          <div class="col-12 col-lg-3 mb-3 mx-5">
            <div class="card" style="width: 25rem;">
              <img src="resources/bg11.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center fw-bold">The Art of Wardrobe Remix: Creating Fresh Looks with Existing Pieces</h5>
                <p class="card-text text-center">Elevate your style game by learning the art of wardrobe remix. Discover how to breathe new life into your existing pieces and create fresh, unique looks that reflect your personal style using our fashion shopping web app's versatile options and styling tips.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3 mx-5">
            <div class="card" style="width: 25rem;">
              <img src="resources/bg8.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center fw-bold">Fashion on a Budget: Stylish Choices That Won't Break the Bank</h5>
                <p class="card-text text-center">Style doesn't have to come at a high cost. Explore affordable yet trendy fashion choices on our app, where you can curate a budget-friendly wardrobe that exudes style and confidence.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-3 mb-3 mx-5">
            <div class="card" style="width: 25rem;">
              <img src="resources/bg9.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="text-center fw-bold">Fashion for All: Inclusivity and Diversity in the Fashion World</h5>
                <p class="card-text text-center">Celebrate diversity and inclusivity in fashion with our app's wide range of styles, sizes, and designers. Discover how fashion empowers individuals to express their unique identities and celebrate their authentic selves.</p>
              </div>
            </div>
          </div>
          <br>
        </div>
      </div>
      <hr>
      <!-- blogs -->

      <img src="resources/c4.jpg" alt="">



      <div class="col-12 fw-bold fs-2  mt-5 mb-5 text-center"><a class="newtxt text-decoration-none fw-bold text-dark text-center" style="font-family: Georgia, 'Times New Roman', Times, serif;">New arrivals</a></div>




      <!-- products -->

      <div class="col-12 mb-3" id="newarrivals">
        <div class="row">
          <div class="col-12">
            <div class="row justify-content-center gap-5">

              <?php

              $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 15 OFFSET 0");

              $product_num = $product_rs->num_rows;

              for ($x = 0; $x < $product_num; $x++) {
                $product_data = $product_rs->fetch_assoc();

              ?>

                <div class="card col-12 col-lg-2 mt-2 mb-2 mx-2 p-3" style="width: 15rem;">
                  <!-- Sale badge-->
                  <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">New</div>
                  <?php

                  $img_rs = Database::search("SELECT * FROM `product_img` WHERE 
                                            `product_id`='" . $product_data['id'] . "'");

                  $img_data = $img_rs->fetch_assoc();

                  ?>
                  <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">
                    <img id="zoomButton" src="<?php echo $img_data["img_path"]; ?> " class="card-img" alt="...">
                  </a>
                  <div class="card-body">

                    <span class="card-text text-danger">LKR <span class="fs-3 fw-bold"><?php echo $product_data["price"]; ?></span> .00</span><br />
                    <h5 class="card-title fw-bold"><?php echo $product_data["title"] ?></h5>
                    <div class="row justify-content-center p-3">

                    </div>

                    <div class="row justify-content-center">

                    </div>
                  </div>
                  <button class=" col-12  btn-cart" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to Cart</button>
                  <hr>
                  <button class=" col-12 btn btn-dark" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">Add to Watchlist</button>
                </div>



              <?php
              }

              ?>

            </div>

          </div>
          <!-- About us -->
          <div class="about-section paddingTB60 gray-bg mt-5" id="aboutus">

            <div class="row text-center">
              <div class=" col-sm-12 offset-lg-2 col-lg-8">
                <div class="about-title clearfix">
                  <h1>About <span class="underline-hover">YouBuy Fashion</span></h1>
                  <h3>"Stay Stylish with YouBuy Fashion – Your Trendy Fashion Destination"</h3>
                  <p class="about-paddingB">Welcome to YouBuy Fashion, where fashion meets expression. Dive into a world of endless style possibilities with our curated selection of clothing, footwear, and accessories. We're dedicated to delivering the latest trends and timeless classics, all while providing top-notch quality and a seamless shopping experience. Whether you're dressing up for a special occasion or embracing your everyday look, we're here to empower your fashion journey. Join our fashion-forward community and let your style shine. Discover the art of self-expression with every piece you choose. Shop now and make a statement, one outfit at a time. </p>
                  <p> Explore a handpicked collection of fashion must-haves, from statement pieces to everyday classics. Embrace the art of self-expression and elevate your wardrobe. Shop now and make every outfit a reflection of your unique style.</p>
                  <div class="col-12 col-md-3 col-lg-2 mx-auto mt-3">
                    <div class="row text-sm-center text-md-start">

                      <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                          <a href="https://www.facebook.com/samitha.jayarathne.9/" class="form-floting text-dark">
                            <i class="bi bi-facebook" style="font-size: 22px;"></i>
                          </a>
                        </li>

                        <li class="list-inline-item">
                          <a href="#" class="form-floting text-dark">
                            <i class="bi bi-twitter" style="font-size: 22px;"></i>
                          </a>
                        </li>

                        <li class="list-inline-item">
                          <a href="https://api.whatsapp.com/send?phone=+94704829706&text=Hello%20from%20your%20website" target="_blank" class="form-floting text-dark">
                            <i class="bi bi-whatsapp" style="font-size: 22px;"></i>
                          </a>
                        </li>

                        <li class="list-inline-item">
                          <a href="#" class="form-floting text-dark">
                            <i class="bi bi-instagram" style="font-size: 22px;"></i>
                          </a>
                        </li>

                        <li class="list-inline-item">
                          <a href="https://www.youtube.com/channel/UC4utvr3huUdpslaBNH38X3g" class="form-floting text-dark">
                            <i class="bi bi-youtube" style="font-size: 22px;"></i>
                          </a>
                        </li>
                      </ul>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 col-sm-6">
                <div class="about-img">
                  <img src="https://devitems.com/preview/appmom/img/mobile/2.png" alt="">
                </div>
              </div>
            </div>

          </div>
          <!-- About us -->

        </div>

      </div>



      <?php include "footer.php" ?>
    </div>



    <!-- products      -->



  </div>
  </div>
  </div>





  </div>

  </div>





  <script src="sweetalert2.all.min.js"></script>
  <script src="script.js"></script>
  <script src="bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/ScrollMagic.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/debug.addIndicators.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.8/plugins/animation.gsap.min.js"></script>

</body>

</html>