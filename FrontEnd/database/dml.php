<?php

require_once 'db_connection.php';
require_once 'hash_password.php';

function createUser($name, $last_name, $password)
{
    try {
        // Connect to the database
        $pdo = connectDb();

        // Hash the password using the hashPassword function
        $hashedPassword = hashPassword($password);

        // Prepare SQL statement for inserting user
        $sql = "INSERT INTO users (name, last_name, password) VALUES (:name, :last_name, :hashedPassword)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the prepared statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':hashedPassword', $hashedPassword);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error creating account " . $e->getMessage();
    } finally {
        // Close the database connection
        $pdo = null;
    }
}

function storeResult($uid, $result)
{
    try {
        // Connect to the database
        $pdo = connectDb();

        // Prepare SQL statement for inserting result
        $sql = "INSERT INTO results (uid, result) VALUES (:uid, :result)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the prepared statement
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':result', $result);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error storing result: " . $e->getMessage();
    } finally {
        // Close the database connection

        $pdo = null;
    }
}
