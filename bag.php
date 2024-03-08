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

                <h6>
                    <div id="logged_subtotal"></div>
                </h6>
                <h6>
                    <div id="logged_vat"></div>
                </h6>
                <h6>
                    <div id="logged_total_price"></div>
                </h6>
                <button type='button' id='checkoutButton' class='btn btn-primary btn-lg mt-2 mb-2 text-center'
                    style='width: 70%; background-color: black; border-radius: 30px; border: 1px solid black;'>
                    Checkout
                </button>

                <!-- Hidden popup -->
                <div id="popup" class="popup" style="display: none;">
                    <div class="popup-content">
                        <p>Would you like to login or checkout as a guest?</p>
                        <button type="button" class="btn btn-primary btn-sm mb-2" onclick="login()">Login</button>
                        <button type="button" class="btn btn-primary btn-sm mb-2 " onclick="checkoutAsGuest()">Checkout
                            as Guest</button>

                    </div>
                </div>

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
        var checkoutButton = document.getElementById('checkoutButton');
        var popup = document.getElementById('popup');

        // Function to display the popup when clicking the button
        checkoutButton.addEventListener('click', function () {
            popup.style.display = 'block';
        });

        // Function to close the popup when mouse leaves the button or the popup
        popup.addEventListener('mouseleave', function () {
            popup.style.display = 'none';
        });

        // Add event listener to close popup when clicking outside of it
        document.addEventListener('click', function (event) {
            var isClickInsidePopup = popup.contains(event.target);
            var isClickOnCheckoutButton = event.target === checkoutButton;

            if (!isClickInsidePopup && !isClickOnCheckoutButton) {
                popup.style.display = 'none';
            }
        });

        // Function to handle login option
        function login() {
            // Redirect to login page or handle login functionality here
            // For example:
            window.location.href = './users_area/login.php';
        }

        // Function to handle checkout as guest option
        function checkoutAsGuest() {
            // Redirect to checkout page for guest checkout or handle guest checkout functionality here
            // For example:
            window.location.href = 'checkout.php';
        }


        // Function to update item price and calculate subtotal
        function updateItem(quantity, price, productId) {
            // Calculate total price for the item
            var totalPrice = quantity * price;

            // Update the total price displayed for the item
            document.getElementById('price_' + productId).textContent = '$' + totalPrice.toFixed(2);

            // Update the subtotal including the pre-calculated total price
            calculateSubtotal();
        }



        function calculateSubtotal(productId) {
            var subtotal = 0;
            var vat = 0;
            var totalPrice = 0;


            var cards = document.getElementsByClassName('card');
            for (var i = 0; i < cards.length; i++) {
                var card = cards[i];
                var priceElement = card.querySelector('.card-price');
                if (priceElement) {
                    var priceText = priceElement.textContent;
                    var price = parseFloat(priceText.replace('$', ''));
                    subtotal += price;
                }
            }

            vat = subtotal * 0.034;

            totalPrice = subtotal + vat


            // Create an XMLHttpRequest object
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'store_prices.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status === 200) {
                    console.log('Prices stored successfully in the session.');

                    // Parse the JSON response text
                    var responseJson = JSON.parse(xhr.responseText);

                    // Extract prices from the parsed JSON object
                    var loggedSubtotal = parseFloat(responseJson.subtotal);
                    var loggedVat = parseFloat(responseJson.vat);
                    var loggedTotalPrice = parseFloat(responseJson.totalPrice);

                    // Update the subtotal, vat, and total price displayed on the webpage
                    document.getElementById('logged_subtotal').textContent = 'Subtotal: $' + loggedSubtotal.toFixed(2);
                    document.getElementById('logged_vat').textContent = 'VAT: $' + loggedVat.toFixed(2);
                    document.getElementById('logged_total_price').textContent = 'Total Price: $' + loggedTotalPrice
                        .toFixed(2);

                    // Log the prices
                    console.log('Logged Subtotal:', loggedSubtotal);
                    console.log('Logged VAT:', loggedVat);
                    console.log('Logged Total Price:', loggedTotalPrice);
                } else {
                    console.log('Error storing prices in the session.');
                }
            };

            xhr.send('subtotal=' + encodeURIComponent(subtotal) + '&vat=' + encodeURIComponent(vat) + '&totalPrice=' +
                encodeURIComponent(totalPrice));
        }



        // Assign a function to be called when the window loads
        window.onload = function () {
            calculateSubtotal();
        };
    </script>






</body>

</html>