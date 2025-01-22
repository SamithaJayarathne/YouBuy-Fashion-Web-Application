<?php

session_start();
require "connection.php";

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

	<title>YouBuy Fashion | User Profile</title>
</head>

<body>
	<div class="container-fluid bg-dark-subtle">
		<div class="row">
			
			<?php

			if (isset($_SESSION["u"])) {
				$email = $_SESSION["u"]["email"];

				$details_rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON  
                                                users.gender_id=gender.id WHERE `email`='" . $email . "'");

				$image_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "'");

				$address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `city` ON  
                                                users_has_address.city_city_id=city.city_id INNER JOIN 
                                                `district` ON city.district_district_id=district.district_id 
                                                INNER JOIN `province` ON 
                                                district.province_province_id=province.province_id 
                                                WHERE `users_email`='" . $email . "'");

				$city_rs = Database::search("SELECT * FROM `city`");
				$city = $city_rs->fetch_assoc();


				$details_data = $details_rs->fetch_assoc();
				$image_data = $image_rs->fetch_assoc();
				$address_data = $address_rs->fetch_assoc();
				$name = $details_data["fname"] . " " . $details_data["lname"];

			?>
				<div class="main-body">
					<!-- Breadcrumb -->
					<nav aria-label="breadcrumb" class="main-breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="home.php">Home</a></li>

							<li class="breadcrumb-item"><a href="userProfile.php">User Profile</a></li>
							<li class="breadcrumb-item active" aria-current="page">Edit User Profile</li>
						</ol>
					</nav>
					<!-- /Breadcrumb -->
					<div class="row">
						<div class="col-lg-4">
							<div class="card">
								<div class="card-body">
									<div class="d-flex flex-column align-items-center text-center">
										<?php

										if (empty($image_data["path"])) {
										?>
											<img src="resources/user.png" alt="Admin" class="rounded-circle" width="150">
										<?php
										} else {
										?>
											<img src="<?php echo $image_data["path"]; ?>" alt="Admin" class="rounded-circle" width="150">
										<?php
										}

										?>

										<div class="mt-3">
											<h4><?php echo $name; ?></h4>
											<p class="text-secondary mb-1"><?php echo $details_data["email"]; ?></p>
											<p class="text-muted font-size-sm"><?php echo $details_data["mobile"]; ?></p>
											<input type="file" class="d-none" id="profileImage" />
                                        <label for="profileImage" class="btn btn-warning ">Update Profile Image</label>
											
										</div>
									</div>
									<hr class="my-4">
									
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							<div class="card">
								<div class="card-body">
									<div class="row mt-4">

										<div class="col-6">
											<label class="form-label">First Name</label>
											<input type="text" class="form-control" id="fname" value="<?php echo $details_data["fname"]; ?>" />
										</div>

										<div class="col-6">
											<label class="form-label">Last Name</label>
											<input type="text" class="form-control" id="lname" value="<?php echo $details_data["lname"]; ?>" />
										</div>

										<div class="col-12">
											<label class="form-label">Mobile Number</label>
											<input type="text" class="form-control" id="mobile" value="<?php echo $details_data["mobile"]; ?>" />
										</div>

										<div class="col-12">
											<label class="form-label">Password</label>
											<div class="input-group">
												<input type="password" id="pw" value="<?php echo $details_data["password"]; ?>" class="form-control" aria-describedby="pwb">
												<span class="input-group-text" id="pwb" onclick="showPassword3();"><i class="bi bi-eye-fill"></i></span>
											</div>
										</div>

										<div class="col-12">
											<label class="form-label">Email</label>
											<input type="text" class="form-control" id="email" value="<?php echo $email; ?>" />
										</div>

										<div class="col-12">
											<label class="form-label">Registered Date</label>
											<input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"]; ?>" />
										</div>

										<?php

										if (empty($address_data["line1"])) {
										?>
											<div class="col-12">
												<label class="form-label">Address Line 01</label>
												<input type="text" id="line1" class="form-control" placeholder="Enter Address Line 01" />
											</div>
										<?php
										} else {
										?>
											<div class="col-12">
												<label class="form-label">Address Line 01</label>
												<input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
											</div>
										<?php
										}

										if (empty($address_data["line2"])) {
										?>
											<div class="col-12">
												<label class="form-label">Address Line 02</label>
												<input type="text" id="line2" class="form-control" placeholder="Enter Address Line 02" />
											</div>
										<?php
										} else {
										?>
											<div class="col-12">
												<label class="form-label">Address Line 02</label>
												<input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"]; ?>" />
											</div>
										<?php
										}

										$province_rs = Database::search("SELECT * FROM `province`");
										$district_rs = Database::search("SELECT * FROM `district`");
										$city_rs = Database::search("SELECT * FROM `city`");

										$province_num = $province_rs->num_rows;
										$district_num = $district_rs->num_rows;
										$city_num = $city_rs->num_rows;

										?>

										<div class="col-6">
											<label class="form-label">Province</label>
											<select class="form-select" id="province">
												<option value="0">Select Province</option>
												<?php

												for ($x = 0; $x < $province_num; $x++) {
													$province_data = $province_rs->fetch_assoc();
												?>
													<option value="<?php echo $province_data["province_id"]; ?>" <?php
																													if (!empty($address_data["province_province_id"])) {
																														if ($province_data["province_id"] == $address_data["province_province_id"]) {
																													?> selected <?php
																															}
																														}
																																?>>
														<?php echo $province_data["province_name"]; ?>
													</option>
												<?php
												}

												?>

											</select>
										</div>

										<div class="col-6">
											<label class="form-label">District</label>
											<select class="form-select" id="district">
												<option value="0">Select District</option>


												<?php

												for ($x = 0; $x < $district_num; $x++) {
													$district_data = $district_rs->fetch_assoc();
												?>
													<option value="<?php echo $district_data["district_id"]; ?>" <?php
																													if (!empty($address_data["district_id"])) {
																														if ($district_data["district_id"] == $address_data["district_id"]) {
																													?> selected <?php
																															}
																														}
																																?>>
														<?php echo $district_data["district_name"]; ?>
													</option>
												<?php
												}

												?>
											</select>
										</div>

										<div class="col-6">
											<label class="form-label">City</label>
											<select class="form-select" id="city">
												<option value="0">Select City</option>

												<?php

												for ($x = 0; $x < $city_num; $x++) {
													$city_data = $city_rs->fetch_assoc();
												?>
													<option value="<?php echo $city_data["city_id"]; ?>" <?php
																											if (!empty($address_data["city_id"])) {
																												if ($city_data["city_id"] == $address_data["city_id"]) {
																											?> selected <?php
																													}
																												}
																														?>>
														<?php echo $city_data["city_name"]; ?>
													</option>
												<?php
												}

												?>

											</select>
										</div>

										<?php

										if (empty($address_data["postal_code"])) {
										?>
											<div class="col-6">
												<label class="form-label">Postal Code</label>
												<input type="text" id="pc" class="form-control" placeholder="Enter Your Postal Code" />
											</div>
										<?php
										} else {
										?>
											<div class="col-6">
												<label class="form-label">Postal Code</label>
												<input type="text" id="pc" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
											</div>
										<?php
										}

										?>



										<div class="col-12">
											<label class="form-label">Gender</label>
											<input type="text" class="form-control" readonly value="<?php echo $details_data["gender_name"]; ?>" />
										</div><hr class="mt-3">

										<div class="col-12 offset-lg-2 col-lg-8 d-grid mt-2">
											<button class="btn" style="background: #1D2B64;  
    										background: -webkit-linear-gradient(to right, #F8CDDA, #1D2B64); 
    										background: linear-gradient(to right, #F8CDDA, #1D2B64); " 
											onclick="updateProfile();"><span class="fw-bold text-light fs-5">Update My Profile</span></button>
										</div>

									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
			<?php
			}

			?>







			<?php include "footer.php" ?>
		</div>
	</div>







	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="script.js"></script>
	<script src="bootstrap.js"></script>
</body>

</html>