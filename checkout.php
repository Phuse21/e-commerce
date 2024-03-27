<?php
include ("includes/connectionPage.php");
include ("functions/common_functions.php");


// Check if the form is submitted
if (isset ($_POST['shipping_details'])) {
    // Retrieve form data
    $first_name = $_POST['firstName'];
    $last_name = $_POST['lastName'];
    $address = $_POST['address'];
    $digital_address = $_POST['digital_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Check for empty fields
    if (
        empty ($first_name) || empty ($last_name) || empty ($address) || empty ($city) ||
        empty ($state) || empty ($zip) || empty ($email) || empty ($phone_number)
    ) {
        echo "<script>alert('Please fill out all fields!')</script>";
    } else {
        // Check if email already exists in the database
        $check_query = $con->prepare("SELECT * FROM `shipping_details` WHERE `email` = ?");
        $check_query->bind_param("s", $email);
        $check_query->execute();
        $result = $check_query->get_result();

        if ($result->num_rows > 0) {
            // Email already exists in the database
            echo "<script>alert('Email in use')</script>";
        } else {
            // Prepare the statement
            $query = $con->prepare("INSERT INTO `shipping_details` (first_name, last_name, address,
                                digital_address, city, state, zip, email, phone_number, time) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, now())");

            if ($query) {
                // Bind the parameters
                $query->bind_param("sssssssss", $first_name, $last_name, $address, $digital_address, $city, $state, $zip, $email, $phone_number);

                // Execute the statement
                if ($query->execute()) {
                    echo "<script>alert('Shipping Details Added Successfully'); window.location='payment.php';</script>";
                    exit;
                } else {
                    // Handle execution errors
                    echo "<script>alert('Error: Unable to add shipping details')</script>";
                }

                // Close the statement
                $query->close();
            } else {
                // Handle statement preparation errors
                echo "<script>alert('Error: Unable to prepare statement')</script>";
            }
        }
    }
}
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
                    <a class="nav-link" href="#">Welcome
                        <?php if (isset ($user_data['user_name'])) {
                            echo $user_data['user_name'];
                        } else
                            echo "Guest"; ?>
                    </a>
                </li>
                <?php if (isset ($user_data['user_name'])) {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='users_area/logout.php'>Logout</a>
                </li>";
                } else {
                    echo "<li class='nav-item'>
                    <a class='nav-link' href='users_area/login.php'>Login</a>
                </li>";
                }
                ?>

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

                    <form class="row g-3" method="post">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name*</label>
                            <input type="text" class="form-control" id="firstName" name="firstName"
                                value="<?php echo isset ($user_data['first_name']) ? $user_data['first_name'] : ''; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name*</label>
                            <input type="text" class="form-control" id="lastName" name="lastName"
                                value="<?php echo isset ($user_data['last_name']) ? $user_data['last_name'] : ''; ?>">
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address*</label>
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="5 Dingo St">
                        </div>
                        <div class="col-12">
                            <label for="digital_address" class="form-label">Digital Address</label>
                            <input type="text" class="form-control" id="digital_address" name="digital_address"
                                placeholder="GM-591-9130">
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
                        <div class="col-6">
                            <label for="email" class="form-label">Email*</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?php echo isset ($user_data['email']) ? $user_data['email'] : ''; ?>">
                        </div>
                        <div class="col-6">
                            <label for="phone_number" class="form-label">Phone Number*</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="<?php echo isset ($user_data['phone_number']) ? $user_data['phone_number'] : ''; ?>">
                        </div>

                        <div class="col-4 mt-3">
                            <button class="btn btn-primary btn-sm mt-2 mb-2 text-center" style="padding: 10px;
    width: 70%; background-color: black; border-radius: 30px; border: 1px solid black;
            cursor: pointer;" onmouseover="this.style.backgroundColor='white'; this.style.color='#551a8b';this.style.border= '2px solid #551a8b'; this.style.fontWeight='bold';"
                                onmouseout="this.style.backgroundColor='black'; this.style.border= '2px solid black'; this.style.color='white'; this.style.fontWeight='normal';"
                                type="submit" name="shipping_details">
                                Save & Continue
                            </button>
                        </div>
                    </form>

                    <!-- <form id="paymentForm">
                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary mt-2" style="padding: 10px;
    width: 10%; background-color: black; border-radius: 15px; border: 1px solid black;
            cursor: pointer;" onmouseover="this.style.backgroundColor='white'; this.style.color='#551a8b';this.style.border= '2px solid #551a8b'; this.style.fontWeight='bold';"
                                onmouseout="this.style.backgroundColor='black'; this.style.border= '2px solid black'; this.style.color='white'; this.style.fontWeight='normal';"
                                onclick="payWithPaystack()">Pay</button>
                        </div>
                    </form>
                    <script src="https://js.paystack.co/v1/inline.js"></script> -->

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
                        if (isset ($_SESSION['subtotal'])) {
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
                        if (isset ($_SESSION['vat'])) {
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
                        if (isset ($_SESSION['total_price'])) {
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