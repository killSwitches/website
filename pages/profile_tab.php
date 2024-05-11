<?php
// Start the session
session_start();

// Check if the OwnerID is set in the session
if (!isset($_SESSION['OwnerID'])) {
    echo "No Owner ID in session, please log in.";
    exit; // Or redirect to login page
}

$ownerId = $_SESSION['OwnerID']; // Get the Owner ID from session

// DB configuration
$host = "sql11.freesqldatabase.com"; // Change to your database host
    $dbname = "sql11701255"; // Change to your database name
    $username = "sql11701255"; // Change to your database username
    $password = "y4bq5IUQaq"; // Change to your database password

try {
    // Establish connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Assume the form has been submitted and handle the POST data
        $name = $_POST['name'];
        $lastName = $_POST['lastName'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        // SQL to update owner information
        $sql = "UPDATE Owner SET name = ?, lastName = ?, address = ?, email = ?, phoneNumber = ? WHERE OwnerID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $lastName, $address, $email, $phoneNumber, $ownerId]);

        echo "<p>Information updated successfully!</p>";
    }

    // Fetch the current data
    $sql = "SELECT * FROM Owner WHERE OwnerID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$ownerId]);
    $owner = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Owner Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px #ccc;
        }
        input[type="text"], input[type="email"], input[type="submit"] {
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box; /* Include padding and border in the element's width and height */
        }
        input[type="submit"] {
            background-color: #5C8BC0;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4a6e8c;
        }
    </style>
</head>
<body>
    <h1>Update Your Information</h1>

    <?php if ($owner): ?>
        <form action="" method="post">
            Name: <input type="text" name="name" value="<?php echo htmlspecialchars($owner['name']); ?>"><br>
            Last Name: <input type="text" name="lastName" value="<?php echo htmlspecialchars($owner['lastName']); ?>"><br>
            Address: <input type="text" name="address" value="<?php echo htmlspecialchars($owner['address']); ?>"><br>
            Email: <input type="email" name="email" value="<?php echo htmlspecialchars($owner['email']); ?>"><br>
            Phone Number: <input type="text" name="phoneNumber" value="<?php echo htmlspecialchars($owner['phoneNumber']); ?>"><br>
            <input type="submit" value="Update Information">
        </form>

        <a href="clienthomepage.php"> Go back home</a>
    <?php else: ?>
        <p>No owner found with ID: <?php echo htmlspecialchars($ownerId); ?></p>
    <?php endif; ?>
</body>
</html>
