<?php

try {
    $dbhost = "localhost";
    $dbname = "kerremus_deepdive";
    $dbuser = "bit_academy";
    $dbpass = "bit_academy";
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}