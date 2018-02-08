<?php

/*
  This is the accounts model for site visitors...
 */

//this function will handle site registrations

function regVisitor($firstname, $lastname, $email, $password) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname,
           clientEmail, clientPassword)
           VALUES (:firstname, :lastname, :email, :password)';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

//this function will check for an existing email address
function checkExistingEmail($email) {
    // Create a connection object from the acme connection function
    $db = acmeConnect();
    // The SQL statement to be used with the database
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    // The next line creates the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
    // The line replace the placeholder in the SQL
    // statement with the actual value in the variable
    // and tells the database the type of data it is
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    // The next line runs the prepared statement
    $stmt->execute();
    // The next line gets the data from the database and
    // stores it as a single row in the $matchEmail variable
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    // The next line closes the interaction with the database
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

// Get client data based on an email address
function getClient($email){
  $db = acmeConnect();
  $sql = 'SELECT * FROM clients WHERE clientEmail = :email';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':email', $email, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

// Get client data based on the user id
function getUpdatedClient($clientId){
  $db = acmeConnect();
  $sql = 'SELECT * FROM clients WHERE clientId = :clientId';
  $stmt = $db->prepare($sql);
  $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
  $stmt->execute();
  $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmt->closeCursor();
  return $clientData;
}

// this function will update a clients account
function accountUpdate($clientId, $UpdateFirstname, $UpdateLastname, $UpdateEmail) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'UPDATE clients SET clientFirstname = :firstname, clientLastname = :lastname, clientEmail = :email WHERE clientId = :clientId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':firstname', $UpdateFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':lastname', $UpdateLastname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $UpdateEmail, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}

// this function will change the user's password
function changePassword($clientId, $changePassword) {
// Create a connection object using the acme connection function
    $db = acmeConnect();
// The SQL statement
    $sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
// Create the prepared statement using the acme connection
    $stmt = $db->prepare($sql);
// The next four lines replace the placeholders in the SQL
// statement with the actual values in the variables
// and tells the database the type of data it is
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->bindValue(':clientPassword', $changePassword, PDO::PARAM_STR);
// Insert the data
    $stmt->execute();
// Ask how many rows changed as a result of our insert
    $rowsChanged = $stmt->rowCount();
// Close the database interaction
    $stmt->closeCursor();
// Return the indication of success (rows changed)
    return $rowsChanged;
}