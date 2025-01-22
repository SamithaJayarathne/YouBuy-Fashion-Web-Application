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

    <body class="container-fluid bg-primary-subtle" onload="loadUsers(0);">
        <div class="row">
            <div class="col-12 col-lg-2 text-light text-center">
            <a href="home.php">YouBuy Fashion | Home</a>


                <div class="nav flex-column nav-pills me-3 mt-5" role="tablist" aria-orientation="vertical">
                    <nav class="nav flex-column">
                        <a class="nav-link mt-lg-3 fs-2" href="adminDashboard.php">Dashboard</a>
                        <a class="nav-link active mt-lg-3 fs-2" aria-current="page" href="adminManageUsers.php">Manage Users</a>
                        <a class="nav-link mt-lg-3 fs-2" href="addProduct.php">Manage Products</a>
                        <a class="nav-link mt-lg-3 fs-2" href="adminManageStock.php">Manage Stock</a>
                        <hr>
                        <a class="nav-link mt-lg-3 fs-2" href="adminReports.php">Reports Generator</a>
                    </nav>
                </div>
            </div>

            <div class="col-12 col-lg-10 bg-light pdiv">
                <h2 class="fw-bold mt-3 text-center">User Management</h2>

                <div class="row mt-3 justify-content-end">
                    <div class="col-8 d-none" id="msgDiv1" onclick="reload();">
                        <div class="alert alert-danger" id="msg1"></div>
                    </div>
                    <div class="col-2">
                        <input type="text" class="form-control" placeholder="User's Email" id="uemail">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-outline-dark fw-bold" onclick="updateUserStatus();">Change Status</button>
                    </div>
                </div>


                <table class="table table-hover  mt-3">
                    <thead class="fw-bold fs-5">
                        <tr>

                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>Joined Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="userTable">
                        <?php
                        
                        $rs = Database::search("SELECT * FROM `users` INNER JOIN `gender` ON users.gender_id=gender.id");
                        $num = $rs->num_rows;
                        for ($i = 0; $i < $num; $i++) {
                            $data = $rs->fetch_assoc();
                        ?>
                            <tr>

                                <td><?php echo $data["fname"] . "   " .  $data["lname"]; ?></td>
                                <td><?php echo $data["email"] ?></td>
                                <td><?php echo $data["mobile"] ?></td>
                                <td><?php echo $data["gender_name"] ?></td>
                                <td><?php echo $data["joined_date"] ?></td>
                                <td>
                                    <?php
                                    if ($data["status"] == "1") {
                                        echo("Active");
                                        
                                    } else {
                                        echo("Deactive");
                                        
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php
                        }
                        ?>



                    </tbody>

                </table>
            </div>
        </div>

        <script src="script.js"></script>
    </body>

    </html>

<?php

} else {
    echo ("You are not a valid Admin");
}

?>