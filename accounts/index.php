<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Accounts controller
//get or create the session
session_start();


// Get the functions library
require_once '../library/functions.php';
// Get the database connection file
require_once '../library/connections.php';
// Get the acme model for use as needed
require_once '../model/acme-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';
// Get the reviews model
require_once '../model/reviews-model.php';

$navList = createNavList();

//// Get the array of categories
//$categories = getCategories();
//
//// Build a navigation bar using the $categories array
//$navList = '<ul id="home">';
//$navList .= "<li><a href='.' title='View the Acme home page'>Home</a></li>";
//foreach ($categories as $category) {
//    $navList .= "<li><a href='.?action=$category[categoryName]' title='View our $category[categoryName] product line'>$category[categoryName]</a></li>";
//}
//$navList .= '</ul>';


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        header('location: /acme/index.php?action=register');
        exit;
    }
}
switch ($action) {
    case 'register':
        // Filter and store the data
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $email = checkEmail($email);
        $checkPassword = checkPassword($password);

        $existingEmail = checkExistingEmail($email);

        // check for an existing email in the database
        if ($existingEmail) {
            $message = '<p>That email is already in the system. Login instead.</p>';
            include '../view/login.php';
            exit;
        }

        // Check for missing data
        if (empty($firstname) || empty($lastname) || empty($email) || empty($checkPassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/register.php';
        } else {
            // Hash the checked password
            $password = password_hash($password, PASSWORD_DEFAULT);
            // Send the data to the model
            $regOutcome = regVisitor($firstname, $lastname, $email, $password);
            // Check and report the result
            if ($regOutcome === 1) {

                setcookie('firstname', $firstname, strtotime('+1 year'), '/');

                $message = "<p>Thanks for registering $firstname. Please use your email and password to login.</p>";
                include '../view/login.php';
                exit;
            } else {
                $message = "<p>Sorry $firstname, but the registration failed. Please try again.</p>";
                include '../view/registration.php';
            }
        }
        break;
    case 'login':
        // Check if the firstname cookie exists, get its value
        if (isset($_COOKIE['firstname'])) {
            unset($_COOKIE['firstname']); //clear the cookie value
            setcookie('firstname', '', time() - 3600, '/'); // clear the cookie from the browser
        }

        $email = filter_input(INPUT_POST, 'email');
        $email = checkEmail($email);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $passwordCheck = checkPassword($password);

        // Run basic checks, return if errors
        if (empty($email) || empty($passwordCheck)) {
            $message = '<p class="notice">Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($email);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($password, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

//        setcookie('firstname', $clientData['clientFirstname'], strtotime('+1 year'), '/');
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        if(isset($_SESSION['clientData'])) {
            $clientId = $_SESSION['clientData']['clientId'];
            $reviewInfo = getAdminReviews($clientId); //function call to model
            $clientReviews = buildAdminReviews($reviewInfo);
        }

        // Send them to the admin view
        include '../view/admin.php';
        exit;

        break;
    case 'logout':
        session_destroy();
        header('location: /acme/');
        exit;

        break;

    case 'accountUpdatePage':
        $clientId = $_SESSION['clientData']['clientId'];
        $firstname = $_SESSION['clientData']['clientFirstname'];
        $lastname = $_SESSION['clientData']['clientLastname'];
        $email = $_SESSION['clientData']['clientEmail'];
        include '../view/client-update.php';
        exit;

        break;

    case 'accountUpdate':
        $email = $_SESSION['clientData']['clientEmail'];
        // Filter and store the data
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $UpdateFirstname = filter_input(INPUT_POST, 'UpdateFirstname', FILTER_SANITIZE_STRING);
        $UpdateLastname = filter_input(INPUT_POST, 'UpdateLastname', FILTER_SANITIZE_STRING);
        $UpdateEmail = filter_input(INPUT_POST, 'UpdateEmail', FILTER_SANITIZE_EMAIL);
        $UpdateEmail = checkEmail($UpdateEmail);

        if ($UpdateEmail != $email) {
            $existingEmail = checkExistingEmail($UpdateEmail);

            // check for an existing email in the database
            if ($existingEmail) {
                $message = '<p>That email is already in the system. Login instead.</p>';
                include '../view/login.php';
                exit;
            }
        }
        // Check for missing data
        if (empty($UpdateFirstname) || empty($UpdateLastname) || empty($UpdateEmail)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
        } else {
            // Send the data to the model
            $accountUpdate = accountUpdate($clientId, $UpdateFirstname, $UpdateLastname, $UpdateEmail);
            // Check and report the result
            if ($accountUpdate === 1) {
                $message = "<p class='notify'>Congratulations, $UpdateFirstname. Your account was successfully updated.</p>";
                $_SESSION['message'] = $message;
                $clientData = getUpdatedClient($clientId);

//                setcookie('firstname', $clientData['clientFirstname'], strtotime('+1 year'), '/');
                // Remove the password from the array
                // the array_pop function removes the last
                // element from an array
                array_pop($clientData);
                // Store the array into the session
                $_SESSION['clientData'] = $clientData;
                include '../view/admin.php';
                exit;
            } else {
                $message = "<p>Sorry $UpdateFirstname, but the update failed. Please try again.</p>";
                include '../view/client-update.php';
                exit;
            }
        }
        break;

    case 'changePassword':
        // Filter and store the data
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $changePassword = filter_input(INPUT_POST, 'changePassword', FILTER_SANITIZE_STRING);
        $checkPassword = checkPassword($changePassword);

        // Check for missing data
        if (empty($changePassword)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
        } else {
            // Hash the checked password
            $changePassword = password_hash($changePassword, PASSWORD_DEFAULT);
            // Send the data to the model
            $changePasswordOutcome = changePassword($clientId, $changePassword);
            // Check and report the result
            if ($changePasswordOutcome === 1) {
                $message = "<p class='notify'>Congratulations, your password was changed.</p>";
                $_SESSION['message'] = $message;
                include '../view/admin.php';
                exit;
            } else {
                $message = "<p>Sorry, but the change failed. Please try again.</p>";
                include '../view/client-update.php';
                exit;
            }
        }
        break;
}