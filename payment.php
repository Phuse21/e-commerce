<?php
include("includes/connectionPage.php");
include("functions/common_functions.php");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SoleStride</title>

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }




        .logo {
            width: 4%;
            height: 4%;
        }

        .card a {
            color: inherit;
            text-decoration: none;
        }


        .card .nav-link {
            position: relative;
        }


        .image-container {
            position: relative;
            overflow: hidden;

        }

        .image-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .image-container:hover::before {
            opacity: 1;
        }

        .image-container-img {
            padding: 10px;
            transition: transform 0.3s ease;
            width: 100%;
            height: 100%;
        }

        .image-container:hover .image-container-img {
            transform: scale(1.1);
        }


        .card-img-top {
            height: 400px;
            /* Set the desired height for the images */
            object-fit: cover;
        }

        .card-price {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-info-subtle">
            <div class="container-fluid">
                <img src="images/logo1.png" alt="" class="logo">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Men</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Women</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Kids</a>
                        </li>


                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="search_data">
                        <input type="submit" value="Search" class="btn btn-outline-light text-dark"
                            name="search_data_product">
                    </form>

                </div>
            </div>
        </nav>


        <nav class="navbar navbar-expand-lg bg-secondary-subtle">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>
            </ul>
        </nav>

        <div class="bg-light">

            <p class="text-center">Get Unlimited Next Day Delivery for a Whole Year for just $6.98</p>
        </div>

        <?php

        $productId = isset($_GET['add_to_cart']) ? $_GET['add_to_cart'] : null;

        //calling cart function
        addToCart($productId);
        ?>

        <div class="row mt-2 mb-2">


            <div class="col-md-8 p-3 ">
                <div class="card w-60 mx-4 mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-danger">Members get free shipping on orders $50+</h5>
                        <p class="card-text">Become a SoleStride Member for fast free shipping on orders $50+ <a
                                href="">Join us</a> or <a href="">Sign-in</a> .</p>

                    </div>
                </div>
                <div class="mx-4">
                    <h5>Bag</h5>
                </div>

                <?php

                $html = display_cart_items();
                echo $html;

                ?>


            </div>
            <!--col end-->


            <div class="col-md-4 p-3">
                <div>
                    <h4>
                        Summary
                    </h4>
                </div>

                <div class="mt-4 justify-content-between">
                    <h6>
                        <div>Subtotal: <span id="subtotal"></div>
                    </h6>
                </div>

                <div class="mt-4 justify-content-between">
                    <h6>
                        <div>VAT: <span id="vat"></span></div>
                    </h6>
                </div>


                <div class="mt-4 justify-content-between">
                    <h5>
                        <div>Total Price: <span id="total_price"></span></div>
                    </h5>
                </div>
                <a href='checkout.php'> <button type='button' class='btn btn-primary btn-lg mt-2 mb-2 text-center'
                        style='width: 70%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                        Checkout

                    </button> </a>

                <a href=''> <button type='button' class='btn btn-primary btn-lg mt-2 mb-2 text-dark' style='width: 70%; background-color:white; border-radius: 30px;
                            border: 1px solid black; text'>
                        Continue Shopping

                    </button></a>
            </div>
        </div>

    </div>

    <div class="row p-3 mb-4 mt-4" style="width: 100%;">
        <h5>You might also like</h5>


        <?php
        // calling function
        $html = get_products();
        echo $html;

        ?>

    </div><!-- col end -->




    <div class="bg-light d-flex justify-content-between footer">
        <P class="text-center"> &copy;2024 SoleStride, Inc. All rights Reserved</P>
        <a href="">
            <p>Help</p>
        </a>
    </div>

    </div>



    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>

    <script>
        // Function to update item price and calculate subtotal
        function updateItem(quantity, price, productId) {
            // Calculate total price
            var totalPrice = quantity * price;

            // Update the total price displayed for the item
            document.getElementById('price_' + productId).textContent = '$' + totalPrice.toFixed(2);

            // Update the subtotal
            calculateSubtotal();
        }

        // Function to calculate subtotal
        function calculateSubtotal() {
            var subtotal = 0;
            // Iterate over all cards to sum up the prices
            var cards = document.getElementsByClassName('card');
            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];
                var priceElement = card.querySelector('.card-price');
                if (priceElement) {
                    // Extract the price from the text content
                    var priceText = priceElement.textContent;
                    var price = parseFloat(priceText.replace('$', ''));
                    subtotal += price;
                }
            }

            // Calculate VAT (3.4% of the subtotal)
            var vat = subtotal * 0.034;

            // Calculate total price
            var totalPrice = subtotal + vat;

            // Update the subtotal, VAT, and total price displayed
            document.getElementById('subtotal').textContent = '$' + subtotal.toFixed(2);
            document.getElementById('vat').textContent = '$' + vat.toFixed(2);
            document.getElementById('total_price').textContent = '$' + totalPrice.toFixed(2);
        }

        // Calculate subtotal when the page loads
        window.onload = calculateSubtotal;
    </script>






</body>

</html>