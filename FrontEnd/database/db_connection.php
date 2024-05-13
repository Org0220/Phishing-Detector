<?php

function connectDb()
{
    // Database connection parameters
    $host = '127.0.0.1';
    $DBname = 'anti_phishing_academy';
    $username = 'admin';
    $password = 'admin';

    // Establish database connection using PDO
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$DBname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
    return $pdo;
}
