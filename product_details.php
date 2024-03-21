<?php
include ("includes/connectionPage.php");
include ("functions/common_functions.php");

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

        .card .nav-link:hover {
            color: black;
            /* Change the color to your desired hover color */
        }

        .card .nav-link:hover::after {
            opacity: 1;
        }

        .card .nav-link:hover::after {
            content: "Add to favorites";
            /* The text to display for the hover message */
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: black;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
            opacity: 0;
            transition: opacity 0.2s ease;
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



        .card .favorite:hover::after {
            content: "Add to favorites";
            /* The text to display for the favorite icon */
        }

        .card-img-top {
            height: 400px;
            /* Set the desired height for the images */
            object-fit: cover;
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

                    <ul class="navbar-nav my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link" style="margin-left: 10px;" href="#"><i
                                    class="fa fa-shopping-bag"></i><sup>
                                    <?php cart_items(); ?>
                                </sup></a>
                        </li>

                    </ul>
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



        <?php
        $productId = isset ($_GET['add_to_cart']) ? $_GET['add_to_cart'] : null;
        //calling cart function
        addToCart($productId);
        ?>


        <div class="row p-3" style="margin-top: 20px;">
            <?php
            display_details();
            ?>

        </div>
        <!-- row end -->

        <div class="row p-3 mb-4 mt-4" style="width: 100%;">
            <h5>Similar Products</h5>


            <?php
            showRelatedProducts();
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
</body>

</html>