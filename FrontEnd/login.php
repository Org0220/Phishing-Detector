<?php
// Include db_connection.php to use the connectDb() function
require_once 'database/db_connection.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
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

        input[type="number"],
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
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
        <h2>Login</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" required>
            <label for="id">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Login" name="Submit">
        </form>
    </div>

    <?php
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $id = $_POST['id'];
        $password = $_POST['password'];

        try {
            // Establish database connection using connectDb() function
            $pdo = connectDb(); // Assuming connectDb() function is available from db_connection.php

            // Hash the password

            echo $id;
            echo $password;
            // Prepare SQL statement to insert a new user
            $sql = "SELECT * FROM users WHERE uid = :uid";
            $stmt = $pdo->prepare($sql);

            // Bind parameters and execute the prepared statement
            $stmt->bindParam(':uid', $id);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                throw new Exception('Invalid ID');
            }

            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!password_verify($password, $user['password'])) {
                throw new Exception('Invalid password');
            }
            if ($id == 0) {
                //admin
                header("Location: http://localhost/Phishing-Detector/FrontEnd/database/display_table.php");
            }
            $_SESSION['uid'] = $user['uid'];
            header("Location: http://localhost/Phishing-Detector/FrontEnd/index.php");
            // Display success message
            echo '<div style="text-align: center; margin-top: 20px; color: green;">Logged in successfully!</div>';

            // Close the database connection
            $pdo = null;
        } catch (PDOException $e) {
            // Display error message
            echo '<div style="text-align: center; margin-top: 20px; color: red;">Error logging in: ' . $e->getMessage() . '</div>';
        }
    }
    ?>

</body>

</html>