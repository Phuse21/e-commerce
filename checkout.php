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
    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
    // Function to save shipping details in the session
    function saveShippingDetails() {
        // Retrieve form inputs
        var firstName = document.getElementById('firstName').value;
        var lastName = document.getElementById('lastName').value;
        var email = document.getElementById('email').value;
        var address = document.getElementById('address').value;
        var address2 = document.getElementById('address2').value;
        var city = document.getElementById('city').value;
        var state = document.getElementById('state').value;
        var zip = document.getElementById('zip').value;

        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure the request
        xhr.open('POST', 'shipping_details.php');
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        // Define the data to be sent in the request body
        var data = 'firstName=' + encodeURIComponent(firstName) +
            '&lastName=' + encodeURIComponent(lastName) +
            '&address=' + encodeURIComponent(address) +
            '&address2=' + encodeURIComponent(address2) +
            '&city=' + encodeURIComponent(city) +
            '&state=' + encodeURIComponent(state) +
            '&zip=' + encodeURIComponent(zip);

        // Set up event listener to process response
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Shipping details saved successfully.');
                // Redirect to the payment page or perform any other action
                window.location.href =
                    'payment.php';
            } else {
                console.log('Error saving shipping details.');
            }
        };

        // Send the request
        console.log(data);
        xhr.send(data);
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Find the "Save & Continue" button by its ID
        var saveAndContinueButton = document.getElementById('saveAndContinueButton');

        // Check if the button element exists
        if (saveAndContinueButton) {
            // Attach a click event listener to the button
            saveAndContinueButton.addEventListener('click', function(event) {
                // Prevent the default form submission behavior
                event.preventDefault();

                // Call the function to save shipping details
                saveShippingDetails();
            });
        }
    });
    </script>



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

    body {
        overflow-x: hidden;
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

        <div class="text-center mb-2 mt-2">
            <h4>Checkout</h4>
        </div>

        <div class="row mt-2 mb-2">


            <div class="col-md-8 p-3 ">

                <div class="mx-4">
                    <div>
                        <h5>Shipping Details</h5>
                    </div>

                    <form class="row g-3" id="shippingForm">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name*</label>
                            <input type="text" class="form-control" id="firstName" name="firstName">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name*</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" id="email" name="email">
                        </div>
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="5 Dingo St">
                        </div>
                        <div class="col-12">
                            <label for="address2" class="form-label">Address 2</label>
                            <input type="text" class="form-control" id="address2" name="address2"
                                placeholder="Apartment, studio, or floor">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city">
                        </div>
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select id="state" class="form-select" name="state">
                                <option selected>Choose...</option>
                                <option>Ashanti</option>
                                <option>Brong Ahafo</option>
                                <option>Greater Accra</option>
                                <option>Central</option>
                                <option>Eastern</option>
                                <option>Northern</option>
                                <option>Upper East</option>
                                <option>Upper West</option>
                                <option>Volta</option>
                                <option>Western</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="zip">
                        </div>

                        <div class="col-4 mt-3">
                            <button class="btn btn-primary btn-sm mt-2 mb-2 text-center" style="padding: 10px;
    width: 70%; background-color: black; border-radius: 30px; border: 1px solid black
            cursor: pointer;" onmouseover="this.style.backgroundColor='white'; this.style.color='#551a8b';this.style.border= '2px solid #551a8b'; this.style.fontWeight='bold';"
                                onmouseout="this.style.backgroundColor='black'; this.style.border= 'none'; this.style.color='white'; this.style.fontWeight='normal';"
                                onclick="saveShippingDetails()" id='saveAndContinueButton'>
                                Save & Continue
                            </button>
                        </div>
                    </form>



                </div>



            </div>
            <!--col end-->


            <div class="col-md-4 p-3">
                <div>
                    <h5>
                        In Your Bag
                    </h5>
                </div>

                <div>
                    <h6>
                        <?php
                        //check if subtotal is stored in session
                        if (isset($_SESSION['subtotal'])) {
                            $subtotal = $_SESSION['subtotal'];
                            //display subtotal
                            echo "Subtotal: $" . number_format($subtotal, 2);
                        } else //if subtotal is not stored in session
                        {
                            echo "Subtotal: $0.00";
                        }
                        ?>
                    </h6>

                </div>

                <div>
                    <h6>
                        <?php
                        //check if VAT is stored in session
                        if (isset($_SESSION['vat'])) {
                            $vat = $_SESSION['vat'];
                            //display VAT
                            echo "VAT: $" . number_format($vat, 2);
                        } else //if VAT is not stored in session
                        {
                            echo "VAT: $0.00";
                        }
                        ?>
                    </h6>

                </div>

                <div>
                    <h6>
                        <?php
                        //check if Total Price is stored in session
                        if (isset($_SESSION['total_price'])) {
                            $total_price = $_SESSION['total_price'];
                            //display Total Price
                            echo "Total Price: $" . number_format($total_price, 2);
                        } else //if Total Price is not stored in session
                        {
                            echo "Total Price: $0.00";
                        }

                        ?>
                    </h6>

                </div>
            </div>
        </div>

    </div>






    <div class="bg-light d-flex justify-content-between footer">
        <P class="text-center"> &copy;2024 SoleStride, Inc. All rights Reserved</P>
        <a href="">
            <p>Help</p>
        </a>
    </div>

    </div>

</body>

</html>