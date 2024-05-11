<?php
// Start the session to use session variables
session_start();

$servername = "sql11.freesqldatabase.com"; // Change to your database host
    $dbname = "sql11701255"; // Change to your database name
    $username = "sql11701255"; // Change to your database username
    $password = "y4bq5IUQaq"; // Change to your database password

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input (email and password) from POST request using prepared statements
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    // Prepare SQL query to retrieve owner data based on provided email and password using prepared statements
    $sql = "SELECT * FROM owner WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User found, retrieve the ownerID
        $row = $result->fetch_assoc();
        $ownerID = $row['OwnerID']; // Assuming 'ownerID' is the correct column name for user's ID

        // Save ownerID into session variable
        $_SESSION['OwnerID'] = $ownerID;

        // Redirect based on user type
        if ($row['user_type'] == 'admin') {
            header("Location: ../pages/adminhomepage.php");
            exit;
        } else {
            // Redirect to client homepage after successful login
            header("Location: ../pages/clienthomepage.php");
           //header("Location: ../pages/test.php");
            exit;
        }
    } else {
        // User not found, redirect to error page or login page
        header("Location: ../pages/loginerror.php");
        exit;
    }
} else {
    // If the form data is not submitted via POST, handle accordingly (e.g., display an error message)
    die("Invalid request method.");
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
