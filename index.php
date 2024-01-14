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

    <link rel="stylesheet" href="style.css">
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
                            <a class="nav-link" href="#"><i class="fa fa-shopping-bag"></i><sup>1</sup></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:100/-</a>
                        </li>
                    </ul>
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


        <div class="row">
            <div class="col-md-2 bg-light p-4">
                </ul>
                <ul class="navbar-nav me-auto">
                    <li class='nav-item'>
                        <a class='nav-link text-dark' href='new_product.php?New'>
                            <h5>New in</h5>
                        </a>
                    </li>
                    <?php
                    //calling function
                    
                    ?> <br>


                </ul>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item p-2">
                        <h5>Categories</h5>

                    </li>
                    <?php
                    //calling function
                    get_categories();
                    ?> <br>


                </ul>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item p-2">
                        <h5>Brands</h5>

                    </li>
                    <?php
                    //calling function
                    get_brands();
                    ?>


                </ul>

                <?php
                //calling cart function
                cart();
                ?>


            </div>
            <?php if (!isset($brand_id) && !isset($category_id)): ?>
                <div class="col-md-10">
                    <div>
                        <h4>Featured Products</h4>
                    </div>

                    <div class="row" style="margin-top: 20px; padding: 0">
                        <!--fetching products-->
                        <?php
                        // calling function
                        get_products();

                        ?>

                        <div>
                            <h4>Trending Products</h4>
                        </div>

                        <div class="row" style="margin-top: 20px; padding: 0">
                            <!--fetching products-->
                            <?php
                            // calling function
                            get_products()

                                ?>
                        </div>

                    </div> <!-- row end -->

                </div> <!-- col end -->
            <?php else: ?>
                <div style="display: none;">
                    <h4>Featured Products</h4>
                </div>
            <?php endif; ?>



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