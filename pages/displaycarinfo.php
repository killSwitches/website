<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h2 {
            color: #007bff;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        p {
            color: #ff0000;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php
    session_start(); // Start the session to use session variables

    // Database connection parameters
    $servername = "sql11.freesqldatabase.com"; // Change to your database host
    $database = "sql11701255"; // Change to your database name
    $username = "sql11701255"; // Change to your database username
    $password = "y4bq5IUQaq"; // Change to your database password

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if OwnerID is set in the session
    if (isset($_SESSION['OwnerID'])) {
        $ownerID = $_SESSION['OwnerID'];

        // Prepare SQL query to retrieve car information for the logged-in owner
        $sql = "SELECT * FROM Car WHERE OwnerID = '$ownerID'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            // Display car information in a table
            echo "<h2>Car Information</h2>";
            echo "<table>";
            echo "<tr><th>Car VIN Number</th><th>License Plate</th><th>Make</th><th>Model</th><th>Color</th><th>Year Model</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["carVinNumber"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["licensePlate"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["make"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["color"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["yearModel"]) . "</td>";
                echo "</tr>";
            }

            echo "</table>";

            // Button to go back to index page
            echo '<form action="clienthomepage.php" method="post">';
            echo '<input type="submit" value="Back to Home" />';
            echo '</form>';
        } else {
            echo "<p>No car information found for this owner.</p>";
        }

        // Free result set
        $result->free_result();
    } else {
        echo "<p>OwnerID not found in session.</p>";
    }

    // Close database connection
    $conn->close();
    ?>
</body>
</html>
