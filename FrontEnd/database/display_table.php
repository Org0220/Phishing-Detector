<!DOCTYPE html>
<html>
<head>
    <title>Users & Results</title>
    <style>
        h1 {
            text-align: center;
            font-weight: bold;
        }
        table {
            width: 75%;
            border-collapse: collapse;
            margin: 30px auto;
        }
        table, th, td {
            text-align: center;
            border: 1px solid black;
            padding: 5px;
        }
        th {
            background-color: #f2f2f2;
        }
        .delete-btn {
            color: red;
            cursor: pointer;
        }
        #add-user-form {
            margin: 20px auto;
            width: 30%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center; /* Center content within the form */
        }
        #add-user-form input[type="text"],
        #add-user-form input[type="password"],
        #add-user-form input[type="submit"] {
            margin: 5px auto; /* Center the input elements horizontally */
            padding: 8px;
            width: 90%;
            box-sizing: border-box;
        }
        #add-user-form label {
            display: block; /* Display labels as block elements (on new lines) */
            margin-bottom: 5px; /* Add space below each label */
            text-align: left; /* Align labels to the left */
        }
    </style>
</head>
<body>

<h1>Users & Results</h1>

<!-- Add User Form -->
<div id="add-user-form">
    <h2>+ Add a User</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name" style = "margin-left: 20px;">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="last_name" style = "margin-left: 20px;"> Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="password" style = "margin-left: 20px;">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Add User">
    </form>
</div>

<?php
// Include db_connection.php to use the connectDB() function
require_once 'db_connection.php';

// Handle form submission to add a new user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'], $_POST['last_name'], $_POST['password'])) {
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $password = $_POST['password'];

    try {
        // Establish database connection using connectDB() function
        $pdo = connectDB();

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

        // Close the database connection
        $pdo = null;

        // Redirect back to the page after adding the user
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        echo 'Error adding user: ' . $e->getMessage();
    }
}

// Handle form submission to delete a user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_uid'])) {
    $deleteUid = $_POST['delete_uid'];

    try {
        // Establish database connection using connectDB() function
        $pdo = connectDB();

        // Prepare SQL statement to delete the user
        $sql = "DELETE FROM users WHERE uid = :uid";
        $stmt = $pdo->prepare($sql);

        // Bind parameter and execute the prepared statement
        $stmt->bindParam(':uid', $deleteUid);
        $stmt->execute();

        // Close the database connection
        $pdo = null;

        // Redirect back to the page after deleting the user
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } catch (PDOException $e) {
        echo 'Error deleting user: ' . $e->getMessage();
    }
}

try {
    // Establish database connection using connectDB() function
    $pdo = connectDB();

    // Query to retrieve user data with result statistics
    $sql = "SELECT u.uid, u.name, u.last_name, 
            COUNT(r.result) AS num_attempts,
            MIN(r.result) AS min_result,
            AVG(r.result) AS avg_result,
            MAX(r.result) AS max_result
            FROM users u
            LEFT JOIN results r ON u.uid = r.uid
            GROUP BY u.uid";

    // Prepare and execute the SQL query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // Check if there are any users
    if ($stmt->rowCount() > 0) {
        // Display user results in a table
        echo '<table>';
        echo '<tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Last Name</th>
                <th>Number of Attempts</th>
                <th>Minimum Result</th>
                <th>Average Result</th>
                <th>Maximum Result</th>
                <th>Delete</th>
              </tr>';

        // Fetch and display each user's data
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr>';
            echo '<td>' . $row['uid'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['last_name'] . '</td>';
            echo '<td>' . ($row['num_attempts'] ?? 0) . '</td>'; // Display "0" if num_results is null
            echo '<td>' . ($row['min_result'] !== null ? $row['min_result'] : 'N/A') . '</td>'; // Display "N/A" if min_result is null
            echo '<td>' . ($row['avg_result'] !== null ? intval($row['avg_result']) : 'N/A') . '</td>'; // Display "N/A" if avg_result is null
            echo '<td>' . ($row['max_result'] !== null ? $row['max_result'] : 'N/A') . '</td>'; // Display "N/A" if max_result is null
            
            // Check if uid is not equal to 1 to display the delete button
            if ($row['uid'] != 1) {
                echo '<td><button class="delete-btn" onclick="deleteUser(' . $row['uid'] . ')">&times;</button></td>'; // Delete button with uid parameter
            } else {
                echo '<td></td>'; // Display empty column if uid is 1 (no delete button)
            }
            
            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo 'No users found.';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Close the database connection
$pdo = null;
?>

<script>
// JavaScript function to confirm user deletion and submit form
function deleteUser(uid) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Create a form element dynamically
        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', '<?php echo $_SERVER['PHP_SELF']; ?>');

        // Create an input element to hold the uid value
        var inputUid = document.createElement('input');
        inputUid.setAttribute('type', 'hidden');
        inputUid.setAttribute('name', 'delete_uid');
        inputUid.setAttribute('value', uid);

        // Append input element to the form
        form.appendChild(inputUid);

        // Append form to the document body and submit
        document.body.appendChild(form);
        form.submit();
    }
}
</script>

</body>
</html>