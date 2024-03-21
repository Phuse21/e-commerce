<?php
session_start();

include("../includes/connectionPage.php");
include("functionsPage.php");


// Add cache-control headers to prevent caching of the index page
// header('Cache-Control: no-store, no-cache, must-revalidate');
// header('Pragma: no-cache');
// header('Expires: 0');


// Check if an error message is stored in the session
if (isset($_SESSION['error_message'])) {
    echo '<div id="box">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Clear the error message from the session
}




// Initialize variables
$email = $phone_number = $first_name = $last_name = $gender = $date_of_birth = $user_name = $password = $confirm_password = '';
$email_error = $email_error1 = $phone_number_error = $user_name_error = $password_error = $confirm_password_error = '';
$hashedPassword = '';
$hasUppercase = false;
$hasLowercase = false;
$hasNumber = false;
$hasSymbol = false;
$hasMinLength = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];



    //Encrypt password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false && !empty($email)) {
        $email_error = "Invalid email";
    } else {


        // Check if email is already in use
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            $email_error1 = "Email address is already in use";

        } else {
            // Check if username is already in the database
            $query = "SELECT * FROM users WHERE user_name = '$user_name'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $user_name_error = "Username has already been taken";

            }
            // Check if phone number is already in the database
            $query = "SELECT * FROM users WHERE phone_number = '$phone_number'";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                $phone_number_error = "Phone number already exists";

            } else {

                // Check if the password meets the strength criteria
                $hasUppercase = preg_match('/[A-Z]/', $password);
                $hasLowercase = preg_match('/[a-z]/', $password);
                $hasNumber = preg_match('/[0-9]/', $password);
                $hasSymbol = preg_match('/[!@#$%^&*()_+\-=[\]{};:\'\\\\"|,.<>\/?]/', $password);
                $hasMinLength = strlen($password) >= 8;

                if (!$hasUppercase || !$hasLowercase || !$hasNumber || !$hasSymbol || !$hasMinLength) {
                    $password_error = "Password does not meet the strength criteria";

                } else {


                    if ($password != $confirm_password) {
                        $confirm_password_error = "Passwords do not match";

                    } else {



                        //save to database

                        $user_id = random_num(20);
                        $query = "INSERT INTO users (user_id, email, phone_number, first_name, last_name, gender, date_of_birth, user_name, password) VALUES ('$user_id', '$email', '$phone_number', '$first_name', '$last_name', '$gender', '$date_of_birth', '$user_name', '$hashedPassword')";

                        if (mysqli_query($con, $query) && $hasUppercase && $hasLowercase && $hasNumber && $hasSymbol && $hasMinLength) {

                            // Set the success message in a query parameter
                            $successMessage = "Account created successfully";
                            $redirectUrl = "loginPage.php?successMessage=" . urlencode($successMessage);

                            // Delay redirect
                            sleep(2); // 2 seconds



                            // Redirect to the login page with the success message
                            header("Location: " . $redirectUrl);
                            exit();
                        } else {
                            // Display an error message if the account creation fails
                            echo "Error: " . mysqli_error($con);
                        }
                    }
                }
            }
        }
    }
}

?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script>
    window.history.forward();
    </script>


    <title>Signup</title>
    < </head>

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
        width: 100%;
        height: 100%;
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

    .error {
        color: red;
        border-radius: 3px;

        font-size: 14px;
        width: 290px;

    }




    .password-strength {
        display: none;
    }

    .password-strength ul {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .password-strength ul li {
        font-size: 12px;
        color: red;
        font-weight: 50;
    }

    .password-strength ul li.active {
        color: green;
    }


    .password-strength ul li span:before {
        content: "\2716";
        padding-right: 5px;
    }

    .password-strength ul li.active span:before {
        content: "\2713";
        padding-right: 5px;
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
                            <a href="../index.php"><img src="../images/logo.png" alt=""></a>

                            <div class="text">
                                <p> <i> Join SoleStride </i></p>
                            </div>
                            <label for="email" class="form-label">Email address</label>
                            <input id="email" type="text" name="email" class="form-control"
                                value="<?php echo $email; ?>" required>
                            <p class="error email-error">
                                <?php echo $email_error1; ?>
                            </p>
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input id="phone_number" type="text" name="phone_number" class="form-control"
                                value="<?php echo $phone_number; ?>" required>
                            <p class="error phone_number-error">
                                <?php echo $phone_number_error; ?>
                            </p>
                            <label for="first_name" class="form-label">First Name</label>
                            <input id="first_name" type="text" name="first_name" class="form-control"
                                value="<?php echo $first_name; ?>" required>
                            <br>
                            <label for="last_name" class="form-label">Last Name</label>
                            <input id="last_name" type="text" name="last_name" class="form-control"
                                value="<?php echo $last_name; ?>" required>
                            <br>
                            <div>
                                <input type="radio" id="male" name="gender" value="male" checked>
                                <label for="male">Male</label>
                            </div>
                            <div>
                                <input type="radio" id="female" name="gender" value="female">
                                <label for="female">Female</label>
                            </div>
                            <br>
                            <label for="date_of_birth">Date of birth:</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" required>

                            <br><br>
                            <label for="user_name" class="form-label">Email address</label>
                            <input id="user_name" type="text" name="user_name" class="form-control"
                                value="<?php echo $user_name; ?>" required>
                            <p class="error user_name-error">
                                <?php echo $user_name_error; ?>
                            </p>

                            <label for="password_validation" class="form-label">Password</label>
                            <input type="password" id="password_validation" name="password" class="form-control"
                                value="<?php echo $password; ?>" required>
                            <p class="error password-error">
                                <?php echo $password_error; ?>
                            </p>
                            <div class="password-strength">
                                <ul>
                                    <li><span></span>Uppercase</li>
                                    <li><span></span>Lowercase</li>
                                    <li><span></span>Number</li>
                                    <li><span></span>Special Character</li>
                                    <li><span></span>8 or more characters</li>
                                </ul><br>
                            </div>

                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input id="confirm_password" type="password" name="confirm_password" class="form-control"
                                value="<?php echo $confirm_password; ?>" required>
                            <p class="error confirm_password-error">
                                <?php echo $confirm_password_error; ?>
                            </p>



                            <button class="btn btn-primary btn-sm mt-2 mb-2 text-center" style="padding: 10px;
        width: 50%; background-color: black; border-radius: 30px; border: 1px solid black
                cursor: pointer; margin-left: 25%;"
                                onmouseover="this.style.backgroundColor='white'; this.style.color='#551a8b';this.style.border= '2px solid #551a8b'; this.style.fontWeight='bold';"
                                onmouseout="this.style.backgroundColor='black'; this.style.border= 'none'; this.style.color='white'; this.style.fontWeight='normal';">
                                Signup
                            </button> <br><br>
                            <span>Already created an account? </span><a href="login.php">Login</a> <br><br>

                        </form>




                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
    const passwordInput = document.getElementById('password_validation');
    const passwordStrength = document.querySelector('.password-strength');


    passwordInput.addEventListener('focus', function() {
        passwordStrength.style.display = 'inline-block';
    });

    passwordInput.addEventListener('blur', function() {
        passwordStrength.style.display = 'none';
    });

    const passwordStrengthItems = document.querySelectorAll('.password-strength ul li');

    passwordInput.addEventListener('input', function() {

        const inputValue = passwordInput.value;
        const hasUppercase = /[A-Z]/.test(inputValue);
        const hasLowercase = /[a-z]/.test(inputValue);
        const hasNumber = /\d/.test(inputValue);
        const hasSymbol = /[\W_]/.test(inputValue);
        const hasMinLength = inputValue.length >= 8;

        passwordStrengthItems[1].classList.toggle('active', hasLowercase);
        passwordStrengthItems[0].classList.toggle('active', hasUppercase);
        passwordStrengthItems[2].classList.toggle('active', hasNumber);
        passwordStrengthItems[3].classList.toggle('active', hasSymbol);
        passwordStrengthItems[4].classList.toggle('active', hasMinLength);


    });
    </script>


</body>

</html>