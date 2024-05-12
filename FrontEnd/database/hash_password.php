<?php
function hashPassword($password) {
    // Generate a password hash using bcrypt algorithm (default)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($hashedPassword === false) {
        // Password hashing failed
        throw new Exception('Password hashing failed.');
    }
    return $hashedPassword;
}