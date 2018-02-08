<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//THIS IS THE REVIEWS CONTROLLER
//get or create the session
session_start();


// Get the functions library
require_once '../library/functions.php';

// Get the database connection file
require_once '../library/connections.php';

// Get the acme model for use as needed
require_once '../model/acme-model.php';

// Get the reviews model for use as needed
require_once '../model/reviews-model.php';

$navList = createNavList();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'home';
    }
}

switch ($action) {
    case 'home':
        include 'view/home.php';
        break;

    case 'new-review':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_STRING);
        $clientId = $_SESSION['clientData']['clientId'];

        // Check for missing data
        if (empty($reviewText)) {
            $message = '<p>The review cannot be empty. Please provide a review.</p>';
            $_SESSION['message'] = $message;
            header('Location:/acme/products/index.php?action=detail&id=' . $invId . '');
            exit;
        } else {
            // Send the data to the model
            $revOutcome = revOutcome($reviewText, $invId, $clientId);
            // Check and report the result
            if ($revOutcome === 1) {
                $message = '<p>Review Added.</p>';
                $_SESSION['message'] = $message;
                header('Location:/acme/products/index.php?action=detail&id=' . $invId . '');
                exit;
            } else {
                $message = "<p>Sorry, your review was not added. Please try again.</p>";
                $_SESSION['message'] = $message;
                header('Location:/acme/products/index.php?action=detail&id=' . $invId . '');
                exit;
            }
        }
        break;

    case 'update':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $revInfo = getAdminReviewDetail($reviewId);
        include '../view/review-update.php';
        break;

    case 'update-review':
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewText)) {
            $message = '<p>The review cannot be empty. Please provide a review.</p>';
            $_SESSION['message'] = $message;
            header('Location:/acme/reviews/index.php?action=update&id=' . $reviewId . '');
            exit;
        } else {
            $updateReview = updateReview($reviewText, $reviewId);
        }

        if ($updateReview === 1) {
            $message = "<p class='notify'>Congratulations, your review was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('Location:/acme/index.php?action=admin');
            exit;
        } else {
            $message = "<p>Error. The review was not updated.</p>";
            $_SESSION['message'] = $message;
            header('Location:/acme/index.php?action=admin');
            exit;
        }
        break;

    case 'del':
        $reviewId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $revInfo = getAdminReviewDetail($reviewId);
        include '../view/review-delete.php';
        break;

    case 'delete-review':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p class='notice'>The review was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('Location:/acme/index.php?action=admin');
            exit;
        } else {
            $message = "<p class='notice'>Error: the review was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('Location:/acme/index.php?action=admin');
            exit;
        }
        break;

    default:
        if (isset($_SESSION['loggedin'])) {
            include '../view/admin.php';
        } else {
            include '../view/home.php';
        }
        break;
}
