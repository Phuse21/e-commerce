<?php
session_start();

include ("../includes/connectionPage.php");
include ("functionsPage.php");



// Check if an error message is stored in the session
if (isset ($_SESSION['error_message'])) {
    echo '<div id="box">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Clear the error message from the session
}


$email = $password = "";
$email_error = $password_error = "";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $email = $_POST['email'];
    $enteredPassword = $_POST['password'];

    if (!is_numeric($email)) {
        //read from database

        $query = "select * from users where email = '$email' limit 1";

        $result = mysqli_query($con, $query);
        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if (password_verify($enteredPassword, $user_data['password'])) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    if (isset ($_SESSION['cartItems']) && !empty ($_SESSION['cartItems'])) {

                        header("Location: ../bag.php");
                        die;
                    } else {
                        header("Location: ../index.php");
                        die;
                    }
                } else {
                    $password_error = "Wrong Email or Password";
                }
            } else {
                $email_error = "Wrong Email or Password";
            }
        }
    } else {
        echo '<div id="box">' . "Invalid input" . '</div>';
    }
}
?>

<?php
if (isset ($_GET['successMessage'])) {
    $successMessage = $_GET['successMessage'];
    echo '<div id="box" style="color:grey;">' . $successMessage . '</div>';
} ?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
</head>

<body>
    <style type="text/css">
        .error {
            color: red;
            border-radius: 3px;

            font-size: 14px;
            width: 290px;

        }

        .wrapper {
            background: #ececec;
            padding: 0 20px 0 20px;

        }

        .side-image {
            background-image: url("images/2.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 10px 0 0 10px;
            position: relative;
        }

        .row {
            width: 900px;
            height: 550px;
            border-radius: 10px;
            background: #fff;
            padding: 0px;
            box-shadow: 5px 5px 10px 1px rgba(0, 0, 0, 0.2);
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            width: 100%;
            height: 100%;
        }

        img {
            width: 60px;
            height: 60px;
            position: absolute;
            top: 10px;
            left: 20px;
        }

        .right {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .side-image {
            background-image: url("../images/background.jpg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            border-radius: 10px 0 0 10px;
            position: relative;
        }

        .text {
            position: top;
            text-align: center;
            padding: 20px;
            font-size: 20px;
            font-weight: 400;
            margin-top: 40px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: black;
        }

        .text p {
            color: #black;
            font-size: 20px;
        }

        .i {
            font-weight: 400;
            font-size: 15px;
        }


        #box {
            background-color: #fff;
            margin: auto;
            width: 100%;
            padding: 20px;
            height: 100%;


        }
    </style>
    <div class="wrapper">
        <div class="container main">
            <div class="row">
                <div class="col-md-6 side-image">



                </div>
                <div class="col-md-6 right">
                    <div id="box">

                        <form method="post">
                            <!-------------      image     ------------->
                            <a href="../index.php"><img src="../images/logo3.png"></a>

                            <div class="text">
                                <p> <i> Login </i></p>
                            </div>
                            <p class="error email-error">
                                <?php echo $email_error; ?>
                            </p>
                            <label for="email" class="form-label">Email address</label>
                            <input id="email" type="text" name="email" class="form-control"
                                value="<?php echo $email; ?>" autocomplete="off" required>
                            <p class="error password-error">
                                <?php echo $password_error; ?>
                            </p>
                            <label for="email" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                value="<?php echo $password; ?>" required> <br>
                            <button class="btn btn-primary btn-sm mt-2 mb-2 text-center" style="padding: 10px;
        width: 70%; background-color: black; border-radius: 30px; border: 1px solid black
                cursor: pointer; margin-left: 60px;"
                                onmouseover="this.style.backgroundColor='white'; this.style.color='#551a8b';this.style.border= '2px solid #551a8b'; this.style.fontWeight='bold';"
                                onmouseout="this.style.backgroundColor='black'; this.style.border= 'none'; this.style.color='white'; this.style.fontWeight='normal';">
                                Login
                            </button> <br><br>
                            <span>Don't have an account? </span> <a href="signup.php">Signup</a> <br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>