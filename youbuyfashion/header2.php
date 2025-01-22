<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bootstrap.css">
  <link rel="shortcut icon" href="resources/icon.png" type="image/x-icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
  <title>Document</title>
</head>

<body>

  <!--navbar-->
  
  <nav class="navbar  navbar-expand-lg fixed-top  blurred-navbar" id="scrollnavbar">





    <div class="container-fluid" style="font-family: Georgia, 'Times New Roman', Times, serif;">

      <div class="navbar-brand" style="font-family: Georgia, 'Times New Roman', Times, serif;">
        <?php
        if (isset($_SESSION["u"])) {
          $session_data = $_SESSION["u"];
          $uname = $session_data["fname"] . " " . $session_data["lname"];
        ?>
          <span>
            <h5 style="font-family: Georgia, 'Times New Roman', Times, serif;">Hello, <b><?php echo ($uname); ?></b> !</h5>
          </span>


        <?php

        } else {
        ?><a class="text-decoration-none" href="index.php"><b class="text-primary fw-bold fs-5"><?php echo ("Sign in or Register"); ?></b></a><?php
                                                                                                                                            }
                                                                                                                                              ?>
      </div>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>


        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 " >
            <li class="nav-item">
              <a class="nav-link active underline-hover" style="font-family: Georgia, 'Times New Roman', Times, serif;" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link underline-hover" style="font-family: Georgia, 'Times New Roman', Times, serif;" href="#blogs">Blogs</a>
            </li>
            <li class="nav-item">
              <a class="nav-link underline-hover" style="font-family: Georgia, 'Times New Roman', Times, serif;" href="#newarrivals">New arrivals</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" style="font-family: Georgia, 'Times New Roman', Times, serif;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                More
              </a>
              <ul class="dropdown-menu bg-warning-subtle fw-bold" style="font-family: Georgia, 'Times New Roman', Times, serif;">
                <li><a class="dropdown-item" href="index.php">Sign in | Sign up</a></li>
                <li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="addProduct.php">Add New Product</a></li>
                <li><a class="dropdown-item" href="#">My Products</a></li>
                <li><a class="dropdown-item" href="#">My Selling</a></li>
                <li><a class="dropdown-item" href="#">Puchased History</a></li>
                <li><a class="dropdown-item" href="#">Massages</a></li>
                <li><a class="dropdown-item" href="watchlist.php">Watchlist</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><button class="g-3 btn btn-danger" onclick="signout();">Sign Out</button></li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link underline-hover" style="font-family: Georgia, 'Times New Roman', Times, serif;" href="#aboutus">About Us</a>
            </li>&nbsp;
            <?php
            if (isset($_SESSION["u"])) {
            ?>
              <li class="nav-item">


                <a class="nav-link" href="cart.php"><i class="bi bi-cart-fill fs-5"><span class=" position-absolute  start-95 translate-middle badge rounded-pill bg-danger">

                      <?php

                      $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email`='" . $user . "'");
                      $cart_num = $cart_rs->num_rows;
                      for ($x = 0; $x < $cart_num; $x++) {
                        $cart_data = $cart_rs->fetch_assoc();
                      }
                      echo $cart_num;

                      ?>
                      <span class="visually-hidden">unread messages</span>
                    </span>
                  </i></a>
              </li>

            <?php
            } else {
            ?>
              <li class="nav-item">


                <a class="nav-link" href="cart.php"><i class="bi bi-cart-fill fs-5">





                  </i></a>
              </li>
            <?php
            }
            ?>


          </ul>


        </div>

      </div>
    </div>
  </nav>
  <!--navbar-->




  <script src="script.js"></script>
  <script src="bootstrap.js"></script>
  <script src="bootstrap.bundle.js"></script>
</body>

</html>