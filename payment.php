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

        <div class="row mt-2 mb-2">


            <div class="col-md-8 p-3 ">


                <div class="text-center">
                    <h5>Payment Details</h5>
                </div>

                <form id="paymentForm">
                    <div class="form-submit">
                        <button type="submit" class="btn btn-primary mt-2" onclick="payWithPaystack()">Pay</button>
                    </div>
                </form>
                <script src="https://js.paystack.co/v1/inline.js"></script>
            </div>
            <!--col end-->
            <?php
            include("payconfigs.php");
            $email = $_SESSION['email'];
            $amount = $_SESSION['total_price'] * 100;
            $currency = "USD";
            ?>

            <script>
                const paymentForm = document.getElementById('paymentForm');
                paymentForm.addEventListener("submit", payWithPaystack, false);

                function payWithPaystack(e) {
                    e.preventDefault();

                    let handler = PaystackPop.setup({
                        key: '<?php echo $publicKey ?>', // Replace with your public key
                        email: '<?php echo $email ?>',
                        amount: '<?php echo $amount ?>',
                        currency: '<?php echo $currency ?>',
                        ref: '' + Math.floor((Math.random() * 1000000000) +
                            1
                        ), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
                        // label: "Optional string that replaces customer email"
                        onClose: function () {
                            alert('Window closed.');
                        },
                        callback: function (response) {
                            let message = 'Payment complete! Reference: ' + response.reference;
                            alert(message);
                        }
                    });

                    handler.openIframe();
                }
            </script>

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



    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>







</body>

</html>