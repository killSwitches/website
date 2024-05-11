<?php
session_start(); // Start the session

// Database configuration
$host = "sql11.freesqldatabase.com"; // Change to your database host
    $dbname = "sql11701255"; // Change to your database name
    $username = "sql11701255"; // Change to your database username
    $password = "y4bq5IUQaq"; // Change to your database password

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: Could not connect to the database. " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data using $_POST
    $email = $_POST['user'];
    $password = $_POST['pass'];
    $username = $_POST['name'];
    $address = $_POST['Address'];
    $cellNumber = $_POST['CellNumber'];
    $lastName = $_POST['lastName'];
    $user_type = 'client'; // Set default user_type to 'client'

    // Generate a random userID between 1111111111111 and 9999999999999
    $minUserID = 1111111111111;
    $maxUserID = 9999999999999;
    $userID = mt_rand($minUserID, $maxUserID);

    // Prepare SQL statement to insert data into Owner table
    $sql = "INSERT INTO Owner (ownerID, name, lastName, address, email, password, phoneNumber, user_type) 
            VALUES (:userID, :username, :lastName, :address, :email, :password, :cellNumber, :user_type)";

    try {
        // Prepare the SQL statement for execution
        $stmt = $pdo->prepare($sql);

        // Bind parameters to the prepared statement
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':cellNumber', $cellNumber);
        $stmt->bindParam(':user_type', $user_type);

        // Execute the prepared statement
        $stmt->execute();

        // Store ownerID in session variable
        $_SESSION['ownerID'] = $userID;

        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;

        // Redirect to registered page after successful registration
        header("Location: ../pages/carInfo.php");
        exit(); // Stop further execution after redirection
    } catch (PDOException $e) {
        die("Error: Could not execute query. " . $e->getMessage());
    }
} else {
    // Redirect to registration page if accessed without form submission
    header("Location: ../index.php");
    exit(); // Stop further execution after redirection
}
?>
