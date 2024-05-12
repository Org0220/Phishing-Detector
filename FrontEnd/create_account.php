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
            margin: 0;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .background {
            background-image: url('90614.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #D1E6F0;
            /* Transparent white */
            padding: 10px 0px;
            display: flex;
            /* Use flexbox for layout */
            align-items: center;
            /* Center items vertically */
            z-index: 1000;
            /* Ensure navbar stays on top */
            transition: background-color 0.3s ease;
            /* Smooth transition on hover */
        }

        .logo {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Use a different font */
            font-size: 24px;
            font-weight: bold;
            color: #1a237e;
            /* Dark Blue */
            margin-right: auto;
            /* Pushes the logo to the left */
            display: flex;
            /* Use flexbox for layout */
            align-items: center;
            /* Center items vertically */
        }

        .logo img {
            margin-right: 10px;
            /* Add some space between logo text and image */
            max-height: 70px;
            /* Set maximum height for the image */
        }

        .navbar a {
            color: #1a237e;
            /* Dark Blue */
            text-decoration: none;
            margin: 0 15px;
            font-weight: bold;
            transition: color 0.3s ease;
            /* Smooth transition on hover */
        }

        .navbar a:hover {
            color: #0d47a1;
            /* Darker Blue on hover */
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #1a237e;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #121858;
        }
    </style>
</head>

<body>
    
    <div class="navbar">
        <div class="logo">
            <img src="Logo.png" alt="Logo">
            Anti Phishing Academy
        </div style="font-size:20px;">
        <a href="http://localhost/Phishing-Detector/FrontEnd/index.php">Home</a>
        <a href="http://localhost/Phishing-Detector/FrontEnd/create_account.php">Create Account</a>
        <a href="http://localhost/Phishing-Detector/FrontEnd/login.php">Login</a>
        
    </div>

    <div class="background">
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
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Prepare SQL statement to insert a new user
            $sql = "INSERT INTO users (name, last_name, password) VALUES (:name, :last_name, :password)";
            $stmt = $pdo->prepare($sql);
            echo $hashedPassword;
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