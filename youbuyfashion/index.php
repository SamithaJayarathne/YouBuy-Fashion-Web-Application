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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Aclonica&family=Audiowide&family=Belanosima&family=Kaisei+Tokumin&family=Poppins:wght@200&family=Wellfleet&family=Ysabeau+Infant:wght@200&display=swap" rel="stylesheet">
    <title>YouBuy Fashion</title>
</head>


<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 d-none d-lg-block indexbg ">
            </div>


            <!-- sinup box -->
            <div class="col-12 col-lg-5" id="SignUpBox">

                <img src="resources/youbuy3.png" class="col-6 img-fluid mx-auto d-block" alt="" srcset="">

                <div class="col-12 d-none" id="msgdiv">
                    <div class="alert alert-danger alert-dismissible fade show text-center fw-bold" role="alert" id="msg">

                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">First Name</label>
                    <input class="form-control" type="text" placeholder="ex:Martin" id="fname" />
                </div>
                <div class="col-12">
                    <label class="form-label">Last Name</label>
                    <input class="form-control" type="text" placeholder="ex:Guptil" id="lname" />

                </div>
                <div class="col-12">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="email" placeholder="ex:martin@gmail.com" id="email" />
                </div>

                <div class="col-12">
                    <label class="form-label">Password</label>
                    <input class="form-control" type="password" placeholder="***********" id="password" />

                </div>

                <div class="col-12">
                    <label class="form-label">Mobile</label>
                    <input class="form-control" type="text" placeholder="0700000000" id="mobile" />

                </div>
                <div class="col-12">
                    <label class="form-label">Gender</label>
                    <select class="form-select text-center" id="gender" aria-label="Default select example">
                        <option value="0" class="slct-txt">Select Your Gender</option>

                        <?php
                        require "connection.php";

                        $gender_rs = Database::search("SELECT * FROM `gender`");
                        $gender_num = $gender_rs->num_rows;

                        for ($x = 0; $x < $gender_num; $x++) {
                            $gender_data = $gender_rs->fetch_assoc();

                        ?>

                            <option class="slct-txt" value="<?php echo $gender_data["id"]; ?>" class="bg-light"><?php echo $gender_data["gender_name"]; ?></option>

                        <?php

                        }

                        ?>




                    </select>

                </div><br>

                <div class="modal fade" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <span class="p-3 text-center m-auto">
                                <strong class="fw-bold text-center terms-txt">Privacy Policy and Terms of Service</strong>
                                <br>
                                <hr>
                                Welcome to YouBuy Fashion! We are committed to ensuring the utmost transparency, security, and convenience in your shopping experience. Our Privacy Policy is designed to explain how we collect, use, disclose, and safeguard your personal information. We respect your privacy and will never sell or share your data with third parties without your consent. We utilize the latest industry-standard security measures to protect your information from unauthorized access. <br><br>

                                By using our website and services, you agree to adhere to our Terms of Service. These terms govern various aspects of your interactions with YouBuy Fashion, including but not limited to order placement, payment processing, returns, and customer support. It's important to read and understand our Terms of Service to ensure a smooth and satisfying shopping experience. <br><br>

                                If you have any questions or concerns regarding our Privacy Policy or Terms of Service, please don't hesitate to contact our dedicated customer support team. We value your trust and are committed to providing you with top-quality fashion products and exceptional service. Thank you for choosing YouBuy Fashion as your fashion destination!
                            </span><br><br>
                            <button class="btn btn-warning m-3">Contact Us</button>



                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-11">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="terms">
                            <label class="form-check-label" for="terms">
                                <p>I agree to <a href="#" class="text-decoration-none link-danger fw-bold" style="color: #191970;" data-bs-toggle="modal" data-bs-target="#myModal">privacy policy & terms</a></p>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-lg-1 lg-text-end text-center">
                        <a href="home.php"><i class="bi bi-arrow-right-circle"></i></a>
                    </div>
                </div>



                <br>

                <div class="col-12 col-lg-6 d-grid mx-auto">
                    <button class="btn btn-dark text-white" onclick="signUp();"> Sign Up</button>
                </div><br>

                <p class="text-center">Already have an account <a href="#" class="text-decoration-none link-danger fw-bold" onclick="ChangeView();">Sign in</a></p>







            </div>
            <!-- signup box -->
            <!-- signin box -->
            <div class="col-12 col-lg-5 d-none mt-5" id="SignInBox">
                <div class="row">
                    <img src="resources/youbuy.png" class="col-6 img-fluid mx-auto d-block" alt="" srcset="">
                    <div class="col-12">
                        <p class="title01 fw-bold text-dark mt-5">Sign in to your account !</p>
                    </div>

                    <?php
                    $email = "";
                    $password = "";

                    if (isset($_COOKIE["email"])) {
                        $email = $_COOKIE["email"];
                    }

                    if (isset($_COOKIE["password"])) {
                        $password = $_COOKIE["password"];
                    }
                    ?>

                    <div class="col-12 mt-3">
                        <label class="form-label">Email</label>
                        <input class="form-control" type="email" placeholder="ex:martin@gmail.com" id="email2" value="<?php echo $email; ?>" />
                    </div><br>

                    <div class="col-12 ">
                        <label class="form-label">Password</label>
                        <input class="form-control" type="password" placeholder="***********" id="password2" value="<?php echo $password; ?>" />

                    </div>


                    <div class="row mt-1">
                        <div class="col-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                <label class="form-check-label" for="rememberme">
                                    Remember me
                                </label>
                            </div>

                        </div>

                        <div class="col-6 text-end">
                            <a href="#" class="text-decoration-none link-danger text-end" onclick="forgotPassword();">Forgotten password?</a>
                        </div><br>


                        <br>

                        <div class="col-12 d-grid mx-auto my-auto  mb-3 mt-3">
                            <button class="btn text-white fs-6 btn1" style="background-color: #4F7942;" onclick="signin();"> Sign In</button>
                        </div>

                        <div class="col-12 d-grid mx-auto my-auto">
                            <button class="btn btn-dark" onclick="ChangeView();"> Sign Up</button>
                        </div>




                    </div>









                </div>
                <!-- signin box -->

            </div>
        </div>

        <!-- modal -->
        <div class="modal fade" tabindex="-1" id="forgotPasswordModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-3">
                        <h5 class="modal-title">Forgot Password?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-6">
                                <label class="form-label">New Password</label>
                                <div class="input-group mb-3 outline-warning">
                                    <input type="password" class="form-control" id="np" />
                                    <button class="btn btn-outline-warning" type="button" id="npb" onclick="showPassword();">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Retype New Password</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="rnp" />
                                    <button class="btn btn-outline-warning" type="button" id="rnpb" onclick="showPassword2();">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Verifiction Code</label>
                                <input type="text" class="form-control" id="vc" />
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-warning" onclick="resetPassword();">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal -->

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="script.js"></script>
        <script src="bootstrap.bundle.js"></script>
        <script src="bootstrap.js"></script>
</body>

</html>