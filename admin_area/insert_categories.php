<?php

include("../includes/connectionPage.php");

if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    //SELECT DATA FROM DATABASE
    $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number_of_rows = mysqli_num_rows($result_select);
    if ($number_of_rows > 0) {
        echo "<script>alert('Categories already exist')</script>";
    } else {
        //INSERT DATA INTO DATABASE
        $insert_query = "INSERT INTO `categories` (category_title) values ('$category_title')";
        $result = mysqli_query($con, $insert_query);
        if ($result) {
            echo "<script>alert('Categories has been inserted successfully')</script>";
        }

    }
}

?>

<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert Categories" aria-label="categories"
            aria-describedby="basic-addon1">
    </div>
    <div class="input-group w-10 mb-2 m-auto">

        <input type="submit" class="btn btn-primary bg-info-subtle p-2 my-2" style="color: black;" name="insert_cat"
            value="Insert Categories">

    </div>
</form>