<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Car Information</title>
    <style>
        /* Global styles */
        body {
            background: linear-gradient(to top, rgba(0,0,0,0.5) 50%, rgba(0,0,0,0.5) 50%), url(backviewM4.jpg);
            background-size: cover;
            background-position: center;
            justify-content: center; /* Center content horizontally */
            align-items: center;
            min-height: 100vh;
            /* Apply blur effect */
            margin: 0;
            font-family: Arial, sans-serif;
        }

        /* Top bar styles */
        .top-bar {
            background-color: rgba(0, 0, 0, 0.5); /* Transparent background */
            color: white; /* Text color */
            font-size: x-large;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Form styles */
        #form {
            background-color: rgba(255, 255, 255, 0.48);
            max-width: 370px;
            padding: 3% 5%;
            box-shadow: 10px 10px 5px rgb(82, 11, 11);
            border-radius: 5px;
            color: rgb(48, 51, 55);
            margin: 0 auto;
            width: 40%;
        }

        #form h1 {
            margin-top: 0;
            text-align: center;
            font-style: oblique;
            color: black;
        }

        #form h3 {
            color: white;
            text-align: left;
            font-size: medium;
            font-style: oblique;
        }

        #form input[type="text"],
        #form input[type="number"],
        #form input[type="date"],
        #form input[type="datetime-local"] {
            width: calc(100% - 20px); /* Adjust width */
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-left: 10px; /* Adjust margin */
            font-size: 16px; /* Adjust font size */
        }

        #form input[type="submit"] {
            color: white;
            background-color: rgb(64, 124, 209);
            padding: 16px 24px; /* Increase padding */
            font-size: 18px; /* Increase font size */
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: block;
            margin: 0 auto;
            width: 120px; /* Set a specific width */
        }

        #form input[type="submit"]:hover {
            background-color: rgb(34, 94, 169);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div id="form">
        <h1>Add Car Information</h1>
        <form action="../scripts/registerCar.php" method="post">
            <label for="carVinNumber">VIN Number:</label>
            <input type="text" id="carVinNumber" name="carVinNumber" required><br>

            <label for="make">Make:</label>
            <input type="text" id="make" name="make" required><br>

            <label for="licensePlate">License Plate:</label>
            <input type="text" id="licensePlate" name="licensePlate" required><br>

            <label for="carModel">Car Model:</label>
            <input type="text" id="carModel" name="carModel" required><br>

            <label for="color">Color:</label>
            <input type="text" id="color" name="color" required><br>

            <label for="yearBought">Year Model:</label>
            <input type="number" id="yearBought" name="yearBought" required><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
