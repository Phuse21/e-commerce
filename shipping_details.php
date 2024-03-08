<?php

// Start the session
session_start();

// Check if the request method is POST and if the required POST parameters are set
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['firstName'])
    && isset($_POST['lastName']) && isset($_POST['email']) && isset($_POST['address'])
    && isset($_POST['address2']) && isset($_POST['city']) && isset($_POST['state'])
    && isset($_POST['zip'])
) {
    // Retrieve shipping details from the POST request
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip = $_POST['zip'];

    // Store the shipping details in the session
    $_SESSION['shipping_details'] = array(
        'firstName' => $firstName,
        'lastName' => $lastName,
        'email' => $email,
        'address' => $address,
        'address2' => $address2,
        'city' => $city,
        'state' => $state,
        'zip' => $zip
    );

    // Return a success response
    http_response_code(200);
    echo 'Shipping details saved successfully.';
} else {
    // Return an error response if the request is invalid
    http_response_code(400);
    echo 'Error: Invalid request.';
}

