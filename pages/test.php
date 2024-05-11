<?php
session_start(); // Start the session to use session variables

// Check if ownerID is set in the session
if (isset($_SESSION['OwnerID'])) {
    $ownerID = $_SESSION['OwnerID'];
} else {
    $ownerID = "Owner ID not found"; // Default message if ownerID is not set
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Owner ID</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Owner ID Display</h1>

    <div>
        <?php
        // Display ownerID retrieved from the session
        echo "<p>Owner ID: $ownerID</p>";
        ?>
    </div>
</body>
</html>
