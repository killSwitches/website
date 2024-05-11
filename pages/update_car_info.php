<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Car Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
            background-color: #f7f7f7;
        }
        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 12px;
        }
        th {
            background-color: #f2f2f2;
        }
        input[type="text"],
        input[type="number"] {
            padding: 10px;
            width: calc(100% - 20px); /* Adjusted padding width */
            box-sizing: border-box; /* Include padding in width */
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        input[type="submit"],
        button {
            padding: 12px 24px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover,
        button:hover {
            background-color: #0056b3;
        }
        button {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Update Car Information</h2>

    <?php
    session_start();

    if (isset($_SESSION['OwnerID'])) {
        $ownerID = $_SESSION['OwnerID'];

        $servername = "sql11.freesqldatabase.com"; // Change to your database host
    $dbname = "sql11701255"; // Change to your database name
    $username = "sql11701255"; // Change to your database username
    $password = "y4bq5IUQaq"; // Change to your database password

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM `Car` WHERE OwnerID = '$ownerID'";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<form method='post' action=''>";
            echo "<table>";
            echo "<tr><th>Car VIN Number</th><th>License Plate</th><th>Make</th><th>Model</th><th>Color</th><th>Year Model</th><th>Action</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["carVinNumber"]) . "</td>";
                echo "<td><input type='text' name='licensePlate[]' value='" . htmlspecialchars($row["licensePlate"]) . "'></td>";
                echo "<td><input type='text' name='make[]' value='" . htmlspecialchars($row["make"]) . "'></td>";
                echo "<td><input type='text' name='model[]' value='" . htmlspecialchars($row["model"]) . "'></td>";
                echo "<td><input type='text' name='color[]' value='" . htmlspecialchars($row["color"]) . "'></td>";
                echo "<td><input type='number' name='yearModel[]' value='" . htmlspecialchars($row["yearModel"]) . "'></td>";
                echo "<td><input type='hidden' name='carVinNumber[]' value='" . htmlspecialchars($row["carVinNumber"]) . "'>";
                echo "<input type='submit' name='update' value='Update'></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</form>";

            echo "<a href='../pages/clienthomepage.php'><button>Go Back to Home</button></a>";

            if (isset($_POST['update'])) {
                $carVinNumbers = $_POST['carVinNumber'];
                $licensePlates = $_POST['licensePlate'];
                $makes = $_POST['make'];
                $models = $_POST['model'];
                $colors = $_POST['color'];
                $yearModels = $_POST['yearModel'];

                for ($i = 0; $i < count($carVinNumbers); $i++) {
                    $carVinNumber = $carVinNumbers[$i];
                    $licensePlate = $licensePlates[$i];
                    $make = $makes[$i];
                    $model = $models[$i];
                    $color = $colors[$i];
                    $yearModel = $yearModels[$i];

                    $updateSql = "UPDATE `Car` SET licensePlate='$licensePlate', make='$make', model='$model', color='$color', yearModel='$yearModel' WHERE carVinNumber='$carVinNumber'";
                    if ($conn->query($updateSql) !== TRUE) {
                        echo "Error updating record: " . $conn->error;
                    }
                }

                echo "<p>Car information updated successfully!</p>";
            }
        } else {
            echo "<p>No cars found for the logged-in owner.</p>";
        }

        $conn->close();
    } else {
        echo "<p>OwnerID not found in session.</p>";
    }
    ?>
</body>
</html>
