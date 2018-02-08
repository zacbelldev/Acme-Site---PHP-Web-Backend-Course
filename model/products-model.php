<?php

/*
  This is the accounts model for adding products
 */

function catOutcome($categoryName) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'INSERT INTO categories (categoryName) VALUES (:categoryName)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':categoryName', $categoryName, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

function productOutcome($invName, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invSize, $invWeight, $invLocation, $catNameOption, $invVendor, $invStyle) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'INSERT INTO inventory (invName, invDescription, invImage, 
       invThumbnail, invPrice, invStock, invSize, invWeight, invLocation,
       categoryID, invVendor, invStyle)
           VALUES (:invName, :invDescription, :invImage, :invThumbnail, 
           :invPrice, :invStock, :invSize, :invWeight, :invLocation, 
           :catNameOption, :invVendor, :invStyle)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is

    $stmt->bindValue(':invName', $invName, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_INT);
    $stmt->bindValue(':invSize', $invSize, PDO::PARAM_INT);
    $stmt->bindValue(':invWeight', $invWeight, PDO::PARAM_INT);
    $stmt->bindValue(':invLocation', $invLocation, PDO::PARAM_STR);
    $stmt->bindValue(':catNameOption', $catNameOption, PDO::PARAM_STR);
    $stmt->bindValue(':invVendor', $invVendor, PDO::PARAM_STR);
    $stmt->bindValue(':invStyle', $invStyle, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

// this function will get basic product information 
// from the inventory table for starting an update or delete process
function getProductBasics() {
    $db = acmeConnect();
    $sql = 'SELECT invName, invId FROM inventory ORDER BY invName ASC';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $products;
}

// this function will be selecting a single product based on its id
function getProductInfo($prodId) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $prodInfo = $stmt->fetch(PDO::FETCH_NAMED);
    $stmt->closeCursor();
    return $prodInfo;
}

// this function will update a product
function updateProduct($catType, $prodName, $prodDesc, $prodImg, $prodThumb, $prodPrice, $prodStock, $prodSize, $prodWeight, $prodLocation, $prodVendor, $prodStyle, $prodId) {
// Create a connection
    $db = acmeConnect();
// The SQL statement to be used with the database
    $sql = 'UPDATE inventory SET invName = :prodName, invDescription = :prodDesc, invImage = :prodImg, invThumbnail = :prodThumb, invPrice = :prodPrice, invStock = :prodStock, invSize = :prodSize, invWeight = :prodWeight, invLocation = :prodLocation, categoryId = :catType, invVendor = :prodVendor, invStyle = :prodStyle WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catType', $catType, PDO::PARAM_INT);
    $stmt->bindValue(':prodName', $prodName, PDO::PARAM_STR);
    $stmt->bindValue(':prodDesc', $prodDesc, PDO::PARAM_STR);
    $stmt->bindValue(':prodImg', $prodImg, PDO::PARAM_STR);
    $stmt->bindValue(':prodThumb', $prodThumb, PDO::PARAM_STR);
    $stmt->bindValue(':prodPrice', $prodPrice, PDO::PARAM_STR);
    $stmt->bindValue(':prodStock', $prodStock, PDO::PARAM_INT);
    $stmt->bindValue(':prodSize', $prodSize, PDO::PARAM_INT);
    $stmt->bindValue(':prodWeight', $prodWeight, PDO::PARAM_INT);
    $stmt->bindValue(':prodLocation', $prodLocation, PDO::PARAM_STR);
    $stmt->bindValue(':prodVendor', $prodVendor, PDO::PARAM_STR);
    $stmt->bindValue(':prodStyle', $prodStyle, PDO::PARAM_STR);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// this function will delete a product
function deleteProduct($prodId) {
    $db = acmeConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :prodId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':prodId', $prodId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

function getProductsByCategory($type) {
    $db = acmeConnect();
    $sql = 'SELECT * FROM inventory WHERE categoryId IN (SELECT categoryId FROM categories WHERE categoryName = :catType)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':catType', $type, PDO::PARAM_STR);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $products;
}
