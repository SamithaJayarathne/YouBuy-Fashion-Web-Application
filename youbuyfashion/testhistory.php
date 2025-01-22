<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .order-header {
            cursor: pointer;
        }
        .product-image {
            width: 75px;
            height: 75px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Order History</h2>
        <div id="orderAccordion">
            <!-- Order 1 -->
            <div class="card mb-3">
                <div class="card-header order-header" id="orderOneHeader" data-bs-toggle="collapse" data-bs-target="#orderOneDetails" aria-expanded="true" aria-controls="orderOneDetails">
                    <div class="row">
                        <div class="col-md-3">Order ID: 12345</div>
                        <div class="col-md-3">Order Date: 2023-06-01</div>
                        <div class="col-md-3">Total Amount: $150.00</div>
                        <div class="col-md-3 text-end"><i class="bi bi-chevron-down"></i></div>
                    </div>
                </div>
                <div id="orderOneDetails" class="collapse show" aria-labelledby="orderOneHeader" data-bs-parent="#orderAccordion">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">Product Image</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Description</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><img src="product1.jpg" class="img-fluid product-image" alt="Product 1"></td>
                                        <td>Product 1</td>
                                        <td>This is a description for product 1.</td>
                                        <td>2</td>
                                        <td>$50.00</td>
                                    </tr>
                                    <tr>
                                        <td><img src="product2.jpg" class="img-fluid product-image" alt="Product 2"></td>
                                        <td>Product 2</td>
                                        <td>This is a description for product 2.</td>
                                        <td>1</td>
                                        <td>$50.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Repeat for more orders -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/bootstrap-icons.min.js"></script>
    <script>
        // Optional: Change icon direction on collapse/expand
        $('.order-header').on('click', function() {
            var icon = $(this).find('i');
            icon.toggleClass('bi-chevron-down bi-chevron-up');
        });
    </script>
</body>
</html>
