<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

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
    <title>Admin SignIn | YouBuy Fashion</title>
</head>

<body>

    <div class="container-fluid dBox">
        <div class="row ">
            <div class="col-12 col-lg-5">
                
            </div>
            <div class="col-12 col-lg-7 text-center adminSignin">

                <div class="row">
                    <h2 class="fw-bold col-12" style="font-family:Georgia, 'Times New Roman', Times, serif;">SignIn to your Admin Account</h2>
                    <div class="col-8 offset-2 mt-5">
                        <input type="email" class="form-control" id="adminEmail" placeholder="Email Address :" style="font-family:Georgia, 'Times New Roman', Times, serif;">
                    </div>
                    <div class="col-8 offset-2 mt-3">
                        <input type="password" class="form-control" id="adminPw" placeholder="Password :" style="font-family:Georgia, 'Times New Roman', Times, serif;">
                    </div>
                    <div class="mt-5">
                        <button class="col-8 btn btn-dark fw-bolder" style="background-color: rgb(92, 0, 230);font-family:Georgia, 'Times New Roman', Times, serif; " onclick="adminSignin();">Sign In To Your Accound</button>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <script src="script.js"></script>
</body>

</html>