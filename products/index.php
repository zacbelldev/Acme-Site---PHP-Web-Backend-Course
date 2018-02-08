<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Products Controller
//get or create the session
session_start();

// Get the functions library
require_once '../library/functions.php';

// Get the database connection file
require_once '../library/connections.php';

// Get the acme model for use as needed
require_once '../model/acme-model.php';

// Get the accounts model
require_once '../model/products-model.php';

// Get the uploads model
require_once '../model/uploads-model.php';

// Get the reviews model
require_once '../model/reviews-model.php';

$navList = createNavList();

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'prod-mgmt';
    }
}

switch ($action) {
    case 'prod-mgmt':
        $products = getProductBasics();
        if (count($products) > 0) {
            $prodList = '<table>';
            $prodList .= '<thead>';
            $prodList .= '<tr><th>Product Name</th><td>&nbsp;</td><td>&nbsp;</td></tr>';
            $prodList .= '</thead>';
            $prodList .= '<tbody>';
            foreach ($products as $product) {
                $prodList .= "<tr><td>$product[invName]</td>";
                $prodList .= "<td><a href='/acme/products?action=mod&id=$product[invId]' title='Click to modify'>Modify</a></td>";
                $prodList .= "<td><a href='/acme/products?action=del&id=$product[invId]' title='Click to delete'>Delete</a></td></tr>";
            }
            $prodList .= '</tbody></table>';
        } else {
            $message = '<p class="notify">Sorry, no products were returned.</p>';
        }
        include '../view/prod-mgmt.php';
        break;

    case 'new-cat-page':
        include '../view/new-cat.php';
        break;

    case 'new-prod-page':
        include '../view/new-prod.php';
        break;
}


switch ($action) {
    case 'new-cat':
        $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($categoryName)) {
            $message = '<p>Please provide a name for the new category.</p>';
            include '../view/new-cat.php';
        } else {
            // Send the data to the model
            $catOutcome = catOutcome($categoryName);
            // Check and report the result
            if ($catOutcome === 1) {
                header('location: /acme/products/');
            } else {
                $message = "<p>Sorry $categoryName was not added. Please try again.</p>";
                include '../view/new-cat.php';
            }
        }
        break;

    case 'new-prod':
        // Filter and store the data
        $invName = filter_input(INPUT_POST, 'invName', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invSize = filter_input(INPUT_POST, 'invSize', FILTER_SANITIZE_NUMBER_INT);
        $invWeight = filter_input(INPUT_POST, 'invWeight', FILTER_SANITIZE_NUMBER_INT);
        $invLocation = filter_input(INPUT_POST, 'invLocation', FILTER_SANITIZE_STRING);
        $catNameOption = filter_input(INPUT_POST, 'catNameOption', FILTER_SANITIZE_STRING);
        $invVendor = filter_input(INPUT_POST, 'invVendor', FILTER_SANITIZE_STRING);
        $invStyle = filter_input(INPUT_POST, 'invStyle', FILTER_SANITIZE_STRING);

        // Check for missing data
        if (empty($invName) || empty($invDescription) ||
                empty($invImage) || empty($invThumbnail) || empty($invPrice) ||
                empty($invStock) || empty($invSize) || empty($invWeight) ||
                empty($invLocation) || empty($catNameOption) || empty($invVendor) ||
                empty($invStyle)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/new-prod.php';
        } else {
            // Send the data to the model
            $productOutcome = productOutcome($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $catNameOption, $invVendor, $invStyle);
            // Check and report the result
            if ($productOutcome === 1) {
                $message = "<p>Congratulations, $invName was successfully added.</p>";
                include '../view/new-prod.php';
            } else {
                $message = "<p>Sorry $invName was not added. Please try again.</p>";
                include '../view/new-prod.php';
            }
        }
        break;

    case 'mod':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-update.php';
        exit;
        break;

    case 'updateProd':
        $catType = filter_input(INPUT_POST, 'catType', FILTER_SANITIZE_NUMBER_INT);
        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodDesc = filter_input(INPUT_POST, 'prodDesc', FILTER_SANITIZE_STRING);
        $prodImg = filter_input(INPUT_POST, 'prodImg', FILTER_SANITIZE_STRING);
        $prodThumb = filter_input(INPUT_POST, 'prodThumb', FILTER_SANITIZE_STRING);
        $prodPrice = filter_input(INPUT_POST, 'prodPrice', FILTER_SANITIZE_STRING);
        $prodStock = filter_input(INPUT_POST, 'prodStock', FILTER_SANITIZE_NUMBER_INT);
        $prodSize = filter_input(INPUT_POST, 'prodSize', FILTER_SANITIZE_NUMBER_INT);
        $prodWeight = filter_input(INPUT_POST, 'prodWeight', FILTER_SANITIZE_NUMBER_INT);
        $prodLocation = filter_input(INPUT_POST, 'prodLocation', FILTER_SANITIZE_STRING);
        $prodVendor = filter_input(INPUT_POST, 'prodVendor', FILTER_SANITIZE_STRING);
        $prodStyle = filter_input(INPUT_POST, 'prodStyle', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);
        if (empty($catType) || empty($prodName) || empty($prodDesc) || empty($prodImg) || empty($prodThumb) || empty($prodPrice) || empty($prodStock) || empty($prodSize) || empty($prodWeight) || empty($prodLocation) || empty($prodVendor) || empty($prodStyle)) {
            $message = '<p>Please complete all information for the updated item! Double check the category of the item.</p>';
            include '../view/prod-update.php';
            exit;
        } $updateResult = updateProduct($catType, $prodName, $prodDesc, $prodImg, $prodThumb, $prodPrice, $prodStock, $prodSize, $prodWeight, $prodLocation, $prodVendor, $prodStyle, $prodId);
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, $prodName was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p>Error. The new product was not updated.</p>";
            include '../view/prod-update.php';
            exit;
        }
        break;

    case 'del':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        }
        include '../view/prod-delete.php';
        exit;
        break;

    case 'deleteProd':
        $prodName = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING);
        $prodId = filter_input(INPUT_POST, 'prodId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteProduct($prodId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations, $prodName was successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $prodName was not deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /acme/products/');
            exit;
        }
        break;

    case 'category':
        $type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
        $products = getProductsByCategory($type);
        if (!count($products)) {
            $message = "<p class='notice'>Sorry, no $type products ccould be found.</p>";
        } else {
            $prodDisplay = buildProductsDisplay($products);
        }
        include '../view/category.php';
        break;

    case 'detail':
        $prodId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $prodInfo = getProductInfo($prodId);
        if (count($prodInfo) < 1) {
            $message = 'Sorry, no product information could be found.';
        } else {
            $prodDetailThumb = getThumbnail($prodId);
            $prodDisplay = buildProductsDetail($prodInfo, $prodDetailThumb); //function call to functions
            // build the review form
            $prodName = $prodInfo['invName'];

            if (isset($_SESSION['clientData'])) {
                $firstname = $_SESSION['clientData']['clientFirstname'];
                $lastname = $_SESSION['clientData']['clientLastname'];
                $reviewForm = buildReviewForm($firstname, $lastname, $prodId, $prodName); //function call to functions
            }

            // build the reviews on each product detail view
            $reviewInfo = getProdReview($prodId); //function call to model
            if (!empty($reviewInfo)) {
                $reviewDisplay = buildProdReviews($reviewInfo); //function call to functions
            }
        }
        include '../view/product-detail.php';
        exit;
        break;
}



