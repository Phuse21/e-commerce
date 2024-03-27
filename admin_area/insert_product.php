<?php
include ('../includes/connectionPage.php');
if (isset ($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';


    //getting images and tmp names
    $product_image1 = $_FILES['product_image1']['name'];
    $product_image1_tmp = $_FILES['product_image1']['tmp_name'];
    $product_image2 = $_FILES['product_image2']['name'];
    $product_image2_tmp = $_FILES['product_image2']['tmp_name'];
    $product_image3 = $_FILES['product_image3']['name'];
    $product_image3_tmp = $_FILES['product_image3']['tmp_name'];

    //checking empty condition
    if (
        $product_title == '' || $product_description == '' || $product_keywords == '' ||
        $product_category == '' || $product_brand == '' || $product_price == '' ||
        $product_image1 == '' || $product_image2 == '' ||
        $product_image3 == ''
    ) {
        echo "<script>alert('Please fill all the fields')</script>";
        exit();
    } else {
        //uploading images
        move_uploaded_file($product_image1_tmp, "./product_images/$product_image1");
        move_uploaded_file($product_image2_tmp, "./product_images/$product_image2");
        move_uploaded_file($product_image3_tmp, "./product_images/$product_image3");

        //inserting data into database
        // Prepare the statement
        $insert_product = $con->prepare("INSERT INTO `products` (product_title, product_description, 
       product_keywords, category_id, brand_id, product_image1,
       product_image2, product_image3, product_price, date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?)");

        // Bind the parameters
        $insert_product->bind_param("ssssssssss", $product_title, $product_description, $product_keywords, $product_category, $product_brand, $product_image1, $product_image2, $product_image3, $product_price, $product_status);

        // Execute the statement
        if ($insert_product->execute()) {
            echo "<script>alert('Product has been inserted successfully')</script>";
        }

        // Close the statement
        $insert_product->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin Dashboard</title>

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="../style.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Add Product</h1>

        <!-- Insert product form -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- product title -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">
                    Product Title
                </label>
                <input type="text" id="product_title" name="product_title" class="form-control"
                    placeholder="Enter product title" autocomplete="off" required="required" />
            </div>
            <!-- product description -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="description" class="form-label">
                    Product Description
                </label>
                <textarea id="description" name="product_description" class="form-control"
                    placeholder="Enter product description" autocomplete="off" required="required">
                </textarea>
            </div>
            <!-- product keywords -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="keyword" class="form-label">
                    Product Keyword
                </label>
                <input type="text" id="keyword" name="product_keywords" class="form-control"
                    placeholder="Enter product keyword" style="padding: 10px; margin: auto;" autocomplete="off"
                    required="required" />
            </div>
            <!-- categories -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_category" id="" class="form-select">
                    <option value="">Select a Category</option>
                    <?php
                    $select_query = "SELECT * FROM `categories`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $category_title = $row['category_title'];
                        $category_id = $row['category_id'];
                        echo "<option value='$category_id'>$category_title</option>";
                    }
                    ?>

                </select>
            </div>
            <!-- brands -->
            <div class="form-outline mb-4 w-50 m-auto">
                <select name="product_brand" id="" class="form-select">
                    <option value="">Select a Brand</option>
                    <?php
                    $select_query = "SELECT * FROM `brands`";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $brand_title = $row['brand_title'];
                        $brand_id = $row['brand_id'];
                        echo "<option value='$brand_id'>$brand_title</option>";
                    }
                    ?>

                </select>
            </div>

            <!-- product image1 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">
                    Product Image 1
                </label>
                <input type="file" id="product_image1" name="product_image1" class="form-control" required="required" />
            </div>
            <!-- product image2 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">
                    Product Image 2
                </label>
                <input type="file" id="product_image2" name="product_image2" class="form-control" required="required" />
            </div>
            <!-- product image3 -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">
                    Product Image 3
                </label>
                <input type="file" id="product_image3" name="product_image3" class="form-control" required="required" />
            </div>
            <!-- product price -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">
                    Product Price
                </label>
                <input type="text" id="product_price" name="product_price" class="form-control"
                    placeholder="Enter product price" autocomplete="off" required="required" />
            </div>
            <!-- button -->
            <div class="form-outline mb-4 w-50 m-auto">
                <input type="submit" name="insert_product" class="btn btn-info mb-3 px-3" value="Add Product">
            </div>

        </form>
    </div>



    <!-- Bootstrap js link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>