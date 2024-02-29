<?php

if (session_status() == PHP_SESSION_NONE) {
    // If session is not active, start the session
    session_start();
}

//include connection
include("./includes/connectionPage.php");


// check if user is logged in
function check_login($con)
{

    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM users WHERE user_id = '$id' LIMIT 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect to the login page
    header("Location: loginPage.php");
    exit();
}


// generate random number
function random_num($length)
{

    $text = "";
    if ($length < 5) {
        $length = 5;
    }
    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {

        $text .= rand(0, 9);
    }
    return $text;
}



//getting products from database

function get_products()
{

    $html = '';

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


                $html .= "    <div class='col-md-4 mb-4'>
<a href='product_details.php?product_id=$product_id' style='text-decoration: none'>
    <div class='card'>
        <img src='./admin_area/product_images/$product_image1' class='card-img-top' alt='...'>
        <div class='card-body'>
            <h5 class='card-title'> $product_title</h5>
            <p class='card-text'>$product_description</p>
            <h6 class='card-text'>$$product_price</h6>
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
    return $html;
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
            <h6 class='card-text'>$$product_price</h6>
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
            <h6 class='card-text'>$$product_price</h6>
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
                            <h6 class='card-text'>$$product_price</h6>
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
            <h6 class='card-text'>$$product_price</h6>
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
                    <div><img src='./admin_area/product_images/$product_image2' 
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
                                            <img src='./admin_area/product_images/$product_image1'
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
                            <h5 class='card-title'>$product_title</h5>
                            <p class='card-text'>$product_description</p>
                            <h6 class='card-text'>$$product_price</h6>
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


// function for cart




function addToCart($productId)
{
    if (empty($productId)) {
        return;
    }

    // Initialize an empty array to store cart items
    $cartItems = isset($_SESSION['cartItems']) ? $_SESSION['cartItems'] : array();

    // Check if the product is already in the cart
    if (in_array($productId, $cartItems)) {
        // If the item is already in the cart, display alert and return early
        echo "<script>alert('Item Already Added To Bag');</script>";
        echo "<script>window.open('index.php', '_self');</script>";
        exit; // Stop further execution of PHP script
    }

    // Add the product ID to the cart items array
    $cartItems[] = $productId;

    // Store the cart items in the session
    $_SESSION['cartItems'] = $cartItems;

    // JavaScript code for displaying an alert message
    echo "<script>alert('Item Added To Bag');</script>";


    // Redirect back to the same index page after processing
    echo "<script>window.open('index.php', '_self');</script>";
    exit; // Stop further execution of PHP script
}

// Check if 'add_to_cart' parameter is set in the URL
if (isset($_GET['add_to_cart'])) {
    // Get the product ID to add to cart
    $product_id = $_GET['add_to_cart'];

    // Add the product to the cart
    addToCart($product_id);
}





// function for total cart items

function cart_items()
{
    // Initialize total items count
    $totalItems = 0;

    // Check if 'cartItems' session variable is set and not empty
    if (isset($_SESSION['cartItems']) && !empty($_SESSION['cartItems'])) {
        // Retrieve cart items from the session
        $cartItems = $_SESSION['cartItems'];

        // Check if it's an array
        if (is_array($cartItems)) {
            // Calculate the total number of items in the cart
            $totalItems = count($cartItems);
        } else {
            // If it's not an array, log an error or handle it accordingly
            echo "<script>console.error('Error retrieving cart items from session');</script>";
        }
    }

    echo $totalItems;
}



//total price function
function total_cart_price()
{
    global $con;
    // Initialize total price
    $totalPrice = 0;

    // Check if 'cartItems' session variable is set and not empty
    if (isset($_SESSION['cartItems']) && !empty($_SESSION['cartItems'])) {
        // Retrieve cart items from the session
        $cartItems = $_SESSION['cartItems'];

        // Calculate the total price of the cart
        foreach ($cartItems as $product_id) {
            $select_products = "SELECT * FROM `products` WHERE product_id = '$product_id'";
            $result_product = mysqli_query($con, $select_products);
            $row_product_price = mysqli_fetch_array($result_product);
            $totalPrice += $row_product_price['product_price'];
        }
    }
    echo $totalPrice;
}




//display cart item function
function display_cart_items()
{
    $html = '';

    global $con;

    // Check if the 'cartItems' session variable is set and not empty
    if (isset($_SESSION['cartItems']) && !empty($_SESSION['cartItems'])) {
        // Retrieve cart items from the session
        $cartItems = $_SESSION['cartItems'];

        // Handle item deletion if submitted
        if (isset($_POST['delete_product_id'])) {
            // Sanitize input to prevent SQL injection
            $delete_product_id = mysqli_real_escape_string($con, $_POST['delete_product_id']);

            // Remove the product from the session
            if (($key = array_search($delete_product_id, $cartItems)) !== false) {
                unset($cartItems[$key]);
                $_SESSION['cartItems'] = $cartItems;
            }
        }

        // Check if the cart is empty after item deletion
        if (empty($cartItems)) {
            // Return message indicating cart is empty
            return "<p>Your cart is empty.</p>";
        }

        // Loop through the cart items
        foreach ($cartItems as $product_id) {
            // Use prepared statements to fetch product details
            $select_query = "SELECT * FROM `products` WHERE product_id = ?";
            $stmt = $con->prepare($select_query);
            if (!$stmt) {
                // Error handling for failed prepared statement
                $html .= "<p>Error: Failed to prepare SQL statement.</p>";
                continue; // Skip to the next iteration of the loop
            }
            $stmt->bind_param("i", $product_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if (!$result) {
                // Error handling for failed query execution
                $html .= "<p>Error: Failed to execute SQL query.</p>";
                continue; // Skip to the next iteration of the loop
            }
            $row = $result->fetch_assoc();
            $stmt->close();

            // Check if the product details are found
            if ($row) {
                // Generate HTML markup for the item card
                $product_title = htmlspecialchars($row['product_title']);
                $product_image1 = htmlspecialchars($row['product_image1']);
                $product_description = htmlspecialchars($row['product_description']);
                $product_price = htmlspecialchars($row['product_price']);

                // Append HTML markup for the item card
                $html .= "
                <form action='' method='post'>
                    <div class='card mb-2 mx-4'>
                        <div class='row g-0'>
                            <div class='col-md-4'>
                                <img src='./admin_area/product_images/$product_image1' class='img-fluid rounded-start' style='height: 200px' alt='...'>
                            </div>
                            <div class='col-md-8'>
                                <div class='card-body'>
                                    <div class='d-flex justify-content-between'>
                                        <h5 class='card-title'>$product_title</h5>
                                        <span class='card-price' id='price_$product_id'>$$product_price</span>
                                    </div>
                                    <p class='card-text'>$product_description</p>
                                    <label for='quantity'>Quantity:</label>
                                    <select class='form-select form-select-sm w-25' aria-label='' name='quantity_$product_id' id='quantity_$product_id'
                                     onchange='updateItem(this.value, $product_price, $product_id)'>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>
                                        <option value='4'>4</option>
                                    </select>
                                    <div class='position-relative'>
                                        <button type='submit' class='btn btn-danger position-absolute bottom-0 end-0 delete-button' data-product-id='$product_id'>
                                            <i class='fa fa-trash' aria-hidden='true'></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type='hidden' name='delete_product_id' value='$product_id'>
                </form>
                ";
            } else {
                // Error handling for missing product details
                $html .= "<p>Error: Product details not found.</p>";
            }
        }
    } else {
        // Return message indicating cart is empty
        $html .= "<p>Your cart is empty.</p>";
    }

    return $html;
}