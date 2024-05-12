<?php
// Include db_connection.php to use the connectDb() function
require_once 'database/db_connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Create Account</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Create Account">
    </form>
</div>

<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];

    try {
        // Establish database connection using connectDb() function
        $pdo = connectDb(); // Assuming connectDb() function is available from db_connection.php

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert a new user
        $sql = "INSERT INTO users (name, last_name, password) VALUES (:name, :last_name, :password)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters and execute the prepared statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        // Display success message
        echo '<div style="text-align: center; margin-top: 20px; color: green;">User account created successfully!</div>';

        // Close the database connection
        $pdo = null;
    } catch (PDOException $e) {
        // Display error message
        echo '<div style="text-align: center; margin-top: 20px; color: red;">Error creating user account: ' . $e->getMessage() . '</div>';
    }
}
?>

</body>
</html>
