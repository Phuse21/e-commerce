<?php
//include connection
include("./includes/connectionPage.php");


//getting products from database


function get_products()
{
    global $con;
    //check isset or not
    if (!isset($_GET['category'])) {
        if (!isset($_GET['brand'])) {
            $select_query = "SELECT * FROM `products` ORDER BY RAND() LIMIT 0,3";
            $result_query = mysqli_query($con, $select_query);
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image1 = $row['product_image1'];
                echo "    <div class='col-md-4 mb-4'>
<a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <h6 class='card-text'>$product_price</h6>
            <div class='row'>
                <div class='col-md-6'>
                    <a  href='index.php?add_to_cart=$product_id' ><button type='button' class='btn btn-primary btn-sm mt-2 mb-2'
                    style='width: 100%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                    <span style='margin-right: 10px;'>Add to Bag</span>
                    <i class='fa fa-shopping-bag'></i>
                </button></a>
                </div>
                <div class='col-md-6'>
                    <a class='nav-link favorite' href='#'><button type='button' class='btn btn-primary btn-sm mt-2 mb-2' style='width: 100%; background-color:white; border-radius: 30px;
                    border: 1px solid black;'>
            <span style='margin-right: 10px; color: black;'>favorite</span>
            <i class='fa fa-heart text-dark' aria-hidden='true'></i>
        </button></a>
                </div>
            </div>
        </div>
    </div>
</a>
</div>";
            }

        }

    }
}



function get_unique_categories()
{
    global $con;
    //check isset or not
    if (isset($_GET['category'])) {
        $category_id = $_GET['category'];

        $select_query = "SELECT * FROM `products` WHERE category_id = '$category_id'";
        $result_query = mysqli_query($con, $select_query);

        $category_title = "";
        $category_query = "SELECT category_title FROM `categories` WHERE category_id = '$category_id'";
        $category_result = mysqli_query($con, $category_query);
        if ($category_row = mysqli_fetch_assoc($category_result)) {
            $category_title = $category_row['category_title'];
        }

        //display brand title
        echo "<h4 class='text-center'> $category_title </h4>";
        if (mysqli_num_rows($result_query) > 0) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image1 = $row['product_image1'];
                echo "    <div class='col-md-4 mb-4'>
<a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <h6 class='card-text'>$product_price</h6>
            <div class='row'>
                <div class='col-md-6'>
                <a  href='index.php?add_to_cart=$product_id' ><button type='button' class='btn btn-primary btn-sm mt-2 mb-2'
                    style='width: 100%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                    <span style='margin-right: 10px;'>Add to Bag</span>
                    <i class='fa fa-shopping-bag'></i>
                </button></a>
                </div>
                <div class='col-md-6'>
                    <a class='nav-link favorite' href='#'><button type='button' class='btn btn-primary btn-sm mt-2 mb-2' style='width: 100%; background-color:white; border-radius: 30px;
                    border: 1px solid black;'>
            <span style='margin-right: 10px; color: black;'>favorite</span>
            <i class='fa fa-heart text-dark' aria-hidden='true'></i>
        </button></a>
                </div>
            </div>
        </div>
    </div>
</a>
</div>";
            }

        } else {
            echo "<p>0 results</p>";
        }

    }
}


function get_unique_brands()
{
    global $con;
    //check isset or not
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];

        $select_query = "SELECT * FROM `products` WHERE brand_id = '$brand_id'";
        $result_query = mysqli_query($con, $select_query);

        $brand_title = "";
        $brand_query = "SELECT brand_title FROM `brands` WHERE brand_id = '$brand_id'";
        $brand_result = mysqli_query($con, $brand_query);
        if ($brand_row = mysqli_fetch_assoc($brand_result)) {
            $brand_title = $brand_row['brand_title'];
        }

        //display brand title
        echo "<h4 class='text-center'> $brand_title </h4>";


        if (mysqli_num_rows($result_query) > 0) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image1 = $row['product_image1'];
                echo "    <div class='col-md-4 mb-4'>
<a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <h6 class='card-text'>$product_price</h6>
            <div class='row'>
                <div class='col-md-6'>
                <a  href='index.php?add_to_cart=$product_id' ><button type='button' class='btn btn-primary btn-sm mt-2 mb-2'
                    style='width: 100%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                    <span style='margin-right: 10px;'>Add to Bag</span>
                    <i class='fa fa-shopping-bag'></i>
                </button></a>
                </div>
                <div class='col-md-6'>
                    <a class='nav-link favorite' href='#'><button type='button' class='btn btn-primary btn-sm mt-2 mb-2' style='width: 100%; background-color:white; border-radius: 30px;
                    border: 1px solid black;'>
            <span style='margin-right: 10px; color: black;'>favorite</span>
            <i class='fa fa-heart text-dark' aria-hidden='true'></i>
        </button></i></a>
                </div>
            </div>
        </div>
    </div>
</a>
</div>";
            }

        } else {
            echo "<p>0 results</p>";
        }
    }
}


function display_new_products()
{
    global $con;

    // Calculate the timestamp for one day ago


    $select_query = "SELECT * FROM `products` WHERE date > DATE_SUB(NOW(), INTERVAL 48 HOUR);";
    $result_query = mysqli_query($con, $select_query);

    // Check if there are any new products
    if (mysqli_num_rows($result_query) > 0) {
        while ($row = mysqli_fetch_assoc($result_query)) {
            $product_id = $row['product_id'];
            $product_title = $row['product_title'];
            $product_description = $row['product_description'];
            $product_price = $row['product_price'];
            $product_image1 = $row['product_image1'];

            // Display the card with product details
            echo "<div class='col-md-4 mb-4'>
                <a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
                    <div class='card'>
                        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <h6 class='card-text'>$product_price</h6>
                            <div class='row'>
                                <div class='col-md-6'>
                                <a  href='index.php?add_to_cart=$product_id' ><button type='button' class='btn btn-primary btn-sm mt-2 mb-2'
                                    style='width: 100%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                                    <span style='margin-right: 10px;'>Add to Bag</span>
                                    <i class='fa fa-shopping-bag'></i>
                                </button></a>
                                </div>
                                <div class='col-md-6'>
                                    <a class='nav-link favorite' href='#'><button type='button' class='btn btn-primary btn-sm mt-2 mb-2' style='width: 100%; background-color:white; border-radius: 30px;
                                    border: 1px solid black;'>
                            <span style='margin-right: 10px; color: black;'>favorite</span>
                            <i class='fa fa-heart text-dark' aria-hidden='true'></i>
                        </button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>";
        }
    } else {
        echo "<p>No new products</p>";
    }
}





//display brands
function get_brands()
{
    global $con;
    $select_brand = "SELECT * from `brands`";
    $result_brand = mysqli_query($con, $select_brand);
    while ($row = mysqli_fetch_assoc($result_brand)) {
        $brand_title = $row['brand_title'];
        $brand_id = $row['brand_id'];
        echo " <li class='nav-item'>
                        <a class='nav-link text-dark' href='specific.php?brand=$brand_id'>
                            $brand_title
                        </a>
                        </li>";
    }
}

//display categories
function get_categories()
{
    global $con;
    $select_category = "SELECT * from `categories`";
    $result_category = mysqli_query($con, $select_category);
    while ($row = mysqli_fetch_assoc($result_category)) {
        $category_title = $row['category_title'];
        $category_id = $row['category_id'];
        echo " <li class='nav-item'>
                        <a class='nav-link text-dark' href='specific.php?category=$category_id'>
                            $category_title
                        </a>
                        </li>";
    }
}



//search products
function search_product()
{
    global $con;
    if (isset($_GET['search_data_product'])) {

        $search_data_value = $_GET['search_data'];


        $search_query = "SELECT * FROM `products` WHERE product_keywords LIKE '%$search_data_value%'";
        $result_query = mysqli_query($con, $search_query);



        if (mysqli_num_rows($result_query) > 0) {

            // Display the search keyword
            echo "<p>Showing results for: $search_data_value</p>";

            while ($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['product_id'];
                $product_title = $row['product_title'];
                $product_description = $row['product_description'];
                $product_price = $row['product_price'];
                $product_image1 = $row['product_image1'];
                echo "    <div class='col-md-4 mb-4'>
<a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <h6 class='card-text'>$product_price</h6>
            <div class='row'>
                <div class='col-md-6'>
                <a  href='index.php?add_to_cart=$product_id' ><button type='button' class='btn btn-primary btn-sm mt-2 mb-2'
                    style='width: 100%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                    <span style='margin-right: 10px;'>Add to Bag</span>
                    <i class='fa fa-shopping-bag'></i>
                </button></a>
                </div>
                <div class='col-md-6'>
                    <a class='nav-link favorite' href='#'><button type='button' class='btn btn-primary btn-sm mt-2 mb-2' style='width: 100%; background-color:white; border-radius: 30px;
                    border: 1px solid black;'>
            <span style='margin-right: 10px; color: black;'>favorite</span>
            <i class='fa fa-heart text-dark' aria-hidden='true'></i>
        </button></a>
                </div>
            </div>
        </div>
    </div>
</a>
</div>";
            }

        } else {
            echo "<p>No results found</p>";
        }
    }
}


//display details
function display_details()
{
    global $con;
    //check isset or not
    if (isset($_GET['product_id'])) {
        if (!isset($_GET['category'])) {
            if (!isset($_GET['brand'])) {
                $product_id = $_GET['product_id'];
                $select_query = "SELECT * FROM `products` WHERE product_id = $product_id";
                $result_query = mysqli_query($con, $select_query);
                while ($row = mysqli_fetch_assoc($result_query)) {
                    $product_id = $row['product_id'];
                    $product_title = $row['product_title'];
                    $product_description = $row['product_description'];
                    $product_price = $row['product_price'];
                    $product_image1 = $row['product_image1'];
                    $product_image2 = $row['product_image2'];
                    $product_image3 = $row['product_image3'];
                    echo "    <div class= 'col-md-8'>
                    <div><img src='./admin_area/product_images/$product_image1' 
                    class='img-thumbnail' style='height: 100%; width: 100%;' alt='...'></div>
    
                </div>
    
                <div class='col-md-4'>
                    <div class='card' style='height: 100%;'>
                        <div class='card-body'>
                            <h5 class='card-title'>$product_title</h5>
                            <h6 class='card-subtitle mb-2 text-body-secondary'>$product_description</h6>
                            <br>
                            <h6 class='card-text'>$product_price</h6>
                            <br>
                            <div class= 'row' p-2>
                                <div class='col-md-6'>
                                    <a href=''>
                                        <div class='image-container'>
                                            <img src='./admin_area/product_images/$product_image2'
                                                class='rounded float-start img-fluid image-container-img'
                                                style='height: 200px' alt='...'>
                                        </div>
                                    </a>
                                </div>
                                <div class='col-md-6'>
                                    <a href=''>
                                        <div class='image-container'>
                                            <img src='./admin_area/product_images/$product_image3'
                                                class='rounded float-end img-fluid image-container-img'
                                                style='height: 200px' alt='...'>
                                        </div>
                                    </a>
                                </div>
                            </div>
    
                            <a href=''> <button type='button' class='btn btn-primary btn-lg mt-2 mb-2'
                            style='width: 100%; background-color:black; border-radius: 30px; border: 1px solid black;'>
                            <span style='margin-right: 10px;'>Add to Bag</span>
                            <i class='fa fa-shopping-bag'></i>
                        </button> </a>
                            
                            <a href=''> <button type='button' class='btn btn-primary btn-lg mt-2 mb-2' style='width: 100%; background-color:white; border-radius: 30px;
                            border: 1px solid black;'>
                    <span style='margin-right: 10px; color: black;'>favorite</span>
                    <i class='fa fa-heart text-dark' aria-hidden='true'></i>
                </button></a>
                            
                        </div>
                    </div>
                </div>";
                }

            }

        }
    }
}




function showRelatedProducts()
{
    global $con;
    $selectedProductId = $_GET['product_id'];
    // Fetch the brand and category of the selected product
    $select_query = "SELECT brand_id, category_id FROM products WHERE product_id = $selectedProductId";
    $result = mysqli_query($con, $select_query);
    $row = mysqli_fetch_assoc($result);
    $brand = $row['brand_id'];
    $category = $row['category_id'];

    // Fetch the related products with the same brand or category
    $related_query = "SELECT * FROM products WHERE (brand_id = '$brand' OR category_id = '$category') AND product_id != $selectedProductId ORDER BY RAND() LIMIT 3";
    $result = mysqli_query($con, $related_query);

    // Display the related products
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_title = $row['product_title'];
        $product_description = $row['product_description'];
        $product_price = $row['product_price'];
        $product_image1 = $row['product_image1'];
        echo "
        
        <div class='col-md-4 mb-4'>
                <a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
                    <div class='card'>
                        <div class='image-container'>
                            <img src='./admin_area/product_images/$product_image1' class='card-img-top image-container-img' alt='...'>
                        </div>

                        <div class='card-body'>
                            <h5 class='card-title'> $product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <h6 class='card-text'>$product_price</h6>
                        </div>
                    </div>
                </a>
            </div>
        ";
    }
}


function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
// $ip = getIPAddress();
// echo 'User IP Address - ' . $ip;


?>