<?php

include("../includes/connectionPage.php");
if (isset($_POST['insert_brand'])) {
    $brand_title = $_POST['brand_title'];

    //SELECT DATA FROM DATABASE
    $select_query = "SELECT * FROM `brands` WHERE brand_title = '$brand_title'";
    $result_select = mysqli_query($con, $select_query);
    $number_of_rows = mysqli_num_rows($result_select);
    if ($number_of_rows > 0) {
        echo "<script>alert('Brand already exist')</script>";
    } else {
        //INSERT DATA INTO DATABASE
        $insert_query = "INSERT INTO `brands` (brand_title) values ('$brand_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Brand has been inserted successfully')</script>";
        }

    }
}

?>

<h2 class="text-center">Add Category</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="brand_title" placeholder="Insert brands" aria-label="Brands"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">

        <input type="submit" class="btn btn-primary bg-info-subtle p-2 my-2" style="color: black;" name="insert_brand"
            value="Insert Brands">
        <!-- <button class="btn btn-primary bg-info-subtle p-2 my-2" style="color: black;">Insert Brands</button> -->
    </div>
</form>