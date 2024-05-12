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
            margin: 30px;
        }
        table, th, td {
            margin: auto;
            text-align: center;
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Users & Results</h1>

<?php
// Include db_connection.php to use the connectDB() function
require_once 'db_connection.php';

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

</body>
</html>