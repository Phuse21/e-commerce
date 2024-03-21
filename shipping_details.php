<?php

function saveAndContinue()
{
    // Debugging statement
    echo "REQUEST_METHOD: " . $_SERVER["REQUEST_METHOD"];

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Start the session
        session_start();

        // Store data in session
        $_SESSION["shipping_details"] = array(
            'firstName' => $_POST['firstName'],
            'lastName' => $_POST['lastName'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'address2' => $_POST['address2'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'zip' => $_POST['zip']
        );

        // Redirect to payment.php
        header("Location: payment.php");
        exit; // Stop further execution
    } else {
        // Return error message
        echo "<script>alert('Error saving shipping details.')</script>";
    }
}