<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function acmeConnect() {
    $server = 'localhost';
    $database = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $username = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $password = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $dsn = 'mysql:host=' . $server . ';dbname=' . $database;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $acmeDB = new PDO($dsn, $username, $password, $options);
//        echo 'connection successful';
        return $acmeDB;
    } catch (PDOException $exc) {
//        echo $exc->getTraceAsString();
//        echo 'connection failed';
        header('Location: http://localhost/acme/index.php?action=error');
        exit;
    }
}

function connectGuitarOneDB() {
    $server = 'localhost';
    $database = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $username = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $password = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $dsn = 'mysql:host=' . $server . ';dbname=' . $database;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $acmeDB = new PDO($dsn, $username, $password, $options);
//        echo 'connection successful';
        return $acmeDB;
    } catch (PDOException $exc) {
//        echo $exc->getTraceAsString();
//        echo 'connection failed';
        header('Location: http://localhost/acme/index.php?action=error');
        exit;
    }
}

function connectGuitarTwoDB() {
    $server = 'localhost';
    $database = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $username = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $password = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxx';
    $dsn = 'mysql:host=' . $server . ';dbname=' . $database;
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try {
        $acmeDB = new PDO($dsn, $username, $password, $options);
//        echo 'connection successful';
        return $acmeDB;
    } catch (PDOException $exc) {
//        echo $exc->getTraceAsString();
//        echo 'connection failed';
        header('Location: http://localhost/acme/index.php?action=error');
        exit;
    }
}

