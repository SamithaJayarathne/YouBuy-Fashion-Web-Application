document.addEventListener("DOMContentLoaded", function () {
    // Create a new ScrollMagic controller
    var controller = new ScrollMagic.Controller();

    // Create a TweenMax animation for the "About Me" section (you can customize this animation)
    var aboutMeTween = TweenMax.from("#about", 1, { opacity: 0, y: 50 });

    // Create a scene that triggers the animation when the "About Me" section enters the viewport
    var aboutMeScene = new ScrollMagic.Scene({
        triggerElement: "#about",
        triggerHook: 0.8, // Adjust the trigger point as needed
        reverse: false, // Set to true if you want the animation to reverse when scrolling up
    })
        .setTween(aboutMeTween)
        .addTo(controller);
});


function ChangeView() {
    var SignUpBox = document.getElementById("SignUpBox");
    var SignInBox = document.getElementById("SignInBox");

    SignUpBox.classList.toggle("d-none");
    SignInBox.classList.toggle("d-none");

}

function signUp() {

    var fn = document.getElementById("fname");
    var ln = document.getElementById("lname");
    var e = document.getElementById("email");
    var pw = document.getElementById("password");
    var m = document.getElementById("mobile");
    var g = document.getElementById("gender");
    var term = document.getElementById("terms");

    var f = new FormData();
    f.append("fname", fn.value);
    f.append("lname", ln.value);
    f.append("email", e.value);
    f.append("password", pw.value);
    f.append("mobile", m.value);
    f.append("gender", g.value);
    f.append("terms", term.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            // alert("ok");

            if (t == "success") {

                Swal.fire({
                    title: "Good job!",
                    text: "Registered Successfully",
                    icon: "success"
                  });

                // document.getElementById("msg").innerHTML = t;
                // document.getElementById("msg").className = "alert alert-succes";
                // document.getElementById("msgdiv").className = "d-block";

            } else {

                // document.getElementById("msg").innerHTML = t;
                // document.getElementById("msgdiv").className = "d-block";
                Swal.fire({
                    title: "Oops!",
                    text: t,
                    icon: "warning"
                  });

            }

        }
    }

    r.open("POST", "signUpProcess.php", true);
    r.send(f);

}

function signin() {
    var email = document.getElementById("email2");
    var password = document.getElementById("password2");
    var rememberme = document.getElementById("rememberme");


    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);
    f.append("r", rememberme.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                Swal.fire({
                    title: "Loggin Successfull",
                    
                    icon: "success"
                });
                setTimeout(function () {
                    window.location = "home.php";
                }, 2000);
                
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "signinProcess.php", true);
    r.send(f);
}
var bm;
function forgotPassword() {


    var email = document.getElementById("email2");

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;
            if (t == "success") {

                var m = document.getElementById("forgotPasswordModal");
                bm = new bootstrap.Modal(m);
                bm.show();

            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
    r.send();

}

function resetPassword() {

    var email = document.getElementById("email2");
    var np = document.getElementById("np");
    var rnp = document.getElementById("rnp");
    var vc = document.getElementById("vc");

    var f = new FormData();
    f.append("e", email.value);
    f.append("np", np.value);
    f.append("rnp", rnp.value);
    f.append("vc", vc.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "success") {

                bm.hide();
                Swal.fire({
                    title: "Loggin Successfull",
                    
                    icon: "success"
                });
                setTimeout(function () {
                    window.reload();
                }, 2000);

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "resetPasswordProcess.php", true);
    r.send(f);

}

function showPassword() {

    var np = document.getElementById("np");
    var npb = document.getElementById("npb");

    if (np.type == "password") {
        np.type = "text";
        npb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        np.type = "password";
        npb.innerHTML = '<i class="bi bi-eye"></i>';
    }

}

function showPassword2() {

    var rnp = document.getElementById("rnp");
    var rnpb = document.getElementById("rnpb");

    if (rnp.type == "password") {
        rnp.type = "text";
        rnpb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        rnp.type = "password";
        rnpb.innerHTML = '<i class="bi bi-eye"></i>';
    }

}

function signout() {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var t = r.responseText;

            if (t == "Sign out successfully") {
                
                window.location.reload();

            } else {

                alert(t);
            }
        }
    }

    r.open("GET", "signoutProcess.php", true);
    r.send();
}
function loadBrands() {

    var category = document.getElementById("category").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("brand").innerHTML = t;
        }
    }

    r.open("GET", "loadBrandProcess.php?c=" + category, true);
    r.send();

}


function loadModels() {

    var brand = document.getElementById("brand").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("model").innerHTML = t;
        }
    }

    r.open("GET", "loadModelProcess.php?d=" + brand, true);
    r.send();

}




function changeProductImage() {

    var images = document.getElementById("imageuploader");

    images.onchange = function () {

        var file_count = images.files.length;

        if (file_count <= 3) {

            for (var x = 0; x < file_count; x++) {
                var file = this.files[x];
                var url = window.URL.createObjectURL(file);
                document.getElementById("i" + x).src = url;
            }

        } else {
            alert(file_count + " files uploaded. You are proceed to upload 03 or less than 03 files.");
        }

    }

}

function addModel() {
    var model = document.getElementById("newModel");
    var gender = document.getElementById("mgender");

    var f = new FormData();
    f.append("m", model.value);
    f.append("g", gender.value);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var response = r.responseText;
            if(response == "success"){
                Swal.fire({
                    title: "Model Added Successfully",
                
                    icon: "success"
                  });
                  setTimeout(function () {
                    window.reload();
                }, 2000);
            }else{
                Swal.fire({
                    title: response,
                    
                    icon: "warning"
                  });
                  setTimeout(function () {
                    window.reload();
                }, 3000);
            }


        }
    }

    r.open("POST", "addModelProcess.php", true);
    r.send(f);
}

function addProduct() {

    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var model = document.getElementById("model");
    var title = document.getElementById("title");
    var size = document.getElementById("size");
    var clr = document.getElementById("clr");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwc = document.getElementById("dwk");
    var doc = document.getElementById("dok");
    var desc = document.getElementById("desc");
    var image = document.getElementById("imageuploader");

    var f = new FormData();
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("m", model.value);
    f.append("t", title.value);
    f.append("sz", size.value);
    f.append("col", clr.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwk", dwc.value);
    f.append("dok", doc.value);
    f.append("desc", desc.value);

    var file_count = image.files.length;
    for (var x = 0; x < file_count; x++) {
        f.append("img" + x, image.files[x]);
    }

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}

function updateProfile() {


    var profile_img = document.getElementById("profileImage");
    var first_name = document.getElementById("fname");
    var last_name = document.getElementById("lname");
    var mobile_no = document.getElementById("mobile");
    var password = document.getElementById("pw");
    var email_address = document.getElementById("email");
    var address_line_1 = document.getElementById("line1");
    var address_line_2 = document.getElementById("line2");
    var province = document.getElementById("province");
    var district = document.getElementById("district");
    var city = document.getElementById("city");
    var postal_code = document.getElementById("pc");

    var f = new FormData();
    f.append("img", profile_img.files[0]);
    f.append("fn", first_name.value);
    f.append("ln", last_name.value);
    f.append("mn", mobile_no.value);
    f.append("pw", password.value);
    f.append("ea", email_address.value);
    f.append("al1", address_line_1.value);
    f.append("al2", address_line_2.value);
    f.append("p", province.value);
    f.append("d", district.value);
    f.append("c", city.value);
    f.append("pc", postal_code.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            if (t == "success") {
                Swal.fire({
                    title: "Updated Successfully",
                    
                    icon: "success"
                  });
                  setTimeout(function () {
                    reload();
                }, 2000);
                // window.location = "home.php";
            } else {
                Swal.fire({
                    title: t,
                    
                    icon: "warning"
                  });
                  
            }

        }
    }

    r.open("POST", "userProfileUpdateProcess.php", true);
    r.send(f);

}
function showPassword3() {

    var pw = document.getElementById("pw");
    var pwb = document.getElementById("pwb");

    if (pw.type == "password") {
        pw.type = "text";
        pwb.innerHTML = '<i class="bi bi-eye-slash-fill"></i>';
    } else {
        pw.type = "password";
        pwb.innerHTML = '<i class="bi bi-eye-fill"></i>';
    }

}
function loadDistricts() {
    var brand = document.getElementById("province").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;

            document.getElementById("district").innerHTML = t;
        }
    }

    r.open("GET", "loadDistrictProcess.php?d=" + brand, true);
    r.send();
}

function addToCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "This Product Already Exists In The Cart") {
                alert("This Product Already Exists In The Cart");
            } else if (t == "Product Added") {
                alert("Product Added");
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "addToCartProcess.php?id=" + id, true);
    r.send();

}
function removeFromCart(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "deleted") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    }

    r.open("GET", "removeFromCartProcess.php?id=" + id, true);
    r.send();

}
function addToWatchlist(id) {

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Added") {
                alert("Product added to the watchlist successfully.");
                window.location.reload();
            } else if (t == "Removed") {
                alert("Product removed from watchlist successfully.");
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "addWatchListProcess.php?id=" + id, true);
    r.send();

}

function removeFromWatchlist(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeFromWatchListProcess.php?id=" + id, true);
    r.send();
}
function qty_inc(qty) {

    var input = document.getElementById("qty_input");

    if (input.value < qty) {

        var new_value = parseInt(input.value) + 1;
        input.value = new_value;

    } else {

        alert("You have reched to the Maximum");
        input.value = qty;

    }

}

function qty_dec() {
    var input = document.getElementById("qty_input");

    if (input.value > 1) {

        var new_value = parseInt(input.value) - 1;
        input.value = new_value;

    } else {

        alert("You have reched to the Minimum");
        input.value = 1;

    }
}

function check_value(qty) {

    var input = document.getElementById("qty_input");

    if (input.value < 1) {
        alert("You must add 1 or more");
        input.value = 1;
    } else if (input.value > qty) {
        alert("Insufficieant quantity");
        input.value = qty;
    }

}
function changeMainImg(id) {

    var sample_img = document.getElementById("product_img" + id).src;
    var main_img = document.getElementById("mainImg");

    main_img.style.backgroundImage = "url(" + sample_img + ")";

}

function paynow(pid) {

    var qty = document.getElementById("qty_input").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            var umail = obj["umail"];
            var amount = obj["amount"];

            if (t == "address error") {
                alert("Please Update Your Profile.");
                window.location = "userProfile.php";
            } else {

                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);

                    saveInvoice(orderId, pid, umail, amount, qty);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1223969",    // Replace your Merchant ID
                    "return_url": "http://http://localhost/youbuyfashion/singleProductView.php?id=" + pid,     // Important
                    "cancel_url": "http://http://localhost/youbuyfashion/singleProductView.php?id=" + pid,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["item"],
                    "amount": amount,
                    "currency": "LKR",
                    "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": umail,
                    "phone": obj["mobile"],
                    "address": obj["address"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["address"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };

            }
        }
    }

    r.open("GET", "payNowProcess.php?id=" + pid + "&qty=" + qty, true);
    r.send();

}

function saveInvoice(orderId, pid, umail, amount, qty) {

    var f = new FormData();
    f.append("o", orderId);
    f.append("i", pid);
    f.append("m", umail);
    f.append("a", amount);
    f.append("q", qty);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {

                window.location = "invoice.php?id=" + orderId;

            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveInvoice.php", true);
    r.send(f);

}

function printInvoice() {
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("page").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}

function basicSearch(x) {

    var text = document.getElementById("kw").value;
    var select = document.getElementById("c").value;

    var f = new FormData();
    f.append("t", text);
    f.append("s", select);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "basicSearchProcess.php", true);
    r.send(f);
}
function advancedSearch(x) {

    var txt = document.getElementById("t");
    var category = document.getElementById("c1");
    var brand = document.getElementById("b1");
    var model = document.getElementById("m");
    var condition = document.getElementById("c2");
    var color = document.getElementById("c3");
    var from = document.getElementById("pf");
    var to = document.getElementById("pt");
    var sort = document.getElementById("s");

    var f = new FormData();

    f.append("t", txt.value);
    f.append("cat", category.value);
    f.append("b", brand.value);
    f.append("mo", model.value);
    f.append("con", condition.value);
    f.append("col", color.value);
    f.append("pf", from.value);
    f.append("pt", to.value);
    f.append("s", sort.value);
    f.append("page", x);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("basicSearchResult").innerHTML = t;
        }
    }

    r.open("POST", "advancedSearchProcess.php", true);
    r.send(f);

}
var m;
function addFeedback(id) {

    var feedbackModal = document.getElementById("myModal" + id);
    m = new bootstrap.Modal(feedbackModal);
    m.show();
}

function saveFeedback(id) {
    alert("ok");

    var type;

    if (document.getElementById("type1").checked) {
        type = 1;
    } else if (document.getElementById("type2").checked) {
        type = 2;
    } else if (document.getElementById("type3").checked) {
        type = 3;
    }

    var feedback = document.getElementById("feed");

    var f = new FormData();
    f.append("pid", id);
    f.append("t", type);
    f.append("feed", feedback.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "1") {
                alert("Thank You for the feedback")
                m.hide();
            } else {
                alert(t);
            }
        }
    }

    r.open("POST", "saveFeedbackProcess.php?id=" + id, true);
    r.send(f);

}

function removeFromPurchasedHistory(id) {
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.status == 200 && r.readyState == 4) {
            var t = r.responseText;
            if (t == "Deleted") {
                alert("Deleted From Purchased History.")
                window.location.reload();
            } else {
                alert(t);
            }

        }
    }

    r.open("GET", "removeFromPurchasedHistoryProcess.php?id=" + id, true);
    r.send();
}

function viewAllFeedback() {
    alert("ok bng");
}

function adminSignin() {
    var email = document.getElementById("adminEmail");
    var password = document.getElementById("adminPw");

    var f = new FormData();
    f.append("e", email.value);
    f.append("p", password.value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                window.location = "adminDashboard.php"
            } else {
                alert(response);
            }
        }
    }

    request.open("POST", "adminSignInProcess.php", true);
    request.send(f);



}
function updateUserStatus() {
    var email = document.getElementById("uemail");

    var f = new FormData();
    f.append("e", email.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            if (response == "Deactivated") {
                document.getElementById("msg1").innerHTML = "User Deactivated Successfully";
                document.getElementById("msg1").className = "alert alert-success";
                document.getElementById("msgDiv1").className = "d-block";

            } else if (response == "Activated") {
                document.getElementById("msg1").innerHTML = "User Activated Successfully";
                document.getElementById("msg1").className = "alert alert-success";
                document.getElementById("msgDiv1").className = "d-block";
            } else {
                document.getElementById("msg1").innerHTML = response;
                document.getElementById("msgDiv1").className = "d-block";
            }


        }
    }

    r.open("POST", "updateUserStatusProcess.php", true);
    r.send(f);


}
function reload() {
    location.reload();
}
function productReg() {
    var pname = document.getElementById("pname");
    var category = document.getElementById("category");
    var brand = document.getElementById("brand");
    var size = document.getElementById("size");
    var clr = document.getElementById("color");
    var qty = document.getElementById("qty");
    var cost = document.getElementById("cost");
    var dwk = document.getElementById("dwk");
    var dok = document.getElementById("dok");
    var desc = document.getElementById("desc");
    var file = document.getElementById("file");

    var f = new FormData();
    f.append("p", pname.value);
    f.append("ca", category.value);
    f.append("b", brand.value);
    f.append("s", size.value);
    f.append("col", clr.value);
    f.append("qty", qty.value);
    f.append("cost", cost.value);
    f.append("dwk", dwk.value);
    f.append("dok", dok.value);
    f.append("desc", desc.value);
    f.append("img", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            alert(response);
        }
    }

    r.open("POST", "registerProductProcess.php", true);
    r.send(f);
}
function addNewCat() {
    var cat = document.getElementById("newCat");

    var f = new FormData();
    f.append("c", cat.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            if (response == "success") {
                document.getElementById("m1").innerHTML = "Successfully added new Category";
                document.getElementById("m1").className = "alert alert-success";
                document.getElementById("d1").className = "d-block";


            } else {
                document.getElementById("m1").innerHTML = response;
                document.getElementById("d1").className = "d-block";
            }
        }
    }

    r.open("POST", "addNewCatProcess.php", true);
    r.send(f);

}
function addNewBrand() {
    var brand = document.getElementById("newBrand");

    var f = new FormData();
    f.append("b", brand.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            if (response == "success") {
                document.getElementById("m2").innerHTML = "Successfully added new Brand";
                document.getElementById("m2").className = "alert alert-success";
                document.getElementById("d2").className = "d-block";


            } else {
                document.getElementById("m2").innerHTML = response;
                document.getElementById("d2").className = "d-block";
            }
        }
    }

    r.open("POST", "addNewBrandProcess.php", true);
    r.send(f);

}
function addNewColor() {
    var color = document.getElementById("newColor");

    var f = new FormData();
    f.append("c", color.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            if (response == "success") {
                document.getElementById("m3").innerHTML = "Successfully added new Color";
                document.getElementById("m3").className = "alert alert-success";
                document.getElementById("d3").className = "d-block";


            } else {
                document.getElementById("m3").innerHTML = response;
                document.getElementById("d3").className = "d-block";
            }
        }
    }

    r.open("POST", "addNewColorProcess.php", true);
    r.send(f);

}
function addNewSize() {
    var size = document.getElementById("newSize");

    var f = new FormData();
    f.append("s", size.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var response = r.responseText;
            if (response == "success") {
                document.getElementById("m4").innerHTML = "Successfully added new Size";
                document.getElementById("m4").className = "alert alert-success";
                document.getElementById("d4").className = "d-block";


            } else {
                document.getElementById("m4").innerHTML = response;
                document.getElementById("d4").className = "d-block";
            }
        }
    }

    r.open("POST", "addNewSizeProcess.php", true);
    r.send(f);

}
function seeOutStock() {
    document.getElementById("table").classList.toggle("d-none");
}
function loadStock(x) {

    var page = x;

    var f = new FormData();
    f.append("p", page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            //alert(response);
            document.getElementById("tbody").innerHTML = response;
        }
    };

    request.open("POST", "loadStockProcess.php", true);
    request.send(f);

}
function changeProStatus() {
    var status = document.getElementById("bn");
    alert(status.value);
}

function blockProduct(id) {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var txt = request.responseText;
            if (txt == "blocked") {
                document.getElementById("ub" + id).innerHTML = "Unblock";
                document.getElementById("a").innerHTML = "Unavailable";
                document.getElementById("ub" + id).classList = "btn btn-success";
                window.reload();

            } else if (txt == "unblocked") {
                document.getElementById("ub" + id).innerHTML = "Block";
                document.getElementById("ua").innerHTML = "Available";
                document.getElementById("ub" + id).classList = "btn btn-danger";
                window.reload();

            } else {
                alert(txt);
            }
        }
    }

    request.open("GET", "productBlockProcess.php?id=" + id, true);
    request.send();
}


// // charts

document.addEventListener('DOMContentLoaded', function () {
    const userCtx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(userCtx, {
        type: 'doughnut',
        data: {
            labels: ['Male', 'Female'],
            datasets: [{
                label: 'Users',
                data: [0, 0], // Initial empty data
                backgroundColor: [
                    'rgba(4, 43, 192, 0.8)', // Color for AU
                    'rgba(121, 148, 249, 0.8)'  // Color for IU
                ],
                borderColor: [
                    'rgba(0, 27, 129, 0.8)', // Border color for AU
                    'rgba(66, 103, 241, 0.8)'  // Border color for IU
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });

    



    function loadCharts() {
        fetch('loadChartsProcess.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // For debugging: {: 18, iu: 3}

                // Update the chart data
                userChart.data.datasets[0].data = [data.au, data.iu];
                userChart.update();


            })
            .catch(error => console.error('Error:', error));
    }

    // Call loadCharts function to fetch data and update the chart
    loadCharts();
});

function loadUsers(x) {
    var page = x;

    var f = new FormData();
    f.append("p", page);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 & request.status == 200) {
            var response = request.responseText;
            //alert(response);
            document.getElementById("userTable").innerHTML = response;
        }
    };

    request.open("POST", "loadUsersProcess.php", true);
    request.send(f);

}
function loadCart() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            document.getElementById("cartBody").innerHTML = response;

        }
    }

    request.open("POST", "loadCartProcess.php", true);
    request.send();
}
function incrementQty(x) {


    var cartId = x;
    var qty = document.getElementById("qty" + x);

    var newQty = parseInt(qty.value) + 1

    var f = new FormData();
    f.append("qty", newQty);
    f.append("id", cartId);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == "success") {
                qty.value = parseInt(qty.value) + 1
                loadCart();

            } else {
                alert(response);
            }

        }
    }
    request.open("POST", "updateCartQtyProcess.php", true);
    request.send(f);

}

function decrementQty(x) {


    var cartId = x;
    var qty = document.getElementById("qty" + x);

    var newQty = parseInt(qty.value) - 1

    if (newQty > 0) {
        var f = new FormData();
        f.append("qty", newQty);
        f.append("id", cartId);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == "success") {
                    qty.value = parseInt(qty.value) - 1
                    loadCart();
                } else {
                    alert(response);
                }

            }
        }
        request.open("POST", "updateCartQtyProcess.php", true);
        request.send(f);
    } else {
        alert("Reached Minimum Quantity");
    }

}

function checkout(){
    var f = new FormData();
    f.append("cart", true);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            // alert(response);
            var payment = JSON.parse(response);
            doCheckout(payment, "checkoutProcess.php");
        }
    }

    request.open("POST", "paymentProcess.php", true);
    request.send(f);
}

function doCheckout(payment, path) {
    
    // Payment completed. It can be a successful failure.
    payhere.onCompleted = function onCompleted(orderId) {
        
        console.log("Payment completed. OrderID:" + orderId);
        // Note: validate the payment and show success or failure page to the customer

        var f = new FormData();
        
        f.append("payment", JSON.stringify(payment));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                // alert(response);
                var order = JSON.parse(response);
                if (order.resp == "success") {
                    // alert("ok");
                    
                    window.location = "invoice.php?orderId=" + order.order_id;

                } else {
                    alert(response);
                }
            }
        }

        request.open("POST", path, true);
        request.send(f);
    };

    // Payment window closed
    payhere.onDismissed = function onDismissed() {
        // Note: Prompt user to pay again or show an error page
        console.log("Payment dismissed");
    };

    // Error occurred
    payhere.onError = function onError(error) {
        // Note: show an error page
        console.log("Error:" + error);
    };


    // Show the payhere.js popup, when "PayHere Pay" is clicked
    // document.getElementById('payhere-payment').onclick = function (e) {
    payhere.startPayment(payment);
    // };
}

function buyNow(stockId) {
    var qty = document.getElementById("qty_input");

    if (qty.value > 0) {

        var f = new FormData();
        f.append("cart", false);
        f.append("productId", stockId);
        f.append("qty", qty.value);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                // alert(response);
                var payment = JSON.parse(response);
                payment.id = stockId;
                payment.qty = qty.value;
                doCheckout(payment, "buynowProcess.php");

            }
        }

        request.open("POST", "paymentProcess.php", true);
        request.send(f);


    } else {
        alert("Please enter valid quantity");
    }


}
// function loadChart() {

//     var ctx = document.getElementById('myChart');

//     var request = new XMLHttpRequest();
//     request.onreadystatechange = function () {
//         if (request.readyState == 4 && request.status == 200) {
//             var response = request.responseText;
//             // alert(response);
//             var data = JSON.parse(response);

//             new Chart(ctx, {
//                 type: 'doughnut',
//                 data: {
//                     labels: data.labels,
//                     datasets: [{
//                         label: '# of Votes',
//                         data: data.data,
//                         borderWidth: 1
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     }
//                 }
//             });

//         }
//     }
//     request.open("POST", "loadChartProcess.php", true);
//     request.send();

// }
function loadChart() {

    var ctx = document.getElementById('myChart');
    var crt = document.getElementById('crtChart');



    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            // alert(response);
            var data = JSON.parse(response);

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Products',
                        data: data.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                          ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(crt, {
                type: 'bar',
                data: {
                    labels: data.labels2,
                    datasets: [{
                        label: 'Products',
                        data: data.data2,
                        backgroundColor: [
                            'rgba(12, 134, 240, 0.8)',
                            'rgba(96, 235, 16, 0.8)',
                            'rgba(238, 95, 69, 0.8)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgba(9, 87, 155, 0.8)',
                            'rgba(65, 158, 10, 0.8)',
                            'rgba(238, 95, 69, 0.8)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                          ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

        }
    }
    request.open("POST", "loadChartProcess.php", true);
    request.send();

}








