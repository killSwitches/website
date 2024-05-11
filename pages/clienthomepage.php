<?php
session_start(); // Start the session to use session variables

// Check if the logout form is submitted
if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();
    session_destroy();
    // Redirect to a confirmation page or login page
    header("Location: login_page.php"); // Change "login.php" to your desired destination
    exit;
}

// Establish database connection
$servername = "sql11.freesqldatabase.com"; // Change to your database host
$database = "sql11701255"; // Change to your database name
$username = "sql11701255"; // Change to your database username
$password = "y4bq5IUQaq"; // Change to your database password

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch owner data if OwnerID is set in the session
$ownerData = ''; // Variable to store the output data
if (isset($_SESSION['OwnerID'])) {
    $ownerID = $_SESSION['OwnerID'];
    $query = "SELECT name, lastName FROM Owner WHERE OwnerID = ?";
    
    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ownerID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ownerData = "<p>Owner ID: $ownerID</p>" . "<p>Name: " . $row['name'] . " " . $row['lastName'] . "</p>";
    } else {
        $ownerData = "<p>No data found for this Owner ID.</p>";
    }
    $stmt->close();
} else {
    $ownerData = "<p>Owner ID not found in session.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Homepage</title>
    <style>
        /* Reset default browser styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header styles */
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .top-bar {
    background: linear-gradient(to top, var(--overlay-color) 50%, var(--overlay-color) 50%), url(backviewM4.jpg); /* Transparent background */
    color: white; /* Text color */
    font-size: x-large;
    padding: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

        /* Menu styles */
        .menu {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
        }

        .menu ul {
            list-style-type: none;
        }

        .menu ul li {
            margin-bottom: 10px;
        }

        .menu ul li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
        }

        .menu ul li img {
            width: 30px;
            margin-right: 10px;
        }

        /* Button styles */
        .register-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
            cursor: pointer;
            border-radius: 5px;
        }

        .register-button:hover {
            background-color: #45a049;
        }

        /* Slogan styles */
        .slogan {
            text-align: center;
            margin-bottom: 20px;
        }

        .slogan h1 {
            color: #333;
            font-size: 36px;
        }

        /* Story styles */
        .story {
            text-align: center;
            margin-bottom: 40px;
        }

        .story h4 {
            color: #666;
            font-size: 24px;
        }

        /* Owner data styles */
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        /* Logout button styles */
        .logout-button {
            background-color: #f44336;
        }

        .logout-button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <div class="top-bar">
            <div>Automotive Service</div> <!-- Text on the left side -->
        </div>
    </header>
    <div class="middleMan">
        <div class="menu">
            <form action="" method="POST">
                <ul>
                    <li>
                        <a href="profile_tab.php">
                            <img src="../img/service.png" alt="Service">
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </form>
        </div>
    </div>

    <div class="lowClass">
        <div class="slogan">
            <h1>Care For Your Beast</h1>
        </div>
        <div class="story">
            <h4>...she'll take you wherever you want</h4>
        </div>

        <!-- Display OwnerID from Session -->
        <div class="button-container">
            <?php echo $ownerData; ?>

            <form action="../pages/displaycarinfo.php" method="post">
                <input type="submit" class="register-button" value="Display Car info" />
            </form>

            <form action="../pages/update_car_info.php" method="post">
                <input type="submit" class="register-button" value="Update Car info" />
            </form>

            <!-- Logout Button -->
            <form action="" method="post">
                <input type="submit" class="register-button logout-button" name="logout" value="Logout" />
            </form>
        </div>
    </div>

</body>
</html>
