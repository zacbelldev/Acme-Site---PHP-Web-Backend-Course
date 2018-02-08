<?php

/*
  This is the accounts model for adding reviews
 */

// this function will show the reviews on the product detail
function getProdReview($prodId) {
    $db = acmeConnect();
    $sql = 'SELECT reviews.reviewText, 
                    reviews.reviewDate, 
                    clients.clientFirstname, 
                    clients.clientLastname,
                    inventory.invName
            FROM reviews
            JOIN clients
                ON reviews.clientId = clients.clientId
            JOIN inventory 
                ON reviews.invId = inventory.invId
            WHERE inventory.invId = :prodId
            ORDER By reviews.reviewDate ASC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $reviews;
}

// this function will show the reviews on the product detail
function getAdminReviews($clientId) {
    $db = acmeConnect();
    $sql = 'SELECT reviews.reviewId, 
                   reviews.reviewDate,
                   inventory.invName,
                   inventory.invId,
                   clients.clientId
            FROM reviews
            JOIN clients
                ON reviews.clientId = clients.clientId
            JOIN inventory 
                ON reviews.invId = inventory.invId
            WHERE clients.clientId = :clientId
            ORDER By reviews.reviewDate ASC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $reviews;
}

// this function will show the reviews on the product detail
function getAdminReviewDetail($reviewId) {
    $db = acmeConnect();
    $sql = 'SELECT reviews.reviewId,
                   reviews.reviewText,
                   reviews.reviewDate,
                   inventory.invName
            FROM reviews
            JOIN inventory 
                ON reviews.invId = inventory.invId
            WHERE reviews.reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $reviews;
}

function revOutcome($reviewText, $invId, $clientId) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'INSERT INTO reviews (reviewText, invId, clientId) VALUES (:reviewText, :invId, :clientId)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

// this function will update a review
function updateReview($reviewText, $reviewId) {
// Create a connection
    $db = acmeConnect();
// The SQL statement to be used with the database
    $sql = 'UPDATE reviews SET reviewText = :reviewText WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// this function will delete a review
function deleteReview($prodId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM reviews WHERE reviewId = :reviewId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}



