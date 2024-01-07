<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS link -->
    <link rel="stylesheet" href="../style.css">

    <style>
    .admin-image {
        width: 100px;
        object-fit: contain;
    }

    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    </style>
</head>

<body>

    <!-- navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info-subtle">
            <div class="container-fluid">
                <img src="../images/logo1.png" alt="" class="logo">
            </div>
            <nav class="navbar navbar-expand-lg">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Welcome</a>
                    </li>

                </ul>

            </nav>

        </nav>

        <div class="bg-secondary-subtle p-0">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <div class="row">
            <div class="col-md-12 bg-light p-1 d-flex">
                <div>
                    <a href="#">
                        <img src="../images/Admin.png" alt="" class="admin-image">
                    </a>
                    <p class="text-center">Admin</p>
                </div>
                <div class=" text-center p-5 align-items-center">
                    <button style="border: none;"><a href="" class="btn btn-primary">Insert Products</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">View Products</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">Insert Category</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">View Category</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">Insert Brands</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">View Brands</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">All Orders</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">All Payments</a></button>
                    <button style="border: none;"><a href="" class="btn btn-primary">List Users</a></button>
                    <button style="border: none; margin-top: 10px"><a href=""
                            class="btn btn-primary">Logout</a></button>
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